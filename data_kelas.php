<?php
session_start();
 if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi SPP - Data Kelas</title>
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
  			$id_kelas = $_GET['id'];
  			$conn->query("delete from kelas where id_kelas='$id_kelas'");
  			echo"
  				<script>
            alert('Data Berhasil Dihapus !!');
            window.location.href='data_kelas.php';
         	</script>;
  			";
  	} 
  	if (isset($_POST['simpan'])) {
  			$id = $_POST['id_kelas'];
  			$nama_kelas = $_POST['nama_kelas'];
  			$kompetensi_keahlian = $_POST['kompetensi_keahlian'];
  			$conn->query("update kelas set nama_kelas='$nama_kelas',kompetensi_keahlian='$kompetensi_keahlian' where id_kelas='$id'");
  			echo "
  			<script>
          alert('Data Berhasil disimpan  !!');
          window.location.href='data_kelas.php';
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
	      <h1>Data Kelas</h1>
	      <p>
	      	<table>
			  <tr>
			    <th>No</th>
			    <th>Nama Kelas</th>
			    <th>Kompetensi keahlian</th>
			    <th style="width: 74px;">Aksi</th>
			  </tr>
			  <?php
			  	$no = 1;
			  	$query = $conn->query("select * from kelas");
			  	while ($data = $query->fetch_array()) {	
			  ?>
			  <tr>
			    <td><?php echo $no; ?></td>
			    <td><?php echo $data['nama_kelas'];?></td>
			    <td><?php echo $data['kompetensi_keahlian'];?></td>
			    <td>
			    	<div id="edit-<?php echo $data['id_kelas'];?>" class="modal">
						  <form class="modal-content animate" method="post">
						    <div class="imgcontainer">
						      <span onclick="document.getElementById('edit-<?php echo $data['id_kelas'];?>').style.display='none'" class="close" title="Close Modal">&times;</span>
						    </div>
						    <input type="hidden" name="id_kelas" value="<?php echo $data['id_kelas'];?>" >
						    <div class="container-fluid ">
						      <label for="nama_kelas"><b>Nama kelas</b></label>
						      <input type="text" placeholder="Enter Nama Kelas" name="nama_kelas" value="<?php echo $data['nama_kelas'];?>" required>

						      <label for="kompetensi_keahlian"><b>Kompetensi Keahlian</b></label>
						      <input type="text" placeholder="Enter Kompetensi Keahlian" name="kompetensi_keahlian" value="<?php echo $data['kompetensi_keahlian'];?>" required>
						      <button type="submit" name="simpan">Simpan</button>
						    </div>
						    <div class="container-fluid" style="background-color:#f1f1f1">
						      <button type="button" onclick="document.getElementById('edit-<?php echo $data['id_kelas'];?>').style.display='none'" class="cancelbtn">Cancel</button>
						    </div>
						  </form>
						</div>
			    	<a href="#" onclick="document.getElementById('edit-<?php echo $data['id_kelas'];?>').style.display='block'" style="color: green;"><i class='bx bx-edit-alt bx-md'></i></a>
			    	|
			    	<a onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?');" href="data_kelas.php?page=hapus&id=<?php echo $data['id_kelas'];?>" ><i class='bx bxs-trash-alt bx-md' style="color: red;"></i></a>
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
  		$nama_kelas = $_POST['nama_kelas'];
  		$kompetensi_keahlian = $_POST['kompetensi_keahlian'];
  		$conn->query("insert into kelas set nama_kelas='$nama_kelas',kompetensi_keahlian='$kompetensi_keahlian'");
  		echo "
  			<script>
            alert('Data Berhasil dimasukkan  !!');
            window.location.href='data_kelas.php';
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
			      <label for="nama_kelas"><b>Nama Kelas</b></label>
			      <input type="text" placeholder="Enter Nama Kelas" name="nama_kelas" required>

			      <label for="kompetensi_keahlian"><b>Kompetensi Keahlian</b></label>
			      <input type="text" placeholder="Enter Kompetensi Keahlian" name="kompetensi_keahlian" required>      
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
var modal = document.getElementById('edit-<?php echo $data['id_kelas'];?>');

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


