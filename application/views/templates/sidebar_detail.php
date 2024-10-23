<!-- Sidebar -->
<div class="sidebar" style="width: 60px; 
                           background-color: #333; 
                           color: #fff; 
                           position: fixed; 
                           height: 100vh; /* Sesuaikan dengan tinggi top bar */
                           top: 40px; /* Sesuaikan dengan tinggi top bar */
                           left: 0; 
                           transition: width 0.3s; 
                           z-index: 1000;"> <!-- z-index dibawah top bar -->
    <img src="<?= base_url('asset/images/logo_app.png'); ?>" alt="Logo" style="width: 40px; display: block; margin: 10px auto;">
    <div style="height: 1px; background-color: #444; margin: 10px 0;"></div>

    <a class="nav-link" href="<?php echo site_url('admin/transaksi'); ?>" style="display: flex; align-items: center; justify-content: center; padding: 10px; text-decoration: none; color: #fff;" data-tooltip="Transaksi" data-position="right center" data-inverted="">
        <i class="fa-solid fa-chevron-left" style="margin-right: 5px;"></i>
    </a>
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