<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section dashboard">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title"><?= ucfirst($active); ?> <span>| <?= ucfirst($sub); ?></span></h5>
                    <table class="table table-borderless datatable">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact #</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($user_list as $user): ?>
                            <tr>
                                <th scope="row"><?= $user['name']; ?></th>
                                <td><?= $user['address']; ?></td>
                                <td><?= $user['contact_number']; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="<?= url_to('admin-users-info', $user['id']); ?>">See User Details</a></li>
                                            <li><a class="dropdown-item" href="<?= url_to('admin-users-travel-history', $user['id']); ?>">See Travel History</a></li>
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><span class="text-danger">Delete</span></a></li>
                                        </ul>
                                    </div>
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
                    <a href="<?= url_to('admin-users-register'); ?>" class="btn float-end btn-primary">Create New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Customers</h5>
                        <div id="columnChart"></div>
                    </div>
                    <div class="card-footer">
                        <p>
                            <strong>Total</strong>: <?= $total_customers; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#columnChart"), {
            series: [
                <?php foreach ($monthly_customers as $loc => $stat): ?>
                <?php array_walk($stat, function(&$a) { $a = array_sum(array_column($a, 'count')); }); ?>
                {
                    name: '<?= $loc; ?>',
                    data: [<?= implode(', ', $stat); ?>]
                },
                <?php endforeach; ?>
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            yaxis: {
                title: {
                    text: 'Customers'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " customers"
                    }
                }
            }
        }).render();
    });
</script>