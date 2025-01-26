import Swal from "sweetalert2";

const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

// Cek apakah sessionStorage memiliki kunci 'success'
if (sessionStorage.getItem('success')) {
    Swal.fire({
        title: 'Berhasil!',
        text: 'Laporan telah disimpan.',
        icon: 'success',
        background: isDarkMode ? '#1a202c' : '#f0f9ff', // Warna background
        color: isDarkMode ? '#f7fafc' : '#333', // Warna teks
        confirmButtonColor: isDarkMode ? '#4caf50' : '#3182ce', // Warna tombol
    });

    // Hapus kunci dari sessionStorage agar tidak muncul lagi setelah refresh
    sessionStorage.removeItem('success');
}

