<main>
    <div class="container">
        <section
                class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center text-center">
            <h1><?= getenv('app.name'); ?></h1>
            <h2 class="mt-2"><?= getenv('app.description'); ?></h2>
            <a class="btn btn-outline-secondary" href="<?= url_to('login'); ?>">Login</a>
            <p class="mt-2">Or <a href="<?= url_to('register'); ?>">Register</a></p>
            <object id="svg1" data="<?= base_url('assets/img/boat.svg'); ?>" type="image/svg+xml" width="40%" class="my-5"></object>
        </section>
    </div>
</main>
