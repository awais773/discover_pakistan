<!DOCTYPE html>
<html lang="en">

<head>
  <script>
$( "button.continue" ).html( "Next Step..." )
var hiddenBox = $( "#banner-message" );
$( "#button-container button" ).on( "click", function( event ) {
  hiddenBox.show();
});
$.ajax({
  url: "/api/getWeather",
  data: {
    zipcode: 97201
  },
  success: function( result ) {
    $( "#weather-temp" ).html( "<strong>" + result + "</strong> degrees" );
  }
});
  </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <a href="https://code.jquery.com/jquery-3.5.1.js"></a>
    <a href="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></a>
    <a href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></a>
<a href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"></a>
<a href="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></a>
<a href="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></a>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready( function () {
    $('#table_id').DataTable();
} );
    </script>
    <script>var table = $('#myTable').DataTable();
 
      // Search for a data point
      table.search( 'Fiona' ).draw();</script>
<script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }
    </script>
    <!-- CSS only -->
    <link href="{{ asset('import/assets/https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css') }}"
        rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('import/assets/https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ asset('import/assets/https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css') }}"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <title>Discover Pakistan</title>
    <a
        href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></a>
        <a href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></a>


    <!-- Custom fonts for this template-->
    <link href="{{ asset('import/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('import/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/css/customstyle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js
    ">
    <link href="{{ asset('import/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/css/customstyle.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('import/assets/js/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
