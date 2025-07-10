@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Data Keseluruhan</h5>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered mt-4" id="dataList">
            <thead class="table-secondary">
            <tr>
              <th>Nama Kelas</th>
              <th>Nama Siswa</th>
              <th>NIS</th>
              <th>Nama Guru</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function () {
    $.ajax({
      url: "{{ route('dataList') }}",
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        let tableBody = $('#dataList tbody');
        tableBody.empty();

        $.each(data, function (index, kelas) {
          const jmlhSiswa=kelas.siswas.length;
          $.each(kelas.siswas, function (i, siswa) {
            let guru = 'Belum ada guru';
            if (Array.isArray(kelas.gurus) && kelas.gurus.length > 0) {
              guru = kelas.gurus.map(g => g.nama).join(', ');
            }
            let row = '<tr>';
              if(i === 0) {
                row += `<td rowspan="${jmlhSiswa}">${kelas.nama}</td>`
              };
              row += `
              <td>${siswa.nama}</td>
              <td>${siswa.nis}</td>
              <td>${guru}</td>`
            tableBody.append(row);
          });
        });
      },
      error: function (xhr, status, error) {
        console.error("Gagal mengambil data:", xhr.responseText);
      }
    });
  });
</script>
@endpush