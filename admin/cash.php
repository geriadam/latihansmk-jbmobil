<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Aplikasi Pembelian Mobil</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <link href="tanggal/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
<?php include "include/header.php"; ?>
<div class="content-wrapper">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h4 class="page-head-line">Pembayaran Cash</h4>
          </div>
      </div>
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-heading">
            <form action="cash-cari.php" method="post">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input name="cari" type="text" class="form-input" id="tanggal" placeholder="Pencarian" size="30">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
                </div>
                <a class="btn btn-success" href="export.php"><span class="glyphicon glyphicon-upload"> </span> Export</a></div>                   
            </form>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Cash</th>
                      <th>Nama Pembeli</th>
                      <th>Merk Mobil</th>
                      <th>Tanggal Beli</th>
                      <th>Uang Pembeli</th>
                      <th>Kembalian</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <?php
                    include "../koneksi/koneksi.php";
                    $query=mysqli_query($koneksi,"SELECT A.kode_cash,B.merk,A.cash_tanggal,A.cash_bayar,A.cash_kembalian,A.kode_mobil,A.id,C.id,C.nama_pembeli,A.status FROM beli_cash A , mobil B , pembeli C WHERE A.id = C.id AND A.kode_mobil = B.kode_mobil  order by A.cash_tanggal desc");
                    $no=1;
                    $jumlah = mysqli_num_rows($query);
                    if ($jumlah > 0) {  
                      while($a=mysqli_fetch_array($query, MYSQLI_ASSOC)){
                        $number=$a['cash_bayar'];
                        $number1=$a['cash_kembalian'];
                        $format_indonesia = number_format ($number, 2, ',', '.');
                        $format_indonesia1 = number_format ($number1, 2, ',', '.');
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $a['kode_cash']; ?></td>
                      <td><?php echo $a['nama_pembeli']; ?></td>
                      <td><a title="Detail Data" class="Open" data-toggle="modal" data-id="<?php echo $a['kode_mobil']; ?>" href="#">
                        <?php echo $a['merk']; ?></a>
                      </td>
                      <td><?php echo $a['cash_tanggal']; ?></td>
                      <td><?php echo "Rp.".$format_indonesia; ?></td>
                      <?php
                        $pas=$a['cash_kembalian'];
                        if($pas==0){
                      ?>
                      <td><?php echo "Uang Pas"; ?></td>
                      <?php } else { echo "<td>Rp.".$format_indonesia1."</td>"; } ?>
                      <?php
                        $stat=$a['status'];
                        if($stat=='Masih Di Proses'){
                      ?>
                      <td>
                        <a href="cash-edit.php?id=<?php echo $a['kode_cash']; ?>&status=Berhasil" class="btn btn-danger"><?php echo $stat; ?></a>
                      </td>
                      <?php } else { ?>
                      <td><a href="cash-edit.php?id=<?php echo $a['kode_cash']; ?>&status=Masih Di Proses" class="btn btn-success"><?php echo $stat; ?></td>
                      <?php } ?>
                    </tr>
                    <?php } } else {
                    echo '<br>'; 
                     echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-alert"></span> Maaf, Keranjang Anda Masih Kosong.</div>';  
                    } 
    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
        <!-- akhir kode -->
     </div>
</div>
</div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; <?php echo date('Y'); ?> Mobil | By : <a href="http://teknosut.blogspot.com/" target="_blank">Teknosut</a>
                </div>

            </div>
        </div>
    </footer>
<div aria-hidden="true" aria-labelledby="myModalLabel3" role="dialog" tabindex="-1" id="modal" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                                              <h4 class="modal-title">Gambar Mobil</h4>
                                          </div>
                                          <div class="modal-body">
                                          </div>
                                      </div>
                                  </div>
                              </div>   
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="tanggal/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="tanggal/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
</script>
    <script>
        $(function(){
            $(document).on('click','.Open',function(e){
                e.preventDefault();
                $("#modal").modal('show');
                $.get('mobil-detil.php',
                    {mobil:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
    </script>
</body>
</html>