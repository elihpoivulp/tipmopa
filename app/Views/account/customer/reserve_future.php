<main id="main" class="main">
    <?= $breadcrumbs; ?>
    <section class="section pt-4">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-body py-3">
                        <p><strong><label for="date">Select Date</label></strong></p>
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <select name="date" id="date" class="form-control"
                                    onchange="document.querySelectorAll('.input-date').forEach(x => x.value = this.value)">
                                <?php foreach ($dates as $date): ?>
                                    <option value="<?= $date['schedule_date']; ?>"><?= $date['schedule_date']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-12">
                <form class="card" method="post" action="<?= url_to('customer-reserve-future-redirect'); ?>">
                    <div class="card-body py-3">
                        <p><strong>Select time</strong></p>
                        <?= csrf_field(); ?>
                        <input type="hidden" name="date" class="input-date" value="<?= $dates[0]['schedule_date']; ?>">
                        <div class="row">
                            <div class="col-12">
                                <h5>Going to <?= get_location(1); ?></h5>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="itt" id="tii_2am"
                                               value="2am" required>
                                        <label class="form-check-label" for="tii_2am">2:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="itt" id="tii_3am"
                                               value="3am" required>
                                        <label class="form-check-label" for="tii_3am">3:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="itt" id="tii_4am"
                                               value="4am" required>
                                        <label class="form-check-label" for="tii_4am">4:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="itt" id="tii_5am"
                                               value="5am" required>
                                        <label class="form-check-label" for="tii_5am">5:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="itt" id="tii_8am"
                                               value="8am" required>
                                        <label class="form-check-label" for="tii_8am">8:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="itt" id="tii_9am"
                                               value="9am" required>
                                        <label class="form-check-label" for="tii_9am">9:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="itt" id="tii_4pm"
                                               value="4pm" required>
                                        <label class="form-check-label" for="tii_4pm">4:00 pm</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="itt" id="tii_5pm"
                                               value="5pm" required>
                                        <label class="form-check-label" for="tii_5pm">5:00 pm</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12 mt-3">
                                    <p><strong><label for="location">Select Origin</label></strong></p>
                                    <select name="location" id="location" class="form-select" required>
                                        <option selected disabled value="">Select Origin</option>
                                        <?php foreach ($locations as $location): ?>
                                            <?php if ($location['name'] !== 'Terminal'): ?>
                                                <option value="<?= $location['id']; ?>"><?= $location['name']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary w-100" type="submit">Reserve</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-12">
                <form class="card" method="post" action="<?= url_to('customer-reserve-future-redirect'); ?>">
                    <div class="card-body py-3">
                        <p><strong>Select time</strong></p>
                        <input type="hidden" name="date" class="input-date" value="<?= $dates[0]['schedule_date']; ?>">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <h5>Going to <?= get_location(); ?></h5>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tti" id="tti_6am"
                                               value="6am" required>
                                        <label class="form-check-label" for="tti_6am">06:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tti" id="tti_7am"
                                               value="7am" required>
                                        <label class="form-check-label" for="tti_7am">07:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tti" id="tti_8am"
                                               value="8am" required>
                                        <label class="form-check-label" for="tti_8am">08:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tti" id="tti_9am"
                                               value="9am" required>
                                        <label class="form-check-label" for="tti_9am">09:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tti" id="tti_10am"
                                               value="10am" required>
                                        <label class="form-check-label" for="tti_10am">10:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tti" id="tti_11am"
                                               value="11am" required>
                                        <label class="form-check-label" for="tti_11am">11:00 am</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tti" id="tti_12pm"
                                               value="12pm" required>
                                        <label class="form-check-label" for="tti_12pm">12:00 pm</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tti" id="tti_1pm"
                                               value="1pm" required>
                                        <label class="form-check-label" for="tti_1pm">01:00 pm</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12 my-3">
                                    <p><strong><label for="location">Select Destination</label></strong></p>
                                    <select name="location" id="location" class="form-select" required>
                                        <option selected disabled value="">Select Destination</option>
                                        <?php foreach ($locations as $location): ?>
                                            <?php if ($location['name'] !== 'Terminal'): ?>
                                                <option value="<?= $location['id']; ?>"><?= $location['name']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary w-100" type="submit">Reserve</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>