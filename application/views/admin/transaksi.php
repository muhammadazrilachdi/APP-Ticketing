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
    <div class="card">
        <div class="ui top attached tabular menu">
            <a class="item active" data-tab="first">Menunggu Antrean & Sedang Diproses</a>
            <a class="item" data-tab="second">Selesai</a>
        </div>

        <div class="ui bottom attached tab segment active" data-tab="first">
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Topic</th>
                        <th>Description</th>
                        <th>ID Request</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($request as $row) : ?>
                        <?php if ($row['status_name'] == 'Menunggu Antrean' || $row['status_name'] == 'Sedang Diproses') : ?>
                            <tr>
                                <td><?php echo $row['category_name']; ?></td>
                                <td><?php echo $row['priority_name']; ?></td>
                                <td><?php echo $row['status_name']; ?></td>
                                <td><?php echo $row['topic']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['user_name']; ?></td>
                                <td>
                                    <button class="ui button edit-button" data-request-id="<?php echo $row['request_id']; ?>" data-request-topic="<?php echo $row['topic']; ?>" data-request-description="<?php echo $row['description']; ?>">
                                        Edit
                                    </button>
                                    <button class="ui button negative delete-button" data-request-id="<?php echo $row['request_id']; ?>">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="ui bottom attached tab segment" data-tab="second">
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Topic</th>
                        <th>Description</th>
                        <th>ID Request</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($request as $row) : ?>
                        <?php if ($row['status_name'] == 'Selesai') : ?>
                            <tr>
                                <td><?php echo $row['category_name']; ?></td>
                                <td><?php echo $row['priority_name']; ?></td>
                                <td><?php echo $row['status_name']; ?></td>
                                <td><?php echo $row['topic']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['user_name']; ?></td>
                                <td>
                                    <button class="ui button edit-button" data-request-id="<?php echo $row['request_id']; ?>" data-request-topic="<?php echo $row['topic']; ?>" data-request-description="<?php echo $row['description']; ?>">
                                        Edit
                                    </button>
                                    <button class="ui button negative delete-button" data-request-id="<?php echo $row['request_id']; ?>">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="ui modal" id="createTransaksiModal">
            <i class="close icon"></i>
            <div class="header">Buat Transaksi Baru</div>
            <div class="content">
                <form class="ui form" method="post" action="<?php echo site_url('admin/transaksi/process_tambah'); ?>">
                    <div class="field">
                        <label>Kategori</label>
                        <select name="category_id" class="ui dropdown" required>
                            <?php foreach ($category as $cat) : ?>
                                <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label>Prioritas</label>
                        <select name="priority_id" class="ui dropdown" required>
                            <?php foreach ($priority as $pri) : ?>
                                <option value="<?php echo $pri['priority_id']; ?>"><?php echo $pri['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select name="status_id" class="ui dropdown" required>
                            <?php foreach ($status as $sta) : ?>
                                <option value="<?php echo $sta['status_id']; ?>"><?php echo $sta['name']; ?></option>
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
                        <label>ID Request</label>
                        <input type="number" name="user_id_request" placeholder="Masukkan ID Request" required>
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
                            <label>Kategori</label>
                            <select name="category_id" class="ui dropdown" required>
                                <?php foreach ($category as $cat) : ?>
                                    <option value="<?php echo $cat['category_id']; ?>" <?php echo ($cat['category_id'] == $row['category_id']) ? 'selected' : ''; ?>><?php echo $cat['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="field">
                            <label>Prioritas</label>
                            <select name="priority_id" class="ui dropdown" required>
                                <?php foreach ($priority as $pri) : ?>
                                    <option value="<?php echo $pri['priority_id']; ?>" <?php echo ($pri['priority_id'] == $row['priority_id']) ? 'selected' : ''; ?>><?php echo $pri['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="field">
                            <label>Status</label>
                            <select name="status_id" class="ui dropdown" required>
                                <?php foreach ($status as $sta) : ?>
                                    <option value="<?php echo $sta['status_id']; ?>" <?php echo ($sta['status_id'] == $row['status_id']) ? 'selected' : ''; ?>><?php echo $sta['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="field">
                            <label>Topik</label>
                            <input type="text" name="topic" value="<?php echo $row['topic']; ?>" placeholder="Masukkan Topik" required>
                        </div>
                        <div class="field">
                            <label>Deskripsi</label>
                            <textarea name="description" required><?php echo $row['description']; ?></textarea>
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