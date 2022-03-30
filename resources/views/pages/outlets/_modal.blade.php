<!-- Modal Create Outlets -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Create Data Outlet</h5>
         <button type="button" class="close btnResetForm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formCreateOutlet">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="nama">
               </div>
               <div class="form-group">
                  <label>Number</label>
                  <input type="tel" class="form-control" name="tlp">
               </div>
               <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" placeholder="Input your address ..." style="height: 4rem;"></textarea>
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnCreateOutlet">Create</button>
               <button type="button" class="btn btn-secondary btnResetForm" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Modal Edit Outlets -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Data Outlet</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formUpdateOutlet">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="nama" id="nama">
               </div>
               <div class="form-group">
                  <label>Number</label>
                  <input type="tel" class="form-control" name="tlp" id="tlp">
               </div>
               <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" placeholder="Input your address ..." style="height: 4rem;" id="alamat"></textarea>
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnUpdateOutlet">Save changes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Modal Hapus Outlets -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h6 class="modal-title" id="modal-title-notification">Delete Data Outlet</h6>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form id="formDeleteOutlet">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="id2">
               <div class="text-center">
                  <i class="fas fa-exclamation-triangle mb-3" style="font-size: 6rem !important"></i>
                  <h4 class="text-danger mb-0" id="namaOutlet"></h4>
                  <p>Are you sure to delete the data above?</p>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" id="btnDeleteOutlet">Delete</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Import Data Outlet</h5>
         <button type="button" class="close btnResetForm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form method="POST" action="{{ route('outlets.import') }}" autocomplete="off" id="formImport" enctype="multipart/form-data">
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
