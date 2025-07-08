@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Data Guru</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahGuru">
          + Tambah Guru
        </button>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-bordered mt-4">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Guru</th>
              <th>NIP</th>
              <th>Kelas</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($gurus as $guru)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $guru->nama }}</td>
                <td>{{ $guru->nip }}</td>
                <td>{{ $guru->kelas->nama ?? '-' }}</td>
                <td>
                  <div class="d-flex gap-1">
                    <a href="javascript:void(0)" onclick="showGuru({{ $guru->id }})" class="btn btn-info btn-sm">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="javascript:void(0)" onclick="editGuru({{ $guru->id }})" class="btn btn-warning btn-sm">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <button onclick="hapusGuru({{ $guru->id }})" class="btn btn-danger btn-sm">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">Data tidak ditemukan</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Tambah Guru -->
@include('guru.create')

<!-- Modal Detail Guru -->
@include('guru.show')

<!-- Modal Edit -->
@include('guru.edit')
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
  // Tambah Guru
  const formTambah = document.getElementById('formTambahGuru');
  if (formTambah) {
    formTambah.addEventListener('submit', function (e) {
      e.preventDefault();
      const data = {
        nama: document.getElementById('nama').value,
        nip: document.getElementById('nip').value,
        kelas_id: document.getElementById('kelas_id').value
      };

      fetch('/guru', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
      })
      .then(res => res.json())
      .then(res => {
        alert(res.message || 'Data berhasil ditambahkan');
        location.reload();
      })
      .catch(err => {
        alert('Gagal menambahkan data.');
        console.error(err);
      });
    });
  }

  // Edit Guru
  const formEdit = document.getElementById('formEditGuru');
  if (formEdit) {
    formEdit.addEventListener('submit', function (e) {
      e.preventDefault();

      const id = document.getElementById('editId').value;
      const data = {
        nama: document.getElementById('editNama').value,
        nip: document.getElementById('editNip').value,
        kelas_id: document.getElementById('editKelas').value,
      };

      fetch(`/guru/${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
      })
      .then(res => res.json())
      .then(res => {
        alert(res.message || 'Data berhasil diupdate');
        location.reload();
      })
      .catch(err => {
        alert("Gagal memperbarui data");
        console.error(err);
      });
    });
  }
});

// Tampilkan Detail Guru
function showGuru(id) {
  fetch(`/guru/${id}`)
    .then(res => res.json())
    .then(data => {
      document.getElementById('modalNama').textContent = data.nama;
      document.getElementById('modalNIP').textContent = data.nip;
      document.getElementById('modalKelas').textContent = data.kelas?.nama ?? '-';

      if (typeof bootstrap !== 'undefined') {
        const modal = new bootstrap.Modal(document.getElementById('guruModal'));
        modal.show();
      } else {
        alert("Bootstrap tidak tersedia!");
      }
    })
    .catch(err => {
      alert('Gagal memuat data');
      console.error(err);
    });
}

// Edit Modal
function editGuru(id) {
  fetch(`/guru/${id}/edit`)
    .then(res => res.json())
    .then(data => {
      document.getElementById('editId').value = data.guru.id;
      document.getElementById('editNama').value = data.guru.nama;
      document.getElementById('editNip').value = data.guru.nip;
      document.getElementById('editKelas').value = data.guru.kelas_id;

      const modal = new bootstrap.Modal(document.getElementById('editGuruModal'));
      modal.show();
    })
    .catch(err => {
      alert("Gagal mengambil data guru");
      console.error(err);
    });
}

// Hapus Guru
function hapusGuru(id) {
  if (confirm("Yakin ingin menghapus data ini?")) {
    fetch(`/guru/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept': 'application/json',
      },
    })
    .then(res => res.json())
    .then(data => {
      alert(data.message || 'Data berhasil dihapus');
      location.reload();
    })
    .catch(err => {
      alert('Terjadi kesalahan saat menghapus data.');
      console.error(err);
    });
  }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush

