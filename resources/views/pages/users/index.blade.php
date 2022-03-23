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
      <div class="d-flex justify-content-between align-items-center">
         <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Add New User</button>
         <div>
            {{-- <a href="/members/export" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i>&nbsp;Export Data</a> --}}
            <button class="btn btn-icon icon-left btn-info" data-toggle="modal" data-target="#importModal"><i class="fas fa-file-excel"></i>&nbsp;Import Data</button>
         </div>
      </div>
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

      </script>
   </x-slot>
</x-app>