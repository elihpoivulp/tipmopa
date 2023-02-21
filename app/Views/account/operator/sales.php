<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sales today</h5>
                        <div id="pieChart1"></div>
                    </div>
                    <div class="card-footer">
                        <p><strong>Total</strong>: <?= peso_sign() . ' ' . array_sum($sales_today) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sales All Time</h5>
                        <div id="pieChart2"></div>
                    </div>
                    <div class="card-footer">
                        <p><strong>Total</strong>: <?= peso_sign() . ' ' . array_sum($sales_alltime) ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Sales</h5>
                        <div id="monthly"></div>
                    </div>
                    <div class="card-footer">
                        <p><strong>Total</strong>: <?= peso_sign() . ' ' . array_sum(array_column($monthly, 'payment')) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#pieChart1"), {
            series: [<?= implode(',', array_values($sales_today)); ?>],
            chart: {
                height: 350,
                type: 'pie',
                toolbar: {
                    show: true
                }
            },
            labels: [<?= '"' . implode('", "', array_keys($sales_today)) . '"'; ?>],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "<?= peso_sign(); ?> " + val + " pesos"
                    }
                }
            }
        }).render();
        new ApexCharts(document.querySelector("#pieChart2"), {
            series: [<?= implode(',', array_values($sales_alltime)); ?>],
            chart: {
                height: 350,
                type: 'pie',
                toolbar: {
                    show: true
                }
            },
            labels: [<?= '"' . implode('", "', array_keys($sales_alltime)) . '"'; ?>],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "<?= peso_sign(); ?> " + val + " pesos"
                    }
                }
            }
        }).render();
        new ApexCharts(document.querySelector("#monthly"), {
            series: [{
                name: 'Profit',
                data: [<?= implode(',', array_column($monthly, 'payment')); ?>]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "<?= peso_sign(); ?> " + val + " pesos"
                    }
                }
            }
        }).render();
    });
</script>