<x-app title="Users">
   <div class="section-header">
      <h1>Halaman Kelola User</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
         <div class="breadcrumb-item">Users</div>
      </div>
   </div>
   <div class="section-body">
      <div id="alertHere"></div>
      <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Add New User</button>
      <div class="row">
         <div class="col-12">
            <div id="wrapperTable"></div>
         </div>
      </div>
   </div>
   <x-slot name="btm">
      @include('pages.users._modal')
   </x-slot>
   <x-slot name="script">
      <script>
         const grid = new gridjs.Grid({
            server: {
               method: 'GET',
               url: '/users/get',
               then: data => data.map((item, index) => [
                  index+1,
                  item.nama,
                  item.tlp,
                  item.username,
                  item.password,
                  item.outlet.nama
               ]),
            },
            columns: [
               {
                  name: 'No',
               },
               {
                  name: 'Nama',
               },
               {
                  name: 'Telepon',
               },
               {
                  name: 'Username',
               },
               {
                  name: 'Password',
               },
               {
                  name: 'Outlet',
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
         }).render(document.getElementById('wrapperTable'));
      </script>
   </x-slot>
</x-app>
