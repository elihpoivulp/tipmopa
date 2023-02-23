<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?= $active == '' ? '' : 'collapsed'; ?>" href="<?= url_to('/'); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active == 'customers' ? '' : 'collapsed'; ?>" href="<?= url_to('operator-customer-list'); ?>">
                <i class="bi bi-file-person-fill"></i>
                <span>Customers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active == 'sales' ? '' : 'collapsed'; ?>" href="<?= url_to('operator-sales'); ?>">
                <i class="bi bi-currency-dollar"></i>
                <span>Sales</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active == 'schedules' ? '' : 'collapsed'; ?>" href="<?= url_to('operator-schedules'); ?>">
                <i class="bi bi-clock"></i>
                <span>Schedules</span>
            </a>
        </li>

        <li class="nav-heading">Account</li>
<!--        <li class="nav-item">-->
<!--            <a class="nav-link collapsed" href="--><?php //= current_url() . '/profile'; ?><!--">-->
<!--                <i class="bi bi-person"></i>-->
<!--                <span>Profile</span>-->
<!--            </a>-->
<!--        </li>-->
        <li class="nav-item">
            <form action="<?= url_to('logout'); ?>" method="post" id="logout_form">
                <?= csrf_field() ?>
                <a class="nav-link collapsed" href="javascript:void(0);"
                   onclick="document.getElementById('logout_form').submit();">
                    <i class="bi bi-box-arrow-in-left"></i>
                    <span>Logout</span>
                </a>
            </form>
        </li>
    </ul>
</aside>
