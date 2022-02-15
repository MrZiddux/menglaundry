<!-- Modal Create Packages -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Create Data Package</h5>
         <button type="button" class="close btnResetForm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formCreatePackage">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label>Jenis Paket</label>
                  <select class="form-control" name="jenis">
                     <option value="kiloan">Kiloan</option>
                     <option value="selimut">Selimut</option>
                     <option value="bed_cover">Bed Cover</option>
                     <option value="kaos">Kaos</option>
                     <option value="lain">Lainnya</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Nama Paket</label>
                  <input type="text" class="form-control" name="nama_paket">
               </div>
               <div class="form-group">
                  <label>Harga</label>
                  <input type="text" class="form-control" name="harga">
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnCreatePackage">Create</button>
               <button type="button" class="btn btn-secondary btnResetForm" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Modal Edit Packages -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Data Package</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formUpdatePackage">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <div class="form-group">
                  <label>Jenis Paket</label>
                  <select class="form-control" name="jenis" id="jenis">
                     <option value="kiloan">Kiloan</option>
                     <option value="selimut">Selimut</option>
                     <option value="bed_cover">Bed Cover</option>
                     <option value="kaos">Kaos</option>
                     <option value="lain">Lainnya</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Nama Paket</label>
                  <input type="text" class="form-control" name="nama_paket" id="nama_paket">
               </div>
               <div class="form-group">
                  <label>Harga</label>
                  <input type="text" class="form-control" name="harga" id="harga">
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnUpdatePackage">Save changes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Modal Hapus Packages -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h6 class="modal-title" id="modal-title-notification">Delete Data Package</h6>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form id="formDeletePackage">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="id2">
               <div class="text-center">
                  <i class="fas fa-exclamation-triangle mb-3" style="font-size: 6rem !important"></i>
                  <h4 class="text-danger mb-0" id="namaPackage"></h4>
                  <p>Are you sure to delete the data above?</p>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" id="btnDeletePackage">Delete</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
   </div
