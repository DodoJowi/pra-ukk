<?php
include "koneksi.php";
$page = $_GET['page'];
if ($page=="nisn") {
$nisn = $_POST['nisn'];
$t_data = $conn->query("select siswa.id_spp, siswa.nama, kelas.nama_kelas, spp.nominal from siswa inner join kelas on kelas.id_kelas = siswa.id_kelas inner join spp on spp.id_spp=siswa.id_spp where siswa.nisn ='$nisn'")->fetch_array();
?>
	<label for="nama"><b>Nama</b></label>
	<input type="text" value="<?php echo $t_data['nama'];?>" disabled>

	<label for="kelas"><b>Kelas</b></label>
	<input type="text" value="<?php echo $t_data['nama_kelas'];?>" disabled>

	<label for="bulan_dibayar"><b>Bulan Dibayar</b></label>
	<select name="bulan_dibayar" required>
		<option value="Januari">Januari</option>
		<option value="Februari">Februari</option>
		<option value="Maret">Maret</option>
		<option value="April">April</option>
		<option value="mei">mei</option>
		<option value="Juni">Juni</option>
		<option value="Juli">Juli</option>
		<option value="Agustus">Agustus</option>
		<option value="September">September</option>
		<option value="Oktober">Oktober</option>
		<option value="November">November</option>
		<option value="Desember">Desember</option>
	</select>

	<label for="thn_dibayar">Tahun Dibayar</label>
	<select name="tahun_dibayar" required>
		<?php
		$tahun = date('Y');
		for ($i=$tahun-4; $i<=$tahun+3  ; $i++) { 
		?>
		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php
		}
		?>
	</select>

	<label for="nominal">Nominal yang harus dibayar</label>
	<input type="text" name="jumlah_bayar" value="<?php echo $t_data['nominal'] ?>" readonly>
	<input type="hidden" name="id_spp" value="<?php echo $t_data['id_spp'] ?>" readonly>
<?php
}
?>

