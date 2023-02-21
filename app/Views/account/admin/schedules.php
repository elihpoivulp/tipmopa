<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Schedule <span>| Today</span></h5>
                        <table class="table table-borderless datatable">
                            <thead>
                            <tr>
                                <th scope="col">License</th>
                                <th scope="col">Boat Name</th>
                                <th scope="col">Operator</th>
                                <th scope="col">Origin</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($itt as $item): ?>
                                <tr>
                                    <th scope="row"><?= $item['license']; ?></th>
                                    <td><?= $item['boat_name']; ?></td>
                                    <td><?= $item['operator']; ?></td>
                                    <td><?= $item['origin_location']; ?></td>
                                    <td><?= $item['destination_location']; ?></td>
                                    <td><?= extract_date($item['schedule_date']); ?></td>
                                    <td>
                                        <?php if ($item['origin'] == 1): ?>
                                            <?= extract_time($item['itt_start']) . ' - ' . extract_time($item['itt_end']);  ?>
                                        <?php else: ?>
                                            <?= extract_time($item['tti_start']) . ' - ' . extract_time($item['tti_end']);  ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($item['departed_2'] != 1): ?>
                                            <span class="badge bg-primary">Queued</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Fulfilled</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php foreach ($tti as $item): ?>
                                <tr>
                                    <th scope="row"><?= $item['license']; ?></th>
                                    <td><?= $item['boat_name']; ?></td>
                                    <td><?= $item['operator']; ?></td>
                                    <td><?= $item['origin_location']; ?></td>
                                    <td><?= $item['destination_location']; ?></td>
                                    <td><?= extract_date($item['schedule_date']); ?></td>
                                    <td>
                                        <?php if ($item['origin'] != 1): ?>
                                            <?= extract_time($item['itt_start']) . ' - ' . extract_time($item['itt_end']);  ?>
                                        <?php else: ?>
                                            <?= extract_time($item['tti_start']) . ' - ' . extract_time($item['tti_end']);  ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($item['departed_1'] != 1): ?>
                                            <span class="badge bg-primary">Queued</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Fulfilled</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="d-sm-none d-md-block">
                            <button class="btn btn-success float-start" id="export-table" data-exclude-columns="actions">Export CSV</button>
                        </div>
                        <?php if ($filtered): ?>
                            <a href="<?= url_to('admin-schedules'); ?>" class="btn float-end btn-primary">Show Today Only</a>
                        <?php else: ?>
                            <a href="<?= url_to('admin-schedules'); ?>?all_time=true" class="btn float-end btn-primary">Show All Time</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
