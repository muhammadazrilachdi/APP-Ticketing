<!-- Sidebar -->
<div class="sidebar" style="width: 60px; background-color: #333; color: #fff; position: fixed; height: 100%; transition: width 0.3s;">
    <img src="<?= base_url('asset/images/logo_app.png'); ?>" alt="Logo" style="width: 40px; display: block; margin: 10px auto;">
    <div style="height: 1px; background-color: #444; margin: 10px 0;"></div>

    <a class="nav-link" href="<?php echo site_url('admin/transaksi'); ?>" style="display: flex; align-items: center; justify-content: center; padding: 10px; text-decoration: none; color: #fff;" data-tooltip="Transaksi" data-position="right center" data-inverted="">
        <i class="fa-solid fa-envelope-open-text" style="margin-right: 5px;"></i>
    </a>

    <a class="nav-link" href="javascript:void(0)" id="master-menu" style="display: flex; align-items: center; justify-content: center; padding: 10px; text-decoration: none; color: #fff;" data-tooltip="Master" data-position="right center" data-inverted="">
        <i class="fa-solid fa-house" style="margin-right: 5px;"></i>
    </a>

    <ul class="sub-menu" id="master-submenu" style="display: none; padding: 0; margin: 0; list-style: none;">
        <li>
            <a href="<?php echo site_url('admin/user/index'); ?>" style="color: #fff; text-decoration: none; display: flex; align-items: center; justify-content: flex-start; padding: 10px;" data-tooltip="User" data-position="right center" data-inverted="">
                <i class="fa-solid fa-user" style="margin-left: 7px;"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/departement/index'); ?>" style="color: #fff; text-decoration: none; display: flex; align-items: center; justify-content: flex-start; padding: 10px;" data-tooltip="Departement" data-position="right center" data-inverted="">
                <i class="fa-solid fa-building" style="margin-left: 7px;"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/category/index'); ?>" style="color: #fff; text-decoration: none; display: flex; align-items: center; justify-content: flex-start; padding: 10px;" data-tooltip="Category" data-position="right center" data-inverted="">
                <i class="fa-solid fa-tags" style="margin-left: 7px;"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/status/index'); ?>" style="color: #fff; text-decoration: none; display: flex; align-items: center; justify-content: flex-start; padding: 10px;" data-tooltip="Status" data-position="right center" data-inverted="">
                <i class="fa-solid fa-flag" style="margin-left: 7px;"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/priority/index'); ?>" style="color: #fff; text-decoration: none; display: flex; align-items: center; justify-content: flex-start; padding: 10px;" data-tooltip="Priority" data-position="right center" data-inverted="">
                <i class="fa-solid fa-star" style="margin-left: 7px;"></i>
            </a>
        </li>
    </ul>

    <a class="nav-link" href="#" onclick="if(confirm('Apakah Anda yakin ingin logout?')) { window.location.href = '<?php echo site_url('auth/logout'); ?>'; }" style="display: flex; align-items: center; justify-content: center; padding: 10px; text-decoration: none; color: #fff;" data-tooltip="Logout" data-position="right center" data-inverted="">
        <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>
    </a>

    <div style="height: 1px; background-color: #444; margin: 5px 0;"></div> <!-- Garis pembatas hanya setelah logout -->

</div>

<!-- JavaScript untuk Semantic UI -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi tooltip
        $('.nav-link').popup();
    });
</script>