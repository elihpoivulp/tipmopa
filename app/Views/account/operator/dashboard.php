<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Reservations <span>| Today</span></h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th>Ref No.</th>
                                        <th>Customer</th>
                                        <th>Payment</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Date</th>
                                        <th>Receipt</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($reservations): ?>
                                        <?php foreach ($reservations as $reservation): ?>
                                            <tr>
                                                <th scope="row"><a href="#"><?= $reservation['reference_no']; ?></a></th>
                                                <td><a href="#"><?= $reservation['customer']; ?></a></td>
                                                <td>₱ <?= $reservation['payment']; ?></td>
                                                <td><?= $reservation['origin']; ?></td>
                                                <td><?= $reservation['destination']; ?></td>
                                                <td><?= date_format(date_create($reservation['schedule_date']), 'F j, o',); ?></td>
                                                <td>
                                                    <a target="_blank" href="<?= base_url('uploads/receipts/' . $reservation['receipt_img']); ?>">
                                                        <?= substr($reservation['receipt_img'], 1, 10,) . (strlen($reservation['receipt_img']) > 10 ? '..' : ''); ?>
                                                    </a>
                                                </td>
                                                <td class="text-left">
                                                    <form action="<?= url_to('operator-reserve-accept'); ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="reservation_id" value="<?= $reservation['reservation_id']; ?>">
                                                        <input type="hidden" name="customer_id" value="<?= $reservation['customer_id']; ?>">
                                                        <input type="hidden" name="reference_no" value="<?= $reservation['reference_no']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-link">Accept</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <?= $journey; ?>
                    <?php if ($minutes <= 302): ?>
                        <div class="col-md-12">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <div class="card-title"><i class="bi bi-exclamation-triangle"></i> Important</div>
                                    <p><strong>You have an incoming schedule (in <?= $minutes; ?> minutes)</strong></p>
                                    <p>Destination: <?= get_location($upcoming['origin']); ?></p>
                                    <p>Departure:
                                        <?php
                                        $start = 'tti_start';
                                        if ($upcoming['departed_1']) {
                                            $start = 'itt_start';
                                        }
                                        echo date('h:i A', strtotime($upcoming[$start]));
                                        ?>
                                    </p>
                                    <p>ETA: <?= date('h:i A', strtotime($upcoming[str_replace('start', 'end', $start)])); ?></p>
                                    <?php if ($minutes <= 522): ?>
                                        <form action="<?= url_to('operator-schedule-set-status'); ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $upcoming['schedule_id'];?>">
                                            <input type="hidden" name="status" value="1">
                                            <input type="hidden" name="depart_type" value="<?= $upcoming['origin'] ? 'departed_1' : 'departed_2'; ?>">
                                            <button type="submit" class="btn btn-link p-0">Click to set status to Departed</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Sales <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                        <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Revenue <span>| This Month</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>$3,264</h6>
                                        <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>