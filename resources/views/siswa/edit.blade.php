<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEditSiswa" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editId">
        <div class="mb-3">
          <label for="editNama" class="form-label">Nama</label>
          <input type="text" id="editNama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="editNis" class="form-label">NIS</label>
          <input type="text" id="editNis" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="editKelas" class="form-label">Kelas</label>
          <select id="editKelas" class="form-select" required>
            @foreach ($kelas as $kls)
              <option value="{{ $kls->id }}">{{ $kls->nama }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Update</button>
      </div>
    </form>
  </div>
</div>
