<?php
  session_start();
  include 'config/database.php';
  include 'function/alertfunc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    require_once 'layout/head.php'
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <?php
    require_once 'layout/navbar.php'
  ?>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/storage-stacks.png" width="50px" height="50px" style="margin-right: 10px;margin-left: 10px;">
      <span class="brand-text font-weight-bold">Point Of Sales</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <?php
        require_once 'layout/sidebar.php'
    ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php 
          include 'content/content.php'
        ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Page specific script -->
<!-- <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#examplex").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script> -->
<script>
  $.noConflict();
  jQuery(document).ready(function($) {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#examplex").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>
<script>
  //Pembelian Check-Box
$(document).ready(function() {
  function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  $('.netto-checkbox').on('change', function() {
    var totalNetto = 0;
    $('.netto-checkbox:checked').each(function() {
      var nettoValue = parseInt($(this).val());
      totalNetto += nettoValue;
    });

    var formattedNetto = formatNumber(totalNetto);
    $('#totalNetto').val(formattedNetto);
  });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectElement = document.querySelector('select[name="id_jasa"]');
        var hargaJasaInput = document.querySelector('input[id="modal_jasa"]');
        
        selectElement.addEventListener('change', function() {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var hargaJasa = selectedOption.getAttribute('data-harga');
            hargaJasaInput.value = hargaJasa;
        });
    });
</script>

<script>
  $(document).ready(function() {
  $('.netto-checkbox').on('change', function() {
    var selectedPembelianIds = $('.netto-checkbox:checked').map(function() {
      return $(this).data('id_pembelian');
    }).get();

    $('#id_pembelian').val(selectedPembelianIds.join(','));
  });
});

</script>
<script>
  $(document).ready(function() {
    $('.netto-checkbox').on('change', function() {
      var selectedNoFaktur = [];
      $('.netto-checkbox:checked').each(function() {
        var noFaktur = $(this).data('no_faktur');
        selectedNoFaktur.push(noFaktur);
      });
      var joinedNoFaktur = selectedNoFaktur.join('\n');
      $('#noFakturDisplay').val(joinedNoFaktur);
    });
  });
</script>
<script>
$(document).ready(function() {
  $('.netto-checkbox').on('change', function() {
    var selectedPembelianIds = [];
    
    $('.netto-checkbox:checked').each(function() {
      var pembelianId = $(this).data('id_pembelian');
      selectedPembelianIds.push(pembelianId);
    });

    var baseUrl = window.location.href.split('?')[0];
    var existingParams = window.location.search;

    var updatedParams = '';

    if (existingParams.length > 0) {
      var params = new URLSearchParams(existingParams);

      // Remove any existing 'id_pembelian' parameter
      params.delete('id_pembelian');

      updatedParams = params.toString();
    }

    var newUrl = baseUrl + (updatedParams ? '?' + updatedParams : '');

    if (selectedPembelianIds.length > 0) {
      newUrl += (newUrl.includes('?') ? '&' : '?') + 'id_pembelian=' + selectedPembelianIds.join(',');
    }

    newUrl += (newUrl.includes('module=buyItem') ? '' : '&module=buyItem');

    history.replaceState(null, null, newUrl);
  });
});
</script>


<script>
  //Penjualan Check-Box
$(document).ready(function() {
  function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  $('.netto-checkbox-jual').on('change', function() {
    var totalNettoJual = 0;
    $('.netto-checkbox-jual:checked').each(function() {
      var nettoValue = parseInt($(this).data('netto'));
      totalNettoJual += nettoValue;
    });

    var formattedNettoJual = formatNumber(totalNettoJual);
    $('#totalNettoJual').val(formattedNettoJual);
  });

  $('.netto-checkbox-jual').change(function() {
    var selectedPenjualanIds = $('.netto-checkbox-jual:checked').map(function() {
      return $(this).data('id_penjualan');
    }).get();

    $('#id_penjualan').val(selectedPenjualanIds.join(','));

    var selectedNoFakturJual = $('.netto-checkbox-jual:checked').map(function() {
      return $(this).data('no_faktur_jual');
    }).get();

    $('#noFakturDisplayJual').val(selectedNoFakturJual.join('\n'));
  });
});
</script>
<script>
  $(document).ready(function() {
  $('.netto-checkbox-jual').on('change', function() {
    var selectedPenjualanIds = [];
    
    $('.netto-checkbox-jual:checked').each(function() {
      var penjualanId = $(this).data('id_penjualan');
      selectedPenjualanIds.push(penjualanId);
    });

    var baseUrl = window.location.href.split('?')[0];
    var existingParams = window.location.search;

    var updatedParams = '';

    if (existingParams.length > 0) {
      var params = new URLSearchParams(existingParams);

      // Remove any existing 'id_penjualan' parameter
      params.delete('id_penjualan');

      updatedParams = params.toString();
    }

    var newUrl = baseUrl + (updatedParams ? '?' + updatedParams : '');

    if (selectedPenjualanIds.length > 0) {
      newUrl += (newUrl.includes('?') ? '&' : '?') + 'id_penjualan=' + selectedPenjualanIds.join(',');
    }

    newUrl += (newUrl.includes('module=sellItem') ? '' : '&module=sellItem');

    history.replaceState(null, null, newUrl);
  });
});
</script>
<script>
$(document).ready(function() {
  $('input[name="perlengkapan"]').on('change', function() {
    if ($(this).val() === 'Tidak ada') {
      $('#kondisi-container input[name="kondisi"]').prop('disabled', true);
      $('#kondisi-container input[name="kondisi"]').prop('checked', false);
      $('#kondisi-container input[name="kondisi"][value="-"]').prop('disabled', false);
    } else {
      $('#kondisi-container input[name="kondisi"]').prop('disabled', false);
    }
  });
});
</script>
<script>
$('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
</script>
<script>
function updateUOMpembelian(id_barang) {
  var uom_select = document.getElementById("uom_select");
  var selectedOption = "";

  // Clear the select options
  uom_select.innerHTML = "";

  <?php
  $pilihansatuan = mysqli_query($conn, "select * from barang WHERE status = 'Y'");
  while ($fetcharray = mysqli_fetch_array($pilihansatuan)) {
    $barang_id = $fetcharray['id_barang'];
    $uombesar = $fetcharray['uom_besar'];
    $uomkecil = $fetcharray['uom_kecil'];
    $satuanbesar = $fetcharray['satuan_besar'];
    $satuankecil = $fetcharray['satuan_kecil'];
  ?>

    if (<?= $barang_id; ?> == id_barang) {
      uom_select.add(new Option('<?= $uombesar; ?>', 'besar'));
      uom_select.add(new Option('<?= $uomkecil; ?>', 'kecil'));
      uom_select.selectedIndex = -1;
      
      console.log('satuan kecil:', '<?= $satuankecil; ?>');
      document.getElementById('satuankecil_input').value = '<?= $satuankecil; ?>';
    }
  <?php
  }
  ?>
}
</script>

<script>
function updateUOMpembelian(id_barang) {
  var uom_select = document.getElementById("uom_select");
  var selectedOption = "";

  // Clear the select options
  uom_select.innerHTML = "";

  <?php
  $pilihansatuan = mysqli_query($conn, "select * from barang WHERE status = 'Y'");
  while ($fetcharray = mysqli_fetch_array($pilihansatuan)) {
    $barang_id = $fetcharray['id_barang'];
    $uombesar = $fetcharray['uom_besar'];
    $uomkecil = $fetcharray['uom_kecil'];
    $satuanbesar = $fetcharray['satuan_besar'];
    $satuankecil = $fetcharray['satuan_kecil'];
  ?>

    if (<?= $barang_id; ?> == id_barang) {
      uom_select.add(new Option('<?= $uombesar; ?>', 'besar'));
      uom_select.add(new Option('<?= $uomkecil; ?>', 'kecil'));
      uom_select.selectedIndex = -1;
      
      console.log('satuan kecil:', '<?= $satuankecil; ?>');
      document.getElementById('satuankecil_input').value = '<?= $satuankecil; ?>';
    }
  <?php
  }
  ?>
}
</script>

<script>
  const costPriceInput = document.getElementById('costPrice');
  const sellingpinput = document.getElementsByClassName('harga_barang')[0];
  const sellingPriceInput = document.getElementById('harga_barang');
  const marginInput = document.getElementById('margin');
  const barangIdInput = document.getElementById('id_barang_penjualan');
  const hargaModalInput = document.getElementById('harga_modal');

  function updateSellingPrice() {
    const costPrice = parseFloat(barangIdInput.options[barangIdInput.selectedIndex].dataset.hargaModal);
    const sellingPrice = parseFloat(sellingPriceInput.value);
    const margin = ((sellingPrice - costPrice) / costPrice) * 100;
    marginInput.value = margin.toFixed(0);
  }

  barangIdInput.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const hargaModal = parseFloat(selectedOption.dataset.hargaModal);
    costPriceInput.value = hargaModal;
    hargaModalInput.value = hargaModal.toFixed(0); // Display harga_modal value in the input field
    updateSellingPrice();
  });

  sellingPriceInput.addEventListener('input', updateSellingPrice);
</script>


<script>
  function showFormMasuk() {
    var option1 = document.getElementById("radioPrimary1");
    var option2 = document.getElementById("radioPrimary2");
    var form1 = document.getElementById("cashmasuk-option1");
    var form2 = document.getElementById("cashmasuk-option2");

    if (option1.checked) {
    form1.style.display = "block";
    form2.style.display = "none";
    } else if (option2.checked) {
    form1.style.display = "none";
    form2.style.display = "block";
    }
}
</script>
<script>
  function showFormKeluar() {
    var option1 = document.getElementById("radioPrimary1");
    var option2 = document.getElementById("radioPrimary2");
    var option3 = document.getElementById("radioPrimary3")
    var form1 = document.getElementById("cashkeluar-option1");
    var form2 = document.getElementById("cashkeluar-option2");
    var form3 = document.getElementById("cashkeluar-option3");

    if (option1.checked) {
      form1.style.display = "block";
      form2.style.display = "none";
      form3.style.display = "none";
    } else if (option2.checked) {
      form1.style.display = "none";
      form2.style.display = "block";
      form3.style.display = "none";
    } else if (option3.checked) {
      form1.style.display = "none";
      form2.style.display = "none";
      form3.style.display = "block";
    }
}
</script>

<!-- Page specific script -->
<script>
  //Area Chart
  $(function () {
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d');
    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        }
      ]
    };
  
    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      },
      elements: {
        point: {
          radius: 0,
          hoverRadius: 0
        }
      }
    };
  
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    });
  });
   
  //Line Chart
  $(function () {
<?php
// Fetch the data from MySQL
$queryjual = "SELECT * FROM penjualan_netto";
$resultjual = mysqli_query($conn, $queryjual);
$querybeli = "SELECT * FROM pembelian_netto";
$resultbeli = mysqli_query($conn, $querybeli);

// Process the fetched data and generate JavaScript array variables
$chartpembelian = [];
for ($i = 0; $i < 12; $i++) {
  $chartpembelian[] = 0;
}
$chartpenjualan = [];
for ($i = 0; $i < 12; $i++) {
  $chartpenjualan[] = 0;
}
$bulan_akum_beli = [];
$total_netto_beli = [];
while ($row = mysqli_fetch_assoc($resultbeli)) {
  $bulan_akum_beli[] = $row['bulan_akum_beli'];
  $total_netto_beli[] = $row['total_netto_beli'];
}
// mysqli_data_seek($result, 0); // Reset the result pointer to fetch data again
$bulan_akum_jual = [];
$total_netto_jual = [];
while ($row = mysqli_fetch_assoc($resultjual)) {
  $bulan_akum_jual[] = $row['bulan_akum_jual'];
  $total_netto_jual[] = $row['total_netto_jual'];
}
foreach ($bulan_akum_beli as $i => $data) {
  switch ($bulan_akum_beli[$i]) {
    case 1:
      $chartpembelian[0] = $total_netto_beli[$i];
      break;
    case 2:
      $chartpembelian[1] = $total_netto_beli[$i];
      break;
    case 3:
      $chartpembelian[2] = $total_netto_beli[$i];
      break;
    case 4:
      $chartpembelian[3] = $total_netto_beli[$i];
      break;      
    case 5:
      $chartpembelian[4] = $total_netto_beli[$i];
      break;
    case 6:
      $chartpembelian[5] = $total_netto_beli[$i];
      break;
    case 7:
      $chartpembelian[6] = $total_netto_beli[$i];
      break;
    case 8:
      $chartpembelian[7] = $total_netto_beli[$i];
      break;
    case 9:
      $chartpembelian[8] = $total_netto_beli[$i];
      break;
    case 10:
      $chartpembelian[9] = $total_netto_beli[$i];
      break;
    case 11:
      $chartpembelian[10] = $total_netto_beli[$i];
      break;
    case 12:
      $chartpembelian[11] = $total_netto_beli[$i];
      break;
    }
}
foreach ($bulan_akum_jual as $i => $data) {
  switch ($bulan_akum_jual[$i]) {
    case 1:
      $chartpenjualan[0] = $total_netto_jual[$i];
      break;
    case 2:
      $chartpenjualan[1] = $total_netto_jual[$i];
      break;
    case 3:
      $chartpenjualan[2] = $total_netto_jual[$i];
      break;
    case 4:
      $chartpenjualan[3] = $total_netto_jual[$i];
      break;      
    case 5:
      $chartpenjualan[4] = $total_netto_jual[$i];
      break;
    case 6:
      $chartpenjualan[5] = $total_netto_jual[$i];
      break;
    case 7:
      $chartpenjualan[6] = $total_netto_jual[$i];
      break;
    case 8:
      $chartpenjualan[7] = $total_netto_jual[$i];
      break;
    case 9:
      $chartpenjualan[8] = $total_netto_jual[$i];
      break;
    case 10:
      $chartpenjualan[9] = $total_netto_jual[$i];
      break;
    case 11:
      $chartpenjualan[10] = $total_netto_jual[$i];
      break;
    case 12:
      $chartpenjualan[11] = $total_netto_jual[$i];
      break;
    }
}
?>

    var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
    var lineChartData = {
      labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [
        {
          label               : 'Pembelian',
          backgroundColor     : 'rgba(50, 205, 50)',
          borderColor         : 'rgba(50, 205, 50)',
          data                : <?php echo json_encode($chartpembelian); ?>,
          fill                : false
        },
        {
          label               : 'Penjualan',
          backgroundColor     : 'rgba(255, 0, 0)',
          borderColor         : 'rgba(255, 0, 0)',
          data                : <?php echo json_encode($chartpenjualan); ?>,
          fill                : false
        }
      ]
    };
  
    var lineChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }],
      },
      elements: {
        point: {
          radius: 0,
          hoverRadius: 0
        }
      }
    };
  
    new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    });
  });
  //Donut Chart
  $(function () {
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
    var donutData = {
      labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
      datasets: [
        {
          data: [700, 500, 400, 600, 300, 100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
        }
      ]
    };
          
          var donutOptions = {
          maintainAspectRatio : false,
          responsive : true
          };
          
          new Chart(donutChartCanvas, {
          type: 'doughnut',
          data: donutData,
          options: donutOptions
            });
    });
  //Pie Chart
$(function () {
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieData = {
    labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
    datasets: [
      {
        data: [700, 500, 400, 600, 300, 100],
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
      }
    ]
  };

  var pieOptions = {
    maintainAspectRatio : false,
    responsive : true
  };

  new Chart(pieChartCanvas, {
    type: 'pie',
    data: pieData,
    options: pieOptions
  });
});
//Bar Chart
$(function () {
  <?php
// Fetch the data from MySQL
$queryjual = "SELECT * FROM penjualan_netto";
$resultjual = mysqli_query($conn, $queryjual);
$querybeli = "SELECT * FROM pembelian_netto";
$resultbeli = mysqli_query($conn, $querybeli);

// Process the fetched data and generate JavaScript array variables
$chartpembelian = [];
for ($i = 0; $i < 12; $i++) {
  $chartpembelian[] = 0;
}
$chartpenjualan = [];
for ($i = 0; $i < 12; $i++) {
  $chartpenjualan[] = 0;
}
$bulan_akum_beli = [];
$total_netto_beli = [];
while ($row = mysqli_fetch_assoc($resultbeli)) {
  $bulan_akum_beli[] = $row['bulan_akum_beli'];
  $total_netto_beli[] = $row['total_netto_beli'];
}
// mysqli_data_seek($result, 0); // Reset the result pointer to fetch data again
$bulan_akum_jual = [];
$total_netto_jual = [];
while ($row = mysqli_fetch_assoc($resultjual)) {
  $bulan_akum_jual[] = $row['bulan_akum_jual'];
  $total_netto_jual[] = $row['total_netto_jual'];
}
foreach ($bulan_akum_beli as $i => $data) {
  switch ($bulan_akum_beli[$i]) {
    case 1:
      $chartpembelian[0] = $total_netto_beli[$i];
      break;
    case 2:
      $chartpembelian[1] = $total_netto_beli[$i];
      break;
    case 3:
      $chartpembelian[2] = $total_netto_beli[$i];
      break;
    case 4:
      $chartpembelian[3] = $total_netto_beli[$i];
      break;      
    case 5:
      $chartpembelian[4] = $total_netto_beli[$i];
      break;
    case 6:
      $chartpembelian[5] = $total_netto_beli[$i];
      break;
    case 7:
      $chartpembelian[6] = $total_netto_beli[$i];
      break;
    case 8:
      $chartpembelian[7] = $total_netto_beli[$i];
      break;
    case 9:
      $chartpembelian[8] = $total_netto_beli[$i];
      break;
    case 10:
      $chartpembelian[9] = $total_netto_beli[$i];
      break;
    case 11:
      $chartpembelian[10] = $total_netto_beli[$i];
      break;
    case 12:
      $chartpembelian[11] = $total_netto_beli[$i];
      break;
    }
}
foreach ($bulan_akum_jual as $i => $data) {
  switch ($bulan_akum_jual[$i]) {
    case 1:
      $chartpenjualan[0] = $total_netto_jual[$i];
      break;
    case 2:
      $chartpenjualan[1] = $total_netto_jual[$i];
      break;
    case 3:
      $chartpenjualan[2] = $total_netto_jual[$i];
      break;
    case 4:
      $chartpenjualan[3] = $total_netto_jual[$i];
      break;      
    case 5:
      $chartpenjualan[4] = $total_netto_jual[$i];
      break;
    case 6:
      $chartpenjualan[5] = $total_netto_jual[$i];
      break;
    case 7:
      $chartpenjualan[6] = $total_netto_jual[$i];
      break;
    case 8:
      $chartpenjualan[7] = $total_netto_jual[$i];
      break;
    case 9:
      $chartpenjualan[8] = $total_netto_jual[$i];
      break;
    case 10:
      $chartpenjualan[9] = $total_netto_jual[$i];
      break;
    case 11:
      $chartpenjualan[10] = $total_netto_jual[$i];
      break;
    case 12:
      $chartpenjualan[11] = $total_netto_jual[$i];
      break;
    }
}
?>

  var barChartCanvas = $('#barChart').get(0).getContext('2d');
  var barChartData = {
    labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [
      {
        label               : 'Pembelian',
        backgroundColor     : 'rgba(50, 205, 50)',
        borderColor         : 'rgba(50, 205, 50)',
        data                : <?php echo json_encode($chartpembelian); ?>
      },
      {
        label               : 'Penjualan',
        backgroundColor     : 'rgba(255, 0, 0)',
        borderColor         : 'rgba(255, 0, 0)',
        data                : <?php echo json_encode($chartpenjualan); ?>,
      }
    ]
  };

  var barChartOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false
  };

  new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  });
});
//Stacked Bar Chart
$(function () {
  var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d');
  var stackedBarChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label               : 'Electronics',
        backgroundColor     : 'rgba(210, 214, 222, 1)',
        borderColor         : 'rgba(210, 214, 222, 1)',
        data                : [65, 59, 80, 81, 56, 55, 40]
      },
      {
        label               : 'Digital Goods',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        data                : [28, 48, 40, 19, 86, 27, 90]
      }
    ]
  };

  var stackedBarChartOptions = {
    responsive : true,
    maintainAspectRatio : false,
    scales: {
      xAxes: [
      {
        stacked: true
      }],
        yAxes: [
        {
          stacked: true
      }]
    }
  };

  new Chart(stackedBarChartCanvas, {
    type: 'bar',
    data: stackedBarChartData,
    options: stackedBarChartOptions
    });
});

