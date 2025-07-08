@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header fw-semibold">Detail Kelas</div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Nama Kelas</th>
          <td>{{ $kelas->nama }}</td>
        </tr>
      </table>
      <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
@endsection
