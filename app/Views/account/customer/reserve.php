<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column">
                        <strong class="h5">Reservation Details</strong>
                        <?php if (session()->has('reserve-error')): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                <?= session()->get('reserve-error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="mt-2">
                            <div class="row g-1">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-5 label"><strong>Origin</strong></div>
                                        <div class="col-lg-7 col-md-8 col-7"><?= $origin; ?></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-5 label"><strong>Destination</strong></div>
                                        <div class="col-lg-7 col-md-8 col-7"><?= $destination; ?></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-5 label"><strong>Date</strong></div>
                                        <div class="col-lg-7 col-md-8 col-7"><?= date('F j, o', strtotime($trip_info['schedule_date'])); ?></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-5 label"><strong>Departure</strong></div>
                                        <div class="col-lg-7 col-md-8 col-7">
                                            <?php
                                            $start = 'tti_start';
                                            if ($depart_type === 'departed_2') {
                                                $start = 'itt_start';
                                            }
                                            echo date('h:i A', strtotime($trip_info[$start]));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-5 label"><strong>ETA</strong></div>
                                        <div class="col-lg-7 col-md-8 col-7"><?= date('h:i A', strtotime($trip_info[str_replace('start', 'end', $start)])); ?></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-5 label"><strong>Slot</strong></div>
                                        <div class="col-lg-7 col-md-8 col-7">For 1 only</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-5 label"><strong>Cost</strong></div>
                                        <div class="col-lg-7 col-md-8 col-7">
                                             <?= peso_sign() . ' ' . $location['fare_price_in_peso']; ?></div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary external-trigger"
                                                data-target-panel="payment-tab-nav">Continue to Payment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
                                    Boat
                                    Information
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#payment-tab"
                                        id="payment-tab-nav">
                                    Payment
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings"
                                        id="edit-info-tab-nav">
                                    Profile Information
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Boat information</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Boat Name</div>
                                    <div class="col-lg-9 col-md-8"><?= $trip_info['boat_name']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">License Number</div>
                                    <div class="col-lg-9 col-md-8"><?= $trip_info['license']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Operator</div>
                                    <div class="col-lg-9 col-md-8"><?= $trip_info['operator']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Contact Number</div>
                                    <div class="col-lg-9 col-md-8"><?= $trip_info['contact_number']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Passenger Capacity</div>
                                    <div class="col-lg-9 col-md-8"><?= $trip_info['passenger_capacity']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Weight Capacity</div>
                                    <div class="col-lg-9 col-md-8"><?= $trip_info['weight_capacity']; ?> KG</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">GCash/Contact Number</div>
                                    <div class="col-lg-9 col-md-8"><?= $trip_info['gcash_account_number']; ?></div>
                                </div>
                                <div class="row">
                                    <img src="<?= base_url('assets/img/' . $trip_info['boat_img']); ?>"
                                         alt="<?= $trip_info['boat_name']; ?>" class="rounded img-fluid">
                                </div>
                            </div>
                            <form class="tab-pane fade pt-3" id="payment-tab" method="post"
                                  action="<?= url_to('customer-reserve-process'); ?>" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="trip_schedule_id" value="<?= $trip_info['schedule_id']; ?>">
                                <input type="hidden" name="depart_type" value="<?= $depart_type == 'departed_1' ? 1 : 2; ?>">
                                <input type="hidden" name="operator_id" value="<?= $trip_info['operator_id']; ?>">
                                <input type="hidden" name="user_id" value="<?= $customer['id']; ?>">
                                <input type="hidden" name="payment" value="<?= $location['fare_price_in_peso']; ?>">
                                <input type="hidden" name="origin" value="<?= $travel_type == 'in' ? 1 : $location['id']; ?>">
                                <input type="hidden" name="destination" value="<?= $travel_type == 'out' ? 1 : $location['id']; ?>">
                                <h5>Instruction</h5>
                                <p>To process your reservation, you need to send payment to the GCash number below.</p>
                                <p>After the successful transaction, please send your receipt by attaching it to the
                                    form below and then
                                    submit.</p>
                                <strong>Verification may take a long time.</strong>
                                <hr class="mt-4">
                                <div class="profile-overview">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="card-title">Customer Details</h5>
                                                <div class="row">
                                                    <div class="col-6 label">Name</div>
                                                    <div class="col-6"><?= $customer['name']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">GCash number</div>
                                                    <div class="col-6"><?= $customer['contact_number']; ?></div>
                                                    <small class="text-muted mt-1">To change your number, go <a
                                                                href="javascript:void(0);"
                                                                data-target-panel="edit-info-tab-nav"
                                                                class="external-trigger">here</a>.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="card-title">Checkout</h5>
                                                <div class="row">
                                                    <div class="col-6 label">Send to</div>
                                                    <div class="col-6">
                                                        <strong><?= $trip_info['gcash_account_number']; ?></strong>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">Account</div>
                                                    <div class="col-6"><?= $trip_info['gcash_account_name']; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">GCash Receipt</div>
                                                    <div class="col-6">
                                                        <input type="file" accept="image/*" style="display: none"
                                                               id="file-upload-input" name="receipt" required>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-sm"
                                                           title="Upload GCash receipt" id="file-upload-btn"><i
                                                                    class="bi bi-upload"></i></a>
                                                        <br>
                                                    </div>
                                                </div>
                                                <div class="row bg-dark-light d-none">
                                                    <p id="selected-file-name"></p>
                                                </div>
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="tab-pane fade pt-3" id="profile-settings">
                                <form>
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="name"
                                                   value="<?= $customer['name']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="text" class="form-control" id="email"
                                                   value="<?= $customer['email']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="address"
                                                   value="<?= $customer['address']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="gender" class="col-form-label">Gender</label>
                                            <select id="gender" class="form-select" name="gender" disabled>
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
                                                    disabled>
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
                                                    disabled>
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
                                                    disabled>
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