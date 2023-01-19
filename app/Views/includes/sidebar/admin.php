<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?= $active == '' ? '' : 'collapsed'; ?>" href="<?= url_to('/'); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $active == 'reservations' ? '' : 'collapsed'; ?>" href="<?= url_to('admin-reservations'); ?>">
                <i class="bi bi-archive"></i>
                <span>Reservations</span>
            </a>
        </li>

        <li class="nav-heading">Maintenance</li>
        <li class="nav-item">
            <a class="nav-link <?= $active == 'users' ? '' : 'collapsed'; ?>" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="users-nav" class="nav-content collapse <?= $active == 'users' ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li class="active">
                    <a href="<?= url_to('users-list', 'customers'); ?>" class=" <?= $sub == 'customers' ? 'active' : ''; ?>">
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="<?= url_to('users-list', 'operators'); ?>" class=" <?= $sub == 'operators' ? 'active' : ''; ?>">
                        <span>Operators</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-heading">Account</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= current_url() . '/profile'; ?>">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>
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
