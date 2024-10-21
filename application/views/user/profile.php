<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="<?= base_url('asset/images/persada.png'); ?>" type="image/png" />
    <style>
        body {
            font-family: tahoma;
            height: 100vh;
            background-image: url(<?= base_url('asset/images/bg3.jpg'); ?>);
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container-fluid {
            display: flex;
            justify-content: center;
            max-width: 1200px;
            /* adjust this value to your desired maximum width */
        }

        .our-team {
            padding: 30px 0 40px;
            margin-bottom: 30px;
            background-color: #f7f5ec;
            text-align: center;
            overflow: hidden;
            position: relative;
            border-radius: 10px;
            width: 350px;
            /* Sudut membulat pada kotak profil */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Bayangan untuk efek kedalaman */
        }

        .our-team .picture {
            display: inline-block;
            height: 130px;
            width: 130px;
            margin-bottom: 50px;
            z-index: 1;
            position: relative;
        }

        .our-team .picture::before {
            content: "";
            width: 100%;
            height: 0;
            border-radius: 50%;
            background-color: red;
            position: absolute;
            bottom: 135%;
            right: 0;
            left: 0;
            opacity: 0.9;
            transform: scale(3);
            transition: all 0.3s linear 0s;
        }

        .our-team:hover .picture::before {
            height: 100%;
        }

        .our-team .picture::after {
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: red;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .our-team .picture img {
            width: 100%;
            height: auto;
            border-radius: 50%;
            transform: scale(1);
            transition: all 0.9s ease 0s;
        }

        .our-team:hover .picture img {
            box-shadow: 0 0 0 14px #f7f5ec;
            transform: scale(0.7);
        }

        .our-team .title {
            display: block;
            font-size: 15px;
            color: #4e5052;
            text-transform: capitalize;
        }

        .our-team .social {
            width: 100%;
            padding: 0;
            margin: 0;
            background-color: red;
            position: absolute;
            bottom: -100px;
            left: 0;
            transition: all 0.5s ease 0s;
        }

        .our-team:hover .social {
            bottom: 0;
        }

        .our-team .social li {
            display: inline-block;
        }

        .our-team .social li a {
            display: block;
            padding: 10px;
            font-size: 17px;
            color: white;
            transition: all 0.3s ease 0s;
            text-decoration: none;
        }

        .our-team .social li a:hover {
            color: #1369ce;
            background-color: #f7f5ec;
        }

        .team-content {
            margin-top: -20px;
        }


        .modal-content {
            background-color: #fff;
            border-radius: 10px;
            animation: fadeIn 0.5s;
        }

        .modal-body {
            padding: 15px;
            /* Padding lebih kecil */
        }

        .btn-red {
            background-color: red;
            color: white;
            border: none;
        }

        .btn-red:hover {
            background-color: darkred;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .custom-nav {
            background-color: rgba(248, 249, 250, 0.8);
            border-bottom-left-radius: 30px;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 10px;
            border-top-left-radius: 10px;
            margin-top: 10px;
            transition: all 0.3s ease;

        }

        .custom-nav li {
            position: relative;
            float: left;
        }

        .custom-nav li a {
            color: #007bff;
            font-size: 14px;
            text-decoration: none;
            padding: 15px 20px;
            display: inline-block;
        }

        .custom-nav li a::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -5px;
            width: 0;
            height: 2px;
            background-color: #007bff;
            transition: width 0.4s ease, left 0.4s ease;
        }

        .navbar {
            margin-bottom: 0;
            background-color: transparent;
            border: 0;
            font-size: 10px !important;
            border-radius: 0;
            font-family: Montserrat, sans-serif;
            padding: 0;
            width: 500px;
        }

        .navbar.scrolled {
            background-color: transparent !important;
        }

        .navbar.scrolled li a,
        .navbar.scrolled .navbar-brand {
            color: black !important;
        }

        .navbar li a,
        .navbar .navbar-brand {
            color: red !important;
        }

        .navbar-nav li a:hover,
        .navbar-nav li.active a {
            color: #f4511e !important;
            background-color: #fff !important;
            border-bottom-left-radius: 30px;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 10px;
            border-top-left-radius: 10px;
        }

        .alert-container {
            max-width: 400px;
            /* Atur lebar maksimum */
            margin: 20px auto;
            /* Pusatkan alert di halaman */
            text-align: center;
            /* Tengah teks di dalam alert */
            width: 350px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container d-flex align-items-center">
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav custom-nav" style="margin-right: auto;">
                    <li>
                        <a href="<?= base_url('user/dashboard'); ?>" title="Back">
                            <i class="fas fa-arrow-left"></i> BACK
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="our-team">
                    <div class="picture">
                        <img class="img-fluid" src="<?= base_url('asset/images/persada.png'); ?>" alt="Michele Miller">
                    </div>
                    <div class="team-content">
                        <p>Nama: <?php echo $name; ?></p>
                        <p>Email: <?php echo $email; ?></p>
                        <p>Nomor HP: <?php echo $no_hp; ?></p>
                        <p><a href="#" id="ubahPasswordLink" style="color: #1369ce;">Ubah Password</a></p>
                    </div>

                    <ul class="social">
                        <li></li>
                    </ul>
                </div>
                <!-- Modal -->
                <div id="passwordModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <!-- Pesan Feedback -->
                                <?php if ($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <?= $this->session->flashdata('error'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($this->session->flashdata('success')): ?>
                                    <div class="alert alert-success">
                                        <?= $this->session->flashdata('success'); ?>
                                    </div>
                                <?php endif; ?>

                                <form id="passwordForm" method="post" action="<?php echo site_url('user/dashboard/change_password'); ?>">
                                    <div class="form-group">
                                        <label for="oldPassword">Password Lama</label>
                                        <input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="Password Lama" required>
                                        <div class="ui checkbox">
                                            <input type="checkbox" id="showOldPassword">
                                            <label for="showOldPassword">Tampilkan Password</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">Password Baru</label>
                                        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Password Baru" required>
                                        <div class="ui checkbox">
                                            <input type="checkbox" id="showNewPassword">
                                            <label for="showNewPassword">Tampilkan Password</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword">Konfirmasi Password</label>
                                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Konfirmasi Password" required>
                                        <div class="ui checkbox">
                                            <input type="checkbox" id="showConfirmPassword">
                                            <label for="showConfirmPassword">Tampilkan Password</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-red">Ubah Password</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                <?php if ($this->session->flashdata('error')): ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '<?= addslashes($this->session->flashdata('error')); ?>'
                    });
                <?php endif; ?>

                <?php if ($this->session->flashdata('success')): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '<?= addslashes($this->session->flashdata('success')); ?>'
                    });
                <?php endif; ?>
            });

            // Menangani klik untuk modal
            $('#ubahPasswordLink').click(function(e) {
                e.preventDefault();
                $('#passwordModal').modal('show');
            });

            // Menangani submit form
            $('#passwordForm').submit(function(e) {
                const oldPassword = $('#oldPassword').val();
                const newPassword = $('#newPassword').val();
                const confirmPassword = $('#confirmPassword').val();

                if (oldPassword === '' || newPassword === '' || confirmPassword === '') {
                    e.preventDefault();
                    Swal.fire('Error', 'Semua field harus diisi.', 'error');
                } else if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    Swal.fire('Error', 'Password baru dan konfirmasi tidak sama.', 'error');
                } else {
                    // Tambahkan logika untuk menangani form di sini
                    // Jika gagal, tampilkan alert
                    <?php if ($this->session->flashdata('error')): ?>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: '<?= addslashes($this->session->flashdata('error')); ?>'
                        });
                    <?php endif; ?>
                }
            });

            // Toggle password visibility
            document.getElementById('showOldPassword').addEventListener('change', function() {
                const oldPasswordInput = document.getElementById('oldPassword');
                oldPasswordInput.type = this.checked ? 'text' : 'password';
            });

            document.getElementById('showNewPassword').addEventListener('change', function() {
                const newPasswordInput = document.getElementById('newPassword');
                newPasswordInput.type = this.checked ? 'text' : 'password';
            });

            document.getElementById('showConfirmPassword').addEventListener('change', function() {
                const confirmPasswordInput = document.getElementById('confirmPassword');
                confirmPasswordInput.type = this.checked ? 'text' : 'password';
            });
        </script>
</body>

</html>