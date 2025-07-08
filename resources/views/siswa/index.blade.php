@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Data Siswa</h5>
        <button class="btn btn-primary btn-sm" onclick="showFormTambah()">+ Tambah Siswa</button>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered mt-4">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>NIS</th>
              <th>Kelas</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tabelSiswa">
            @foreach ($siswas as $siswa)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->kelas->nama ?? '-' }}</td>
                <td>
                  <div class="d-flex gap-1">
                    <button onclick="showDetailSiswa({{ $siswa->id }})" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button>
                    <button onclick="showFormEdit({{ $siswa->id }})" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button onclick="hapusSiswa({{ $siswa->id }})" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
@include('siswa.create')

<!-- Modal Edit -->
@include('siswa.edit')

<!-- Modal Detail -->
@include('siswa.show')

@endsection

@push('scripts')
<script>
  function showFormTambah() {
    const modal = new bootstrap.Modal(document.getElementById('modalTambah'));
    modal.show();
  }

  function showFormEdit(id) {
    fetch(`/siswa/${id}/edit`)
      .then(res => res.json())
      .then(data => {
        document.getElementById('editId').value = data.siswa.id;
        document.getElementById('editNama').value = data.siswa.nama;
        document.getElementById('editNis').value = data.siswa.nis;
        document.getElementById('editKelas').value = data.siswa.kelas_id;
        new bootstrap.Modal(document.getElementById('modalEdit')).show();
      });
  }

  document.getElementById('formTambahSiswa').addEventListener('submit', function(e) {
    e.preventDefault();
    const data = {
      nama: document.getElementById('tambahNama').value,
      nis: document.getElementById('tambahNis').value,
      kelas_id: document.getElementById('tambahKelas').value,
    };

    fetch('/siswa', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
      alert(res.message);
      location.reload();
    });
  });

  document.getElementById('formEditSiswa').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('editId').value;
    const data = {
      nama: document.getElementById('editNama').value,
      nis: document.getElementById('editNis').value,
      kelas_id: document.getElementById('editKelas').value,
    };

    fetch(`/siswa/${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
      alert(res.message);
      location.reload();
    });
  });

  function showDetailSiswa(id) {
  fetch(`/siswa/${id}`)
    .then(res => {
      if (!res.ok) throw new Error("Gagal mengambil data siswa.");
      return res.json();
    })
    .then(data => {
      document.getElementById('detailNama').textContent = data.nama;
      document.getElementById('detailNis').textContent = data.nis;
      document.getElementById('detailKelas').textContent = data.kelas?.nama ?? '-';

      const modal = new bootstrap.Modal(document.getElementById('detailModal'));
      modal.show();
    })
    .catch(err => {
      alert('Terjadi kesalahan saat menampilkan detail.');
      console.error(err);
    });
}
function hapusSiswa(id) {
  if (!confirm("Yakin ingin menghapus data ini?")) return;

  fetch(`/siswa/${id}`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Accept': 'application/json',
    },
  })
  .then(res => {
    if (!res.ok) throw new Error("Gagal menghapus data.");
    return res.json();
  })
  .then(data => {
    alert(data.message);
    location.reload();
  })
  .catch(err => {
    alert("Terjadi kesalahan saat menghapus.");
    console.error(err);
  });
}
</script>
@endpush

