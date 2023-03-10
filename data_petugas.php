<?php
session_start();
 if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi SPP - Data Petugas</title>
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
  			$conn->query("delete from petugas where id_petugas='$id'");
  			echo"
  				<script>
            alert('Data Berhasil Dihapus !!');
            window.location.href='data_petugas.php';
         	</script>;
  			";
  	} 
  	if (isset($_POST['simpan'])) {
  			$id = $_POST['id_petugas'];
  			$username = $_POST['username'];
  			$password = $_POST['password'];
  			$nama_petugas = $_POST['nama_petugas'];
  			$level = $_POST['level'];
  			$conn->query("update petugas set username='$username',password='$password',nama_petugas='$nama_petugas',level='$level' where id_petugas='$id'");
  			echo "
  			<script>
          alert('Data Berhasil disimpan  !!');
          window.location.href='data_petugas.php';
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
	      <h1>Data Petugas</h1>
	      <p>
	      	<table>
			  <tr>
			    <th>No</th>
			    <th>Username</th>
			    <th>Password</th>
			    <th>Nama Petugas</th>
			    <th>Level</th>
			    <th style="width: 74px;">Aksi</th>
			  </tr>
			  <?php
			  	$no = 1;
			  	$query = $conn->query("select * from petugas");
			  	while ($data = $query->fetch_array()) {	
			  ?>
			  <tr>
			    <td><?php echo $no; ?></td>
			    <td><?php echo $data['username'];?></td>
			    <td><?php echo $data['password'];?></td>
			    <td><?php echo $data['nama_petugas'];?></td>
			    <td><?php echo $data['level'];?></td>
			    <td>
			    	<div id="edit-<?php echo $data['id_petugas'];?>" class="modal">
						  <form class="modal-content animate" method="post">
						    <div class="imgcontainer">
						      <span onclick="document.getElementById('edit-<?php echo $data['id_petugas'];?>').style.display='none'" class="close" title="Close Modal">&times;</span>
						    </div>
						    <input type="hidden" name="id_petugas" value="<?php echo $data['id_petugas'];?>" >
						    <div class="container-fluid ">
						      <label for="username"><b>Username</b></label>
						      <input type="text" placeholder="Enter Username" name="username" value="<?php echo $data['username'];?>" required>

						      <label for="password"><b>Password</b></label>
						      <input type="text" placeholder="Enter Password" name="password" value="<?php echo $data['password'];?>" required>

						      <label for="nama-petugas"><b>Nama Petugas</b></label>
						      <input type="text" placeholder="Enter Nama Petugas" name="nama_petugas" value="<?php echo $data['nama_petugas'];?>" required>

						      <label for="level"><b>Level</b></label>
						      <select name="level" required>
						      	<option value="<?php echo $data['level'];?>"><?php echo $data['level'];?></option>
						      	<option value="admin">Admin</option>
						      	<option value="petugas">Petugas</option>
						      </select>
						        
						      <button type="submit" name="simpan">Simpan</button>
						    </div>
						    <div class="container-fluid" style="background-color:#f1f1f1">
						      <button type="button" onclick="document.getElementById('edit-<?php echo $data['id_petugas'];?>').style.display='none'" class="cancelbtn">Cancel</button>
						    </div>
						  </form>
						</div>
			    	<a href="#" onclick="document.getElementById('edit-<?php echo $data['id_petugas'];?>').style.display='block'" style="color: green;"><i class='bx bx-edit-alt bx-md'></i></a>
			    	|
			    	<a onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?');" href="data_petugas.php?page=hapus&id=<?php echo $data['id_petugas'];?>" ><i class='bx bxs-trash-alt bx-md' style="color: red;"></i></a>

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
  		$username = $_POST['username'];
  		$password = $_POST['password'];
  		$nama_petugas = $_POST['nama_petugas'];
  		$level= $_POST['level'];
  		$conn->query("insert into petugas set username='$username',password='$password',nama_petugas='$nama_petugas',level='$level'");
  		echo "
  			<script>
            alert('Data Berhasil dimasukkan  !!');
            window.location.href='data_petugas.php';
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
			      <label for="username"><b>Username</b></label>
			      <input type="text" placeholder="Enter Username" name="username" required>

			      <label for="password"><b>Password</b></label>
			      <input type="password" placeholder="Enter Password" name="password" required>

			      <label for="nama-petugas"><b>Nama Petugas</b></label>
			      <input type="text" placeholder="Enter Nama Petugas" name="nama_petugas" required>

			      <label for="level"><b>Level</b></label>
			      <select name="level" required>
			      	<option value="">Pilih Level</option>
			      	<option value="admin">Admin</option>
			      	<option value="petugas">Petugas</option>
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
var modal = document.getElementById('edit-<?php echo $data['id_petugas'];?>');

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


