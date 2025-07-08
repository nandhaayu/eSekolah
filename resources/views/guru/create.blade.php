<div class="modal fade" id="modalTambahGuru" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formTambahGuru" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Guru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Guru</label>
          <input type="text" id="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="nip" class="form-label">NIP</label>
          <input type="text" id="nip" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="kelas_id" class="form-label">Kelas</label>
          <select id="kelas_id" class="form-select" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $kls)
              <option value="{{ $kls->id }}">{{ $kls->nama }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>