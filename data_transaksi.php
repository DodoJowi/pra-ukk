<?php
session_start();
 if ($_SESSION['level'] == "admin" or $_SESSION['level'] == "petugas") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi SPP - Data Transaksi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
</head>
<body>
  <?php
    include "login.php";
  ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <?php
      include "menu.php";
    ?>
  </div>
</nav>
<?php
  	$page = @$_GET['page'];
  	if ($page=="hapus") {
  			if ($_SESSION['level']=="admin") {
  				$id_pembayaran = $_GET['id'];
	  			$conn->query("delete from pembayaran where id_pembayaran='$id_pembayaran'");
	  			echo"
	  				<script>
	            alert('Data Berhasil Dihapus !!');
	            window.location.href='data_transaksi.php';
	         	</script>;
	  			";
  			}else{
  				echo"
	  				<script>
	            alert('Anda Tidak Memiliki Akses Untuk Menghapus Data !!');
	            window.location.href='data_transaksi.php';
	         	</script>;
	  			";
  			}
  			
  	} 
  	if (isset($_POST['simpan'])) {
  			$id_pembayaran = $_POST['id_pembayaran'];
  			$id_petugas = $_POST['id_petugas'];
  			$nisn = $_POST['nisn'];
  			$tgl_bayar = $_POST['tgl_bayar'];
  			$bulan_dibayar = $_POST['bulan_dibayar'];
  			$tahun_dibayar = $_POST['tahun_dibayar'];
  			$id_spp = $_POST['id_spp'];
  			$jumlah_bayar = $_POST['jumlah_bayar'];
  			$conn->query("update siswa set id_petugas='$id_petugas',nisn='$nisn',tgl_bayar='$tgl_bayar',bulan_dibayar='$bulan_dibayar',tahun_dibayar='$tahun_dibayar',id_spp='$id_spp',jumlah_bayar='$jumlah_bayar', where id_pembayaran='$id_pembayaran'");
  			echo "
  			<script>
          alert('Data Berhasil disimpan  !!');
          window.location.href='data_transaksi.php';
        </script>;
  		";
  		}	
  ?>
	<div class="container-fluid text-left">    
    <div class="row content">
	    <div class="container"> 
	      <h1>Data Transaksi</h1>
	      <a class="btn btn-primary" onclick="document.getElementById('transaksi').style.display='block'">Entri Transaksi</a>
	      <p>
	      	<table>
			  <tr>
			  	<th>No</th>
			    <th>NISN</th>
			    <th>Nama</th>
			    <th>Kelas</th>
			    <th>Nominal Pembayaran</th>
			    <th>Bulan Dibayar</th>
			    <th>Tahun Dibayar</th>
			    <th>Petugas</th>
			    <th>Aksi</th>
			  </tr>
			  <?php
			  	$no = 1;
			  	$query = $conn->query("select * from pembayaran inner join petugas ON petugas.id_petugas = pembayaran.id_petugas inner join siswa ON siswa.nisn = pembayaran.nisn inner join kelas ON kelas.id_kelas = siswa.id_kelas inner join spp ON spp.id_spp = pembayaran.id_spp");
			  	while ($data = $query->fetch_array()) {	
			  ?>
			  <tr>
			    <td><a  onclick="document.getElementById('details-<?php echo $data['id_pembayaran'];?>').style.display='block'"><?php echo $no; ?></a></td>
			    <td><a  onclick="document.getElementById('details-<?php echo $data['id_pembayaran'];?>').style.display='block'"><?php echo $data['nisn'];?></a></td>
			    <td><a  onclick="document.getElementById('details-<?php echo $data['id_pembayaran'];?>').style.display='block'"><?php echo $data['nama'];?></a></td>
			    <td><a  onclick="document.getElementById('details-<?php echo $data['id_pembayaran'];?>').style.display='block'"><?php echo $data['nama_kelas'];?></a></td>
			    <td><a  onclick="document.getElementById('details-<?php echo $data['id_pembayaran'];?>').style.display='block'"><?php echo $data['nominal'];?></a></td>
			    <td><a  onclick="document.getElementById('details-<?php echo $data['id_pembayaran'];?>').style.display='block'"><?php echo $data['bulan_dibayar'];?></a></td>
			    <td><a  onclick="document.getElementById('details-<?php echo $data['id_pembayaran'];?>').style.display='block'"><?php echo $data['tahun_dibayar'];?></a></td>
			    <td><?php echo $data['nama_petugas'];?></td>
			    <td>
			    	<div id="details-<?php echo $data['id_pembayaran'];?>" class="modal">
			    		<div class="modal-content animate">
						    <div class="imgcontainer">
						      <span onclick="document.getElementById('details-<?php echo $data['id_pembayaran'];?>').style.display='none'" class="close" title="Close Modal">&times;</span>
						    </div>
						    <div class="container-fluid ">
						      <label for="nisn"><b>Nisn</b></label>
						      <input type="text" disabled="disabled" value="<?php echo $data['nisn'];?>">

						      <label for="nama"><b>Nama</b></label>
						      <input type="text"  disabled="disabled" value="<?php echo $data['nama'];?>">

						      <label for="kelas"><b>Kelas</b></label>
						      <input type="text" disabled="disabled"  value="<?php echo $data['nama_kelas'];?>">

						      <label for="tgl_bayar"><b>Tanggal Bayar</b></label>
						      <input type="text" disabled="disabled"  value="<?php echo $data['tgl_bayar'];?>">

						      <label for="bulan_dibayar"><b>Bulan Dibayar</b></label>
						      <input type="text" disabled="disabled" value="<?php echo $data['bulan_dibayar'];?>">

						      <label for="tahun_dibayar"><b>Tahun Dibayar</b></label>
						      <input type="text" disabled="disabled" value="<?php echo $data['tahun_dibayar'];?>">

						      <label for="nominal"><b>Nominal Yang Harus Dibayar </b></label>
						      <input type="text" disabled="disabled"  value="<?php echo $data['nominal'];?>">

						      <label for="jumlah_bayar"><b>Jumlah Bayar</b></label>
						      <input type="text" disabled="disabled"  value="<?php echo $data['jumlah_bayar'];?>">

						      <label for="nama_petugas"><b>Nama Petugas</b></label>
						      <input type="text" disabled="disabled"  value="<?php echo $data['nama_petugas'];?>">

						    </div>
						    <div class="container-fluid" style="background-color:#f1f1f1">
						      <button type="button"  onclick="document.getElementById('details-<?php echo $data['id_pembayaran'];?>').style.display='none'" class="cancelbtn">Cancel</button>
						    </div>
						  </div>
						</div>
			    	<a class="btn btn-info" style="margin-bottom: 5px;" onclick="document.getElementById('details-<?php echo $data['id_pembayaran'];?>').style.display='block'"><i class='bx bxs-info-circle'></i>details</a>
			    	<a  class="btn btn-danger" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?');" href="data_transaksi.php?page=hapus&id=<?php echo $data['id_pembayaran'];?>" ><i class='bx bxs-trash-alt'></i>hapus</a>
			    </td> 	
			  </tr>
			  <?php
			  	$no =$no+1;
			  	}
			  ?>
			</table>
			</p>
	    </div>
  </div>
  <?php 
  	if (isset($_POST['transaksi'])) {
  			$id_petugas = $_SESSION['id_petugas'];
  			$nisn = $_POST['nisn'];
  			$tgl_bayar = date("y-m-d");
  			$bulan_dibayar = $_POST['bulan_dibayar'];
  			$tahun_dibayar = $_POST['tahun_dibayar'];
  			$id_spp = $_POST['id_spp'];
  			$jumlah_bayar = $_POST['jumlah_bayar'];
  			$c_pembayaran = $conn->query("select * from pembayaran where nisn='$nisn' and bulan_dibayar='$bulan_dibayar' and tahun_dibayar='$tahun_dibayar'")->num_rows;
  			if ($c_pembayaran>0) {
  				echo "
		  			<script>
		          alert('Anda Sudah Membayar !!');
		          window.location.href='data_transaksi.php';
		        </script>;
		  		";
  			}else{
  					$conn->query("insert into pembayaran set id_pembayaran='$id_pembayaran', id_petugas='$id_petugas',nisn='$nisn',tgl_bayar='$tgl_bayar',bulan_dibayar='$bulan_dibayar',tahun_dibayar='$tahun_dibayar',id_spp='$id_spp',jumlah_bayar='$jumlah_bayar'");
			  		echo "
			  			<script>
			          alert('Transaksi Berhasil !!');
			          window.location.href='data_transaksi.php';
			        </script>;
			  		";
  			}
  	}
  ?>
  <div id="transaksi" class="modal">
			  <form class="modal-content animate" method="post">
			    <div class="imgcontainer">
			      <span onclick="document.getElementById('transaksi').style.display='none'" class="close" title="Close Modal">&times;</span>
			    </div>
			    <div class="container-fluid ">
			    	<label for="nisn"><b>Nisn</b></label>
						<input list="nisn_list" name="nisn" id="nisn" required>
					  <datalist id="nisn_list">
					    <?php
				      	$q_nisn = $conn->query("select nisn from siswa");
				      	while ($nisn = $q_nisn->fetch_array()) {
			      	?>
			      		<option value="<?php echo $nisn['nisn'];?>"></option>
			      	<?php
			      		}
			      	?>
					  </datalist>
					  <div id="details-pembayaran">

						</div>
 						<script type="text/javascript">
							$('#nisn').change(function() { 
								var nisn = $(this).val(); 
								$.ajax({
									type: 'POST', 
									url: 'ajax_data.php?page=nisn', 
									data: 'nisn=' + nisn, 
									success: function(response) { 
										$('#details-pembayaran').html(response); 
									}
								});
							});
						</script>
			      <button type="submit" onclick="return confirm('kamu Yakin Ingin Membayar?')" name="transaksi">Bayar</button>
			    </div>
			    <div class="container-fluid" style="background-color:#f1f1f1">
			      <button type="button" onclick="document.getElementById('transaksi').style.display='none'" class="cancelbtn">Cancel</button>
			    </div>
			  </form>
			</div> 	
  <script>
// Get the modal
var modal = document.getElementById('transaksi');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script>
// Get the modal
var modal = document.getElementById('edit-<?php echo $data['nisn'];?>');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
<?php
 }else{
 	echo"
		<script>
      alert('Anda Tidak Memiliki Akses !!');
      window.location.href='index.php';
   	</script>;
	";
 }
?>


