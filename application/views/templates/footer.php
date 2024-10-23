<!-- Semantic UI JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                placement: 'right' // Mengatur posisi tooltip di sebelah kanan
            });
        });
    });

    let isSubmenuVisible = false;

    // Menangani klik pada Master untuk toggle submenu
    document.getElementById('master-menu').addEventListener('click', function(event) {
        event.stopPropagation(); // Mencegah event bubbling
        isSubmenuVisible = !isSubmenuVisible; // Ubah status
        document.getElementById('master-submenu').style.display = isSubmenuVisible ? 'block' : 'none';
    });

    // Fungsi untuk konfirmasi logout
    function confirmLogout(event) {
        event.preventDefault(); // Mencegah aksi default
        $('#logout-message').fadeIn(); // Tampilkan konfirmasi logout
    }

    // Panggil fungsi fetchStatistics saat halaman dimuat
    window.onload = function() {
        fetchStatistics(); // Ambil statistik pertama kali
        setInterval(fetchStatistics, 5000); // Pembaruan setiap 5 detik
    };

    // Fungsi untuk memperbarui tanggal dan waktu
    function updateDateTime() {
        const now = new Date();

        // Format tanggal
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const date = now.toLocaleDateString('id-ID', options); // Format tanggal Indonesia

        // Format waktu
        const time = now.toLocaleTimeString('id-ID'); // Format waktu Indonesia

        // Menampilkan tanggal dan waktu
        document.getElementById('date').textContent = date;
        document.getElementById('time').textContent = time;
    }

    // Panggil saat pertama kali halaman dimuat
    updateDateTime();
    // Update setiap detik
    setInterval(updateDateTime, 1000);
</script>
</body>

</html>