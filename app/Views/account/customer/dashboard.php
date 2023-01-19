<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-4">
                <?= $journey; ?>
                <div class="row">
                        <?php if ($minutes && (!empty($my_upcoming)) && $my_upcoming['boarded'] == 0 && $my_upcoming['accepted'] == 1): ?>
                        <div class="col-md-12">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <div class="card-title"><i class="bi bi-exclamation-triangle"></i> Important</div>
                                    <p><strong>You have an incoming schedule (in <?= $minutes; ?> minutes)</strong></p>
                                    <p>Destination: <?= get_location($my_upcoming['origin']); ?></p>
                                    <p>Departure:
                                        <?php
                                        $start = 'tti_start';
                                        if ($my_upcoming['departed_1']) {
                                            $start = 'itt_start';
                                        }
                                        echo date('h:i A', strtotime($my_upcoming[$start]));
                                        ?>
                                    </p>
                                    <p>ETA: <?= date('h:i A', strtotime($my_upcoming[str_replace('start', 'end', $start)])); ?></p>
                                    <form action="<?= url_to('customer-schedule-set-status'); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="reservation_id" value="<?= $my_upcoming['reservation_id'];?>">
                                        <input type="hidden" name="type" value="boarded">
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-link p-0">Click to set status to Boarded</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Your Scheduled Trips <span>| Today</span></h5>
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th scope="col">Ref #</th>
                                    <th scope="col">Boat</th>
                                    <th scope="col">Departure</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($reservations)): ?>
                                    <?php foreach ($reservations as $reservation): ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $reservation['reference_no']; ?></a></th>
                                            <td><a href="#" class="text-primary"><?= $reservation['boat_name']; ?></a>
                                            </td>
                                            <td>
                                                <?php
                                                $start = 'tti_start';
                                                if ($reservation['departed_1']) {
                                                    $start = 'itt_start';
                                                }
                                                echo date('h:i A', strtotime($reservation[$start]));
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $color = 'warning';
                                                $msg = 'Pending';
                                                if ($reservation['accepted'] == 1 and $reservation['fulfilled'] == 0) {
                                                    $color = 'primary';
                                                    $msg = 'Paid';
                                                }
                                                if ($reservation['boarded'] == 1 and $reservation['fulfilled'] ==   0) {
                                                    $color = 'info';
                                                    $msg = 'Boarded';
                                                }
                                                if ($reservation['accepted'] == 1 and $reservation['fulfilled'] ==   1) {
                                                    $color = 'success';
                                                    $msg = 'Fulfilled';
                                                }
                                                ?>
                                                <span class="badge bg-<?= $color; ?>"><?= $msg; ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">
                                            No reservations found
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="filter">
                            <small style="margin-right: 20px"><a href="">Reserve future trips</a></small>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Schedule <span>| Today</span></h5>
                            <h6>Going to <?= get_location(1); ?></h6>
                            <br>
                            <div class="activity">
                                <?php foreach ($itt as $trip): ?>
                                    <div class="activity-item d-flex">
                                        <div class="activite-label"><?= date('h:i a', strtotime($trip['itt_start'])); ?></div>
                                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                        <div class="activity-content" style="width: 70%">
                                            <?= $trip['boat_name'] ?>
                                        </div>
                                        <?php if ($trip['departed_2'] != 1): ?>
                                            <?php if (in_array($trip['schedule_id'], $reservation_columns)): ?>
                                                Reserved
                                            <?php else: ?>
                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                   data-bs-target="#select_origin_modal" class="open-sel-origin-modal"
                                                   data-schedule-id="<?= $trip['schedule_id'] ?>">Reserve</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <hr class="mt-4">
                            <h6>Going to <?= get_location(); ?></h6>
                            <br>
                            <div class="activity">
                                <?php foreach ($tti as $trip): ?>
                                    <div class="activity-item d-flex">
                                        <div class="activite-label"><?= date('h:i a', strtotime($trip['tti_start'])); ?></div>
                                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                        <div class="activity-content" style="width: 70%">
                                            <?= $trip['boat_name'] ?>
                                        </div>
                                        <?php if ($trip['departed_1'] != 1): ?>
                                            <?php if (in_array($trip['schedule_id'], $reservation_columns)): ?>
                                                Reserved
                                            <?php else: ?>
                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                   data-bs-target="#select_destination_modal" class="open-sel-dest-modal"
                                                   data-schedule-id="<?= $trip['schedule_id'] ?>">Reserve</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card info-card revenue-card">
                            <?php if($scheduled): ?>
                                <?php foreach ($scheduled as $upcoming): ?>
                                    <div class="card-body">
                                        <h5 class="card-title">Departing
                                            <!--                                        in --><?php //= floor((strtotime($upcoming[$upcoming['origin'] ? 'tti_start' : 'itt_start']) - time()) / 60); ?>
