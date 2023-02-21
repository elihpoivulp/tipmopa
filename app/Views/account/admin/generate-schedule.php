<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section dashboard">
        <div class="container">
            <section class="section register d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <?php if(session()->has('status')): ?>
                                <div class="alert alert-<?= session()->get('status'); ?> alert-dismissible fade show"
                                     role="alert"><?= session()->get('message'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <div class="card mb-3">
                                <div class="card-body pt-4">
                                    <p><strong>Generate schedule for today.</strong></p>
                                    <form class="row g-3 needs-validation pt-4 pb-2" novalidate method="post"
                                          action="<?= url_to('admin-generate-schedule-action'); ?>">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="type" value="today">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary w-100"
                                                    type="submit" <?= $has_schedule ? 'disabled' : ''; ?>>Generate
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <p><strong>Or generate future schedules.</strong></p>
                                    <form class="row g-3 needs-validation pt-4 pb-2" novalidate method="post"
                                          action="<?= url_to('admin-generate-schedule-action'); ?>">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="type" value="range">
                                        <div class="col-12">
                                            <label for="start_date" class="col-form-label">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date">
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="end_date" class="col-form-label">End Date</label>
                                            <input type="date" class="form-control mb-2" id="end_date" name="end_date">
                                            <small class="text-muted">
                                                <strong>Optional.</strong> Select only if you want to generate schedules
                                                within a range of dates.
                                            </small>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Generate</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</main>
