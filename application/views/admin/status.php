<div class="main-content">
    <div class="welcome-message">Status</div>
    <div class="ui segment">
        <div class="header-container">
            <button id="openModal" class="ui inverted primary button" onclick="$('#createTicketModal').modal('show');">
                <i class="icon user"></i>
                Tambah Status
            </button>
        </div>
    </div>
    <table class="ui celled table" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>Status</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($status_id as $s) : ?>
                <tr>
                    <td><?php echo $s['status_id']; ?></td>
                    <td><?php echo $s['name']; ?></td>
                    <td>
                        <button class="ui button edit-button" data-status-id="<?php echo $s['status_id']; ?>" data-status-name="<?php echo htmlspecialchars($s['name']); ?>">Edit</button>
                        <button class="ui button negative delete-button" data-status-id="<?php echo $s['status_id']; ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
<!-- Modal Buat Ticket Baru -->
<div class="ui modal" id="createTicketModal">
    <i class="close icon"></i>
    <div class="header">Buat Status Baru</div>
    <div class="content">
        <form class="ui form" method="post" action="<?php echo site_url('admin/status/process_tambah'); ?>"> <!-- Ganti dengan URL sesuai -->
            <div class="field">
                <label>Status ID</label>
                <input type="number" name="status_id" placeholder="Masukkan Status ID" required>
            </div>
            <div class="field">
                <label>Nama Status</label>
                <input type="text" name="name" placeholder="Masukkan Nama Status" required>
            </div>
            <div class="actions">
                <button type="button" class="ui button" onclick="$('#createTicketModal').modal('hide');">Batal</button>
                <button type="submit" class="ui button positive">Tambah Status</button>
            </div>
        </form>
    </div>
</div>

<?php foreach ($status_id as $s) : ?>
    <div class="ui modal" id="editTicketModal_<?php echo $s['status_id']; ?>">
        <i class="close icon"></i>
        <div class="header">Edit Status</div>
        <div class="content">
            <form class="ui form" method="post" action="<?php echo site_url('admin/status/process_edit'); ?>">
                <div class="field">
                    <label>Status ID</label>
                    <input type="number" name="status_id" value="<?php echo htmlspecialchars($s['status_id']); ?>" placeholder="Masukkan Status ID" required>
                </div>
                <div class="field">
                    <label>Nama Status</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($s['name']); ?>" placeholder="Masukkan Nama Status" required>
                </div>
                <div class="actions">
                    <button type="button" class="ui button" onclick="$('#editTicketModal_<?php echo $s['status_id']; ?>').modal('hide');">Batal</button>
                    <button type="submit" class="ui button positive">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>