<!--                                            in --><?php //= $upcoming['for_tomorrow'] ? get_time_diff(strtotime(date('Y-m-d H:i:s')), strtotime(date_format(date_add(date_create(date('Y-m-d') . ' ' . $upcoming['itt_start']), date_interval_create_from_date_string('1 day')), 'Y-m-d H:i:s'))) : get_time_diff(strtotime($upcoming[$upcoming['origin'] ? 'tti_start' : 'itt_start'])); ?>
                                            in <?= get_time_diff(strtotime($upcoming[$upcoming['origin'] ? 'tti_start' : 'itt_start'])); ?>
                                            minutes</h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="ri-sailboat-fill"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6>Going to <?= get_location(!$upcoming['origin']); ?></h6>
                                                        <?php if ($upcoming['origin']): ?>
                                                            <?php if (in_array($upcoming['schedule_id'], $reservation_columns)): ?>
                                                                Reserved
                                                            <?php else: ?>
                                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                   data-bs-target="#select_destination_modal" class="open-sel-dest-modal"
                                                                   data-schedule-id="<?= $upcoming['schedule_id'] ?>">Reserve a seat</a>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php if (in_array($upcoming['schedule_id'], $reservation_columns)): ?>
                                                                Reserved
                                                            <?php else: ?>
                                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                   data-bs-target="#select_origin_modal" class="open-sel-origin-modal"
                                                                   data-schedule-id="<?= $upcoming['schedule_id'] ?>">Reserve a seat</a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 mt-3 mt-md-0">
                                                <strong class="h5">Boat information</strong>
                                                <div class="mt-2">
                                                    <div class="row g-1">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-lg-5 col-md-4 col-5 label"><strong>Boat
                                                                        Name</strong></div>
                                                                <div class="col-lg-7 col-md-8 col-7"><?= $upcoming['boat_name']; ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-lg-5 col-md-4 col-5 label">
                                                                    <strong>License</strong></div>
                                                                <div class="col-lg-7 col-md-8 col-7"><?= $upcoming['license']; ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-lg-5 col-md-4 col-5 label">
                                                                    <strong>Operator</strong></div>
                                                                <div class="col-lg-7 col-md-8 col-7"><?= $upcoming['operator']; ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-lg-5 col-md-4 col-5 label">
                                                                    <strong>Schedule</strong></div>
                                                                <div class="col-lg-7 col-md-8 col-7"><?= $upcoming['origin'] ? date('h:i a', strtotime($upcoming['tti_start'])) . ' - ' . date('h:i a', strtotime($upcoming['tti_end'])) : date('h:i a', strtotime($upcoming['itt_start'])) . ' - ' . date('h:i a', strtotime($upcoming['itt_end'])); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mt-4">
                                                <img src="<?= base_url('assets/img/' . $upcoming['boat_img']); ?>"
                                                     alt="<?= $upcoming['boat_name']; ?>" class="rounded img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="card-body">
                                    <div class="card-title">
                                        <p>No scheduled trips.</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<div class="modal fade" id="select_destination_modal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <form class="modal-content" id="select_destination_form" data-submit-url="<?= url_to('customer-dashboard'); ?>">
            <input type="hidden" name="type" value="departed_1">
            <div class="modal-header">
                <h5 class="modal-title">Select Destination</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="travel_type" value="in">
                    <div class="col-12">
                        <label for="location" class="form-label">Select Location</label>
                        <select name="location" id="location" required class="form-select">
                            <option selected disabled value="">Select Location</option>
                            <?php foreach ($locations as $location): ?>
                                <?php if ($location['name'] !== 'Terminal'): ?>
                                    <option value="<?= $location['id']; ?>"><?= $location['name']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Proceed</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="select_origin_modal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <form class="modal-content" id="select_origin_form" data-submit-url="<?= url_to('customer-dashboard'); ?>">
            <input type="hidden" name="type" value="departed_2">
            <div class="modal-header">
                <h5 class="modal-title">Select Origin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="travel_type" value="out">
                    <div class="col-12">
                        <label for="location" class="form-label">Select Location</label>
                        <select name="location" id="location" required class="form-select">
                            <option selected disabled value="">Select Location</option>
                            <?php foreach ($locations as $location): ?>
                                <?php if ($location['name'] !== 'Terminal'): ?>
                                    <option value="<?= $location['id']; ?>"><?= $location['name']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Proceed</button>
            </div>
        </form>
    </div>
</div>
