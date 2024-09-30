<div class="main-content">
    <div class="welcome-message">Departement</div>
    <div class="ui segment">
        <div class="header-container">
            <button id="openModal" class="ui inverted primary button" onclick="$('#createTicketModal').modal('show');">
                <i class="icon user"></i>
                Tambah Departement
            </button>
        </div>
    </div>
    <table class="ui celled table" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>Departement</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departement_id as $d) : ?>
                <tr>
                    <td><?= $d['departement_id']; ?></td>
                    <td><?= $d['name']; ?></td>
                    <td>
                        <button class="ui button edit-button" data-departement-id="<?php echo $d['departement_id']; ?>" data-departement-name="<?php echo htmlspecialchars($d['name']); ?>">Edit</button>
                        <button class="ui button negative delete-button" data-departement-id="<?php echo $d['departement_id']; ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Buat Departement Baru -->
<div class="ui modal" id="createTicketModal">
    <i class="close icon"></i>
    <div class="header">Buat Departement Baru</div>
    <div class="content">
        <form class="ui form" method="post" action="<?php echo site_url('admin/departement/process_tambah'); ?>"> <!-- Ganti dengan URL sesuai -->
            <div class="field">
                <label>Departement ID</label>
                <input type="number" name="departement_id" placeholder="Masukkan Departement ID" required>
            </div>
            <div class="field">
                <label>Nama Departement</label>
                <input type="text" name="name" placeholder="Masukkan Nama Departement" required>
            </div>
            <div class="actions">
                <button type="button" class="ui button" onclick="$('#createTicketModal').modal('hide');">Batal</button>
                <button type="submit" class="ui button positive">Tambah Departement</button>
            </div>
        </form>
    </div>
</div>

<?php foreach ($departement_id as $d) : ?>
    <div class="ui modal" id="editTicketModal_<?php echo $d['departement_id']; ?>">
        <i class="close icon"></i>
        <div class="header">Edit Departement</div>
        <div class="content">
            <form class="ui form" method="post" action="<?php echo site_url('admin/departement/process_edit'); ?>">
                <div class="field">
                    <label>Departement ID</label>
                    <input type="number" name="departement_id" value="<?php echo htmlspecialchars($d['departement_id']); ?>" placeholder="Masukkan Departement ID" required>
                </div>
                <div class="field">
                    <label>Nama Departement</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($d['name']); ?>" placeholder="Masukkan Nama Departement" required>
                </div>
                <div class="actions">
                    <button type="button" class="ui button" onclick="$('#editTicketModal_<?php echo $d['departement_id']; ?>').modal('hide');">Batal</button>
                    <button type="submit" class="ui button positive">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>