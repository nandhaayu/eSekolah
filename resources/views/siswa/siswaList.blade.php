@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Data Siswa Berdasarkan Kelas</h5>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered mt-4" id="siswas">
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
      url: "{{ route('siswa.siswas') }}",
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        let tableBody = $('#siswas tbody');
        tableBody.empty();

        $.each(data, function (index, kelas) {
          tableBody.append(`
            <tr class="bg-light mb-3">
              <td colspan="2" class="fw-bold text-uppercase"> ${kelas.nama}</td>
            </tr>
          `);
          tableBody.append(`
            <tr class="table-secondary">
              <th>Nama Siswa</th>
              <th>NIS</th>
            </tr>
          `);
          $.each(kelas.siswas, function (i, siswa) {
            let row = `
              <tr>
                <td>${siswa.nama}</td>
                <td>${siswa.nis}</td>
              </tr>
            `;
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