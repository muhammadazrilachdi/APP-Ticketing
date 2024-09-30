<div class="main-content">
    <div class="welcome-message">Pengguna</div>
    <div class="ui segment">
        <div class="header-container">
            <button id="openModal" class="ui inverted primary button" onclick="$('#createUserModal').modal('show');">
                <i class="icon user"></i>
                Tambah Pengguna
            </button>
        </div>
    </div>
    <table class="ui celled table" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>Nama</th>
                <th>No Handphone</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user as $u) : ?>
                <tr>
                    <td><?= htmlspecialchars($u['name']); ?></td>
                    <td><?= htmlspecialchars($u['no_hp']); ?></td>
                    <td><?= htmlspecialchars($u['email']); ?></td>
                    <td>
                        <button class="ui button edit-button" data-user-id="<?= $u['nik']; ?>" data-user-name="<?= htmlspecialchars($u['name']); ?>" data-user-nohp="<?= htmlspecialchars($u['no_hp']); ?>" data-user-email="<?= htmlspecialchars($u['email']); ?>">Edit</button>
                        <button class="ui button negative delete-button" data-user-id="<?= $u['nik']; ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Buat Pengguna Baru -->
<div class="ui modal" id="createUserModal">
    <i class="close icon"></i>
    <div class="header">Buat Pengguna Baru</div>
    <div class="content">
        <form class="ui form" method="post" action="<?php echo site_url('admin/user/process_tambah'); ?>">
            <div class="field">
                <label>NIK</label>
                <input type="number" name="nik" placeholder="Masukkan NIK" required>
            </div>
            <div class="field">
                <label>Nama</label>
                <input type="text" name="name" placeholder="Masukkan Nama" required>
            </div>
            <div class="field">
                <label>No Handphone</label>
                <input type="tel" name="no_hp" placeholder="Masukkan No Handphone" required>
            </div>
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan Email" required>
            </div>
            <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <div class="field">
                <label>Departement ID</label>
                <input type="number" name="departement_id" placeholder="Masukkan Departement ID" required>
            </div>
            <div class="actions">
                <button type="button" class="ui button" onclick="$('#createUserModal').modal('hide');">Batal</button>
                <button type="submit" class="ui button positive">Tambah Pengguna</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Pengguna -->
<div class="ui modal" id="editUserModal">
    <i class="close icon"></i>
    <div class="header">Edit Pengguna</div>
    <div class="content">
        <form class="ui form" method="post" action="<?php echo site_url('admin/user/process_edit'); ?>">
            <input type="hidden" name="nik" id="edit-nik">
            <div class="field">
                <label>Nama</label>
                <input type="text" name="name" id="edit-name" placeholder="Masukkan Nama" required>
            </div>
            <div class="field">
                <label>No Handphone</label>
                <input type="tel" name="no_hp" id="edit-no_hp" placeholder="Masukkan No Handphone" required>
            </div>
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" id="edit-email" placeholder="Masukkan Email" required>
            </div>
            <div class="actions">
                <button type="button" class="ui button" onclick="$('#editUserModal').modal('hide');">Batal</button>
                <button type="submit" class="ui button positive">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>