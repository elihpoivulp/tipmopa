<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Customer Information</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Information</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Customer Information</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['name']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['email']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['address']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Contact Number</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['contact_number']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['gender'] == 'M' ? 'Male' : 'Female'; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Weight</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['weight']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Height</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['height']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Age</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['age']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">GCash Account Name</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['gcash_account_name']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">GCash Account Number</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['gcash_account_number']; ?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Emergency Contact Person's Name</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['emergency_contact_person']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Emergency Contact Person's Phone Number</div>
                                    <div class="col-lg-9 col-md-8"><?= $customer['emergency_contact_person_contact_number']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Account Created At</div>
                                    <div class="col-lg-9 col-md-8"><?= extract_date($customer['created_at']); ?></div>
                                </div>
                            </div>
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <form>
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="name"
                                                   value="<?= $customer['name']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="text" class="form-control" id="email"
                                                   value="<?= $customer['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="address"
                                                   value="<?= $customer['address']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="gender" class="col-form-label">Gender</label>
                                            <select id="gender" class="form-select" name="gender">
                                                <option value="m" <?= $customer['gender'] == 'm' ? 'selected' : ''; ?>>
                                                    Male
                                                </option>
                                                <option value="f" <?= $customer['gender'] == 'f' ? 'selected' : ''; ?>>
                                                    Female
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="weight" class="col-form-label">Weight</label>
                                            <input
                                                    value="<?= $customer['weight']; ?>"
                                                    type="number"
                                                    name="weight"
                                                    class="form-control"
                                                    id="weight"
                                                   >
                                            <div class="invalid-feedback">Please enter your weight!</div>
                                        </div>
                                        <div class="col">
                                            <label for="age" class="col-form-label">Age</label>
                                            <input
                                                    value="<?= $customer['age']; ?>"
                                                    type="number"
                                                    name="age"
                                                    class="form-control"
                                                    id="age"
                                                   >
                                            <div class="invalid-feedback">Please enter your age!</div>
                                        </div>
                                        <div class="col">
                                            <label for="height" class="col-form-label">Height</label>
                                            <input
                                                    value="<?= $customer['height']; ?>"
                                                    type="number"
                                                    name="height"
                                                    class="form-control"
                                                    id="height"
                                                   >
                                            <div class="invalid-feedback">Please enter your height!</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="contactNo" class="col-form-label">Contact Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="contactNo" type="text" class="form-control" id="contactNo"
                                                       value="<?= $customer['contact_number']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="gCashNo" class="col-form-label">GCash Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="gCashNo" type="text" class="form-control" id="gCashNo"
                                                       value="<?= $customer['gcash_account_number']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="row mb-3">
                                        <label for="emergencyContactPerson" class="col-md-4 col-lg-3 col-form-label">Emergency
                                            Contact Person</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="emergencyContactPerson" type="text" class="form-control"
                                                   id="emergencyContactPerson"
                                                   value="<?= $customer['emergency_contact_person']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="emergencyContactNo" class="col-md-4 col-lg-3 col-form-label">Emergency
                                            Contact Number</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="emergencyContactNo" type="text" class="form-control"
                                                   id="emergencyContactNo"
                                                   value="<?= $customer['emergency_contact_person_contact_number']; ?>">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>