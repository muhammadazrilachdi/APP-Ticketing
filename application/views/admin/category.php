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
                <th>Prefix</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($category_id as $c) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($c['name']); ?></td>
                    <td><?php echo htmlspecialchars($c['prefix']); ?></td>
                    <td>
                        <a class="ui button CustomYellow detail-button"
                            data-category-id="<?php echo $c['category_id']; ?>"
                            href="<?php echo site_url('admin/category/pic/' . $c['category_id']); ?>"
                            style="background-color: black; color: white; border: none; padding: 10px 15px; text-decoration: none; border-radius: 5px;">
                            PIC
                        </a>
                        <button class="ui olive button CustomGreen edit-button" data-category-id="<?php echo $c['category_id']; ?>" data-category-name="<?php echo htmlspecialchars($c['name']); ?>" data-category-prefix="<?php echo htmlspecialchars($c['prefix']); ?>">Edit</button>
                        <button class="ui button delete-button" data-category-id="<?php echo $c['category_id']; ?>" style="background-color: red; color: white;">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="ui modal" id="createTicketModal">
    <i class="close icon"></i>
    <div class="header">Buat Category Baru</div>
    <div class="content">
        <form class="ui form" method="post" action="<?php echo site_url('admin/category/process_tambah'); ?>">
            <div class="field">
                <label>Prefix Category</label>
                <input type="text" name="prefix" maxlength="3" placeholder="Masukkan Prefix Category" required>
            </div>
            <div class="field">
                <label>Nama Category</label>
                <input type="text" name="name" placeholder="Masukkan Nama Category" required>
            </div>
            <div class="actions">
                <button type="button" class="ui button" onclick="$('#createTicketModal').modal('hide');">Batal</button>
                <button type="submit" class="ui button positive">Tambah Category</button>
            </div>
        </form>
    </div>
</div>

<?php foreach ($category_id as $c) : ?>
    <div class="ui modal" id="editTicketModal_<?php echo $c['category_id']; ?>">
        <i class="close icon"></i>
        <div class="header">Edit Category</div>
        <div class="content">
            <form class="ui form" method="post" action="<?php echo site_url('admin/category/process_edit'); ?>">
                <div class="field">
                    <label>Nama Category</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($c['name']); ?>" placeholder="Masukkan Nama Category" required>
                    <input type="hidden" name="category_id" value="<?php echo $c['category_id']; ?>">
                </div>
                <div class="field">
                    <label>Prefix Category</label>
                    <input type="text" name="prefix" maxlength="3" value="<?php echo htmlspecialchars($c['prefix']); ?>" placeholder="Masukkan Prefix Category" required>
                </div>
                <div class="actions">
                    <button type="button" class="ui button" onclick="$('#editTicketModal_<?php echo $c['category_id']; ?>').modal('hide');">Batal</button>
                    <button type="submit" class="ui button positive">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>