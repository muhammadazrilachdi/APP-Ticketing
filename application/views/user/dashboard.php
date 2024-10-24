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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="<?= base_url('asset/images/persada.png'); ?>" type="image/png" />
    <style>
        body {
            font: 400 1rem Lato, sans-serif;
            /* Gunakan rem untuk ukuran font */
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
            margin-top: 5vh;
            /* Gunakan vh untuk responsivitas vertikal */
            margin-bottom: -2vh;
        }

        .container-fluid {
            padding: 4vw 3vw;
            /* Gunakan vw untuk padding */
        }

        .navbar {
            margin-bottom: 0;
            background-color: transparent;
            border: 0;
            font-size: 0.625rem;
            /* Ganti dengan rem */
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
            border-radius: 30px 30px 10px 10px;
        }

        .footer-section {
            margin: 0 2vw;
            /* Ganti margin ke vw */
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
            border-radius: 30px 30px 10px 10px;
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

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .navbar {
                font-size: 0.5rem;
                /* Sesuaikan ukuran font pada layar kecil */
            }

            .jumbotron h1 {
                font-size: 1.5rem;
                /* Sesuaikan ukuran font judul */
            }

            .container-fluid {
                padding: 2vw;
                /* Sesuaikan padding */
            }

            .footer-section {
                margin: 0 1vw;
                /* Sesuaikan margin footer */
            }
        }

        @media (max-width: 480px) {
            .navbar {
                font-size: 0.4rem;
                /* Lebih kecil untuk perangkat sangat kecil */
            }

            .jumbotron h1 {
                font-size: 1.2rem;
                /* Ukuran lebih kecil untuk judul */
            }

            .container-fluid {
                padding: 1.5vw;
                /* Padding lebih kecil */
            }
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
                    <li><a href="#request">REQUEST</a></li>
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

            <table class="display" id="table-ticket" style="margin-top: 20px;">
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
                            <td colspan="8" style="text-align: center;">Tidak ada tiket yang tersedia.</td>
                        </tr>
                        <?php else :
                        $statusMap = [
                            '1' => 'Menunggu Antrean',
                            '2' => 'Sedang Diproses',
                            '3' => 'Selesai'
                        ];

                        foreach ($request as $row) :
                            $statusNameValue = isset($statusMap[$row['status_id']]) ? $statusMap[$row['status_id']] : 'Status Tidak Ditemukan';
                            $statusClass = 'default'; // Default class

                            switch ($statusNameValue) {
                                case 'Menunggu Antrean':
                                    $statusClass = 'red'; // Merah
                                    break;
                                case 'Sedang Diproses':
                                    $statusClass = 'yellow'; // Kuning
                                    break;
                                case 'Selesai':
                                    $statusClass = 'green'; // Hijau
                                    break;
                            }
                            $statusNameDisplay = htmlspecialchars($statusNameValue);
                        ?>
                            <tr>
                                <td>
                                    <a href="<?php echo site_url('user/request/detail_ticket/' . $row['no_ticket']); ?>" class="btn btn-link">
                                        <?php echo htmlspecialchars($row['no_ticket']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['priority_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['topic']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td>
                                    <div class="ui <?php echo $statusClass; ?> label">
                                        <?php echo $statusNameDisplay; ?>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                            </tr>
                    <?php endforeach;
                    endif; ?>
                </tbody>

            </table>

            <div class="container-fluid bg-grey" id="request">
                <div class="row">
                    <h3 class="ticket-title" style="margin-left: 18px;">Buat Ticket Baru</h3>
                    <p class="ticket-teks" style="margin-left: 18px;">Isi formulir di bawah ini untuk membuat ticket baru. Pastikan semua informasi yang diberikan akurat.</p>

                    <div class="col-md-8">
                        <form id="request-form" class="ui form" method="post" action="<?php echo site_url('user/request/create_request'); ?>" enctype="multipart/form-data"
                            style="padding: 20px; border: 1px solid #ccc; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); width: 100%;">

                            <table style="width: 100%; border-collapse: collapse;">
                                <tbody>
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">
                                            <label style="font-weight: bold;">Kategori</label>
                                            <select name="category_id" class="ui dropdown" required
                                                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                                <option value="0">--Pilih-Kategori-Anda--</option>
                                                <?php foreach ($category as $cat) { ?>
                                                    <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">
                                            <label style="font-weight: bold;">Prioritas</label>
                                            <select name="priority_id" class="ui dropdown" required
                                                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                                <option value="0">--Pilih-Prioritas-Anda--</option>
                                                <?php foreach ($priority as $pri) { ?>
                                                    <option value="<?php echo $pri['priority_id']; ?>"><?php echo $pri['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">
                                            <label style="font-weight: bold;">Topik</label>
                                            <textarea name="topic" rows="1" required
                                                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">
                                            <label style="font-weight: bold;">Deskripsi</label>
                                            <textarea name="description" rows="3" required
                                                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #ddd;">
                                            <label style="font-weight: bold;">Lampiran</label>
                                            <input type="file" name="lampiran" id="lampiran" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <button class="ui secondary button" type="submit"
                                style="background-color: #444; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 15px;">
                                Submit
                            </button>
                        </form>
                    </div>

                    <div class="col-md-4" style="padding: 20px;">
                        <h4 style="margin-bottom: 15px;">Tatacara Pengisian</h4>
                        <p style="margin-bottom: 10px;">Berikut adalah langkah-langkah untuk mengisi formulir:</p>
                        <ol>
                            <li><strong>Pilih kategori:</strong> Tentukan kategori yang sesuai untuk masalah Anda.</li>
                            <li><strong>Tentukan prioritas:</strong> Pilih tingkat prioritas sesuai urgensi masalah.</li>
                            <li><strong>Isi topik:</strong> Masukkan ringkasan singkat tentang masalah yang Anda hadapi.</li>
                            <li><strong>Deskripsi lengkap:</strong> Jelaskan masalah Anda dengan detail.</li>
                            <li><strong>Lampirkan file:</strong> Upload file pendukung jika diperlukan (opsional), max 2MB, hanya bisa file bertipe gif|jpg|png|pdf|doc|docx</li>
                            <li><strong>Submit:</strong> Klik tombol submit untuk mengirimkan ticket Anda.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div id="footerLink" style="display: none;">
            <a href="<?php echo site_url('user/request/detail_ticket/' . $row['no_ticket']); ?>">Klik Disini Untuk Lihat Status Dan No.Status</a>
        </div>

        <div class="separator"></div>
        <footer class="footer" style="margin: 10px -50px -60px -50px; padding: 20px; text-align: left; background-color: #f8f8f8; border-top: 1px solid #ddd; display: flex; flex-direction: column; align-items: flex-start;">
            <div class="footer-sections" style="display: flex; justify-content: center; width: 100%; margin-top: 10px; margin-bottom: 20px;"> <!-- Ubah justify-content ke flex-start -->
                <div class="footer-content" style="display: flex; align-items: center; margin-bottom: 15px; font-size: 0.9em; margin-left: 100px; margin-top: 10px;">
                    <img src="<?= base_url('asset/images/persada.png'); ?>" alt="Logo" class="footer-logo" style="width: 40px; height: auto; margin-right: 5px;">
                    <span class="separator" style="margin: 0 5px;">|</span>
                    <p> System Ticketing</p>
                </div>

                <div class="footer-section" style="margin: 0 80px; max-width: 200px;">
                    <h3 style="margin-bottom: 5px;">Informasi</h3> <!-- Mengurangi margin bawah h3 -->
                    <p><span style="font-weight: bold;">Email Dukungan: </span><a href="mailto:Business@app.id" target="_blank">Business@app.id</a></p>
                    <p style="margin: 0;"><span style="font-weight: bold;">Jam Operasional:</span></p>
                    <p style="margin: 0;">Senin - Jumat, 08:00 - 17:00</p> <!-- Mengurangi margin -->
                </div>

                <div class="footer-section" style="margin: 0 40px; margin-right: 100px; max-width: 200px;">
                    <h3>Media Sosial</h3>
                    <a href="https://www.facebook.com/adhipersadaproperti?mibextid=ZbWKwL" target="_blank" style="margin-right: 10px; color: #3b5998;"><i class="fab fa-facebook"></i></a>
                    <a href="https://x.com/Adhiproperti?t=RWGqjbsCedCFb4qBThLIsw&s=09" target="_blank" style="margin-right: 10px; color: #1DA1F2;"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/adhipersadaproperti?igsh=MTR0ZGE5ZjJ5NXM3dg==" target="_blank" style="margin-right: 10px; color: #C13584;"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/adhipersadaproperti/" target="_blank" style="color: #0077b5;"><i class="fab fa-linkedin"></i></a>
                </div>

                <div class="footer-section" style="margin: 0 80px; max-width: 200px;">
                    <h3>Lokasi</h3>
                    <p style="margin: 0;">Grand Dhika City, Tower Arlington, Jl. Raya Hankam, Jatiwarna, Jawa Barat.</p>
                </div>
            </div>
            <div class="footer-copyright"></div>
            <hr class="footer-divider" style="margin: 20px 0; width: 100%; border: none; border-top: 1px solid #ddd; position: relative; left: 50%; transform: translateX(-50%);">
            <p class="powered" style="color: blue; margin-top: 4px; text-align: center; width: 100%;">
                Powered By <a href="https://app.id" target="_blank" style="color: blue; text-decoration: none;">IT APP</a>
            </p>
        </footer>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#table-ticket').DataTable({
                    "ordering": true,
                    "searching": true,
                    "paging": true
                });
            });

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
                        footer: document.getElementById('footerLink').innerHTML // Ambil HTML dari footerLink
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