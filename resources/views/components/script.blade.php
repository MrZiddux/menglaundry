<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
<script src="/assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="/assets/js/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="/assets/js/chart.js/Chart.min.js"></script>
<script src="/assets/js/owl.carousel/owl.carousel.min.js"></script>
<script src="/assets/js/summernote/summernote-bs4.js"></script>
<script src="/assets/js/chocolat/jquery.chocolat.min.js"></script>
<script src="/assets/js/sweetalert2/sweetalert2.all.min.js"></script>

<!-- Template JS File -->
<script src="/assets/js/scripts.js"></script>
<script src="/assets/js/custom.js"></script>

<script>
   // make function when #logoutButton is clicked logout
   $('#logoutButton').click(function(e){
      const csrf = $('#logoutButton').data('csrf')
      e.preventDefault();
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': csrf
         }
      })
      $.ajax({
         url: '/logout',
         type: 'POST',
         success: function(response){
            window.location.href = '/login';
         }
      });
   });
</script>