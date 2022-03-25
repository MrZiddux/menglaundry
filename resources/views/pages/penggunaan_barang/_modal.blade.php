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
                  <label>Nama Barang</label>
                  <input type="text" class="form-control" name="nama_barang">
               </div>
               <div class="form-group">
                  <label>QTY</label>
                  <input type="number" class="form-control" name="qty" min="0">
               </div>
               <div class="form-group">
                  <label>Harga</label>
                  <input type="text" class="form-control" name="harga">
               </div>
               <div class="form-group">
                  <label>Waktu Beli</label>
                  <input type="datetime-local" class="form-control" name="waktu_beli">
               </div>
               <div class="form-group">
                  <label>Supplier</label>
                  <input type="text" class="form-control" name="supplier">
               </div>
               <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                     <option selected disabled>Pilih Status</option>
                     <option value="diajukan_beli">Diajukan Beli</option>
                     <option value="habis">Habis</option>
                     <option value="tersedia">Tersedia</option>
                  </select>
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnCreate">Create</button>
               <button type="button" class="btn btn-secondary btnResetForm" data-dismiss="modal">Close</button>
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
                  <label>Nama Barang</label>
                  <input type="text" class="form-control" name="nama_barang" id="editNamaBarang">
               </div>
               <div class="form-group">
                  <label>QTY</label>
                  <input type="number" class="form-control" name="qty" min="0" id="editQty">
               </div>
               <div class="form-group">
                  <label>Harga</label>
                  <input type="text" class="form-control" name="harga" id="editHarga">
               </div>
               <div class="form-group">
                  <label>Supplier</label>
                  <input type="text" class="form-control" name="supplier" id="editSupplier">
               </div>
               <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control" id="editStatus">
                     <option disabled>Pilih Status</option>
                     <option value="diajukan_beli">Diajukan Beli</option>
                     <option value="habis">Habis</option>
                     <option value="tersedia">Tersedia</option>
                  </select>
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnUpdate">Update</button>
               <button type="button" class="btn btn-secondary btnResetForm" data-dismiss="modal">Close</button>
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
                  <h4 class="text-danger mb-0" id="deleteNamaBarang"></h4>
                  <p>Are you sure to delete the data above?</p>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-danger" id="btnDeletePenjemputan">Delete</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
