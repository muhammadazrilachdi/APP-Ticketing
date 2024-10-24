<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Lato" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="<?= base_url('asset/images/persada.png'); ?>" type="image/png" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .text-content {
            max-width: 500px;
            margin-right: 40px;
        }

        .text-content h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .text-content p {
            font-size: 16px;
            color: #666;
            margin: 5px 0;
        }

        .text-content .contact-info {
            margin-top: 20px;
        }

        .text-content .contact-info p {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .text-content .contact-info p i {
            margin-right: 10px;
            font-size: 30px;
            /* Ukuran ikon lebih besar */
            /* Ketebalan ikon */
        }

        .image-content img {
            border-radius: 50%;
            width: 300px;
            height: 300px;
            object-fit: cover;
        }

        .custom-nav {
            background-color: rgba(255, 0, 0, 0.7);
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
            color: white !important;
        }

        .navbar-nav li a:hover,
        .navbar-nav li.active a {
            color: white !important;
            background-color: rgba(255, 0, 0, 0.5) !important;
            border-bottom-left-radius: 30px;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 10px;
            border-top-left-radius: 10px;
        }

        .contact-info {
            font-family: 'Montserrat', sans-serif;
        }

        .icon {
            text-decoration: none;
            /* Menghilangkan underline */
            color: #333;
            /* Warna teks */
            display: flex;
            align-items: center;
            padding: 10px;
            /* Menambahkan padding untuk ruang */
            border-radius: 8px;
            /* Menambahkan sudut yang membulat */
            transition: background-color 0.3s, transform 0.3s;
            /* Transisi latar belakang dan skala */
        }

        .icon i {
            margin-right: 10px;
            font-size: 20px;
            /* Ukuran ikon */
            transition: transform 0.3s;
            /* Transisi rotasi */
        }

        /* Hover effects for each icon */
        .whatsapp:hover {
            color: green;
            text-decoration: none;
            /* Menghilangkan underline saat hover */
            background-color: rgba(37, 211, 102, 0.2);
            /* Latar belakang hijau */
            transform: scale(1.05);
            /* Sedikit membesar saat hover */
        }

        .phone:hover {
            color: blue;
            text-decoration: none;
            /* Menghilangkan underline saat hover */
            background-color: rgba(0, 0, 139, 0.2);
            /* Latar belakang biru tua */
            transform: scale(1.05);
            /* Sedikit membesar saat hover */
        }

        .email:hover {
            color: red;
            text-decoration: none;
            /* Menghilangkan underline saat hover */
            background-color: rgba(255, 0, 0, 0.2);
            /* Latar belakang merah */
            transform: scale(1.05);
            /* Sedikit membesar saat hover */
        }

        .icon:hover i {
            transform: rotate(15deg);
            /* Sedikit rotasi saat hover */
        }

        .icon:active {
            transform: scale(0.95);
            /* Kecilkan sedikit saat diklik */
        }

        /* Untuk menjaga agar warna ikon tetap sama saat dihover */
        .whatsapp:hover i,
        .phone:hover i,
        .email:hover i {
            color: inherit;
            text-decoration: none
        }

        .image-content {
            margin-top: 15px;
            /* Ubah nilai ini untuk menyesuaikan jarak */
        }

        .image-content img {
            border-radius: 50%;
            width: 370px;
            /* Ukuran gambar */
            height: 370px;
            /* Ukuran gambar */
            object-fit: cover;
        }

        .modal-content {
            width: 90%;
            max-width: 600px;
            margin: auto;
            border: none;
            /* Menghapus border pada modal */
            border-radius: 10px;
            /* Menambahkan sudut melengkung */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Menambahkan bayangan */
        }

        .modal-header {
            background-color: #343a40;
            /* Mengubah ke warna gelap */
            color: white;
            padding: 15px;
            border-top-left-radius: 10px;
            /* Sudut melengkung atas */
            border-top-right-radius: 10px;
            /* Sudut melengkung atas */
        }

        .modal-title {
            font-weight: bold;
            font-size: 1.5em;
            /* Ukuran font lebih besar */
        }

        .faq {
            margin-top: 20px;
        }

        .faq-question {
            cursor: pointer;
            padding: 15px;
            margin: 5px 0;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: background-color 0.3s;
        }

        .faq-question:hover {
            background-color: #e9ecef;
        }

        .faq-answer {
            padding: 15px;
            border-left: 3px solid red;
            background-color: #f1f1f1;
            margin-bottom: 10px;
            border-radius: 5px;
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


    <div class="text-content">
        <h1>Jika Anda memerlukan informasi lebih lanjut, jangan ragu untuk menghubungi kami.</h1>
        <p> Hubungi Admin System Ticketing</p>
        <div class="contact-info">
            <p>
                <a href="https://wa.me/6289622957132" target="_blank" class="icon whatsapp">
                    <i class="fa-brands fa-whatsapp"></i>
                    081289622957132
                </a>
            </p>
            <p>
                <a href="#" class="icon phone" data-toggle="modal" data-target="#helpCenterModal">
                    <i class="fa-regular fa-circle-question"></i>
                    Help Center
                </a>
            </p>
            <p>
                <a href="mailto:Business@app.id" class="icon email" target="_blank">
                    <i class="fa-regular fa-envelope"></i>
                    Business@app.id
                </a>

            </p>
        </div>
    </div>
    <div class="image-content">
        <img src="<?php echo site_url('asset/images/admin.png'); ?>" />
    </div>
    </div>
    <div class="modal fade" id="helpCenterModal" tabindex="-1" role="dialog" aria-labelledby="helpCenterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="helpCenterModalLabel">Help Center</h2>
                </div>
                <div class="modal-body">

                    <div class="faq">
                        <div class="faq-question" data-toggle="collapse" data-target="#faq1" aria-expanded="false" aria-controls="faq1">
                            <strong>1. Bagaimana cara mengajukan tiket?</strong>
                        </div>
                        <div id="faq1" class="collapse faq-answer">
                            <p>Anda dapat mengajukan tiket melalui aplikasi dengan klik request/scroll kebawah dan isi form request atau menghubungi tim support kami.</p>
                        </div>

                        <div class="faq-question" data-toggle="collapse" data-target="#faq2" aria-expanded="false" aria-controls="faq2">
                            <strong>2. Berapa lama waktu respon untuk tiket saya?</strong>
                        </div>
                        <div id="faq2" class="collapse faq-answer">
                            <p>Waktu respon tergantung pada kompleksitas tiket, namun kami berusaha merespons dalam 24 jam.</p>
                        </div>

                        <div class="faq-question" data-toggle="collapse" data-target="#faq3" aria-expanded="false" aria-controls="faq3">
                            <strong>3. Apakah saya dapat melacak status tiket saya?</strong>
                        </div>
                        <div id="faq3" class="collapse faq-answer">
                            <p>Ya, Anda dapat melacak status tiket melalui dashboard pengguna di aplikasi kami.</p>
                        </div>

                        <div class="faq-question" data-toggle="collapse" data-target="#faq4" aria-expanded="false" aria-controls="faq4">
                            <strong>4. Apa yang harus dilakukan jika saya tidak menerima balasan?</strong>
                        </div>
                        <div id="faq4" class="collapse faq-answer">
                            <p>Jika Anda tidak menerima balasan dalam waktu 24 jam, silakan hubungi tim dukungan kami untuk mendapatkan bantuan lebih lanjut.</p>
                        </div>

                        <div class="faq-question" data-toggle="collapse" data-target="#faq5" aria-expanded="false" aria-controls="faq5">
                            <strong>5. Apakah ada batasan jumlah tiket yang dapat diajukan?</strong>
                        </div>
                        <div id="faq5" class="collapse faq-answer">
                            <p>Tidak ada batasan jumlah tiket yang dapat diajukan. Namun, kami sarankan untuk mengajukan tiket yang relevan dan jelas agar lebih cepat ditangani.</p>
                        </div>

                        <div class="faq-question" data-toggle="collapse" data-target="#faq6" aria-expanded="false" aria-controls="faq6">
                            <strong>6. Bagaimana cara mengubah atau membatalkan tiket yang sudah diajukan?</strong>
                        </div>
                        <div id="faq6" class="collapse faq-answer">
                            <p>Anda dapat mengubah atau membatalkan tiket dengan menghubungi tim dukungan kami untuk bantuan lebih lanjut.</p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>