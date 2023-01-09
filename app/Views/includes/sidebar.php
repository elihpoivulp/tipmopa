<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= url_to('/'); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Account</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?=  current_url() . '/profile'; ?>">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <form action="<?= url_to('logout'); ?>" method="post" id="logout_form">
                <?= csrf_field() ?>
                <a class="nav-link collapsed" href="javascript:void(0);" onclick="document.getElementById('logout_form').submit();">
                    <i class="bi bi-box-arrow-in-left"></i>
                    <span>Logout</span>
                </a>
            </form>
        </li>
    </ul>
</aside>
