<!DOCTYPE html>
<html lang="en">

<head>
    <title>System Ticketing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Lato" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="<?= base_url('asset/images/persada.png'); ?>" type="image/png" />
    <style>
        body {
            font: 400 15px Lato, sans-serif;
            line-height: 1.8;
            color: #818181;
        }

        .jumbotron {
            background-image: url(<?= base_url('asset/images/bg.jpg'); ?>);
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
            height: 100vh;
            /* Set to full viewport height */
            padding: 0;
            /* Remove padding */
            display: flex;
            /* Use flexbox for centering */
            flex-direction: column;
            /* Align items in a column */
            justify-content: center;
            /* Center content vertically */
            align-items: center;
            /* Center content horizontally */
        }

        .jumbotron h1 {
            margin-top: 50px;
            margin-bottom: -25px;
        }

        .container-fluid {
            padding: 60px 50px;
            margin-top: -30px;
        }

        .navbar {
            margin-bottom: 0;
            background-color: transparent;
            border: 0;
            font-size: 10px !important;
            border-radius: 0;
            font-family: Montserrat, sans-serif;
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

        .logout-message {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            /* Pastikan di atas elemen lain */
        }

        .modal-content {
            background: #fff;
            /* Warna latar belakang konten modal */
            padding: 20px;
            border-radius: 5px;
            /* Sudut membulat */
            text-align: center;
            /* Rata tengah */
        }

        @keyframes slideDown {
            from {
                transform: translate(-50%, -50%);
            }

            to {
                transform: translate(-50%, 0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .modal-body {
            padding: 20px;
            text-align: left;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            padding: 15px 20px;
        }

        .ui.segment.custom {
            left: 250px;
        }

        #info {
            background: transparent;
            backdrop-filter: blur(2px);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            animation: slideIn 0.5s forwards;
            display: none;
        }

        .logout-message h4 {
            margin: 0 0 10px;
            color: black;
        }

        .logout-message button {
            margin-right: 5px;
        }

        .animated-text {
            font-size: 18px;
            color: black;
            white-space: pre;
        }

        .custom-nav {
            background-color: rgba(248, 249, 250, 0.8);
            border-bottom-left-radius: 30px;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 10px;
            border-top-left-radius: 10px;

        }

        .custom-nav li {
            position: relative;
            /* Posisi relatif untuk parent */
        }

        .custom-nav li a {
            color: #007bff;
            /* Warna teks */
            font-size: 14px;
            text-decoration: none;
            /* Hapus garis bawah */
            padding: 15px 20px;
            /* Beri sedikit padding */
            display: inline-block;
            /* Agar bisa ditata dengan leluasa */
        }

        .custom-nav li a::after {
            content: '';
            position: absolute;
            left: 50%;
            /* Pusatkan */
            bottom: -5px;
            /* Posisi di bawah teks */
            width: 0;
            height: 2px;
            /* Tinggi garis */
            background-color: #007bff;
            /* Warna garis */
            transition: width 0.4s ease, left 0.4s ease;

        }

        .scroll-down {
            margin-top: 20px;
            /* Space above the icon */
            animation: bounce 1.5s infinite;
            /* Add bounce animation */
        }

        .scroll-down i {
            font-size: 25px;
            /* Adjust icon size */
            color: white;
            /* Icon color */
        }

        /* Bounce animation */
        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        footer .glyphicon-chevron-up {
            color: red;
            font-size: 20px;
            transition: color 0.3s;
        }

        footer .glyphicon-chevron-up:hover {
            color: red;
        }

        .footer {
            margin-top: 10px;
            margin-bottom: -60px;
            margin-left: -50px;
            margin-right: -50px;
            padding: 20px;
            /* Atur padding atas dan bawah */
            text-align: center;
            /* Pusatkan teks */
            background-color: #f8f8f8;
            border-top: 1px solid #ddd;
            /* Tambahkan garis pemisah di atas footer */
        }

        .footer a {
            display: inline-block;
            /* Mengatur tampilan link */
            margin-bottom: 10px;
            /* Jarak bawah untuk link */
        }

        .powered {
            color: blue;
            /* atau gunakan kode warna seperti #0000FF */
        }


        .modal {
            display: none;
            /* Tersembunyi secara default */
            position: fixed;
            /* Tetap di layar */
            z-index: 1000;
            /* Di atas semua elemen lainnya */
            left: 0;
            top: 0;
            width: 100%;
            /* Lebar penuh */
            height: 100%;
            /* Tinggi penuh */
            overflow: auto;
            /* Membuat scroll jika perlu */
            background-color: rgb(0, 0, 0);
            /* Warna latar belakang gelap */
            background-color: rgba(0, 0, 0, 0.4);
            /* Dengan transparansi */
        }

        .modal-content-custom {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% dari atas dan otomatis dari kiri/kanan */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Lebar modal */
            max-width: 500px;
            /* Maksimal lebar modal */
            border-radius: 5px;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .ticket-title {
            color: black;
            font-size: x-large;
            /* Ganti dengan kode warna yang kamu inginkan */
        }

        .ticket-teks {
            color: black;
            font-size: medium;
        }

        .ui.pointing.label {
            color: dimgrey;
            font-size: 15px;
        }

        .field {
            font-size: 15px;
        }

        .ui.message.animated {
            animation-duration: 0.5s;
        }

        .ui.message.animated.fadeIn {
            animation-name: fadeIn;
        }

        .checkmark.icon {
            font-size: 24px;
            margin-right: 10px;
            color: #34C759;
            /* green color */
        }

        .times.icon {
            font-size: 24px;
            margin-right: 10px;
            color: #FF69B4;
            /* red color */
        }
    </style>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container d-flex align-items-center">
            <div class="navbar-header d-flex align-items-center">
                <a href="#" onclick="location.reload();">
                    <img src="<?= base_url('asset/images/sempel.png'); ?>" alt="logo" class="logo" style="width: 150px; height: 150px; margin-top: -5px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right custom-nav">
                    <li><a href="#about">ABOUT</a></li>
                    <li><a href="#services">REQUEST</a></li>
                    <li><a href="<?php echo site_url('user/dashboard/profile'); ?>">PROFILE</a></li>
                    <li><a href="<?php echo site_url('user/dashboard/contact'); ?>">CONTACT</a></li>
                    <li><a href="#" onclick="confirmLogout(event)">LOGOUT</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="jumbotron text-center">
        <h1>System Ticketing</h1>
        <h2>Adhi Persada Properti</h2>
        <div class="scroll-down">
            <a href="#about"><i class="fas fa-chevron-down"></i></a>
        </div>

        <!-- Modal -->
    </div>




    <div id="about" class="container-fluid bg-grey">
        <div class="row">
            <div class="col-sm-8" style="padding-left: 50px; padding-right: 50px; margin-top: 35px;">
                <h2 style="color: black; font-weight: normal;">Tentang System Ticketing</h2>
                <p style="text-align: left; line-height: 1.6; max-width: 600px; margin-top: 20px;">
                    Sistem Ticketing adalah platform yang dirancang untuk membantu pengguna dalam mengelola permintaan dukungan teknis dan memudahkan proses penyelesaian masalah. Dengan antarmuka yang intuitif dan fitur yang lengkap, pengguna dapat membuat tiket, melacak status permintaan, dan mendapatkan bantuan dengan lebih efisien.
                </p>
                <p style="text-align: left; line-height: 1.6; max-width: 600px;">
                    Kami berkomitmen untuk memberikan layanan yang terbaik dan memastikan bahwa setiap permintaan ditangani dengan cepat dan profesional.
                </p>
            </div>
            <div class="col-sm-4 text-center">
                <img src="<?= base_url('asset/images/system.png'); ?>" alt="Logo" style="width: 400px; height: 300px; margin-top: -30px;">
            </div>
        </div>
    </div>

    <div id="services" class="container-fluid">
        <div class="main-content">
            <div class="ui segment">
                <div class="header-container text-center">
                    <h2 class="text-center">All Ticket</h2>
                </div>
            </div>

            <table class="ui celled table" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th>No Ticket</th>
                        <th>ID Request</th>
                        <th>Category</th>
                        <th>Priority</th>
                        <th>Topic</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $request = $this->Request_model->get_request_by_user($_SESSION['user_id']);
                    if (empty($request)) : ?>
                        <tr>
                            <td colspan="7" style="text-align: center;">Tidak ada tiket yang tersedia.</td>
                        </tr>
                        <?php else:
                        // Mapping status_id ke nama status
                        $statusMap = [
                            '1' => 'Menunggu Antrean',
                            '2' => 'Sedang Diproses',
                            '3' => 'Selesai'
                        ];

                        foreach ($request as $row) :
                            $statusNameValue = isset($statusMap[$row['status_id']]) ? $statusMap[$row['status_id']] : 'Status Tidak Ditemukan';

                            $statusColor = 'gray';
                            switch ($statusNameValue) {
                                case 'Menunggu Antrean':
                                    $statusColor = 'red';
                                    break;
                                case 'Sedang Diproses':
                                    $statusColor = 'yellow';
                                    break;
                                case 'Selesai':
                                    $statusColor = 'green';
                                    break;
                            }

                            // Pastikan status ditampilkan dengan benar
                            $statusNameDisplay = htmlspecialchars($statusNameValue);
                        ?>
                            <tr>
                                <td>
                                    <a
                                        href="<?php echo site_url('user/request/detail_ticket/' . $row['no_ticket']); ?>" class="ui button">
                                        <?php echo htmlspecialchars($row['no_ticket']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['priority_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['topic']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td>
                                    <span style="padding: 5px 10px; background-color: <?php echo $statusColor; ?>; color: black; font-weight: bold; border-radius: 5px; font-size: 16px; font-style: italic; display: inline-block;">
                                        <?php echo $statusNameDisplay; ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                            </tr>
                    <?php endforeach;
                    endif; ?>
                </tbody>
            </table>

            <div class="container-fluid bg-grey">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="ui segment custom">
                            <h3 class="ticket-title">Buat Ticket Baru</h3>
                            <p class="ticket-teks">Isi formulir di bawah ini untuk membuat ticket baru. Pastikan semua informasi yang diberikan akurat.</p>
                            <form id="request-form" class="ui form" method="post" action="<?php echo site_url('user/request/create_request'); ?>" enctype="multipart/form-data">
                                <!-- ... field lainnya ... -->
                                <div class="field">
                                    <label>Kategori</label>
                                    <select name="category_id" class="ui dropdown" required>
                                        <option value="0">--Pilih-Kategori-Anda--</option>
                                        <?php foreach ($category as $cat) { ?>
                                            <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <small class="ui pointing label">Pilih kategori yang sesuai untuk ticket Anda.</small>
                                </div>

                                <div class="field">
                                    <label>Prioritas</label>
                                    <select name="priority_id" class="ui dropdown" required>
                                        <option value="0">--Pilih-Prioritas-Anda--</option>
                                        <?php foreach ($priority as $pri) { ?>
                                            <option value="<?php echo $pri['priority_id']; ?>"><?php echo $pri['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <small class="ui pointing label">Tentukan tingkat prioritas ticket Anda.</small>
                                </div>

                                <div class="field">
                                    <label>Topik</label>
                                    <textarea name="topic" rows="1" required></textarea>
                                    <small class="ui pointing label">Masukkan topik singkat tentang masalah Anda.</small>
                                </div>

                                <div class="field">
                                    <label>Deskripsi</label>
                                    <textarea name="description" rows="3" required></textarea>
                                    <small class="ui pointing label">Jelaskan masalah Anda secara rinci.</small>
                                </div>
                                <div class="field">
                                    <label>Lampiran</label>
                                    <input type="file" name="lampiran" id="lampiran" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                    <small class="ui pointing label">Upload file pendukung (opsional). Max 2MB.</small>
                                </div>

                                <button class="ui secondary button" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator"></div>
            <footer class="footer">
                <a href="#myPage" title="To Top">
                    <span class="glyphicon glyphicon-chevron-up"></span>
                </a>
                <p>&copy; 2024 System Ticketing</p>
                <p class="powered">Powered BY IT APP</p>
            </footer>


            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                let typingActive = false; // Menandakan apakah typing sedang aktif

                function typeWriter(text, elementId, delay) {
                    let i = 0;
                    const element = document.getElementById(elementId);
                    element.innerHTML = ''; // Clear previous content

                    function type() {
                        if (i < text.length) {
                            element.innerHTML += text.charAt(i);
                            i++;
                            setTimeout(type, delay);
                        } else {
                            typingActive = false; // Menandakan bahwa typing telah selesai
                        }
                    }
                    type();

                    function handleFormSubmit() {
                        alert('Request berhasil ditambahkan!');

                        document.getElementById('request-form').reset();

                        return false; // Cegah form dari submit biasa
                    }

                }
                document.getElementById('lampiran').addEventListener('change', function(e) {
                    var file = e.target.files[0];
                    var fileInfo = document.getElementById('file-info');

                    if (file) {
                        // Cek ukuran file (dalam bytes)
                        if (file.size > 2 * 1024 * 1024) { // 2MB
                            fileInfo.innerHTML = '<p style="color: red;">File terlalu besar. Maksimum 2MB.</p>';
                            e.target.value = ''; // Reset input file
                        } else {
                            fileInfo.innerHTML = '<p>File yang dipilih: ' + file.name + ' (' + (file.size / 1024).toFixed(2) + ' KB)</p>';
                        }
                    } else {
                        fileInfo.innerHTML = '';
                    }
                });
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('request-form').addEventListener('submit', function(e) {
                        e.preventDefault();


                        var form = this;
                        var isValid = true;
                        form.querySelectorAll('input[required], select[required], textarea[required]').forEach(function(element) {
                            if (!element.value.trim()) {
                                isValid = false;
                                element.classList.add('error');
                            } else {
                                element.classList.remove('error');
                            }
                        });

                        if (!isValid) {
                            alert('Semua field wajib diisi!');
                            return;
                        }

                        // Validasi ukuran file
                        var fileInput = document.getElementById('lampiran');
                        if (fileInput.files.length > 0) {
                            if (fileInput.files[0].size > 2 * 1024 * 1024) {
                                alert('Ukuran file terlalu besar. Maksimum 2MB.');
                                return;
                            }
                        }

                        form.submit();
                    });
                });

                function confirmLogout(event) {
                    event.preventDefault(); // Prevent the default anchor action
                    $('#logout-message').fadeIn(); // Show the logout confirmation
                }

                document.querySelector('.scroll-down a').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default anchor click behavior

                    const targetId = this.getAttribute('href'); // Get the target section ID
                    const targetElement = document.querySelector(targetId); // Find the target element

                    // Custom smooth scroll function
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                    const startPosition = window.pageYOffset;
                    const distance = targetPosition - startPosition;
                    const duration = 1500; // Adjust this value for slower or faster scroll
                    let startTime = null;

                    function animation(currentTime) {
                        if (startTime === null) startTime = currentTime;
                        const timeElapsed = currentTime - startTime;
                        const progress = Math.min(timeElapsed / duration, 1); // Ensure progress is between 0 and 1
                        const ease = easeInOutQuad(progress); // Easing function
                        window.scrollTo(0, startPosition + distance * ease);

                        if (timeElapsed < duration) requestAnimationFrame(animation);
                    }

                    function easeInOutQuad(t) {
                        return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
                    }

                    requestAnimationFrame(animation);
                });

                $(document).ready(function() {
                    // Tampilkan modal jika ada pesan
                    if ($('.ui.message').length) {
                        $('#alertModal').css('display', 'block');
                    }

                    // Tutup modal ketika tombol close ditekan
                    $('.close-button').on('click', function() {
                        $('#alertModal').css('display', 'none');
                    });

                    // Tutup modal ketika klik di luar modal
                    $('#statusLink').on('click', function() {
                        $('#alertModal').css('display', 'none');
                    });
                });


                $(document).ready(function() {
                    $('#read-more').on('click', function() {
                        const infoText = "Sistem Ticketing adalah solusi untuk mengelola dan menyelesaikan permintaan dukungan teknis.";
                        if (!typingActive) {
                            typingActive = true; // Menandakan bahwa typing sedang aktif
                            $('#info').hide().fadeIn(); // Show the info div
                            typeWriter(infoText, 'info', 50); // Call the typing animation
                        }
                    });

                    $('#myNavbar a[data-target="#profileModal"]').on('click', function() {
                        $('#profileModal').modal('show');
                    });

                    $('#confirm-logout').on('click', function() {
                        $('#logout-message').fadeOut(300, function() {
                            window.location.href = "<?php echo site_url('auth/logout'); ?>"; // Redirect to logout URL
                        });
                    });

                    $('#cancel-logout').on('click', function() {
                        $('#logout-message').fadeOut(300); // Hide the logout message with animation
                    });

                    // Smooth scrolling for navbar and footer links
                    $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
                        if (this.hash !== "") {
                            event.preventDefault();
                            var hash = this.hash;
                            $('html, body').animate({
                                scrollTop: $(hash).offset().top
                            }, 900, function() {
                                window.location.hash = hash;
                            });
                        }
                    });

                    // Change navbar style on scroll
                    $(window).on('scroll', function() {
                        if ($(this).scrollTop() > 50) { // Adjust this value as needed
                            $('.navbar').addClass('scrolled');
                        } else {
                            $('.navbar').removeClass('scrolled');
                        }
                    });
                });

                document.addEventListener('DOMContentLoaded', function() {
                    <?php if (!empty($message)): ?>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '<?php echo addslashes($message); ?>'
                        });
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('success')): ?>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '<?php echo addslashes($this->session->flashdata('success')); ?>',
                            footer: '<a href="#services" id="statusLink">Klik Disini Untuk Lihat Status Dan No.Status</a>'
                        });
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: '<?php echo addslashes($this->session->flashdata('error')); ?>'
                        });
                    <?php endif; ?>
                });

                function confirmLogout(event) {
                    event.preventDefault(); // Mencegah aksi default tautan
                    Swal.fire({
                        title: 'Apakah Anda yakin ingin logout?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Ganti dengan URL logout yang benar
                            window.location.href = '<?php echo site_url('auth/logout'); ?>'; // Misalnya, '/logout'
                        }
                    });
                }
            </script>
</body>

</html>