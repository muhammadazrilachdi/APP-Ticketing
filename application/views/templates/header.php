<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: rgb(240, 240, 240);
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
            background: #9EB0B3;
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
            background-color: #9EB0B3;
        }

        .sidebar {
            background: #2F4F4F;
            color: #fff;
            width: 222px;
            height: 100%;
            position: fixed;
            top: 40px;
            left: 0;
            padding: 20px 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            z-index: 1000;
            background: linear-gradient(to bottom right, #36454F, #36454F);
        }

        .sidebar .sidebar-text {
            margin: 50px;
            font-size: 1em;
            color: #fff;
            text-align: center;
        }

        .sidebar .logo-separator {
            width: 222px;
            height: 1px;
            background: #6C757D;
            margin-right: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
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

        .sub-menu {
            list-style: none;
            padding-left: 30px;
            display: none;
        }

        .sub-menu li {
            margin: 10px 0;
            margin-left: 5px;
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

        .sidebar .sidebar-logo {
            width: 200px;
            margin: 0 auto;
            margin-bottom: 20px;
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


        footer {
            color: #6C757D;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: calc(100% - 220px);
            left: 220px;
            border-top: 1px dotted #9EB0B3;
            background: transparent;
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
    </style>
</head>