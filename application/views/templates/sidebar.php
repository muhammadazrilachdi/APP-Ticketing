<div class="sidebar">
    <img src="<?= base_url('asset/images/logo_app.png'); ?>" alt="Logo" class="sidebar-logo">
    <div class="logo-separator"></div>
    <a class="nav-link" href="<?php echo site_url('admin/transaksi'); ?>"><i class="fa-solid fa-envelope-open-text"></i>Transaksi</a>
    <a class="nav-link" href="javascript:void(0)" id="master-menu">
        <i class="fa-solid fa-house"></i>Master
        <i class="fas fa-chevron-down submenu-arrow"></i>
    </a>
    <ul class="sub-menu" id="master-submenu">
        <li><a href="<?php echo site_url('admin/user/index'); ?>"><i class="caret right icon"></i>User</a></li>
        <li><a href="<?php echo site_url('admin/departement/index'); ?>"><i class="caret right icon"></i>Departement</a></li>
        <li><a href="<?php echo site_url('admin/category/index'); ?>"><i class="caret right icon"></i>Category</a></li>
        <li><a href="<?php echo site_url('admin/status/index'); ?>"><i class="caret right icon"></i>Status</a></li>
        <li><a href="<?php echo site_url('admin/priority/index'); ?>"><i class="caret right icon"></i>Priority</a></li>
    </ul>

    <a class="nav-link" href="<?php echo site_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i>Logout</a>
</div>