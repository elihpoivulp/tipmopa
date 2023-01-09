<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to
                                        Your <?= getenv('app.name'); ?> Account</h5>
                                </div>
                                <form class="row g-3 needs-validation" novalidate method="post" action="<?= url_to('login'); ?>">
                                    <?php if ($success_message): ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="bi bi-check-circle me-1"></i>
                                            <?= $success_message; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($login_error): ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <?= $login_error; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    <?= csrf_field(); ?>
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="email" class="form-control" id="email"
                                                   required value="<?= $email; ?>" maxlength="70" minlength="7">
                                            <div class="invalid-feedback">Please enter your email.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword"
                                               required maxlength="255" minlength="8">
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>
                                    <br>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Don't have account? <a href="<?= url_to('register'); ?>">Create an account</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>