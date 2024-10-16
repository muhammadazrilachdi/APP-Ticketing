<div class="container mx-auto content-container">
    <div class="flex-container" style="display: flex; justify-content: space-between;">
        <div class="section ticket-section" style="flex: 1; margin-right: 10px; border: 1px solid #ccc; border-radius: 5px; padding: 15px; background-color: #f9f9f9;">
            <div class="header" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Detail Tiket</div>
            <table style="width: 100%; border-collapse: collapse;">
                <tbody>
                    <tr style="background-color: #f1f1f1;">
                        <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">Status:</td>
                        <td style="padding: 10px 15px; text-align: left;">
                            <span style="
                                color: <?= $ticket['status_name'] === 'Menunggu Antrean' ? 'red' : ($ticket['status_name'] === 'Sedang Diproses' ? 'orange' : 'green'); ?>; 
                                font-weight: bold; 
                                font-style: italic;">
                                <?= $ticket['status_name']; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">No Tiket:</td>
                        <td style="padding: 10px 15px; text-align: left;"><?= $ticket['no_ticket']; ?></td>
                    </tr>
                    <tr style="background-color: #f1f1f1;">
                        <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">Jenis:</td>
                        <td style="padding: 10px 15px; text-align: left;"><?= $ticket['category_name']; ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">Prioritas:</td>
                        <td style="padding: 10px 15px; text-align: left;"><?= $ticket['priority_name']; ?></td>
                    </tr>
                    <tr style="background-color: #f1f1f1;">
                        <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">PIC:</td>
                        <td style="padding: 10px 15px; text-align: left;"><?= $ticket['pic_name']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section reporter-section" style="flex: 1; margin-left: 10px; border: 1px solid #ccc; border-radius: 5px; padding: 15px; background-color: #f9f9f9;">
            <div class="header" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Pelapor</div>
            <table style="width: 100%; border-collapse: collapse;">
                <tbody>
                    <tr style="background-color: #f1f1f1;">
                        <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">Nama:</td>
                        <td style="padding: 10px 15px; text-align: left;"><?= $ticket['user_name']; ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">Email:</td>
                        <td style="padding: 10px 15px; text-align: left;"><?= $ticket['email']; ?></td>
                    </tr>
                    <tr style="background-color: #f1f1f1;">
                        <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">No Handphone:</td>
                        <td style="padding: 10px 15px; text-align: left;"><?= $ticket['no_hp']; ?></td>
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
                    <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">Topik:</td>
                    <td style="padding: 10px 15px; text-align: left;"><?= isset($ticket['topic']) ? $ticket['topic'] : 'Tidak tersedia'; ?></td>
                </tr>
                <tr>
                    <td style="padding: 10px 15px; text-align: left; font-weight: bold; color: #444;">Deskripsi:</td>
                    <td style="padding: 10px 15px; text-align: left;"><?= isset($ticket['description']) ? $ticket['description'] : 'Tidak tersedia'; ?></td>
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