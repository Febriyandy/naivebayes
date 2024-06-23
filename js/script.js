// DASHBOARD
// Animasi Jumlah Data Training dan Data Testing
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".box").forEach(function (box) {
    box.classList.add("show");
  });
});

// DATA TRAINING dan DATA TESTING
// Formulir Tambah Data
function toggleForm() {
  var formTambah = document.getElementById("formTambah");
  formTambah.classList.toggle("show");

  var tambahBtnIcon = document.getElementById("tambahBtnIcon");
  tambahBtnIcon.classList.toggle("fa-plus");
  tambahBtnIcon.classList.toggle("fa-minus");
}

// Hapus data satu-satu
function confirmDelete() {
  return confirm("Apakah Anda yakin ingin menghapus data ini?");
}

// Hapus semua data training
function hapusSemuaData() {
  // Munculkan dialog konfirmasi
  var userConfirmation = confirm(
    "Apakah Anda yakin ingin menghapus semua data training?"
  );

  // Cek apakah pengguna mengklik "OK"
  if (userConfirmation) {
    // Jika mengklik "OK", arahkan ke halaman hapus_semua_data.php
    window.location.href = "hapus_semua_data.php";
  } else {
    // Jika tidak mengklik "OK", tidak melakukan apa-apa.
    event.preventDefault();
  }
}

// Hapus semua data testing
function hapusSemuaData1() {
  // Munculkan dialog konfirmasi
  var userConfirmation = confirm(
    "Apakah Anda yakin ingin menghapus semua data testing?"
  );

  // Cek apakah pengguna mengklik "OK"
  if (userConfirmation) {
    // Jika mengklik "OK", arahkan ke halaman hapus_semua_data.php
    window.location.href = "hapus_semuadata.php";
  } else {
    // Jika tidak mengklik "OK", tidak melakukan apa-apa.
    event.preventDefault();
  }
}

// PENGUJIAN
// Tombol petunjuk
function togglePetunjuk() {
  var petunjukText = document.getElementById("petunjukText");
  petunjukText.classList.toggle("show");
  petunjukText.classList.toggle("hide");
}
