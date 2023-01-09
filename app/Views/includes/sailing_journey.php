<?php $operator = $operator ?? false; ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Sailing Journey <span><?= date('H:i a', time()); ?></span></h5>
            <div class="activity">
                <div class="activity-item d-flex">
                    <div class="activite-label"><?= extract_time($sailing_data['date_departed']); ?></div>
                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                    <div class="activity-content text-muted" style="width: 70%">
                        <?= $started_at['name']; ?>
                    </div>
                    <a href="javascript:void(0);" disabled class="text-muted">Departed</a>
                </div>
                <?php foreach ($locations as $location): ?>
                    <div class="activity-item d-flex">
                        <div class="activite-label">
                            <?php
                            if (array_key_exists($location['id'], $date_arrival_assignment)) {
                                echo extract_time($sailing_data[$date_arrival_assignment[$location['id']]]);
                            }
                            ?>
                        </div>
                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                        <div class="activity-content" style="width: 70%">
                            <?= $location['name']; ?>
                        </div>
                        <?php if ($operator): ?>
                            <?php if (array_key_exists($location['id'], $date_arrival_assignment)): ?>
                                <a href="javascript:void(0);" class="text-muted" disabled>Arrived</a>
                            <?php else: ?>
                                <a href="<?= url_to('operator-schedule-set-arrived') . '?location_id=' . $location['id'] . '&sail_id=' . session()->get('sailing_boat_data')['id']; ?>">Arrived</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if (array_key_exists($location['id'], $date_arrival_assignment)): ?>
                                <p>Arrived</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>