<x-app title="Laporan Transaksi">
   <div class="section-header">
      <h1>Halaman Laporan Transaksi</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Laporan Transaksi</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4>Tanggal Transaksi</h4>
               </div>
               <form id="tanggalTransaksi">
                  @csrf
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="tanggalAwal">Tanggal Awal</label>
                              <input type="date" class="form-control form-control-sm" id="tanggalAwal" name="tgl_awal">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="tanggalAkhir">Tanggal Akhir</label>
                              <input type="date" class="form-control form-control-sm" id="tanggalAkhir" name="tgl_akhir">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
               </form>
            </div>
            <div id="cardTransaksi"></div>
         </div>
      </div>
   </div>
   <x-slot name="script">
      <script>
         $('#tanggalTransaksi').on('submit', function(e) {
            e.preventDefault();
            const form = new FormData(this)
            $.ajax({
               type: 'POST',
               url: '/laporan/transaksi/getLaporanTransaksi',
               data: form,
               processData: false,
               contentType: false,
               success: function(data) {
                  let html = ``
                  html += `
                     <div class="card">
                        <div class="card-header">
                           <h4>Data Laporan Transaksi</h4>
                           <div class="card-header-form">
                              <div class="input-group">
                                 <input type="text" class="form-control" placeholder="Search">
                                 <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#packageModal"><i class="fas fa-search"></i> Search</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-striped table-md" id="tableLaporan">
                                 <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Invoice</th>
                                    <th>Member</th>
                                    <th>Total</th>
                                 </tr>
                  `

                  data.data.map(item => {
                     html += `
                        <tr>
                           <td>1</td>
                           <td>${item.tgl}</td>
                           <td>${item.kode_invoice}</td>
                           <td>${item.member.nama}</td>
                           <td>${item.pembayaran.total_harga}</td>
                        </tr>
                     `
                  })

                  html += `
                              </table>
                           </div>
                        </div>
                     </div>
                  `

                  $('#cardTransaksi').html(html)
               }
            })
         })
      </script>
   </x-slot>
</x-app>