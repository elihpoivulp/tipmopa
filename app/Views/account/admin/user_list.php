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
                    <a href="<?= url_to('admin-users-register'); ?>" class="btn float-end btn-primary">Create New</a>
                </div>
            </div>
        </div>
    </section>
</main>