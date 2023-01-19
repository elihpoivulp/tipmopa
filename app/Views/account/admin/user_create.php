<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section dashboard">
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form class="row g-3 needs-validation pt-4 pb-2" novalidate method="post"
                                          action="<?= url_to('admin-users-register'); ?>">
                                        <?= csrf_field(); ?>
                                        <?php if ($account_creation_error): ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <i class="bi bi-exclamation-triangle me-1"></i>
                                                <?= $account_creation_error; ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" id="name" required
                                                   maxlength="70" minlength="2">
                                            <div class="invalid-feedback">Please enter your name!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" required
                                                   maxlength="70" minlength="7">
                                            <div class="invalid-feedback">Please enter a valid email address!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="email" name="address" class="form-control" id="address" required
                                                   maxlength="255" minlength="2">
                                            <div class="invalid-feedback">Please enter your address!</div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select name="gender" id="gender" required class="form-select">
                                                    <option selected disabled value="">Select Gender</option>
                                                    <option value="m">Male</option>
                                                    <option value="f">Female</option>
                                                </select>
                                                <div class="invalid-feedback">Please select your gender!</div>
                                            </div>
                                            <div class="col">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="number" name="age" id="age" required class="form-control">
                                                <div class="invalid-feedback">Please enter your age!</div>
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col">
                                                <label for="weight" class="form-label">Weight</label>
                                                <input type="number" name="weight" id="weight" required class="form-control"
                                                       step="any">
                                                <div class="invalid-feedback">Please enter your weight!</div>
                                            </div>
                                            <div class="col">
                                                <label for="height" class="form-label">Height</label>
                                                <input type="number" name="height" id="height" required class="form-control"
                                                       step="any">
                                                <div class="invalid-feedback">Please enter your height!</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="contact_number" class="form-label">Contact Number</label>
                                            <input type="tel" name="contact_number" id="contact_number" required
                                                   class="form-control" pattern="[0-9]+{11,13}" maxlength="13"
                                                   minlength="11">
                                            <div class="invalid-feedback">Please enter your contact number!</div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <label for="password1" class="form-label">Password</label>
                                            <input type="password" name="password1" class="form-control" id="password1"
                                                   required maxlength="255" minlength="8">
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="password2" class="form-label">Confirm Password</label>
                                            <input type="password" name="password2" class="form-control" id="password2"
                                                   required maxlength="255" minlength="8">
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <label for="emergency_contact_person" class="form-label">Emergency Contact
                                                Person</label>
                                            <input type="text" name="emergency_contact_person" class="form-control"
                                                   id="emergency_contact_person"
                                                   required maxlength="70" minlength="2">
                                            <div class="invalid-feedback">Please enter your emergency contact person!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="emergency_contact_person_contact_number" class="form-label">Emergency
                                                Contact Person's Contact Number</label>
                                            <input type="tel" name="emergency_contact_person_contact_number"
                                                   class="form-control" id="emergency_contact_person_contact_number"
                                                   required pattern="[0-9]+{11,13}" maxlength="13" minlength="11">
                                            <div class="invalid-feedback">Please enter your emergency contact person's
                                                contact number!
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Save</button>
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
