<?php
session_start();
session_destroy();
?>
<script>
	alert("Anda Berhasil Logout !!");
	window.location.href="index.php";
</script>