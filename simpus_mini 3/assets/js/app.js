// ===== Menu hamburger =====
function initNavToggle() {
  const toggleBtn = document.getElementById("nav-toggle-btn");
  const nav = document.querySelector("header nav");
  if (!toggleBtn || !nav) return;

  toggleBtn.addEventListener("click", function () {
    nav.classList.toggle("nav-open");
  });
}

// ===== Konfirmasi hapus (event delegation pada "submit") =====
function initHapusConfirm() {
  document.addEventListener("submit", function (e) {
    const form = e.target;
    if (!form.classList.contains("form-hapus")) return;

    const row = form.closest("tr");
    const nama = row ? row.querySelector("td").textContent : "data ini";
    const yakin = confirm('Yakin ingin menghapus "' + nama + '"?');
    if (!yakin) {
      e.preventDefault();
    }
  });
}

// ===== Filter tabel real-time =====
function initTableFilter() {
  const input = document.getElementById("search-input");
  if (!input) return;

  input.addEventListener("input", function () {
    const keyword = input.value.toLowerCase();
    const rows = document.querySelectorAll("tbody tr");
    rows.forEach(function (row) {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(keyword) ? "" : "none";
    });
  });
}

// ===== Validasi form sisi klien =====
function tampilkanError(field, pesan) {
  hapusError(field);
  const span = document.createElement("span");
  span.className = "error";
  span.textContent = pesan;
  field.insertAdjacentElement("afterend", span);
}

function hapusError(field) {
  const next = field.nextElementSibling;
  if (next && next.classList.contains("error")) {
    next.remove();
  }
}

function initValidasiForm() {
  const form = document.getElementById("form-tambah");
  if (!form) return;

  form.addEventListener("submit", function (e) {
    let valid = true;

    form.querySelectorAll("[required]").forEach(function (field) {
      if (field.value.trim() === "") {
        tampilkanError(field, "Kolom ini wajib diisi.");
        valid = false;
      } else {
        hapusError(field);
      }
    });

    const tahun = form.querySelector("[name='tahun']");
    if (tahun && tahun.value !== "" && (tahun.value < 1900 || tahun.value > 2026)) {
      tampilkanError(tahun, "Tahun harus antara 1900-2026.");
      valid = false;
    }

    const stok = form.querySelector("[name='stok']");
    if (stok && stok.value !== "" && stok.value < 0) {
      tampilkanError(stok, "Stok tidak boleh negatif.");
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  initNavToggle();
  initHapusConfirm();
  initTableFilter();
  initValidasiForm();
});
