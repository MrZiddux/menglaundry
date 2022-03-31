<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Create Data Barang</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form id="createForm">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label>Nama Karyawan</label>
                  <input type="text" class="form-control" name="nama_karyawan">
               </div>
               <div class="form-group">
                  <label>Tanggal Masuk</label>
                  <input type="date" class="form-control" name="tanggal_masuk" value="{{ date('Y-m-d') }}">
               </div>
               <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control" id="createStatus">
                     <option selected disabled>Pilih Status</option>
                     <option value="masuk">Masuk</option>
                     <option value="sakit">Sakit</option>
                     <option value="cuti">Cuti</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Waktu Masuk</label>
                  <input type="time" class="form-control" name="waktu_masuk" id="createWaktuMasuk" disabled>
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnCreate">Create</button>
               <button type="reset" class="btn btn-secondary btnResetForm" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Update Data Penjemputan</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form id="updateForm">
            @csrf
            <input type="hidden" id="editId" name="id">
            <div class="modal-body">
               <div class="form-group">
                  <label>Nama Karyawan</label>
                  <input type="text" class="form-control" name="nama_karyawan" id="updateNama">
               </div>
               <div class="form-group">
                  <label>Tanggal Masuk</label>
                  <input type="date" class="form-control" name="tanggal_masuk" id="updateTanggalMasuk">
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnUpdate">Update</button>
               <button type="reset" class="btn btn-secondary btnResetForm" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h6 class="modal-title" id="modal-title-notification">Delete Data Penjemputan</h6>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form id="deleteForm">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="deleteId">
               <div class="text-center">
                  <i class="fas fa-exclamation-triangle mb-3" style="font-size: 6rem !important"></i>
                  <h4 class="text-danger mb-0" id="deleteNamaKaryawan"></h4>
                  <p>Are you sure to delete the data above?</p>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-danger" id="btnDelete">Delete</button>
               <button type="reset" class="btn btn-secondary btnResetForm" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="selesaiModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h6 class="modal-title" id="modal-title-notification">Update Waktu Kerja Modal</h6>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form id="selesaiForm">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="selesaiId">
               <div class="text-center">
                  <i class="fas fa-exclamation-triangle mb-3" style="font-size: 6rem !important"></i>
                  <h4 class="text-success mb-0" id="NamaKaryawan"></h4>
                  <p>Yakin untuk mengubah waktu kerja selesai?</p>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success" id="btnSelesai">Selesai</button>
               <button type="reset" class="btn btn-secondary btnResetForm" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Import Data Absensi Kerja</h5>
         <button type="button" class="close btnResetForm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form method="POST" action="{{ route('absensi-kerja.import') }}" autocomplete="off" id="formImport" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
               <label>Import File</label>
               <div class="custom-file">
                  <input type="file" name="importFile" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Pilih file</label>
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnImport">Import</button>
               <button type="button" class="btn btn-secondary btnResetForm" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>