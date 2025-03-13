
// fungsi untuk jam dan tanggal

function showConfirmationDialog(event) {
  event.preventDefault(); 
  document.getElementById('confirmationContainer').classList.remove('hidden');
}

function proceedDelete() {
  document.getElementById('deleteForm').submit();
}

function cancelDelete() {
  document.getElementById('confirmationContainer').classList.add('hidden');
}








// -------------------------------------------------

// fungsi untuk kelender

// ----------------------------------------

// fungsi untuk konfirmasi menghapus data
