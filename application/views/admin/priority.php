<div class="main-content">
    <div class="welcome-message">Priority</div>
    <div class="ui segment">
        <div class="header-container">
            <button id="openModal" class="ui inverted primary button" onclick="$('#createTicketModal').modal('show');">
                <i class="icon user"></i>
                Tambah Priority
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
    <table class="display" style="margin-top: 20px;" id="table-users">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($priority_id as $p) : ?>
                <tr>
                    <td><?php echo $p['name']; ?></td>
                    <td>
                        <button class="ui olive button edit-button" data-priority-id="<?php echo $p['priority_id']; ?>" data-priority-name="<?php echo htmlspecialchars($p['name']); ?>">Edit</button>
                        <button class="ui button negative delete-button" data-priority-id="<?php echo $p['priority_id']; ?>">Hapus</button>
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
    <div class="header">Buat Priority Baru</div>
    <div class="content">
        <form class="ui form" method="post" action="<?php echo site_url('admin/priority/process_tambah'); ?>"> <!-- Ganti dengan URL sesuai -->
            <div class="field">
                <label>Nama Priority</label>
                <input type="text" name="name" placeholder="Masukkan Nama Priority" required>
            </div>
            <div class="actions">
                <button type="button" class="ui button" onclick="$('#createTicketModal').modal('hide');">Batal</button>
                <button type="submit" class="ui button positive">Tambah Priority</button>
            </div>
        </form>
    </div>
</div>

<?php foreach ($priority_id as $p) : ?>
    <div class="ui modal" id="editTicketModal_<?php echo $p['priority_id']; ?>">
        <i class="close icon"></i>
        <div class="header">Edit Priority</div>
        <div class="content">
            <form class="ui form" method="post" action="<?php echo site_url('admin/priority/process_edit'); ?>">
                <div class="field">
                    <label>Nama Priority</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($p['name']); ?>" placeholder="Masukkan Nama Priority" required>
                    <input type="hidden" name="priority_id" value="<?php echo $p['priority_id']; ?>">
                </div>
                <div class="actions">
                    <button type="button" class="ui button" onclick="$('#editTicketModal_<?php echo $p['priority_id']; ?>').modal('hide');">Batal</button>
                    <button type="submit" class="ui button positive">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>