<x-app title="Faktur">
   <div class="section-header">
      <h1>Halaman Faktur</h1>
   </div>
   <div class="section-body">
      <div class="invoice">
         <div class="invoice-print">
            @foreach ($transaksi as $item)                
            <div class="row">
            <div class="col-lg-12">
               <div class="invoice-title">
                  <h2>Invoice</h2>
                  <div class="invoice-number">Order {{ $item->kode_invoice }}</div>
               </div>
               <hr>
               <div class="row">
                  <div class="col-md-6">
                  <address>
                     <strong>Kasir:</strong><br>
                        {{ $item->user->nama }}<br>
                        {{ $item->user->tlp }}<br>
                        {{ $item->user->alamat }}
                  </address>
                  </div>
                  <div class="col-md-6 text-md-right">
                  <address>
                     <strong>Customer:</strong><br>
                     {{ $item->member->nama }}<br>
                     {{ $item->member->tlp }}<br>
                     {{ $item->member->alamat }}
                  </address>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                  @php
                     $resultJenisPembayaran = str_replace('_', ' ', $item->pembayaran->jenis_pembayaran);
                     $resultJenisPembayaran = ucwords($resultJenisPembayaran);

                     $resultPelunasan = str_replace('_', ' ', $item->pelunasan);
                     $resultPelunasan = ucwords($resultPelunasan);

                     setLocale(LC_TIME, 'IND');
                     // make variable to change format date to indonesia
                     $resultTgl = strftime("%d %B %Y", strtotime($item->tgl));
                     // $resultTgl = strftime('%d %B %Y');
                     // $resultTgl = date('%d %B, %Y', strtotime($item->tgl));
                  @endphp
                  <address>
                     <strong>Tipe Pembayaran:</strong><br>
                     {{ $resultJenisPembayaran }}<br>
                     {{ $resultPelunasan }}
                  </address>
                  </div>
                  <div class="col-md-6 text-md-right">
                  <address>
                     <strong>Tanggal Transaksi:</strong><br>
                     {{ $resultTgl }}<br><br>
                  </address>
                  </div>
               </div>
            </div>
            </div>
            @endforeach

            
            <div class="row mt-4">
            <div class="col-md-12">
               <div class="section-title">List Paket</div>
               <div class="table-responsive">
                  <table class="table table-striped table-hover table-md">
                  <tr>
                     <th data-width="40">No</th>
                     <th>Nama Paket</th>
                     <th class="text-center">Harga</th>
                     <th class="text-center">Qty</th>
                     <th class="text-right">Total</th>
                  </tr>
                  @foreach ($detailTransaksi as $item)
                  <tr>
                     <td class="text-center">{{ $loop->iteration }}</td>
                     <td>{{ $item->paket->nama_paket }}</td>
                     <td class="text-center">Rp. {{ number_format($item->paket->harga, 0, ',', '.') }}</td>
                     <td class="text-center">{{ $item->qty }}</td>
                     <td class="text-right">Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                  </tr>
                  @endforeach
                  </table>
               </div>
               <div class="row mt-4">
                  <div class="col-lg-4">
                  </div>
                  <div class="col-lg-8 text-right">
                     @php
                        $calculateSubtotal = 0;                        
                     @endphp
                     @foreach ($detailTransaksi as $item)
                     @php
                        $calculateSubtotal += $item->subtotal;
                     @endphp
                     @endforeach
                     <div class="invoice-detail-item">
                        <div class="invoice-detail-name">Subtotal</div>
                        <div class="invoice-detail-value">Rp. {{ number_format($calculateSubtotal, 0, ',', '.') }}</div>
                     </div>
                        <div class="row">
                           @foreach ($transaksi as $item)        
                           <div class="col">
                              <div class="invoice-detail-item">
                                 <div class="invoice-detail-name">Pajak</div>
                                 <div class="invoice-detail-value">{{ $item->pembayaran->pajak }}%</div>
                              </div>
                           </div>
                           <div class="col">
                              <div class="invoice-detail-item">
                                 <div class="invoice-detail-name">Diskon</div>
                                 <div class="invoice-detail-value">{{ $item->pembayaran->diskon }}%</div>
                              </div>
                           </div>
                           <div class="col">
                              <div class="invoice-detail-item">
                                 <div class="invoice-detail-name">Biaya Tambahan</div>
                                 <div class="invoice-detail-value">Rp. {{ $item->pembayaran->biaya_tambahan }}</div>
                              </div>
                           </div>
                        </div>
                        <hr class="mt-2 mb-2">
                        <div class="invoice-detail-item">
                           <div class="invoice-detail-name">Total</div>
                           <div class="invoice-detail-value invoice-detail-value-lg">Rp.  {{ number_format($item->pembayaran->total_harga, 0, ',', '.') }}</div>
                        </div>
                        @endforeach
                  </div>
               </div>
            </div>
            </div>
         </div>
         <hr>
         <div class="text-md-right">
            <a href="/transaction/new" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Close</a>
            <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
         </div>
      </div>
   </div>
</x-app>