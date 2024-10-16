<!-- Semantic UI JS -->
<footer>
    <p>&copy; 2024 Management System Asset. All rights reserved.</p>
    <p1 class="powered-by">Powered by IT APP</p1>
</footer>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-users').DataTable({
            "ordering": true,
            "searching": true,
            "paging": true
        });
    });

    $(document).ready(function() {
        $('.select2').select2({
            allowClear: false
        });
    });

    $(document).ready(function() {
        $('.edit-button').on('click', function() {
            const userId = $(this).data('user-id');
            const userName = $(this).data('user-name');
            const userNoHp = $(this).data('user-nohp');
            const userEmail = $(this).data('user-email');

            $('#edit-nik').val(userId);
            $('#edit-name').val(userName);
            $('#edit-no_hp').val(userNoHp);
            $('#edit-email').val(userEmail);

            $('#editUserModal').modal('show');
        });

        $('#editUserForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?php echo site_url('admin/user/process_edit'); ?>',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert('Pengguna berhasil diperbarui.');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat mengedit pengguna.');
                }
            });
        });

        $(document).ready(function() {
            $(document).on('click', '.delete-button', function() {
                var userId = $(this).data('user-id');
                if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                    window.location.href = '<?php echo site_url('admin/user/delete/'); ?>' + userId;
                }
            });

            $(document).on('click', '.edit-button', function() {
                var userId = $(this).data('user-id');
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const masterMenu = document.getElementById('master-menu');
        const masterSubmenu = document.getElementById('master-submenu');

        // Toggle submenu visibility when the Master menu is clicked
        masterMenu.addEventListener('click', function() {
            if (masterSubmenu.style.display === "none" || masterSubmenu.style.display === "") {
                masterSubmenu.style.display = "block"; // Show the submenu
            } else {
                masterSubmenu.style.display = "none"; // Hide the submenu
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const toggleSidebar = document.getElementById('toggle-sidebar');
        const sidebar = document.querySelector('.sidebar');
        const body = document.body;

        toggleSidebar.addEventListener('click', function() {
            if (sidebar.style.display === "none" || sidebar.style.display === "") {
                sidebar.style.display = "block"; // Tampilkan sidebar
                body.classList.remove('sidebar-hidden');
                toggleSidebar.innerHTML = '<i class="fa-solid fa-bars"></i>';
            } else {
                sidebar.style.display = "none"; // Tutup sidebar
                body.classList.add('sidebar-hidden');
                toggleSidebar.innerHTML = '<i class="fa-solid fa-bars"></i>';
            }
        });
    });


    function fetchStatistics() {
        fetch('<?php echo site_url('dashboard/get_statistics'); ?>')
            .then(response => response.json())
            .then(data => {
                // Update konten dari setiap elemen
                document.getElementById('total-users').textContent = data.total_users;
                document.getElementById('active-tickets').textContent = data.active_tickets;
                document.getElementById('total-reports').textContent = data.total_reports;
                document.getElementById('pending-issues').textContent = data.pending_issues;
            })
            .catch(error => console.error('Error fetching statistics:', error));
    }

    function confirmLogout(event) {
        event.preventDefault(); // Prevent the default anchor action
        $('#logout-message').fadeIn(); // Show the logout confirmation
    }
    // Panggil fungsi fetchStatistics saat halaman dimuat
    window.onload = function() {
        fetchStatistics();
    };

    // Jika ingin diperbarui secara berkala, gunakan setInterval
    setInterval(fetchStatistics, 5000); // Update setiap 5 detik

    // Perbarui statistik setiap 5 detik
    setInterval(fetchStatistics, 5000);

    // Panggil saat pertama kali halaman dimuat
    fetchStatistics();


    function updateDateTime() {
        const now = new Date();

        // Format tanggal
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const date = now.toLocaleDateString('id-ID', options); // Menggunakan format tanggal Indonesia

        // Format waktu
        const time = now.toLocaleTimeString('id-ID'); // Menggunakan format waktu Indonesia

        document.getElementById('date').textContent = date;
        document.getElementById('time').textContent = time;
    }

    setInterval(updateDateTime, 1000); // Update every second
    updateDateTime(); // Initialize immediately
</script>
</body>

</html>