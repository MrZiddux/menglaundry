<x-app>
   <div class="section-header">
      <h1>Algoritma Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Algoritma</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row justify-content-center">
         <div class="col-lg-4">
            <div class="card">
               <div class="card-header">
                  <h4>To Do List</h4>
               </div>
               <form id="todolistForm">
                  <div class="card-body">
                     <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" id="id" class="form-control" placeholder="What's your id?" name="id">
                     </div>
                     <div class="form-group">
                        <label for="tenggatWaktu">Tenggat Waktu</label>
                        <input type="datetime-local" id="tenggatWaktu" class="form-control" name="tenggat_waktu">
                     </div>
                     <div class="form-group">
                        <label for="kegiatan">Kegiatan</label>
                        <input type="text" id="kegiatan" class="form-control" placeholder="What's your activity?" name="kegiatan">
                     </div>
                  </div>
                  <div class="card-footer text-right">
                     <button type="reset" class="btn btn-secondary">Clear</button>
                     <button type="submit" class="btn btn-primary">Set Kegiatan</button>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-8">
            <div class="card">
               <div class="card-header row justify-content-between align-items-center">
                  <h4>List Data</h4>
                  <div class="card-header-form">
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                           <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#packageModal"><i class="fas fa-search"></i> Find Package</button>
                        </div>
                     </div>
                  </div>
                  <button id="sortByDate" class="btn btn-sm btn-icon icon-left btn-primary ml-2"><i class="fas fa-sort"></i>Sort Date</button>
               </div>
               <div class="card-body p-0">
                  <div class="table-responsive">
                     <table class="table table-striped table-md" id="tableTodolist">
                        <tr class="header">
                           <th>No</th>
                           <th class="d-flex justify-content-between">
                              Id
                              <a href="javascript;" id="sortById"><i class="fas fa-sort"></i>&nbsp;Sort Id</a>
                           </th>
                           <th>Kegiatan</th>
                           <th>Tenggat Waktu</th>
                           <th>&nbsp;</th>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <x-slot name="script">
      <script>
         const checkDataForBtn = () => {
            if (JSON.parse(localStorage.getItem('data')).length === 0) {
               $('#sortById').attr('disabled', true)
               $('#sortByDate').attr('disabled', true)
               $('#sortById').removeClass('btn-primary')
               $('#sortById').addClass('btn-secondary')
               $('#sortByDate').removeClass('btn-primary')
               $('#sortByDate').addClass('btn-secondary')
            } else {
               $('#sortById').removeAttr('disabled')
               $('#sortByDate').removeAttr('disabled')
               $('#sortById').removeClass('btn-secondary')
               $('#sortById').addClass('btn-primary')
               $('#sortByDate').removeClass('btn-secondary')
               $('#sortByDate').addClass('btn-primary')
            }
         }

         const resetForm = () => {
            $('#todolistForm')[0].reset()
         }

         let dataAll = []
         $('#todolistForm').on('submit', function(e) {
            e.preventDefault()
            const dataForm = new FormData(this)
            let obj = {}
            for (const key of dataForm) {
               obj[key[0]] = key[1]
            }
            // make if when input is empty add class to input is-invalid
            if (obj.id === '' || obj.tenggat_waktu === '' || obj.kegiatan === '') {
               $('#id').addClass('is-invalid')
               $('#tenggatWaktu').addClass('is-invalid')
               $('#kegiatan').addClass('is-invalid')
            } else {
               $('#id').removeClass('is-invalid')
               $('#tenggatWaktu').removeClass('is-invalid')
               $('#kegiatan').removeClass('is-invalid')
               dataAll.push(obj)
               localStorage.setItem('data', JSON.stringify(dataAll))
               renderTable()
               checkDataForBtn()
               resetForm()
            }
         })

         const renderTable = () => {
            let data = ''
            let dataLocalStorage = JSON.parse(localStorage.getItem('data'))
            dataLocalStorage.map((item, index) => {
               return data +=  `
                  <tr class="item">
                     <td>${index+1}</td>
                     <td>${item.id}</td>
                     <td>${item.kegiatan}</td>
                     <td>${item.tenggat_waktu}</td>
                     <td><button data-index="${index+1}" class="btn btn-sm btn-danger">Remove</button></td>
                  </tr>`
            })
            $('.item').remove()
            $(data).insertAfter('#tableTodolist .header')
         }

         $(window).on('load', function () {
            checkDataForBtn()
            renderTable()
            let data = JSON.parse(localStorage.getItem('data'))

            // CARA PENDEK
            dataAll = data

            // CARA RIVALDI
            // if (data) {
            //    dataAll.push(..data)
            // }
            
            // CARA IHSAN
            // data.forEach(item => {
               //    dataAll.push({...item})
               // })
         })

         $('#tableTodolist').on('click', '.btn-danger', function() {
            let index = $(this).data('index')
            dataAll.splice(index-1, 1)
            localStorage.setItem('data', JSON.stringify(dataAll))
            checkDataForBtn()
            renderTable()
         })

         $('#sortByDate').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('data'))
            let dataSort = []
            data.forEach(item => {
               dataSort.push({...item})
            })
            let temp
            for (let i = 1; i < dataSort.length; i++) {
               for (let j = i; j > 0 && dataSort[j].tenggat_waktu < dataSort[j-1].tenggat_waktu; j--) {
                  temp = dataSort[j]
                  dataSort[j] = dataSort[j-1]
                  dataSort[j-1] = temp
               }
            }
            localStorage.setItem('data', JSON.stringify(dataSort))
            renderTable()
         })

         $('#sortById').on('click', function(e) {
            e.preventDefault()
            let data = JSON.parse(localStorage.getItem('data'))
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
            localStorage.setItem('data', JSON.stringify(dataSort))
            renderTable()
         })

      </script>
   </x-slot>
</x-app>