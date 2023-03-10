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