</script>
<!-- Required Select -->
<script>
function updateUOMpenjualan(selectedValue) {
    // Get the uom_select_penjualan and satuankecil_input elements
    var uomSelect = document.getElementById('uom_select_penjualan');
    var satuanKecilInput = document.getElementById('satuankecil_input');
    var kuantitasInput = document.getElementById('kuantitas_input');
    var id_barang = selectedValue; // Assuming selectedValue is the id_barang

    // Clear the select options
    uomSelect.innerHTML = "";

    <?php
    $pilihansatuan = mysqli_query($conn, "select * from barang WHERE status = 'Y'");
    while ($fetcharray = mysqli_fetch_array($pilihansatuan)) {
        $barang_id = $fetcharray['id_barang'];
        $uombesar = $fetcharray['uom_besar'];
        $uomkecil = $fetcharray['uom_kecil'];
        $satuanbesar = $fetcharray['satuan_besar'];
        $satuankecil = $fetcharray['satuan_kecil'];
    ?>

        if (<?= $barang_id; ?> == id_barang) {
            uomSelect.add(new Option('<?= $uombesar; ?>', 'besar'));
            uomSelect.add(new Option('<?= $uomkecil; ?>', 'kecil'));
            uomSelect.selectedIndex = -1;

            console.log('satuan kecil:', '<?= $satuankecil; ?>');
            satuanKecilInput.value = '<?= $satuankecil; ?>';

            // Set the required attribute
            uomSelect.setAttribute('required', 'required');
            satuanKecilInput.setAttribute('required', 'required');
            kuantitasInput.setAttribute('required', 'required');
        }
    <?php
    }
    ?>

    // Remove the required attribute if nothing is selected
    if (!selectedValue) {
        uomSelect.removeAttribute('required');
        satuanKecilInput.removeAttribute('required');
    }
}
</script>


</body>
</html>
