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
                        <button class="ui olive button edit-button"
                            data-user-id="<?php echo $u['user_id']; ?>"
                            data-nik="<?php echo $u['nik']; ?>"
                            data-name="<?php echo $u['name']; ?>"
                            data-no_hp="<?php echo $u['no_hp']; ?>"
                            data-email="<?php echo $u['email']; ?>"
                            data-departement-id="<?php echo $u['departement_id']; ?>">Edit</button>
                        <button class="ui button negative delete-button" data-user-id="<?= $u['user_id']; ?>">Hapus</button>
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
                <input type="number" name="no_hp" placeholder="Masukkan No Handphone" required>
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
                <label>Departemen</label>
                <select name="departement_id" class="select2" style="width: 100%;" required>
                    <option value="">Pilih Departemen</option>
                    <?php foreach ($departement_id as $dep) : ?>
                        <option value="<?php echo $dep['departement_id']; ?>"><?php echo $dep['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="actions">
                <button type="button" class="ui button" onclick="$('#createUserModal').modal('hide');">Batal</button>
                <button type="submit" class="ui button positive">Tambah Pengguna</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">Edit Pengguna</div>
    <div class="content">
        <form class="ui form" id="editForm" method="post" action="<?= site_url('admin/user/process_edit') ?>">
            <input type="hidden" name="user_id" id="user_id">

            <div class="field">
                <label>NIK</label>
                <input type="number" name="nik" id="nik" placeholder="Masukkan NIK" required>
            </div>
            <div class="field">
                <label>Nama</label>
                <input type="text" name="name" id="name" placeholder="Masukkan Nama" required>
            </div>
            <div class="field">
                <label>No Handphone</label>
                <input type="number" name="no_hp" id="no_hp" placeholder="Masukkan No Handphone" required>
            </div>
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan Email" required>
            </div>
            <div class="field">
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan Password (biarkan kosong jika tidak diubah)">
            </div>
            <div class="field">
                <label>Departemen</label>
                <select name="departement_id" id="departement_id" class="select2" style="width: 100%;" required>
                    <option value="">Pilih Departemen</option>
                    <?php foreach ($departement_id as $dep) : ?>
                        <option value="<?php echo $dep['departement_id']; ?>"><?php echo $dep['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>
    <div class="actions">
        <button type="button" class="ui button" onclick="closeModal()">Batal</button>
        <button type="submit" class="ui button positive" form="editForm">Perbarui Pengguna</button>
    </div>
</div>