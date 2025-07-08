@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Data Kelas</h5>
        <div>
          <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm">+ Tambah Kelas</a>
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
                    <a href="{{ route('kelas.show', $kls->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('kelas.edit', $kls->id) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('kelas.destroy', $kls->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </form>
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
@endsection
