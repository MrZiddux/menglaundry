<x-app>
   <div class="section-header">
      <h1>Packages Page</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
         <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
         <div class="breadcrumb-item">Modal</div>
      </div>
   </div>
   <div class="section-body">
      <div id="alertHere"></div>
      <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i>&nbsp;Add New Package</button>
      <div class="row">
         <div class="col-12">
            <div id="wrapperTable"></div>
         </div>
      </div>
   </div>
   <x-slot name="btm">
      @include('pages.packages._modal')
   </x-slot>
</x-app>