@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header fw-semibold">Tambah Data Siswa</div>
    <div class="card-body">
      <form action="{{ route('siswa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Siswa</label>
          <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
          <label for="nis" class="form-label">NIS</label>
          <input type="text" name="nis" class="form-control" value="{{ old('nis') }}" required>
        </div>

        <div class="mb-3">
          <label for="kelas_id" class="form-label">Kelas</label>
          <select name="kelas_id" class="form-select" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $kls)
              <option value="{{ $kls->id }}">{{ $kls->nama }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection
