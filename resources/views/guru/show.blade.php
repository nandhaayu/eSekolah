@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header fw-semibold">Detail Guru</div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Nama</th>
          <td>{{ $guru->nama }}</td>
        </tr>
        <tr>
          <th>NIP</th>
          <td>{{ $guru->nip }}</td>
        </tr>
        <tr>
          <th>Kelas</th>
          <td>{{ $guru->kelas->nama ?? '-' }}</td>
        </tr>
      </table>
      <a href="{{ route('guru.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
@endsection
