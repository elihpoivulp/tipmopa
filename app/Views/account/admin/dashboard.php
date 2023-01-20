<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
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
                                        <th scope="col">Schedule</th>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Sales <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= peso_sign() . ' ' . $total_sales_today; ?></h6>
                                        <span class="text-muted small pt-2 ps-1"><a href="#">See History</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Customers <span>| Today</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $total_customers_today; ?></h6>
                                        <span class="text-muted small pt-2 ps-1"><a href="#">See History</a></span>
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
