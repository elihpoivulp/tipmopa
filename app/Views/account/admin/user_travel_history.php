<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Travel History of <?= ucfirst($user_name); ?></span></h5>
                    <table class="table table-borderless datatable">
                        <thead>
                        <tr>
                            <th scope="col">Reference #</th>
                            <th scope="col">Origin</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Boat</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($trips as $trip): ?>
                            <tr>
                                <th scope="row"><?= $trip['reference_no']; ?></th>
                                <td><?= $trip['origin']; ?></td>
                                <td><?= $trip['destination']; ?></td>
                                <td><?= $trip['boat_name']; ?></td>
                                <td><?= $trip['schedule_date']; ?></td>
                                <td><?= implode(' - ', array_map(function ($t) {
                                        return extract_time($t);
                                    }, explode('-', $trip['time']))); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-sm-none d-md-block">
                        <button class="btn btn-success float-start" id="export-table" data-exclude-columns="actions">Export CSV</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>