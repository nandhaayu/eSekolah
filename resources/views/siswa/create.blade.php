<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formTambahSiswa" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="tambahNama" class="form-label">Nama</label>
          <input type="text" id="tambahNama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="tambahNis" class="form-label">NIS</label>
          <input type="text" id="tambahNis" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="tambahKelas" class="form-label">Kelas</label>
          <select id="tambahKelas" class="form-select" required>
            @foreach ($kelas as $kls)
              <option value="{{ $kls->id }}">{{ $kls->nama }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
