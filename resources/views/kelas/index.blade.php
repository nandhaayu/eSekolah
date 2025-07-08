@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Data Kelas</h5>
        <div>
          <button onclick="showFormTambah()" class="btn btn-primary btn-sm">+ Tambah Kelas</button>
        </div>
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
              <th>Nama Kelas</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if($kelas->isNotEmpty())
              @foreach ($kelas as $kls)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kls->nama }}</td>
                <td>
                  <div class="d-flex gap-1">
                    <button onclick="showDetailKelas({{ $kls->id }})" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button>
                    <button onclick="showEditKelas({{ $kls->id }})" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button onclick="hapusKelas({{ $kls->id }})" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                  </div>
                </td>
              </tr>
              @endforeach
            @else
              <tr>
                <td colspan="3" class="text-center">Data tidak ditemukan</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Tambah/Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditLabel">Edit Kelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form id="formEditKelas">
          <input type="hidden" id="editId">
          <div class="mb-3">
            <label for="editNama" class="form-label">Nama Kelas</label>
            <input type="text" id="editNama" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-warning">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title">Detail Kelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p><strong>ID:</strong> <span id="detailId"></span></p>
        <p><strong>Nama Kelas:</strong> <span id="detailNama"></span></p>
      </div>
    </div>
  </div>
</div>
<!-- modal tambah -->
  <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah Kelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form id="formTambahKelas">
          <div class="mb-3">
            <label for="tambahNama" class="form-label">Nama Kelas</label>
            <input type="text" id="tambahNama" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
  // TAMPILKAN MODAL TAMBAH
  function showFormTambah() {
    document.getElementById('tambahNama').value = '';
    new bootstrap.Modal(document.getElementById('modalTambah')).show();
  }

  // TAMBAH KELAS
  document.getElementById('formTambahKelas').addEventListener('submit', function(e) {
    e.preventDefault();
    const nama = document.getElementById('tambahNama').value;

    fetch('/kelas', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ nama })
    })
    .then(res => res.json())
    .then(res => {
      alert(res.message);
      location.reload();
    })
    .catch(err => {
      alert('Gagal menambahkan kelas.');
      console.error(err);
    });
  });

  // TAMPILKAN MODAL EDIT
  function showEditKelas(id) {
    fetch(`/kelas/${id}/edit`)
      .then(res => res.json())
      .then(data => {
        document.getElementById('editId').value = data.kelas.id;
        document.getElementById('editNama').value = data.kelas.nama;
        new bootstrap.Modal(document.getElementById('modalEdit')).show();
      });
  }

  // EDIT KELAS
document.getElementById('formEditKelas').addEventListener('submit', function(e) {
  e.preventDefault();
  const id = document.getElementById('editId').value;
  const nama = document.getElementById('editNama').value;

  fetch(`/kelas/${id}`, {
    method: 'POST', // Ubah dari PUT ke POST
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'X-HTTP-Method-Override': 'PUT' // Override ke PUT
    },
    body: JSON.stringify({ nama })
  })
  .then(res => res.json())
  .then(res => {
    alert(res.message);
    location.reload();
  })
  .catch(err => {
    alert('Gagal memperbarui kelas.');
    console.error(err);
  });
});

  // SHOW DETAIL KELAS
  function showDetailKelas(id) {
    fetch(`/kelas/${id}`)
      .then(res => {
        if (!res.ok) throw new Error('Gagal mengambil data');
        return res.json();
      })
      .then(data => {
        document.getElementById('detailId').textContent = data.id;
        document.getElementById('detailNama').textContent = data.nama;
        new bootstrap.Modal(document.getElementById('detailModal')).show();
      })
      .catch(err => {
        alert('Gagal menampilkan detail.');
        console.error(err);
      });
  }

  // HAPUS KELAS
  function hapusKelas(id) {
    if (confirm('Yakin ingin menghapus kelas ini?')) {
      fetch(`/kelas/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      })
      .then(res => {
        if (!res.ok) throw new Error('Gagal menghapus data');
        return res.json();
      })
      .then(res => {
        alert(res.message);
        location.reload();
      })
      .catch(err => {
        alert('Terjadi kesalahan saat menghapus.');
        console.error(err);
      });
    }
  }
  
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
