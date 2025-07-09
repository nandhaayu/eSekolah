@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-fex justify-content-between align-item-center mb-4">
            <h5 class="card-title fw-semibold">Data Guru Berdasarkan Kelas</h5>
        </div>

        @foreach ($guruList as $d)
        <h5 class="fw-semibold text-center">{{ $d->nama }}</h5>
        <div class="table-responsive">                
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Nama Guru</th>
                        <th style="width: 40%;">NIP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($d->gurus as $guru )
                        <tr>
                            <td>{{ $guru->nama }}</td>
                            <td>{{ $guru->nip }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>