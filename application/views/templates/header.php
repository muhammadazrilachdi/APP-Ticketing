<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="<?= base_url('asset/images/persada.png'); ?>" type="image/png" />
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Membuat wrapper memenuhi tinggi layar */
        }

        .container {
            margin-top: 60px;
            /* Sesuaikan dengan tinggi top bar */
        }

        .content-container {
            margin-left: 150px;
            /* Sesuaikan dengan lebar sidebar */
            width: calc(100% - 222px);
            /* Kurangi lebar sidebar */
            padding: 20px;
        }

        /* Memastikan tooltip muncul di atas content */
        .ui.popup {
            z-index: 9999 !important;
            background-color: #333 !important;
            color: #fff !important;
            border: 1px solid #444 !important;
        }

        /* Arrow tooltip */
        .ui.popup:before {
            background-color: #333 !important;
            border-color: #444 !important;
        }

        .sidebar {
            z-index: 1000;
        }

        .select2 {
            width: 100%;
            /* Mengatur lebar penuh dari elemen induk */
        }

        .top-bar {
            background: #333;
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
            box-sizing: border-box;
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
            background: #444;
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

        .nav-link:hover span,
        .sub-menu a:hover span {
            display: block !important;
        }

        .sub-menu a.active {
            background-color: #444;
        }

        .top-bar .sidebar-text::after {
            content: '';
            position: absolute;
            right: 0;
            top: 9px;
            transform: translateY(-50%);
            width: 1px;
            height: 40px;
            background-color: #444;
        }

        .nav-link:hover span,
        .sub-menu a:hover span {
            display: block !important;
            z-index: 2000 !important;

        }

        .nav-link:hover .tooltip {
            display: block;
            /* Tampilkan tooltip saat dihover */
            z-index: 2000 !important;

        }

        .sidebar-show {
            transform: translateX(0);
        }

        .sub-menu {
            list-style: none;
            padding-left: 30px;
            display: none;
            z-index: 2000 !important;
        }

        .sub-menu li {
            margin: 10px 0;
            margin-left: 5px;
            z-index: 2000 !important;

        }

        .sub-menu a {
            color: #fff;
            text-decoration: none;
            z-index: 2000 !important;

        }

        .sub-menu a:hover {
            text-decoration: underline;
            z-index: 2000 !important;

        }

        .submenu-arrow {
            float: right;
            transition: transform 0.3s ease;
            margin-left: 110px;
        }

        .submenu-arrow.rotate {
            transform: rotate(180deg);
        }

        .sidebar .sidebar-logo {
            width: 200px;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .main-content {
            margin-left: 50px;
            margin-top: 40px;
            padding: 20px;
            height: calc(100vh - 40px);
            box-sizing: border-box;
            z-index: 1 !important;

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

        /* Mengatur padding dan margin untuk memastikan elemen tidak memiliki ruang kosong */
        .ui.segment {
            padding: 10px;
            /* Mengurangi padding di dalam segment */
        }

        .header-container {
            display: flex;
            /* Menggunakan flexbox untuk penataan */
            justify-content: space-between;
            /* Mengatur elemen agar tersebar dengan jarak yang sama */
            align-items: center;
            /* Menyusun elemen secara vertikal di tengah */
            z-index: 1 !important;

        }

        .ui.right.aligned.category.search {
            display: flex;
            /* Menggunakan flexbox untuk penataan dalam search-container */
            align-items: center;
            /* Menyusun elemen secara vertikal di tengah */
        }

        .ui.icon.input.small-search {
            max-width: 200px;
            /* Atur lebar maksimal pencarian */
            width: auto;
            /* Penuhi lebar kontainer jika kurang dari max-width */
            margin-left: 10px;
            /* Jarak antara input pencarian dan tombol Add User */
        }

        .ui.icon.input.small-search input.prompt {
            padding: 5px 10px;
            font-size: 14px;
            /* Ukuran font input pencarian */
        }

        .ui.icon.input.small-search i.search.icon {
            margin-left: 5px;
        }

        /* CSS untuk modal */
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

        /* Gaya untuk header modal agar lebih kecil dan kotak */
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

        /* Tampilan modern untuk card dengan lebar yang lebih besar */
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
    </style>
</head>