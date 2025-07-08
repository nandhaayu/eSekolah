<div class="modal fade" id="editGuruModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditGuru">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Guru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editId">
          <div class="mb-3">
            <label for="editNama" class="form-label">Nama</label>
            <input type="text" id="editNama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="editNip" class="form-label">NIP</label>
            <input type="text" id="editNip" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="editKelas" class="form-label">Kelas</label>
            <select id="editKelas" class="form-select" required>
              <option value="">-- Pilih Kelas --</option>
              @foreach($kelas as $kls)
                <option value="{{ $kls->id }}">{{ $kls->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>