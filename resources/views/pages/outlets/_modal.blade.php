<!-- Modal Create Outlets -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Create Data Outlet</h5>
         <button type="clear" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formCreateOutlet">
            @csrf
            <div class="modal-body">
               <div class="input-group input-group-dynamic mb-4 mt-2">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control" name="nama">
               </div>
               <div class="input-group input-group-dynamic mb-4">
                  <label class="form-label">Number</label>
                  <input type="tel" class="form-control" name="tlp">
               </div>
               <div class="input-group input-group-static mb-4">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" rows="2" placeholder="Input your address ..."></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn bg-gradient-primary" id="btnCreateOutlet">Create</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Modal Edit Outlets -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Edit Data Outlet</h5>
         <button type="clear" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formUpdateOutlet">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <div class="input-group input-group-static mb-4 mt-2">
                  <label for="nama">Name</label>
                  <input type="text" class="form-control" name="nama" id="nama">
               </div>
               <div class="input-group input-group-static mb-4">
                  <label for="tlp">Number</label>
                  <input type="tel" class="form-control" name="tlp" id="tlp">
               </div>
               <div class="input-group input-group-static">
                  <label for="alamat">Address</label>
                  <textarea class="form-control" name="alamat" rows="2" placeholder="Input your address ..." id="alamat"></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn bg-gradient-primary" id="btnUpdateOutlet">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Modal Hapus Outlets -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
   <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h6 class="modal-title font-weight-normal" id="modal-title-notification">Delete Data Outlet</h6>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
         </button>
         </div>
         <form id="formDeleteOutlet">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="id2">
               <div class="py-3 text-center">
                  <i class="material-icons text-secondary" style="font-size: 6rem">
                     warning
                  </i>
                  <h4 class="text-gradient text-danger mt-2" id="namaOutlet"></h4>
                  <p>Are you sure to delete the data above?</p>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" id="btnDeleteOutlet">Delete</button>
               <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
   </div
