<?php
        function alertText ($alert, $text){
          //Kelipatan 7 = warning
          if ($alert % 7 == 0){
            echo "<script>
            $(document).ready(function() {
                toastr.warning('$text');
            });
          </script>";
          }  
          //Ganjil (kecuali 7) = success
          else if ($alert % 2 == 1 ) {
              echo "<script>
              $(document).ready(function() {
                  toastr.success('$text');
              });
            </script>";
            } 
          //Genap = error
          else {
            echo "<script>
            $(document).ready(function() {
                toastr.error('$text');
            });
          </script>";
          }
        }
    
          function switchAlert ($alert) {
            switch ($alert){
                case 1:
                alertText(1, "Data berhasil ditambahkan");
                break;
                case 2:
                alertText(2, "Data gagal ditambahkan");
                break;
                case 3:
                alertText(3, "Data berhasil di-edit");
                break;
                case 4:
                alertText(4, "Data gagal di-edit");
                break;
                case 5:
                alertText(5, "Data berhasil dihapus");
                break;
                case 6:
                alertText(6, "Data gagal dihapus");
                break;  
                case 7:
                  alertText(7, "Stock tidak mencukupi");
                break;  
                case 8:
                  alertText(8, "Data dengan nama ini sudah ada");
                case 14:
                  alertText(14, "Data yang diisi tidak lengkap. Mohon diisi dengan benar");
          }
        }
?>
<?php 
  function existCheck($var, array $array) {
    for ($i = 0; $i < count($array); $i++) {
      if ($var == $array[$i])
        return true;
    }
    return false;
  }
?>