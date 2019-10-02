<center>
<h1>Enkrpsi DES</h1>
<form action="enkripsi1.php" method="post">
<textarea name="pesan" cols="60" rows="4"></textarea><br /><br />
Kunci : <input type="text" name="kunci" maxlength="8"><br /><br />
<input type="submit" name="submit" value="Proses">
</form>

<?php 
require_once("message.php");


if(isset($_POST["submit"])) {
	$pesan = $_POST["pesan"];
	$kunci = $_POST["kunci"];


	///////////////////////////// Enkrpisi //////////////////////////////////////////////

	//Ubah ke bentuk biner dan tiap 8 character di simpan kedalam tiap-tipa nilai array
	$hasil = setChr_to_bin($pesan);
	
	//kunci
	$kunci = setChr_to_bin($kunci)[0];
	$kunci = getPC1($kunci);

	//array hasil semua
	$arr_hasil = array();
	$arr_biner = array();
	//Jumlah loop tergantung berapa banyak nilai array (8 charater) per nilai
	for($n = 0 ; $n < count($hasil); $n++) {
		$ip1 = getIP($hasil[$n]);
		
		//Untuk menyimpan tiap irisan (1/2) dari pesan yang dimasukan		
		$pesan1 = "";
		$pesan2 = "";

		$parameter = 1;
		//round 12
		for($i = 0 ; $i < 16 ; $i++) {
			
			//Left Circular Shift
			$get_kunci = get_leftCS($kunci[0],$kunci[1],$i);
			$get_kunci = getPC2($get_kunci);

			//inisialisasi Awal saat pertama kali nilai masuk ke dalam round
			if($i == 0) {
				//memotong nilai, tiap $pesan1 dan $pesan2 menyimpan 1/2 dari $potong
				$potong = get_half_input($ip1);
				$pesan1 = $potong[0];
				$pesan2 = $potong[1];

			}

			//selection table
			$selec = get_selection_table($pesan2);
			$pesan_xor2 = $pesan1;

			//XOR1
			$xor1 = get_indkey($selec,$get_kunci);

			//s-box
			$sbox = get_sbox($xor1);

			//permutasi
			$perm = get_permutation($sbox);
			$pesan1 = get_balik_permutation($perm);

			//XOR2
			$xor2 = get_xor2($pesan_xor2,$perm);
			$pesan2 = $xor2;
			
		}

		//IP-1
		$output_bin = get_IP2($pesan2,$pesan1);

		//Hasil output diubah menjadi karater
		$output_hasil = get_output($output_bin);
		$arr_hasil[] = $output_hasil;

		$arr_biner[] = $output_bin;
	}

	//menampilkan hasil yang masih dalam bentuk biner
	
	/*
	echo "</p>";
	echo "<p>Hasil Berupa Binner : <br />";
	foreach($arr_biner as $val) {
		echo $val."<br />";
	}
	echo "</p>";
	*/

	//menampilkan hasil yang berasal dari array hasil
	echo "<p>Hasil Berupa Karater : <br />";
	foreach($arr_hasil as $val) {
		echo $val;
	}
	echo "</p>";
}
?>
</center>