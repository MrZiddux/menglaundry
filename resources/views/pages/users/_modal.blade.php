<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Create Data User</h5>
         <button type="button" class="close btnResetForm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formCreate">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama">
               </div>
               <div class="form-group">
                  <label>Telepon</label>
                  <input type="tel" class="form-control" name="tlp">
               </div>
               <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" placeholder="Input your address ..." style="height: 4rem;"></textarea>
               </div>
               <div class="form-group">
                  <label>Outlet</label>
                  <select class="form-control" name="id_outlet">
                     <option selected disabled>Pilih Outlet</option>
                     @foreach($outlets as $item)
                     <option value="{{ $item->id }}">{{ $item->id }} - {{ $item->nama }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="username">
               </div>
               <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password">
               </div>
               <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" name="role">
                     <option selected disabled>Pilih Role</option>
                     <option value="admin">Admin</option>
                     <option value="kasir">Kasir</option>
                     <option value="owner">Owner</option>
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
         <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formUpdate">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="updateId">
               <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" id="updateNama">
               </div>
               <div class="form-group">
                  <label>Telepon</label>
                  <input type="tel" class="form-control" name="tlp" id="updateTlp">
               </div>
               <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" placeholder="Input your address ..." style="height: 4rem;" id="inputAlamat"></textarea>
               </div>
               <div class="form-group">
                  <label>Outlet</label>
                  <select class="form-control" name="id_outlet" id="selectOutlet">
                     <option disabled>Pilih Outlet</option>
                     @foreach($outlets as $item)
                     <option value="{{ $item->id }}">{{ $item->id }} - {{ $item->nama }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="username" id="inputUsername">
               </div>
               <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" name="role" id="selectRole">
                     <option disabled>Pilih Role</option>
                     <option value="admin">Admin</option>
                     <option value="kasir">Kasir</option>
                     <option value="owner">Owner</option>
                  </select>
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnUpdate">Save changes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h6 class="modal-title" id="modal-title-notification">Delete Data User</h6>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form id="formDelete">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="deleteId">
               <div class="text-center">
                  <i class="fas fa-exclamation-triangle mb-3" style="font-size: 6rem !important"></i>
                  <h4 class="text-danger mb-0" id="deleteNama"></h4>
                  <p>Are you sure to delete the data above?</p>
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-danger" id="btnDelete">Delete</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form autocomplete="off" id="formChangePassword">
            @csrf
            <div class="modal-body">
               <input type="hidden" name="id" id="CPid">
               <div class="form-group">
                  <label>Password Lama</label>
                  <input type="password" class="form-control" name="password_lama" id="inputPasswordLama">
               </div>
               <div class="form-group">
                  <label>Password Baru</label>
                  <input type="password" class="form-control" name="password_baru" id="inputPasswordBaru">
               </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="submit" class="btn btn-primary" id="btnUpdate">Save changes</button>
               <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Import Data Member</h5>
         <button type="button" class="close btnResetForm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <form method="POST" action="{{ route('members.import') }}" autocomplete="off" id="formImport" enctype="multipart/form-data">
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
