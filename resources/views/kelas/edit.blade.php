@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header fw-semibold">Edit Data Kelas</div>
    <div class="card-body">
      <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Kelas</label>
          <input type="text" name="nama" class="form-control" value="{{ old('nama', $kelas->nama) }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection
