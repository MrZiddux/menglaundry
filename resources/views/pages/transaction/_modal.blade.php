<!-- Modal Detail Transaction -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"><span id="displayKodeInvoice"></span> &mdash; Detail Transaction</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <div class="modal-body px-0">
            <ul class="steps mb-3">
               <li class="step step-success">
                  <div class="step-content">
                     <span class="step-circle"><i class="fas fa-tshirt"></i></span>
                     <span class="step-text">Baru</span>
                  </div>
               </li>
               <li class="step">
                  <div class="step-content">
                     <span class="step-circle"><i class="fas fa-tint"></i></span>
                     <span class="step-text">Proses</span>
                  </div>
               </li>
               <li class="step">
                  <div class="step-content">
                     <span class="step-circle"><i class="fas fa-check"></i></span>
                     <span class="step-text">Selesai</span>
                  </div>
               </li>
               <li class="step">
                  <div class="step-content">
                     <span class="step-circle"><i class="fas fa-check-double"></i></span>
                     <span class="step-text">Diambil</span>
                  </div>
               </li>
            </ul>
            <div class="row row-cols-3 p-3">
               <div class="col-lg-4 mt-3 mt-lg-0">
                  <div class="bg-info p-4 text-white d-flex flex-column justify-content-center align-items-center">
                     <div class="mb-3">
                        <i style="font-size: 1.8rem" class="fas fa-tshirt"></i>
                     </div>
                     <div id="wizardStatus">
                        &nbsp;
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 mt-3 mt-lg-0">
                  <div class="bg-primary p-4 text-white d-flex flex-column justify-content-center align-items-center">
                     <div class="mb-3">
                        <i style="font-size: 1.8rem" class="fas fa-calendar"></i>
                     </div>
                     <div id="wizardTgl">
                        &nbsp;
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 mt-3 mt-lg-0">
                  <div class="p-4 text-white d-flex flex-column justify-content-center align-items-center myWizardPelunasan">
                     <div class="mb-3">
                        <i style="font-size: 1.8rem" class="fas fa-money-bill"></i>
                     </div>
                     <div id="wizardPelunasan">
                        &nbsp;
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 mt-3 mt-lg-4">
                  <div class="bg-primary p-4 text-white d-flex flex-column justify-content-center align-items-center">
                     <div class="mb-3">
                        <i style="font-size: 1.8rem" class="fas fa-user-tie"></i>
                     </div>
                     <div id="wizardUser">
                        &nbsp;
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 mt-3 mt-lg-4">
                  <div class="bg-primary p-4 text-white d-flex flex-column justify-content-center align-items-center">
                     <div class="mb-3">
                        <i style="font-size: 1.8rem" class="fas fa-user"></i>
                     </div>
                     <div id="wizardMember">
                        &nbsp;
                     </div>
                  </div>
               </div>
            </div>
            <div class="table-responsive">
               <table class="table table-striped table-md" id="tableDetailTransaction">
                  <tr id="header">
                     <th>No</th>
                     <th>Nama Paket</th>
                     <th>Harga</th>
                     <th class="text-center">Qty</th>
                     <th>Subtotal</th>
                  </tr>
               </table>
            </div>
         </div>
         <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-primary" id="confirmationModalBtn"></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal Create Packages -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Perubahan</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <div class="modal-body">
            <div class="text-center">
               <i class="fas fa-exclamation-triangle mb-3" style="font-size: 6rem !important"></i>
               <h4 class="text-danger mb-0" id="namaMember"></h4>
               <p>Click Yes To Confirm!</p>
            </div>
         </div>
         <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-warning">Yes!</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>