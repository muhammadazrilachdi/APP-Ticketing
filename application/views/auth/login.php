<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="<?= base_url('asset/images/persada.png'); ?>" type="image/png" />
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: rgb(240, 240, 240);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        .container {
            background: white;
            width: 600px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: url('<?= base_url('asset/images/app.jpg'); ?>') no-repeat center center;
            background-size: cover;
            padding: 40px 20px;
            text-align: center;
            color: white;
        }

        .logo {
            width: 50px;
            height: auto;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 10px 0 0;
            font-size: 14px;
        }

        .login-form {
            padding: 20px;
        }

        .login-form h2 {
            margin: 0 0 20px;
            font-size: 18px;
            color: black;
            text-align: center;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: black;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .input-group input:focus {
            outline: none;
            border-color: #007bff;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: black;
            margin-bottom: 15px;
        }

        .options input {
            margin-right: 5px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: red;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .login-btn:hover {
            background: darkred;
        }

        /* Modal Styles */
        .modal {
            display: none;
            /* Sembunyikan modal secara default */
            position: fixed;
            /* Tetap di layar */
            z-index: 1;
            /* Di atas konten lain */
            left: 0;
            top: 0;
            width: 100%;
            /* Lebar penuh */
            height: 100%;
            /* Tinggi penuh */
            overflow: auto;
            /* Scroll jika perlu */
            background-color: rgb(0, 0, 0);
            /* Warna latar belakang */
            background-color: rgba(0, 0, 0, 0.4);
            /* Dengan transparansi */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% dari atas dan tengah */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Lebar modal */
            max-width: 400px;
            /* Maksimal lebar modal */
            border-radius: 10px;
            /* Sudut melengkung */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            background-color: green;
            /* Warna WhatsApp */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .swal2-container {
            position: fixed !important;
            z-index: 9999 !important;
        }

        .button i {
            margin-right: 8px;
            /* Jarak antara ikon dan teks */
            font-size: 24px;
            /* Ukuran ikon */
        }

        .modal {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Latar belakang semi-transparan */
            z-index: 1000;
            /* Pastikan di atas elemen lainnya */
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .large-icon {
            font-size: 2em;
            /* Atur ukuran ikon di sini */
        }

        .alert-container {
            margin-bottom: 13px;
            text-align: left;
            width: 80%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="<?= base_url('asset/images/persada.png'); ?>" alt="logo" class="logo">
            <h1>System Ticketing</h1>
            <p>Adhi Persada Properti</p>
        </div>
        <form method="post" action="<?php echo site_url('auth/process_login'); ?>">
            <div class="login-form">
                <h2>USER LOGIN</h2>
                <div class="alert-container">
                    <div class="ui messages">
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="ui negative message">
                                <p><?= $this->session->flashdata('error'); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input name="email" placeholder="E-mail address" type="text" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input id="password" name="password" placeholder="Password" type="password" required />
                </div>
                <div class="options">
                    <div class="ui checkbox">
                        <input type="checkbox" id="show-password">
                        <label for="show-password">Tampilkan Password</label>
                    </div>
                    <a href="#" onclick="showForgotPasswordModal()">Lupa password or info?</a>
                </div>
                <button class="login-btn">Log in</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Menampilkan atau menyembunyikan password
        document.getElementById('show-password').addEventListener('change', function() {
            var passwordInput = document.getElementById('password');
            passwordInput.type = this.checked ? 'text' : 'password';
        });

        // Modal functionality
        var modal = document.getElementById("forgotPasswordModal");
        var btn = document.getElementById("forgotPassword");
        var closeButton = document.getElementById("close-forgot-password");
        var adminPasswordBtn = document.getElementById('adminPasswordBtn'); // Menambahkan referensi untuk tombol WA Admin
        var resetEmailInput = document.getElementById('resetEmail'); // Pastikan input email ada

        // Show modal when button is clicked
        btn.onclick = function() {
            modal.style.display = "flex"; // Menampilkan modal
        }

        // Close modal when close button is clicked
        closeButton.onclick = function() {
            modal.style.display = "none"; // Menyembunyikan modal
        }

        // Close modal when clicking outside of the modal content
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none"; // Menyembunyikan modal
            }
        }

        function showForgotPasswordModal() {
            Swal.fire({
                title: 'Lupa Password?',
                text: 'Hubungi Admin Di Bawah Ini Jika Anda Lupa Password/Ingin Jadi Pengguna',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: '<i class="fab fa-whatsapp" style="margin-right: 5px;"></i> Hubungi Admin',
                cancelButtonText: 'Tutup',
                customClass: {
                    confirmButton: 'btn-whatsapp',
                },
                backdrop: true,
                position: 'center', // Menambahkan ini
                allowOutsideClick: false, // Optional: mencegah klik di luar modal
                scrollbarPadding: false, // Menambahkan ini untuk mencegah pergeseran
                heightAuto: false, // Menambahkan ini untuk mengontrol tinggi
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open('https://wa.me/6281282150702', '_blank');
                }
            });
        }
    </script>
</body>

</html>