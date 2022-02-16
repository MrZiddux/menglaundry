<x-app title="New Transaction">
   <div class="section-header">
      <h1>New Transaction Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item active"><a href="/transactions">Transaction</a></div>
         <div class="breadcrumb-item">New Transaction</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4>Data Transaksi</h4>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-6">
                        <h3 class="section-title mt-0">Date</h3>
                        <div class="form-row">
                           <div class="form-group col-md-6">
                              <label for="datain">Date Entry</label>
                              <input type="date" class="form-control form-control-sm">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="datain">Deadline</label>
                              <input type="date" class="form-control form-control-sm">
                           </div>
                        </div>
                        <h3 class="section-title mt-0">
                           Member
                        </h3>
                        <div class="form-row">
                           <div class="form-group col-md-6">
                              <label for="">Name</label>
                              <input type="text" class="form-control form-control-sm" placeholder="John Doe" readonly id="namaMember">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="">Phone Number</label>
                              <div class="input-group mb-3">
                                 <input type="text" name="" class="form-control form-control-sm" placeholder="+62 857 XXXX XXXX" readonly id="tlpMember">
                                 <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary btn-icon icon-left" type="button" data-toggle="modal" data-target="#memberModal"><i class="fas fa-search"></i> Find Member</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="d-flex justify-content-end align-items-end h-100">
                           <div class="d-block">
                              <h5 class="text-center text-primary">Total Pembayaran</h5>
                              <h3 class="text-center text-primary">Rp 100.000</h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <h4>List Item</h4>
                  <div class="card-header-form">
                     <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                           <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#packageModal"><i class="fas fa-search"></i> Find Package</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  {{-- <div class="" id="wrapperTable"></div> --}}
               </div>
            </div>
         </div>
      </div>
   </div>
   <x-slot name="btm">
      @include('pages.transaction.new._modal')
   </x-slot>
   <x-slot name="script">
      <script>
         const formatNumber = (number) => {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
         }
         
         let dataPaket = []
         const gridPackage = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/packages/getData',
               then: data => {
                  dataPaket = data
                  let array = []
                  data.map(item => {
                     array.push([
                        item.nama_paket,
                        item.jenis,
                        formatNumber(item.harga),
                        new gridjs.html(
                           `<button class="btn btn-icon btn-primary" data-id="${ item.id }"><i class="fas fa-check"></i></button>`
                        ),
                     ])
                  })
                  return array
               } 
            },
            columns: [
               {
                  name: 'Package Name',
               },
               {
                  name: 'Package Type',
               },
               {
                  name: 'Price',
               },
               {
                  name: 'Actions',
                  sort: false,
               },
            ],
            className: {
               table: 'table table-striped table-md',
               thead: 'bg-white',
               th: 'text-dark',
               search: 'float-right',
            },
            fixedHeader: true,
            sort: true,
            pagination: true,
            search: true,
            resizable: true,
         }).render(document.getElementById("tablePackage"));

         let dataMember = []
         const gridMember = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/members/getData',
               then: data => {
                  dataMember = data
                  let array = []
                  data.map(item => {
                     array.push([
                        item.nama,
                        item.tlp,
                        new gridjs.html(
                           item.jenis_kelamin == 'L' ? `<span class="badge badge-sm bg-info text-white">L</span>` : `<span class="badge badge-sm bg-danger text-white">P</span>`
                        ),
                        new gridjs.html(
                           `<button class="btn btn-icon btn-primary selectMember" data-id="${ item.id }"><i class="fas fa-check"></i></button>`
                        ),
                     ])
                  })
                  return array
               }
            },
            columns: [
               {
                  name: 'Name',
               },
               {
                  name: 'Phone Number',
               },
               {
                  name: 'Gender',
                  sort: false,
               },
               {
                  name: 'Actions',
                  sort: false,
               },
            ],
            className: {
               table: 'table table-striped table-md',
               thead: 'bg-white',
               th: 'text-dark',
               search: 'float-right',
            },
            search: {
               server: {
                  url: (prev, keyword) => `${prev}?search=${keyword}`
               }
            },
            fixedHeader: true,
            sort: true,
            pagination: true,
            search: true,
            resizable: true,
         }).render(document.getElementById("tableMember"));

         // make function when click button selectMember in gridMember passing data to input name and input phone number
         $(document).on('click', '.selectMember', function() {
            let id = $(this).data('id')
            let data = dataMember.find(item => item.id == id)
            console.log(data.tlp);
            $('#namaMember').val(data.nama)
            $('#tlpMember').val(data.tlp)
            $('#memberModal').modal('hide')
         })
         
      </script>
   </x-slot>
</x-app>