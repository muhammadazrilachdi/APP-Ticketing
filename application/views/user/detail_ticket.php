<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="shortcut icon" href="<?= base_url('asset/images/persada.png'); ?>" type="image/png" />
    <title>Detail Tiket</title>
    <style>
        html,
        body {
            height: 100%;
            /* Mengatur tinggi 100% untuk elemen html dan body */
            margin: 0;
            /* Menghapus margin default */
        }

        body {
            background-color: #f8f9fa;
            /* Latar belakang tetap */
        }


        .content-container {
            margin-top: 20px;
            padding: 20px;
        }

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

        .flex-container {
            display: flex;
            justify-content: space-between;
        }

        .problem-detail {
            margin-top: 20px;
        }

        .label {
            font-weight: bold;
            color: black;
            font-size: 16px;
            margin-right: 10px;
            /* Jarak antara label dan nilai */
        }

        .field-value {
            display: inline-block !important;
            margin-bottom: 10px !important;
            font-size: 14px !important;
            margin-left: -10px;
            /* Jarak di sebelah kiri field value */
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
    </style>
</head>

<body>

    <div class="container mx-auto content-container">

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container d-flex align-items-center">
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav custom-nav" style="margin-right: auto;">
                        <li>
                            <a href="<?= base_url('user/dashboard#services'); ?>" title="Back">
                                <i class="fas fa-arrow-left"></i> BACK
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mx-auto content-container">
            <div class="flex-container" style="display: flex; justify-content: space-between;">
                <div class="section ticket-section" style="flex: 1; margin-right: 10px; border: 1px solid #ccc; border-radius: 5px; padding: 15px; background-color: #f9f9f9;">
                    <div class="header" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Detail Tiket</div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr style="background-color: #f1f1f1;">
                                <td style="padding: 10px; text-align: left; font-weight: bold; color: #444;">Status:</td>
                                <td style="padding: 10px; text-align: left;">
                                    <span style="
                                color: <?= $ticket['status_name'] === 'Menunggu Antrean' ? 'red' : ($ticket['status_name'] === 'Sedang Diproses' ? 'orange' : 'green'); ?>; 
                                font-weight: bold; 
                                font-style: italic;">
                                        <?= $ticket['status_name']; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; text-align: left; font-weight: bold; color: #444;">No Tiket:</td>
                                <td style="padding: 10px; text-align: left;"><?= $ticket['no_ticket']; ?></td>
                            </tr>
                            <tr style="background-color: #f1f1f1;">
                                <td style="padding: 10px; text-align: left; font-weight: bold; color: #444;">Jenis:</td>
                                <td style="padding: 10px; text-align: left;"><?= $ticket['category_name']; ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; text-align: left; font-weight: bold; color: #444;">Prioritas:</td>
                                <td style="padding: 10px; text-align: left;"><?= $ticket['priority_name']; ?></td>
                            </tr>
                            <tr style="background-color: #f1f1f1;">
                                <td style="padding: 10px; text-align: left; font-weight: bold; color: #444;">PIC:</td>
                                <td style="padding: 10px; text-align: left;"><?= $ticket['pic_name']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="section reporter-section" style="flex: 1; margin-left: 10px; border: 1px solid #ccc; border-radius: 5px; padding: 15px; background-color: #f9f9f9;">
                    <div class="header" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Pelapor</div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr style="background-color: #f1f1f1;">
                                <td style="padding: 10px; text-align: left; font-weight: bold; color: #444;">Nama:</td>
                                <td style="padding: 10px; text-align: left;"><?= $ticket['user_name']; ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; text-align: left; font-weight: bold; color: #444;">Email:</td>
                                <td style="padding: 10px; text-align: left;"><?= $ticket['email']; ?></td>
                            </tr>
                            <tr style="background-color: #f1f1f1;">
                                <td style="padding: 10px; text-align: left; font-weight: bold; color: #444;">No Handphone:</td>
                                <td style="padding: 10px; text-align: left;"><?= $ticket['no_hp']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="problem-detail section" style="margin-top: 20px; border: 1px solid #ccc; border-radius: 5px; padding: 15px; background-color: #f9f9f9;">
                <div class="header" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Detail Permasalahan</div>
                <table style="width: 100%; border-collapse: collapse;">
                    <tbody>
                        <tr style="background-color: #f1f1f1;">
                            <td style="padding: 10px; text-align: left; font-weight: bold; color: #444;">Topik:</td>
                            <td style="padding: 10px; text-align: left;"><?= isset($ticket['topic']) ? $ticket['topic'] : 'Tidak tersedia'; ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; text-align: left; font-weight: bold; color: #444;">Deskripsi:</td>
                            <td style="padding: 10px; text-align: left;"><?= isset($ticket['description']) ? $ticket['description'] : 'Tidak tersedia'; ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">Lampiran:</td>
                            <td style="padding: 10px 15px; text-align: left;">
                                <?php if (isset($ticket['lampiran']) && $ticket['lampiran']): ?>
                                    <?php
                                    $file_path = base_url('uploads/' . $ticket['lampiran']);
                                    $file_extension = pathinfo($ticket['lampiran'], PATHINFO_EXTENSION);
                                    $image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                                    ?>
                                    <?php if (in_array(strtolower($file_extension), $image_extensions)): ?>
                                        <img src="<?= $file_path ?>" alt="Lampiran" style="max-width: 100%; height: auto;">
                                    <?php elseif ($file_extension == 'pdf'): ?>
                                        <embed src="<?= $file_path ?>" type="application/pdf" width="100%" height="600px" />
                                    <?php else: ?>
                                        <a href="<?= $file_path ?>" target="_blank">Unduh Lampiran</a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    Tidak ada lampiran
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</body>

</html>