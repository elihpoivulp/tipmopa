<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a class="logo d-flex align-items-center" href="<?= url_to('/'); ?>">
            <span class="d-none d-lg-block">TIPMOPA</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <?php if ($notifications): ?>
                        <span class="badge bg-primary badge-number"><?= count($notifications); ?></span>
                    <?php endif; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have <?= count($notifications); ?> new notifications
                        <!--                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>-->
                    </li>
                    <?php if ($notifications): ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php foreach ($notifications as $notification): ?>
                            <li class="notification-item">
                                <i class="bi <?= $notification['category'][0] . ' bi-' . $notification['category'][1]; ?>"></i>
                                <div>
                                    <form action="<?= url_to('notifications-mark_seen', $notification['id']); ?>" method="post" id="notification_form">
                                        <?= csrf_field() ?>
                                        <a class="nav-link collapsed" href="javascript:void(0);" onclick="document.getElementById('notification_form').submit();">

                                            <!--                                    <h4>Lorem Ipsum</h4>-->
                                            <p><?= $notification['message']; ?></p>
                                            <p><?= get_time_diff(strtotime($notification['created_at'])); ?> min. ago</p>
                                        </a>
                                    </form>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
    </nav>
</header>
