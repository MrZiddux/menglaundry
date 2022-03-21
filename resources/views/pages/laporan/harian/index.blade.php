<x-app title="Laporan Harian">
   <div class="section-header">
      <h1>Halaman Laporan Harian</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Laporan Harian</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4>Data Laporan Harian</h4>
                  <div class="card-header-form">
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                           <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#packageModal"><i class="fas fa-search"></i> Search</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body p-0">
                  <div class="table-responsive">
                     <table class="table table-striped table-md" id="tableLaporan">
                        <tr>
                           <th>No</th>
                           <th>Tanggal</th>
                           <th>Kode Invoice</th>
                           <th>Member</th>
                           <th>Total</th>
                        </tr>
                        @php
                           $grandTotal = 0;
                        @endphp
                        @foreach ($data as $item)
                           @php $grandTotal += $item->pembayaran->total_harga @endphp
                           <tr>
                              <td>{{ $i = (!isset($i)?1:++$i) }}</td>
                              <td>{{ $item->tgl }}</td>
                              <td>{{ $item->kode_invoice }}</td>
                              <td>{{ $item->member->nama }}</td>
                              <td>Rp. {{ number_format($item->pembayaran->total_harga, 0, ',', '.') }}</td>
                           </tr>
                        @endforeach
                        <tr class="bg-primary text-white">
                           <th colspan="4">Grand Total</th>
                           <th>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</th>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <x-slot name="script">
      <script></script>
   </x-slot>
</x-app>