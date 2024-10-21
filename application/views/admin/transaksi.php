<div class="main-content">
    <div class="welcome-message">Transaksi</div>
    <div class="ui segment">
        <div class="header-container">
            <button id="openCreateModal" class="ui inverted primary button" onclick="$('#createTransaksiModal').modal('show');">
                <i class="icon plus"></i>
                Tambah Transaksi
            </button>
        </div>
    </div>
    <div class="alert-container">
        <div class="ui messages">
            <?php if ($this->session->flashdata('error')): ?>
                <div class="ui negative message">
                    <p><?= $this->session->flashdata('error'); ?></p>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="ui positive message">
                    <p><?= $this->session->flashdata('success'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card">
        <div class="ui top attached tabular menu">
            <a class="item active" data-tab="first">Menunggu Antrean & Sedang Diproses</a>
            <a class="item" data-tab="second">Selesai</a>
        </div>

        <div class="ui bottom attached tab segment active" data-tab="first">
            <table class="display" id="table-users">
                <thead>
                    <tr>
                        <th>No Ticket</th>
                        <th>ID Request</th>
                        <th>Category</th>
                        <th>Priority</th>
                        <th>Topic</th>
                        <th>Resource</th>
                        <th>Status</th>
                        <th>Feedback</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $hasPending = false; // Flag untuk cek apakah ada data menunggu atau sedang diproses
                    foreach ($request as $row) :
                        if ($row['status_name'] == 'Menunggu Antrean' || $row['status_name'] == 'Sedang Diproses') :
                            $hasPending = true; // Set flag jika ada data
                    ?>
                            <tr>
                                <td><?php echo $row['no_ticket']; ?></td>
                                <td><?php echo $row['user_name']; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td><?php echo $row['priority_name']; ?></td>
                                <td><?php echo $row['topic']; ?></td>
                                <td><?php echo $row['resource']; ?></td>
                                <td><?php echo $row['status_name']; ?></td>
                                <td><?php echo $row['feedback']; ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/transaksi/detail/' . $row['no_ticket']); ?>" class="ui grey button">
                                        Detail
                                    </a>
                                    <button class="ui olive button edit-button" data-request-id="<?php echo $row['request_id']; ?>" data-request-topic="<?php echo $row['topic']; ?>" data-request-resource="<?php echo $row['resource']; ?>">
                                        Edit
                                    </button>
                                    <button class="ui button negative delete-button" data-request-id="<?php echo $row['request_id']; ?>">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php
                        endif;
                    endforeach;
                    if (!$hasPending): ?>
                        <tr>
                            <td colspan="8">Tidak ada data untuk ditampilkan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="ui bottom attached tab segment" data-tab="second">
            <table class="display" id="requestTable" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 10px; text-align: left;">
                            <div style="margin-bottom: 5px;">No Ticket</div>
                        </th>
                        <th style="padding: 10px; text-align: left;">
                            <div style="margin-bottom: 5px;">ID Request</div>
                        </th>
                        <th style="padding: 10px; text-align: left;">
                            <div style="margin-bottom: 5px;">Category</div>
                        </th>
                        <th style="padding: 10px; text-align: left;">
                            <div style="margin-bottom: 5px;">Priority</div>
                        </th>
                        <th style="padding: 10px; text-align: left;">
                            <div style="margin-bottom: 5px;">Topic</div>
                        </th>
                        <th style="padding: 10px; text-align: left;">
                            <div style="margin-bottom: 5px;">Resource</div>
                        </th>
                        <th style="padding: 10px; text-align: left;">
                            <div style="margin-bottom: 5px;">Status</div>
                        </th>
                        <th style="padding: 10px; text-align: left;">
                            <div style="margin-bottom: 5px;">Feedback</div>
                        </th>
                        <th style="padding: 10px; text-align: left;">
                            <div style="margin-bottom: 5px;">Aksi</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $hasCompleted = false;
                    foreach ($request as $row) :
                        if ($row['status_name'] == 'Selesai') :
                            $hasCompleted = true;
                    ?>
                            <tr>
                                <td style="padding: 10px; white-space: nowrap;"><?php echo $row['no_ticket']; ?></td>
                                <td style="padding: 10px; white-space: nowrap;"><?php echo $row['user_name']; ?></td>
                                <td style="padding: 10px; white-space: nowrap;"><?php echo $row['category_name']; ?></td>
                                <td style="padding: 10px; white-space: nowrap;"><?php echo $row['priority_name']; ?></td>
                                <td style="padding: 10px; white-space: nowrap;"><?php echo $row['topic']; ?></td>
                                <td style="padding: 10px; white-space: nowrap;"><?php echo $row['resource']; ?></td>
                                <td style="padding: 10px; white-space: nowrap;"><?php echo $row['status_name']; ?></td>
                                <td style="padding: 10px; white-space: nowrap;"><?php echo $row['feedback']; ?></td>
                                <td style="padding: 10px; display: flex; justify-content: center;">
                                    <a href="<?php echo site_url('admin/transaksi/detail/' . $row['no_ticket']); ?>" class="ui grey button">
                                        Detail
                                    </a>
                                    <button class="ui olive button edit-button" data-request-id="<?php echo $row['request_id']; ?>" data-request-topic="<?php echo $row['topic']; ?>" data-request-resource="<?php echo $row['resource']; ?>" style="margin-right: 5px;">
                                        Edit
                                    </button>
                                    <button class="ui button negative delete-button" data-request-id="<?php echo $row['request_id']; ?>">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php
                        endif;
                    endforeach;
                    if (!$hasCompleted) : ?>
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 10px;">Tidak ada data untuk ditampilkan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="logout-message" id="logout-message" style="display: none;">
            <div class="modal-content">
                <h4>Apakah Anda yakin ingin logout?</h4>
                <button button class="ui red basic button" id="confirm-logout">Ya</button>
                <button class="ui black basic button" id="cancel-logout">Tidak</button>
            </div>
        </div>

        <div class="ui modal" id="createTransaksiModal">
            <i class="close icon"></i>
            <div class="header">Buat Transaksi Baru</div>
            <div class="content">
                <form class="ui form" id="transactionForm" method="post" action="<?php echo site_url('admin/transaksi/process_tambah'); ?>" enctype="multipart/form-data">
                    <div class="field">
                        <label>ID Request</label>
                        <select name="user_id_request" class="select2" style="width: 100%;" required>
                            <option value="">Pilih ID Request</option>
                            <?php foreach ($user as $u) : ?>
                                <option value="<?php echo $u['user_id']; ?>"><?php echo $u['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label>Kategori</label>
                        <select name="category_id" class="select2" style="width: 100%;" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($category as $cat) : ?>
                                <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label>Prioritas</label>
                        <select name="priority_id" class="select2" style="width: 100%;" required>
                            <option value="">Pilih Prioritas</option>
                            <?php foreach ($priority as $pri) : ?>
                                <option value="<?php echo $pri['priority_id']; ?>"><?php echo $pri['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label>Topik</label>
                        <input type="text" name="topic" placeholder="Masukkan Topik" required>
                    </div>
                    <div class="field">
                        <label>Deskripsi</label>
                        <textarea name="description" placeholder="Masukkan Deskripsi" required></textarea>
                    </div>
                    <div class="field">
                        <label>Lampiran</label>
                        <input type="file" name="lampiran" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    </div>
                    <div class="actions">
                        <button type="button" class="ui button" onclick="$('#createTransaksiModal').modal('hide');">Batal</button>
                        <button type="submit" class="ui button positive">Tambah Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
        <?php foreach ($request as $row) : ?>
            <div class="ui modal" id="editTransaksiModal_<?php echo $row['request_id']; ?>">
                <i class="close icon"></i>
                <div class="header">Edit Transaksi</div>
                <div class="content">
                    <form class="ui form" method="post" action="<?php echo site_url('admin/transaksi/process_edit'); ?>">
                        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                        <div class="field">
                            <label>No Ticket</label>
                            <input type="text" name="no_ticket" value="<?php echo htmlspecialchars($row['no_ticket']); ?>" placeholder="Masukkan No Ticket" required>
                        </div>
                        <div class="field">
                            <label>Kategori</label>
                            <select name="category_id" class="select2" style="width: 100%;" required>
                                <option value="" disabled>Pilih Kategori</option> <!-- Placeholder -->
                                <?php foreach ($category as $cat) : ?>
                                    <option value="<?php echo $cat['category_id']; ?>" <?php echo ($cat['category_id'] == $row['category_id']) ? 'selected' : ''; ?>><?php echo $cat['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="field">
                            <label>Prioritas</label>
                            <select name="priority_id" class="select2" style="width: 100%;" required>
                                <option value="" disabled>Pilih Prioritas</option> <!-- Placeholder -->
                                <?php foreach ($priority as $pri) : ?>
                                    <option value="<?php echo $pri['priority_id']; ?>" <?php echo ($pri['priority_id'] == $row['priority_id']) ? 'selected' : ''; ?>><?php echo $pri['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="field">
                            <label>Topik</label>
                            <input type="text" name="topic" value="<?php echo htmlspecialchars($row['topic']); ?>" placeholder="Masukkan Topik" required>
                        </div>

                        <div class="field">
                            <label>Deskripsi</label>
                            <textarea name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                        </div>

                        <div class="field">
                            <label>Status</label>
                            <select name="status_id" class="select2" style="width: 100%;" required>
                                <option value="" disabled>Pilih Status</option> <!-- Placeholder -->
                                <?php foreach ($status as $sta) : ?>
                                    <option value="<?php echo $sta['status_id']; ?>" <?php echo ($sta['status_id'] == $row['status_id']) ? 'selected' : ''; ?>><?php echo $sta['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="field">
                            <label>Feedback</label>
                            <textarea name="feedback"><?php echo htmlspecialchars($row['feedback']); ?></textarea>
                        </div>

                        <div class="actions">
                            <button type="button" class="ui button" onclick="$('#editTransaksiModal_<?php echo $row['request_id']; ?>').modal('hide');">Batal</button>
                            <button type="submit" class="ui button positive">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>