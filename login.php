<?php
include "koneksi.php";
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = $conn->query("select * from petugas where username='$username' and password='$password'");
  $data = $query->fetch_array();
  if(isset($data['username']) and isset($data['password'])){
    $_SESSION['id_petugas'] = $data['id_petugas'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama_petugas'] = $data['nama_petugas'];
    $_SESSION['level'] = $data['level'];
    echo "
    <script>
    alert('Login Berhasil !!');
    </script>";
  }else{
    echo "
    <script>
    alert('Login Gagal !!');
    </script>";
  }
}    
?>

<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container-fluid">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="submit" name="login">Login</button>
    </div>

    <div class="container-fluid" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>