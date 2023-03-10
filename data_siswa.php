<?php
session_start();
 if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi SPP - Data Siswa</title>
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
  			$nisn = $_GET['nisn'];
  			$conn->query("delete from siswa where nisn='$nisn'");
  			echo"
  				<script>
            alert('Data Berhasil Dihapus !!');
            window.location.href='data_siswa.php';
         	</script>;
  			";
  	} 
  	if (isset($_POST['simpan'])) {
  			$nisn = $_POST['nisn'];
  			$nis = $_POST['nis'];
  			$nama = $_POST['nama'];
  			$id_kelas = $_POST['id_kelas'];
  			$alamat = $_POST['alamat'];
  			$no_telp = $_POST['no_telp'];
  			$id_spp = $_POST['id_spp'];
  			$conn->query("update siswa set nis='$nis',nama='$nama',id_kelas='$id_kelas',alamat='$alamat',no_telp='$no_telp',id_spp='$id_spp' where nisn='$nisn'");
  			echo "
  			<script>
          alert('Data Berhasil disimpan  !!');
          window.location.href='data_siswa.php';
        </script>;
  		";
  		}	
  ?>
	<div class="container-fluid text-center">    
    <div class="row content">
	    <div class="col-sm-2 sidenav">
	      <p><a href="#" onclick="document.getElementById('tambah').style.display='block'">Tambah Data</a></p>
	      <p><a href="#">Link</a></p>
	      <p><a href="#">Link</a></p>
	    </div>
	    <div class="col-sm-8 text-left"> 
	      <h1>Data Siswa</h1>
	      <p>
	      	<table>
			  <tr>
			  	<th>No</th>
			    <th>NISN</th>
			    <th>NIS</th>
			    <th>nama</th>
			    <th>Nama Kelas</th>
			    <th>Alamat</th>
			    <th>No Telp</th>
			    <th>Tahun SPP</th>
			    <th style="width: 74px;">Aksi</th>
			  </tr>
			  <?php
			  	$no = 1;
			  	$query = $conn->query("select * from siswa inner join kelas ON kelas.id_kelas = siswa.id_kelas inner join spp ON spp.id_spp = siswa.id_spp");
			  	while ($data = $query->fetch_array()) {	
			  ?>
			  <tr>
			    <td><?php echo $no; ?></td>
			    <td><?php echo $data['nisn'];?></td>
			    <td><?php echo $data['nis'];?></td>
			    <td><?php echo $data['nama'];?></td>
			    <td><?php echo $data['nama_kelas'];?></td>
			    <td><?php echo $data['alamat'];?></td>
			    <td><?php echo $data['no_telp'];?></td>
			    <td><?php echo $data['tahun'];?></td>
			    <td>
			    	<div id="edit-<?php echo $data['nisn'];?>" class="modal">
						  <form class="modal-content animate" method="post">
						    <div class="imgcontainer">
						      <span onclick="document.getElementById('edit-<?php echo $data['nisn'];?>').style.display='none'" class="close" title="Close Modal">&times;</span>
						    </div>
						    <input type="hidden" name="nisn" value="<?php echo $data['nisn'];?>" >
						    <div class="container-fluid ">
						      <label for="nis"><b>Nis</b></label>
						      <input type="text" placeholder="Enter Nis" name="nis" value="<?php echo $data['nis'];?>" required>

						      <label for="nama"><b>Nama</b></label>
						      <input type="text" placeholder="Enter nama" name="nama" value="<?php echo $data['nama'];?>" required>

						      <label for="kelas"><b>Pilih Kelas</b></label>
						      <select name='id_kelas' required>
						      	<option value="<?php echo $data['id_kelas'];?>"><?php echo $data['nama_kelas'];?></option>
						      	<?php
							      	$q_kelas = $conn->query("select * from kelas");
							      	while ($kelas = $q_kelas->fetch_array()) {
							      	?>
							      		<option value="<?php echo $kelas['id_kelas'];?>"><?php echo $kelas['nama_kelas'];?></option>
							      	<?php
							      	}
							      ?>
						      </select>

						      <label for="alamat"><b>Alamat</b></label>
						      <textarea name="alamat" required><?php echo $data['alamat'];?></textarea>
						      <label for="no_telp"><b>No Telp</b></label>
						      <input type="number" placeholder="Enter No Telp" name="no_telp" value="<?php echo $data['no_telp'];?>" required>

						      <label for="spp"><b>Pilih SPP</b></label>
						      <select name='id_spp' required>
						      	<option value="<?php echo $data['id_spp'];?>"><?php echo $data['nominal'];?></option>
						      	<?php
						      	$q_spp = $conn->query('select * from spp');
						      	while ($spp = $q_spp->fetch_array()) {
						      	?>
						      		<option value="<?php echo $spp['id_spp'];?>"><?php echo $spp['nominal'];?></option>
						      	<?php
						      	}
						      	?>
						      </select>
						        
						      <button type="submit" name="simpan">Simpan</button>
						    </div>
						    <div class="container-fluid" style="background-color:#f1f1f1">
						      <button type="button" onclick="document.getElementById('edit-<?php echo $data['nisn'];?>').style.display='none'" class="cancelbtn">Cancel</button>
						    </div>
						  </form>
						</div>
			    	<a href="#" onclick="document.getElementById('edit-<?php echo $data['nisn'];?>').style.display='block'" style="color: green;"><i class='bx bx-edit-alt bx-md'></i></a>
			    	|
			    	<a onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?');" href="data_siswa.php?page=hapus&nisn=<?php echo $data['nisn'];?>" ><i class='bx bxs-trash-alt bx-md' style="color: red;"></i></a>
			    </td> 	
			  </tr>
			  <?php
			  	$no =$no+1;
			  	}
			  ?>
			</table>
			</p>
	    </div>
	    <div class="col-sm-2 sidenav">
	      <div class="well">
	        <p>ADS</p>
	      </div>
	      <div class="well">
	        <p>ADS</p>
	      </div>
	  	</div>
	  </div>
  </div>
  <?php 
  	if (isset($_POST['tambah'])) {
  			$nisn = $_POST['nisn'];
  			$nis = $_POST['nis'];
  			$nama = $_POST['nama'];
  			$id_kelas = $_POST['id_kelas'];
  			$alamat = $_POST['alamat'];
  			$no_telp = $_POST['no_telp'];
  			$id_spp = $_POST['id_spp'];
  			$conn->query("insert into siswa set nisn='$nisn',nis='$nis',nama='$nama',id_kelas='$id_kelas',alamat='$alamat',no_telp='$no_telp',id_spp='$id_spp'");
  		echo "
  			<script>
          alert('Data Berhasil dimasukkan  !!');
          window.location.href='data_siswa.php';
        </script>;
  		";
  	}
  ?>
  <div id="tambah" class="modal">
			  <form class="modal-content animate" method="post">
			    <div class="imgcontainer">
			      <span onclick="document.getElementById('tambah').style.display='none'" class="close" title="Close Modal">&times;</span>
			    </div>
			    <div class="container-fluid ">
			    	<label for="Nisn">NISN</label>
			    	<input type="number" maxlength="10" placeholder="Enter Nisn" name="nisn" required >

			      <label for="nis"><b>Nis</b></label>
			      <input type="number" placeholder="Enter Nis" maxlength="8" name="nis" required>

			      <label for="nama"><b>Nama</b></label>
			      <input type="text" placeholder="Enter nama" name="nama" required>

			      <label for="kelas"><b>Pilih Kelas</b></label>
			      <select name='id_kelas' required>
			      	<option value="">Pilih Kelas</option>
			      	<?php
			      	$q_kelas = $conn->query("select * from kelas");
			      	while ($kelas = $q_kelas->fetch_array()) {
			      	?>
			      		<option value="<?php echo $kelas['id_kelas'];?>"><?php echo $kelas['nama_kelas'];?></option>
			      	<?php
			      	}
			      	?>
			      	
			      </select>

			      <label for="alamat"><b>Alamat</b></label>
			      <textarea name="alamat" required></textarea>

			      <label for="no_telp"><b>No Telp</b></label>
			      <input type="number" placeholder="Enter No Telp" maxlength="13" name="no_telp" required>

			      <label for="spp"><b>Pilih SPP</b></label>
			      <select name='id_spp' required>
			      	<option value=""> Pilih Spp</option>
			      	<?php
			      	$q_spp = $conn->query('select * from spp');
			      	while ($spp = $q_spp->fetch_array()) {
			      	?>
			      		<option value="<?php echo $spp['id_spp'];?>"><?php echo $spp['nominal'];?></option>
			      	<?php
			      	}
			      	?>
			      </select>
			        
			      <button type="submit" name="tambah">Tambah</button>
			    </div>
			    <div class="container-fluid" style="background-color:#f1f1f1">
			      <button type="button" onclick="document.getElementById('tambah').style.display='none'" class="cancelbtn">Cancel</button>
			    </div>
			  </form>
			</div> 	
  <script>
// Get the modal
var modal = document.getElementById('tambah');

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


