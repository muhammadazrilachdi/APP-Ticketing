<!-- Semantic UI JS -->

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
        // Initialize modal
        $('.ui.modal').modal();

        // Handle Edit User
        $(document).on('click', '.edit-button', function() {
            var userId = $(this).data('user-id');
            var nik = $(this).data('nik');
            var name = $(this).data('name');
            var noHp = $(this).data('no_hp');
            var email = $(this).data('email');
            var departementId = $(this).data('departement-id');

            $('#user_id').val(userId);
            $('#nik').val(nik);
            $('#name').val(name);
            $('#no_hp').val(noHp);
            $('#email').val(email);
            $('#departement_id').val(departementId).trigger('change');

            $('#editModal').modal('show');
        });

        $(document).on('click', '.delete-button', function() {
            var userId = $(this).data('user-id');
            if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                window.location.href = '<?php echo site_url('admin/user/delete/'); ?>' + userId;
            }
        });
    });

    function closeModal() {
        $('#editModal').modal('hide');
    }

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