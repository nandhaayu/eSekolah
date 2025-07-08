@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header fw-semibold">Tambah Data Guru</div>
    <div class="card-body">
      <form action="{{ route('guru.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Guru</label>
          <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
          <label for="nip" class="form-label">NIP</label>
          <input type="text" name="nip" class="form-control" value="{{ old('nip') }}" required>
        </div>

        <div class="mb-3">
          <label for="kelas_id" class="form-label">Kelas</label>
          <select name="kelas_id" class="form-select" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelas as $kls)
              <option value="{{ $kls->id }}">{{ $kls->nama }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('guru.index') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection
