<?php
session_start();
 if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi SPP - Data SPP</title>
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
  			$id = $_GET['id'];
  			$conn->query("delete from spp where id_spp='$id'");
  			echo"
  				<script>
            alert('Data Berhasil Dihapus !!');
            window.location.href='data_spp.php';
         	</script>;
  			";
  	} 
  	if (isset($_POST['simpan'])) {
  			$id = $_POST['id_spp'];
  			$tahun = $_POST['tahun'];
  			$nominal = $_POST['nominal'];
  			$conn->query("update spp set tahun='$tahun',nominal='$nominal' where id_spp='$id'");
  			echo "
  			<script>
          alert('Data Berhasil disimpan  !!');
          window.location.href='data_spp.php';
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
	      <h1>Data SPP</h1>
	      <p>
	      	<table>
			  <tr>
			    <th>No</th>
			    <th>Tahun</th>
			    <th>Nominal</th>
			    <th style="width: 74px;">Aksi</th>
			  </tr>
			  <?php
			  	$no = 1;
			  	$query = $conn->query("select * from spp");
			  	while ($data = $query->fetch_array()) {	
			  ?>
			  <tr>
			    <td><?php echo $no; ?></td>
			    <td><?php echo $data['tahun'];?></td>
			    <td><?php echo $data['nominal'];?></td>
			    <td>
			    	<div id="edit-<?php echo $data['id_spp'];?>" class="modal">
						  <form class="modal-content animate" method="post">
						    <div class="imgcontainer">
						      <span onclick="document.getElementById('edit-<?php echo $data['id_spp'];?>').style.display='none'" class="close" title="Close Modal">&times;</span>
						    </div>
						    <input type="hidden" name="id_spp" value="<?php echo $data['id_spp'];?>" >
						    <div class="container-fluid ">
						      <label for="tahun"><b>Tahun</b></label>
						      <input type="number" placeholder="Enter tahun" name="tahun" value="<?php echo $data['tahun'];?>" required>

						      <label for="nominal"><b>Nominal</b></label>
						      <input type="number" placeholder="Enter nominal" name="nominal" value="<?php echo $data['nominal'];?>" required>
						      <button type="submit" name="simpan">Simpan</button>
						    </div>
						    <div class="container-fluid" style="background-color:#f1f1f1">
						      <button type="button" onclick="document.getElementById('edit-<?php echo $data['id_spp'];?>').style.display='none'" class="cancelbtn">Cancel</button>
						    </div>
						  </form>
						</div>
			    	<a href="#" onclick="document.getElementById('edit-<?php echo $data['id_spp'];?>').style.display='block'" style="color: green;"><i class='bx bx-edit-alt bx-md'></i></a>
			    	|
			    	<a onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?');" href="data_spp.php?page=hapus&id=<?php echo $data['id_spp'];?>" ><i class='bx bxs-trash-alt bx-md' style="color: red;"></i></a>
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
  		$tahun = $_POST['tahun'];
  		$nominal = $_POST['nominal'];
  		$conn->query("insert into spp set tahun='$tahun',nominal='$nominal'");
  		echo "
  			<script>
            alert('Data Berhasil dimasukkan  !!');
            window.location.href='data_spp.php';
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
			      <label for="tahun"><b>Tahun</b></label>
			      <input type="number" placeholder="Enter Tahun" name="tahun" required>

			      <label for="nominal"><b>Nominal</b></label>
			      <input type="number" placeholder="Enter nominal" name="nominal" required>      
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
var modal = document.getElementById('edit-<?php echo $data['id_spp'];?>');

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


