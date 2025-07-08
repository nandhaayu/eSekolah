@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header fw-semibold">Detail Siswa</div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Nama</th>
          <td>{{ $siswa->nama }}</td>
        </tr>
        <tr>
          <th>NIS</th>
          <td>{{ $siswa->nis }}</td>
        </tr>
        <tr>
          <th>Kelas</th>
          <td>{{ $siswa->kelas->nama ?? '-' }}</td>
        </tr>
      </table>
      <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
@endsection
