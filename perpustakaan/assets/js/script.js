document.addEventListener("DOMContentLoaded", function () {
  // Fungsi ini akan dijalankan ketika dokumen HTML selesai dimuat

  // 1. Konfirmasi sebelum menghapus buku
  const deleteButtons = document.querySelectorAll(".btn-delete");
  deleteButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      // Menampilkan dialog konfirmasi sebelum menghapus
      if (!confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
        e.preventDefault(); // Membatalkan aksi jika user memilih 'tidak'
      }
    });
  });

  // 2. Menangani pesan sukses/error (alert)
  const alerts = document.querySelectorAll(".alert");
  alerts.forEach((alert) => {
    // Menghilangkan alert secara otomatis setelah 3 detik
    setTimeout(() => {
      alert.style.transition = "opacity 0.5s"; // Animasi fade out
      alert.style.opacity = "0"; // Mengubah opacity menjadi 0
      setTimeout(() => {
        alert.remove(); // Menghapus elemen alert dari DOM setelah fade out selesai
      }, 500);
    }, 3000); // Waktu tunggu sebelum mulai fade out (3 detik)
  });
});
