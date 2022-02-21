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
      <form method="POST" action="{{ route('') }}"></form>
      <div class="row">
         <div class="col-12 col-xl-9 order-1">
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
                              <input type="date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="datain">Estimated Completed</label>
                              <input type="date" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime(date('Y-m-d') . '+3 day')) }}">
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
                              <h3 class="text-center text-primary">Rp <span id="totalHarga">0</span></h3>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-3 order-3 order-xl-2">
            <div class="card">
               <div class="card-header">
                  <h4>Payment</h4>
               </div>
               <div class="card-body">
                  <div class="form-group">
                     <label for="diskon">Discount</label>
                     <input type="text" id="diskon" class="form-control form-control-sm">
                  </div>
                  <div class="form-group">
                     <label for="pajak">Tax</label>
                     <input type="text" id="pajak" class="form-control form-control-sm" value="10" readonly>
                  </div>
                  <div class="form-group">
                     <label for="total_bayar">Cash</label>
                     <input type="text" id="total_bayar" class="form-control form-control-sm">
                  </div>
                  <button class="btn btn-primary btn-block" id="btnSimpan">Save</button>
               </div>
            </div>
         </div>
         <div class="col-12 order-2 order-xl-3">
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
               <div class="card-body p-0">
                  <div class="table-responsive">
                     <table class="table table-striped table-md" id="tableCart">
                        <tr>
                           <th>Name</th>
                           <th>Package Type</th>
                           <th>Price</th>
                           <th>QTY</th>
                           <th>Subtotal</th>
                           <th>Action</th>
                        </tr>
                     </table>
                  </div>
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

         const unformatNumber = (number) => {
            return parseInt(number.replaceAll(/\./g, ''));
         }

         const delunderscore = (str) => {
            return str.replace(/_/g, " ");
         }

         const capitalize = (str) => {
            return str.replace(/\w\S*/g, function (txt) {
               return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
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
                        capitalize(delunderscore(item.jenis)),
                        formatNumber(item.harga),
                        new gridjs.html(
                           `<button class="btn btn-icon btn-primary selectPackage" data-id="${ item.id }"><i class="fas fa-check"></i></button>`
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
            $('#namaMember').val(data.nama)
            $('#tlpMember').val(data.tlp)
            $('#memberModal').modal('hide')
         })

         // make function calculateTotal
         const calculateTotal = () => {
            let total = 0
            $('#tableCart tr:not(:first)').each(function() {
               total += parseInt(unformatNumber($(this).find('td:eq(4)').text()))
            })
            $('#totalHarga').text(formatNumber(total))
         }

         $(document).on('click', '.selectPackage', function() {
            let id = $(this).data('id')
            let data = dataPaket.find(item => item.id == id)
            let nama_paket = data.nama_paket
            let jenis = data.jenis
            let harga = data.harga
            let newRow = `<tr data-id="${ data.id }">
                              <td>${ nama_paket }</td>
                              <td>${ capitalize(delunderscore(jenis)) }</td>
                              <td id="harga_paket">${ formatNumber(harga) }</td>
                              <td>
                                 <input type="number" name="qty[]" value="1" class="form-control-plaintext qty" readonly>
                                 <input type="hidden" name"id_paket[]" value="${ data.id }">
                              </td>
                              <td class="subtotal">
                                 0
                              </td>
                              <td>
                                 <button class="btn btn-icon btn-danger btn-sm deleteCart" data-id="${ data.id }"><i class="fas fa-trash"></i></button>
                              </td>
                           </tr>`
            let row = $('#tableCart').find(`tr[data-id="${ data.id }"]`)
            if (row.length > 0) {
               let qty = row.find('.qty')
               qty.val(parseInt(qty.val()) + 1)
            } else {
               $('#tableCart').append(newRow)
            }
            let qty = $(`#tableCart tr[data-id="${ data.id }"] .qty`)
            let subtotal = parseInt(qty.val()) * harga
            $(`#tableCart tr[data-id="${ id }"] .subtotal`).text(formatNumber(subtotal))
            calculateTotal()
            $('#packageModal').modal('hide')
         })

         // make function deleteCart when click button delete 1 row in tableCart
         $(document).on('click', '.deleteCart', function() {
            let id = $(this).data('id')
            let data = dataPaket.find(item => item.id == id)
            let row = $(this).closest('tr')
            row.remove()
            calculateTotal()
         })
      </script>
   </x-slot>
</x-app>
