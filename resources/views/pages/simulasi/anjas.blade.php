<x-app>
   <div class="section-header">
      <h1>Simulasi Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Simulasi Transaksi Cucian</div>
      </div>
   </div>
   <div class="section-body">
      <div class="card">
         <div class="card-header">
            <h4>Data Transaksi Cucian</h4>
         </div>
         <form id="Form">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>No Transaksi</label>
                        <input type="text" class="form-control form-control-sm" name="no">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control form-control-sm" name="nama">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>No. HP/WA</label>
                        <input type="tel" class="form-control form-control-sm" name="tlp">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Tanggal Cuci</label>
                        <input type="date" class="form-control form-control-sm" name="tanggal_cuci">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Jenis Cucian</label>
                        <select class="form-control form-control-sm" name="jenis" id="inputJenis">
                           <option selected disabled>Pilih Jenis</option>
                           <option value="Standar">Single</option>
                           <option value="Express">Express</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Berat</label>
                        <input type="number" class="form-control form-control-sm" name="berat" value="0">
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-primary">Input</button>
            </div>
         </form>
      </div>

      <div class="card">
         <div class="card-header row justify-content-between align-items-center">
            <h4>List Gaji Karyawan</h4>
            <div class="card-header-form">
               <div class="input-group">
                  <input type="search" class="form-control" id="search" placeholder="Type here...">
                  <div class="input-group-btn">
                     <button type="button" class="btn btn-primary btn-icon"><i class="fas fa-search"></i>&nbsp;Search</button>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body p-0">
            <div class="table-responsive">
               <table class="table table-striped table-md" id="tableKaryawan">
                  <tr class="header">
                     <th>
                        Id
                        {{-- <a href="javascript;" id="sortById" class="text-primary text-decoration-none ml-1"><i class="fas fa-sort"></i></a> --}}
                     </th>
                     <th>Nama Pelanggan</th>
                     <th>Kontak</th>
                     <th>Tanggal Cuci</th>
                     <th>
                        Jenis Cucian
                        {{-- <a href="javascript;" id="sortByJmlAnak" class="text-primary text-decoration-none ml-1"><i class="fas fa-sort"></i></a> --}}
                     </th>
                     <th>
                        Berat
                        {{-- <a href="javascript;" id="sortByMulaiKerja" class="text-primary text-decoration-none ml-1"><i class="fas fa-sort"></i></a> --}}
                     </th>
                     <th>Diskon</th>
                     <th>
                        Total Harga
                        {{-- <a href="javascript;" id="sortByTunjangan" class="text-primary text-decoration-none ml-1"><i class="fas fa-sort"></i></a> --}}
                     </th>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>

   <x-slot name="script">
      <script>
         const formatNumber = (number) => {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
         }

         const resetForm = () => {
            $('#Form')[0].reset()
         }

         const calculateTunjangan = (data) => {
            let tunjangan = 0
            const tunjanganMasaKerja = 150000
            if(data.status == 'married') {
               const tunjanganMenikah = 250000
               const tunjanganPerAnak = 150000
               tunjangan += tunjanganMenikah
               tunjangan += calculateAge(data.mulai_bekerja) * tunjanganMasaKerja
               if (data.jumlah_anak <= 2 && data.jumlah_anak >= 1) {
                  tunjangan += tunjanganPerAnak * parseInt(data.jumlah_anak)
               } else if (data.jumlah_anak >= 2) {
                  tunjangan += tunjanganPerAnak * 2
               }
               return tunjangan
            } else if(data.status == 'single') {
               tunjangan += calculateAge(data.mulai_bekerja) * tunjanganMasaKerja
               return tunjangan
            }
         }

         const renderTable = (str) => {
            let data = ''
            let grandTotalGaji = 0
            let totalTunjangan = 0
            let totalGajiKaryawan = 0
            let karyawanLocalStorage = JSON.parse(localStorage.getItem(str))

            karyawanLocalStorage.map(item => {
               totalGajiKaryawan +=  parseInt(item.gaji_karyawan)
               totalTunjangan += parseInt(item.tunjangan)
               grandTotalGaji += parseInt(item.total_gaji)
               data += `
                  <tr class="item">
                     <td>${item.id}</td>
                     <td>${item.nama}</td>
                     <td>${item.jenis_kelamin}</td>
                     <td>${item.status}</td>
                     <td>${item.jumlah_anak}</td>
                     <td>${item.mulai_bekerja}</td>
                     <td>Rp. ${formatNumber(item.gaji_karyawan)}</td>
                     <td>Rp. ${formatNumber(item.tunjangan)}</td>
                     <td>Rp. ${formatNumber(item.total_gaji)}</td>
                  </tr>
               `
            })
            data += `
               <tr class="text-white bg-primary item">
                  <td colspan="5"><b>Total</b><td>
                  <td><b>Rp. ${formatNumber(totalGajiKaryawan)}</b></td>
                  <td><b>Rp. ${formatNumber(totalTunjangan)}</b></td>
                  <td><b>Rp. ${formatNumber(grandTotalGaji)}</b></td>
               </td>
            `


            $('.item').remove()
            $(data).insertAfter('#tableKaryawan .header')
         }

         let dataKaryawan = []
         $('#Form').on('submit', function(e) {
            e.preventDefault()
            const form = new FormData(this)
            let obj = {}
            for (const key of form) {
               obj[key[0]] = key[1]
            }
            obj['gaji_karyawan'] = 2000000
            obj['tunjangan'] = calculateTunjangan(obj)
            obj['total_gaji'] = obj['gaji_karyawan'] + obj['tunjangan']
            dataKaryawan.push(obj)
            localStorage.setItem('karyawan', JSON.stringify(dataKaryawan))
            renderTable('karyawan')
            resetForm()
         })

         $(window).on('load', function() {
            renderTable('karyawan')
            let dataLocal = JSON.parse(localStorage.getItem('karyawan'))
            dataKaryawan = dataLocal
         })

         $('#sortById').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('karyawan'))
            let dataSort = []
            data.forEach(item => {
               dataSort.push({...item})
            })
            let temp
            for (let i = 1; i < dataSort.length; i++) {
               for (let j = i; j > 0 && dataSort[j].id < dataSort[j-1].id; j--) {
                  temp = dataSort[j]
                  dataSort[j] = dataSort[j-1]
                  dataSort[j-1] = temp
               }
            }
            localStorage.setItem('sortData', JSON.stringify(dataSort))
            renderTable('sortData')
         })

         $('#sortByJmlAnak').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('karyawan'))
            let dataSort = []
            data.forEach(item => {
               dataSort.push({...item})
            })
            let temp
            for (let i = 1; i < dataSort.length; i++) {
               for (let j = i; j > 0 && dataSort[j].jumlah_anak < dataSort[j-1].jumlah_anak; j--) {
                  temp = dataSort[j]
                  dataSort[j] = dataSort[j-1]
                  dataSort[j-1] = temp
               }
            }
            localStorage.setItem('sortData', JSON.stringify(dataSort))
            renderTable('sortData')
         })

         $('#sortByMulaiKerja').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('karyawan'))
            let dataSort = []
            data.forEach(item => {
               dataSort.push({...item})
            })
            let temp
            for (let i = 1; i < dataSort.length; i++) {
               for (let j = i; j > 0 && dataSort[j].mulai_bekerja < dataSort[j-1].mulai_bekerja; j--) {
                  temp = dataSort[j]
                  dataSort[j] = dataSort[j-1]
                  dataSort[j-1] = temp
               }
            }
            localStorage.setItem('sortData', JSON.stringify(dataSort))
            renderTable('sortData')
         })

         $('#sortByTunjangan').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('karyawan'))
            let dataSort = []
            data.forEach(item => {
               dataSort.push({...item})
            })
            let temp
            for (let i = 1; i < dataSort.length; i++) {
               for (let j = i; j > 0 && dataSort[j].tunjangan < dataSort[j-1].tunjangan; j--) {
                  temp = dataSort[j]
                  dataSort[j] = dataSort[j-1]
                  dataSort[j-1] = temp
               }
            }
            localStorage.setItem('sortData', JSON.stringify(dataSort))
            renderTable('sortData')
         })

         $('#sortByTotalGaji').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('karyawan'))
            let dataSort = []
            data.forEach(item => {
               dataSort.push({...item})
            })
            let temp
            for (let i = 1; i < dataSort.length; i++) {
               for (let j = i; j > 0 && dataSort[j].total_gaji < dataSort[j-1].total_gaji; j--) {
                  temp = dataSort[j]
                  dataSort[j] = dataSort[j-1]
                  dataSort[j-1] = temp
               }
            }
            localStorage.setItem('sortData', JSON.stringify(dataSort))
            renderTable('sortData')
         })

         $('#search').on('keyup', function() {
            let data = JSON.parse(localStorage.getItem('karyawan'))
            let dataSearch = []
            data.forEach(item => {
               dataSearch.push({...item})
            })
            let search = $(this).val()
            let dataSearchResult = dataSearch.filter(item => {
               return item.id.toLowerCase().includes(search.toLowerCase()) || item.nama.toLowerCase().includes(search.toLowerCase()) || item.jenis_kelamin.toLowerCase().includes(search.toLowerCase()) || item.status.toLowerCase().includes(search.toLowerCase())
            })
            localStorage.setItem('dataSearch', JSON.stringify(dataSearchResult))
            renderTable('dataSearch')
         })
      </script>
   </x-slot>
</x-app>
