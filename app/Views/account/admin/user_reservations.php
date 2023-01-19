<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section dashboard">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Reservations <span>| <?= $today ? 'Today' : 'All Time'; ?></span></h5>
                    <table class="table table-borderless datatable" id="allow-export">
                        <thead>
                        <tr>
                            <th scope="col">Ref #</th>
                            <th scope="col">Boat</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($reservations)): ?>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr>
                                    <th scope="row"><a href="#"><?= $reservation['reference_no']; ?></a></th>
                                    <td><?= $reservation['boat_name']; ?></td>
                                    <td><?= $reservation['customer_name']; ?></td>
                                    <td><?= extract_date($reservation['created_at']); ?></td>
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
                <div class="card-footer text-end">
                    <?php if ($today): ?>
                        <a href="<?= current_url() . '?today=false'; ?>">See all</a>
                    <?php else: ?>
                        <a href="<?= current_url(); ?>">Remove filter</a>
                    <?php endif; ?>
                </div>
                <div class="card-footer d-sm-none d-md-block">
                    <button class="btn btn-success" id="export-table">Export CSV</button>
                </div>
            </div>
        </div>
    </section>
</main>

