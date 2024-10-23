<div class="main-content">
    <div class="welcome-message"><?php echo $title; ?></div>
    <div class="ui segment">
        <div class="header-container">
            <button id="openModal" class="ui inverted primary button" onclick="$('#createCategoryPicModal').modal('show');">
                <i class="icon user"></i>
                Tambah Category PIC
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
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            usort($category_pic, function ($a, $b) {
                return $b['is_active'] - $a['is_active']; // Urutkan berdasarkan is_active secara menurun
            });
            foreach ($category_pic as $row) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['no_hp']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td>
                        <?php if ($row['is_active'] == 1) : ?>
                            <div class="ui green label">Aktif</div> <!-- Badge hijau untuk Aktif -->
                        <?php else : ?>
                            <div class="ui red label">Tidak Aktif</div> <!-- Badge merah untuk Tidak Aktif -->
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="ui button olive edit-button" data-category-pic-id="<?php echo $row['category_pic_id']; ?>" data-category-id="<?php echo $row['category_id']; ?>" data-user-id="<?php echo $row['user_id']; ?>">Edit</button>
                        <button class="ui  negative button delete-button" data-category-pic-id="<?php echo $row['category_pic_id']; ?>" data-category-id="<?php echo $row['category_id']; ?>">Hapus</button>
                        <?php if ($row['is_active'] == 1) : ?>
                            <button class="ui button negative nonaktifkan-button" data-category-pic-id="<?php echo $row['category_pic_id']; ?>" data-category-id="<?php echo $row['category_id']; ?>" style="background-color: orange;">Nonaktifkan</button>
                        <?php else : ?>
                            <button class="ui button CustomGreen aktifkan-button" data-category-pic-id="<?php echo $row['category_pic_id']; ?>" data-category-id="<?php echo $row['category_id']; ?>" style="background-color: green; color:white;">Aktifkan</button>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="ui modal" id="createCategoryPicModal">
    <i class="close icon"></i>
    <div class="header">Buat Category PIC Baru</div>
    <div class="content">
        <form class="ui form" method="post" action="<?php echo site_url('admin/category/pic_tambah/' . $category_id); ?>">
            <div class="field">
                <label>User ID</label>
                <select name="user_id" class="select2" style="width: 100%;" required>
                    <?php foreach ($user as $u) : ?>
                        <option value="<?php echo $u['user_id']; ?>"><?php echo $u['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="actions">
                <button type="button" class="ui button" onclick="$('#createCategoryPicModal').modal('hide');">Batal</button>
                <button type="submit" class="ui button positive">Tambah Category PIC</button>
            </div>
        </form>
    </div>
</div>

<div class="ui modal" id="editPicModal">
    <i class="close icon"></i>
    <div class="header">Edit PIC</div>
    <div class="content">
        <form class="ui form" method="post" action="<?php echo site_url('admin/category/pic_edit/' . $category_id); ?>">
            <input type="hidden" name="category_pic_id" value="">

            <div class="field">
                <label>User ID</label>
                <select name="user_id" class="select2" style="width: 100%;" required>
                    <?php foreach ($user as $u) : ?>
                        <option value="<?php echo $u['user_id']; ?>"><?php echo $u['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="actions">
                <button type="button" class="ui button" onclick="$('#editPicModal').modal('hide');">Batal</button>
                <button type="submit" class="ui button positive">Simpan</button>
            </div>
        </form>
    </div>
</div>