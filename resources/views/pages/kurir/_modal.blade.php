<!-- Modal Create Kurir -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Create Data Kurir</h5>
         <button type="button" class="close btnResetForm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formCreateKurir">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="nama">
               </div>
               <div class="form-group">
                  <label class="d-block">Gender</label>
                  <div class="custom-control custom-radio custom-control-inline">
                     <input type="radio" id="male" name="jenis_kelamin" class="custom-control-input" value="L">
                     <label class="custom-control-label" for="male">Male</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                     <input type="radio" id="female" name="jenis_kelamin" class="custom-control-input" value="P">
                     <label class="custom-control-label" for="female">Female</label>
                  </div>
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
               <button type="button" class="btn btn-primary" id="btnCreateKurir">Create</button>
               <button type="button" class="btn btn-secondary btnResetForm" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Modal Edit Kurir -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Data Kurir</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formUpdateKurir">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <div class="form-group">
                  <label for="nama">Name</label>
                  <input type="text" class="form-control" name="nama" id="nama">
               </div>
               <div class="form-group">
                  <label class="d-block">Gender</label>
                  <div class="custom-control custom-radio custom-control-inline">
                     <input type="radio" id="male2" name="jenis_kelamin" class="custom-control-input" value="L">
                     <label class="custom-control-label" for="male2">Male</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                     <input type="radio" id="female2" name="jenis_kelamin" class="custom-control-input" value="P">
                     <label class="custom-control-label" for="female2">Female</label>
                  </div>
               </div>
               <div class="form-group">
                  <label for="tlp">Number</label>
                  <input type="tel" class="form-control" name="tlp" id="tlp">
               </div>
               <div class="form-group">
                  <label for="alamat">Address</label>
                  <textarea class="form-control" name="alamat" placeholder="Input your address ..." id="alamat" style="height: 4rem;"></textarea>
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="button" class="btn btn-primary" id="btnUpdateKurir">Save changes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Modal Hapus Kurir -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h6 class="modal-title" id="modal-title-notification">Delete Data Kurir</h6>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form id="formDeleteKurir">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="id2">
               <div class="text-center">
                  <i class="fas fa-exclamation-triangle mb-3" style="font-size: 6rem !important"></i>
                  <h4 class="text-danger mb-0" id="namaKurir"></h4>
                  <p>Are you sure to delete the data above?</p>
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="button" class="btn btn-danger" id="btnDeleteKurir">Delete</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Modal Create Kurir -->
{{-- <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Import Data Kurir</h5>
         <button type="button" class="close btnResetForm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form method="POST" action="{{ route('kurir.import') }}" autocomplete="off" id="formImport" enctype="multipart/form-data">
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
</div> --}}