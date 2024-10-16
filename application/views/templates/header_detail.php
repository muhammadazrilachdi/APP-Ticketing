<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="shortcut icon" href="<?= base_url('asset/images/persada.png'); ?>" type="image/png" />
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100vh;
            height: 100%;
            margin: 0;
            padding-bottom: 60px;
            /* Sesuaikan dengan tinggi footer */
            background-color: #f8f9fa;
            /* Latar belakang */
        }

        .container {
            margin-top: 60px;
            /* Sesuaikan dengan tinggi top bar */
        }

        .content-container {
            margin-left: 222px;
            /* Sesuaikan dengan lebar sidebar */
            width: calc(100% - 222px);
            /* Kurangi lebar sidebar */
            padding: 20px;
        }

        .top-bar {
            background: #36454F;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            height: 40px;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1001;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .top-bar .logo img {
            height: 20px;
        }

        .top-bar .date-time {
            display: flex;
            align-items: center;
            font-size: 1em;
            color: #9EB0B3;
            font-weight: bold;
            margin-right: auto;
        }

        .top-bar .date-time p {
            margin: 0;
            padding: 0 10px;
        }

        .separator {
            width: 1px;
            height: 40px;
            background: #424A4D;
        }

        .top-bar .sidebar-text {
            margin: 0;
            font-size: 1em;
            color: #9EB0B3;
            text-align: center;
            position: relative;
            padding-right: 33px;
            font-weight: bold;
        }

        .top-bar .sidebar-text::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 40px;
            background-color: #424A4D;
        }

        .sidebar {
            background: linear-gradient(to bottom right, #36454F, #36454F);
            color: #fff;
            width: 222px;
            height: 100%;
            position: fixed;
            top: 40px;
            left: 0;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            z-index: 1000;
        }

        .sidebar .sidebar-logo {
            width: 200px;
            margin: 0 auto 20px;
        }

        .sidebar .nav-link {
            color: #fff;
            margin: 10px 0;
            text-decoration: none;
            display: flex;
            align-items: center;
            width: 100%;
            margin-left: 15px;
            margin-top: 15px;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .sidebar .nav-link:hover {
            text-decoration: underline;
        }

        .sidebar-toggle {
            position: absolute;
            top: 0;
            left: 0;
            width: 50px;
            height: 100%;
            background: #333;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .sidebar-hide {
            transform: translateX(-100%);
        }

        .sidebar-show {
            transform: translateX(0);
        }

        .sub-menu {
            list-style: none;
            padding-left: 30px;
            display: none;
        }

        .sub-menu li {
            margin: 10px 0;
        }

        .sub-menu a {
            color: #fff;
            text-decoration: none;
        }

        .sub-menu a:hover {
            text-decoration: underline;
        }

        .submenu-arrow {
            float: right;
            transition: transform 0.3s ease;
            margin-left: 110px;
        }

        .submenu-arrow.rotate {
            transform: rotate(180deg);
        }

        .main-content {
            margin-left: 220px;
            margin-top: 40px;
            padding: 20px;
            height: calc(100vh - 40px);
            box-sizing: border-box;
        }

        .welcome-message {
            font-size: 2em;
            /* Ukuran font lebih besar */
            color: #36454F;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            /* Menempatkan teks di tengah */
        }

        /* Gaya untuk modal */
        .ui.modal.custom {
            width: 400px;
            /* Atur lebar modal sesuai kebutuhan */
            height: auto;
            /* Sesuaikan tinggi modal secara otomatis */
            border-radius: 5px;
            /* Sudut yang sedikit melengkung */
            padding: 20px;
            /* Jarak internal di dalam modal */
        }

        .ui.modal.custom .header {
            font-size: 1.2em;
            /* Ukuran font header modal */
            font-weight: bold;
            border-bottom: 1px solid #ddd;
            /* Garis bawah header */
            padding-bottom: 10px;
            /* Jarak di bawah header */
        }

        /* Tampilan modern untuk card */
        .ui.card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 20px;
            margin: 20px;
            width: 100%;
            /* Full width dalam grid */
            max-width: 400px;
            /* Lebar maksimal untuk card */
        }

        .ui.card:hover {
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            transform: translateY(-10px);
        }

        .ui.card .header {
            font-size: 1.5rem;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ui.card .header i {
            font-size: 1.8rem;
            color: #007bff;
            /* Warna ikon */
        }

        .ui.card .description {
            margin-top: 10px;
            font-size: 2rem;
            font-weight: bold;
            color: #444;
            text-align: center;
        }

        /* Flexbox untuk card yang responsif dan sejajar */
        .ui.stackable.centered.grid {
            display: flex;
            justify-content: center;
            /* Posisikan card di tengah */
            flex-wrap: wrap;
            /* Agar card tetap rapi di layar kecil */
        }

        .eight.wide.column {
            flex: 1 1 300px;
            /* Fleksibel dengan ukuran minimal 300px */
            max-width: 400px;
            /* Membatasi lebar maksimal */
            margin: 10px;
        }

        footer {
            color: #6C757D;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: calc(100% - 220px);
            left: 220px;
            border-top: 1px dotted #9EB0B3;
            background: #fff;
        }

        footer .footer-text {
            margin: 0;
            font-weight: bold;
        }

        footer .powered-by {
            color: #007BFF;
            font-weight: bold;
            display: inline;
        }

        .alert-container {
            margin-bottom: 13px;
            text-align: left;
            width: 30%;
        }

        .CustomYellow {
            background-color: #F7DC6F;
            color: #333;
        }

        .CustomGreen {
            background-color: #8BC34A;
            color: #333;
        }

        .CustomRed {
            background-color: #FFC080;
            color: #333;
        }

        /* Flexbox untuk pengaturan */
        .flex-container {
            display: flex;
            justify-content: space-between;
        }

        /* Penataan detail tiket */
        .section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 10px;
            flex: 2;
        }

        .header {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .status-value {
            padding: 8px;
            border-radius: 4px;
            margin-left: 10px;
            /* Jarak antara label dan status */
        }

        .label {
            font-weight: bold;
            color: black;
            font-size: 16px;
            margin-right: 10px;
            /* Jarak antara label dan nilai */
        }

        .field-value {
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
        }

        .field-container {
            margin-bottom: 15px;
            /* Jarak antara field atas dan bawah */
        }

        .field-container.status-field {
            margin-bottom: 30px;
            /* Jarak tambahan khusus untuk status */
        }

        .flex-container>.section {
            flex: 1;
            margin-right: 10px;
        }

        .flex-container>.section:last-child {
            margin-right: 0;
        }

        .custom-nav {
            background-color: rgba(255, 0, 0, 0.7);
            border-radius: 30px 30px 10px 10px;
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
            border-radius: 30px 30px 10px 10px;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .content-container {
                margin-left: 0;
                width: 100%;
            }

            .flex-container {
                flex-direction: column;
            }

            .section {
                margin: 10px 0;
            }

            footer {
                width: 100%;
                left: 0;
            }
        }

        /* Animasi */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>