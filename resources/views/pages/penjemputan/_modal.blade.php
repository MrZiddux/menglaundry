<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Create Data Penjemputan</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form id="createForm">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="inputIdTransaksi">Kode Transaksi</label>
                  <select name="id_transaksi" id="inputIdTransaksi" class="form-control">
                     <option class="firstOption" selected disabled>Pilih Kode Invoice</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="inputKurir">Kurir</label>
                  <select name="id_kurir" id="inputKurir" class="form-control">
                     <option class="firstOption" selected disabled>Pilih Kurir</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <input type="text" name="status" id="inputStatus" class="form-control" value="tercatat" readonly>
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
            <input type="hidden" id="id" name="id">
            <div class="modal-body">
               <div class="form-group">
                  <label for="inputIdTransaksi">Kode Transaksi</label>
                  <select name="id_transaksi" id="inputIdTransaksi2" class="form-control">
                     <option class="firstOption" selected disabled>Pilih Kode Invoice</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="inputKurir">Kurir</label>
                  <select name="id_kurir" id="inputKurir2" class="form-control">
                     <option class="firstOption" selected disabled>Pilih Kurir</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <input type="text" name="status" id="inputStatus2" class="form-control" readonly>
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
         <form id="formDeletePenjemputan">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="idDelete">
               <div class="text-center">
                  <i class="fas fa-exclamation-triangle mb-3" style="font-size: 6rem !important"></i>
                  <h4 class="text-danger mb-0" id="kodeInvoice"></h4>
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
</div