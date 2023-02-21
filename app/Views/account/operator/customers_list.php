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
                            <th>Ref No.</th>
                            <th>Customer</th>
                            <th>Payment</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Date</th>
                            <th>Receipt</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($customers): ?>
                            <?php foreach ($customers as $customer): ?>
                                <tr>
                                    <th scope="row"><a href="#"><?= $customer['reference_no']; ?></a></th>
                                    <td><a href="#"><?= $customer['customer']; ?></a></td>
                                    <td>₱ <?= $customer['payment']; ?></td>
                                    <td><?= $customer['origin']; ?></td>
                                    <td><?= $customer['destination']; ?></td>
                                    <td><?= date_format(date_create($customer['schedule_date']), 'F j, o',); ?></td>
                                    <td>
                                        <a target="_blank"
                                           href="<?= base_url('uploads/receipts/' . $customer['receipt_img']); ?>">
                                            <?= substr($customer['receipt_img'], 1, 10,) . (strlen($customer['receipt_img']) > 10 ? '..' : ''); ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-sm-none d-md-block">
                        <button class="btn btn-success float-start" id="export-table" data-exclude-columns="actions">
                            Export CSV
                        </button>
                    </div>
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