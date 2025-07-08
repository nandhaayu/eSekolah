import './bootstrap';
new bootstrap.Modal(document.getElementById('guruModal'))

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('formTambahGuru');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const data = {
                nama: document.getElementById('nama').value,
                nip: document.getElementById('nip').value,
                kelas_id: document.getElementById('kelas_id').value,
            };

            fetch('/guru', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(res => {
                if (res.message) {
                    alert(res.message);
                    // refresh atau arahkan ke halaman lain
                    window.location.href = "/guru";
                } else {
                    alert("Gagal menyimpan data");
                }
            })
            .catch(err => {
                console.error("Terjadi kesalahan:", err);
            });
        });
    }
});

  function showGuru(id) {
    fetch(`/guru/${id}`)
      .then(res => res.json())
      .then(data => {
        document.getElementById('modalNama').textContent = data.nama;
        document.getElementById('modalNIP').textContent = data.nip;
        document.getElementById('modalKelas').textContent = data.kelas?.nama ?? '-';

        const modal = new bootstrap.Modal(document.getElementById('guruModal'));
        modal.show();
      })
      .catch(err => {
        alert('Gagal memuat data');
        console.error(err);
      });
  }
