<div class="main-content">
    <div class="welcome-message">Category</div>
    <div class="ui segment">
        <div class="header-container">
            <button id="openCreateModal" class="ui inverted primary button" onclick="$('#createTicketModal').modal('show');">
                <i class="icon user"></i>
                Tambah Kategori
            </button>
        </div>
    </div>
    <table class="ui celled table" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>Category</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($category_id as $c) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($c['category_id']); ?></td>
                    <td><?php echo htmlspecialchars($c['name']); ?></td>
                    <td>
                        <button class="ui button edit-button" data-category-id="<?php echo $c['category_id']; ?>" data-category-name="<?php echo htmlspecialchars($c['name']); ?>">Edit</button>
                        <button class="ui button negative delete-button" data-category-id="<?php echo $c['category_id']; ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal untuk Tambah Kategori -->
<div class="ui modal" id="createTicketModal">
    <i class="close icon"></i>
    <div class="header">Buat Kategori Baru</div>
    <div class="content">
        <form class="ui form" method="post" action="<?php echo site_url('admin/category/process_tambah'); ?>">
            <div class="field">
                <label>Category ID</label>
                <input type="number" name="category_id" placeholder="Masukkan Kategori ID" required>
            </div>
            <div class="field">
                <label>Nama Category</label>
                <input type="text" name="name" placeholder="Masukkan Nama Kategori" required>
            </div>
            <div class="actions">
                <button type="button" class="ui button" onclick="$('#createTicketModal').modal('hide');">Batal</button>
                <button type="submit" class="ui button positive">Tambah Kategori</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal untuk Edit Kategori -->
<?php foreach ($category_id as $c) : ?>
    <div class="ui modal" id="editTicketModal_<?php echo $c['category_id']; ?>">
        <i class="close icon"></i>
        <div class="header">Edit Kategori</div>
        <div class="content">
            <form class="ui form" method="post" action="<?php echo site_url('admin/category/process_edit'); ?>">
                <div class="field">
                    <label>Category ID</label>
                    <input type="number" name="category_id" value="<?php echo htmlspecialchars($c['category_id']); ?>" placeholder="Masukkan Kategori ID" required>
                </div>
                <div class="field">
                    <label>Nama Category</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($c['name']); ?>" placeholder="Masukkan Nama Kategori" required>
                </div>
                <div class="actions">
                    <button type="button" class="ui button" onclick="$('#editTicketModal_<?php echo $c['category_id']; ?>').modal('hide');">Batal</button>
                    <button type="submit" class="ui button positive">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>