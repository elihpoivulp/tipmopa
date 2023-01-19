<div class="pagetitle">
    <h1><?= $current_page == '' ? 'Dashboard' : str_replace('-', ' ', $current_page); ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= url_to('customer-dashboard'); ?>">Home</a></li>
            <?php if ($segments_count == 3): ?>
                <li class="breadcrumb-item"><?= $active; ?></li>
                <?php if (!$sub_is_int): ?>
                    <li class="breadcrumb-item active"><?= str_replace('-', ' ', $sub); ?></li>
                <?php endif; ?>
            <?php else: ?>
                <li class="breadcrumb-item active"><?= $current_page == '' ? 'Dashboard' : $current_page; ?></li>
            <?php endif; ?>
        </ol>
    </nav>
</div>