<?php
function get_output($n) {
	$h = "";
	$arrHasil = array();

	$konter = 0;
	for($i = 0 ; $i < strlen($n) ; $i++) {
		$konter++;
		$h .= $n[$i]; 
		if($konter % 8 == 0) {
			$arrHasil[] = $h;
			$h = "";
		}
	}

	$hasil = "";
	for($i = 0 ; $i < count($arrHasil) ; $i++) {
		$hasil .=  chr(bindec($arrHasil[$i]));
	}

	return $hasil;
}

function get_IP2($nil1,$nil2) {
	$nil = $nil1.$nil2;

	$fileku = file("setting.php");
	$data = explode(" ",$fileku[20]);
	$hasil = "";

	for($i = 0 ; $i < count($data) ; $i++) {
		$n = $data[$i] - 1;
		$hasil .= $nil[$n];
	}

	return $hasil;
}

function get_xor2($nil,$perm) {
	$hasil = "";
	for($i = 0 ; $i < strlen($nil) ; $i++) {
		if($nil[$i] == $perm[$i]) {
			$hasil .= "0";
		} else {
			$hasil .= "1";
		}
	}

	return $hasil;
}

function get_balik_permutation($hasil) {
	$konter = 0; 
	$n = "";
	$arr_balik = array();

	for($i = 0 ; $i < strlen($hasil) ; $i++) { 
		$konter++;
		$n .= $hasil[$i];

		if($konter % 8  == 0) {
			$arr_balik[] = $n;
			$n = "";
		}

	}

	$konter = 0;
	$posisi1 = 0;
	$posisi2 = 7;
	$n = "";

	$arr_baliks = array();
	
	for($i = 0 ; $i < (8 * 5) ; $i++) {
		$konter++;

		if($konter % 5 != 0) {
			$n .= $arr_balik[$posisi1][$posisi2];
			$posisi1++;
		} else {
			$arr_baliks[] = $n;
			$n = "";
			$posisi1 = 0;
			$posisi2--;
		}
	}

	return implode($arr_baliks);
}

function get_permutation($n) {
	$fileku = file("setting.php");
	$data = explode(" ", $fileku[17]);
	$hasil = "";
	for($i = 0 ; $i < count($data) ; $i++) {
		$nil = $data[$i] - 1;
		$hasil .= $n[$nil];
	}

	$konter = 0; 
	$n = "";
	$arr_balik = array();

	for($i = 0 ; $i < strlen($hasil) ; $i++) { 
		$konter++;
		$n .= $hasil[$i];

		if($konter % 4 == 0) {
			$arr_balik[] = $n;
			$n = "";
		}
	}

	$konter = 0;
	$posisi1 = 7;
	$posisi2 = 0;
	$n = "";

	$arr_baliks = array();
	
	for($i = 0 ; $i < (9 * 4) ; $i++) {
		$konter++;

		if($konter % 9 != 0) {
			$n .= $arr_balik[$posisi1][$posisi2];
			$posisi1--;
		} else {
			$arr_baliks[] = $n;
			$n = "";
			$posisi1 = 7;
			$posisi2++;
		}
	}
	
	return implode($arr_baliks);
}

function get_sbox($n) {
	$konter = 0;
	$h = "";
	$arrHasil = array();

	for($i = 0 ; $i < strlen($n) ; $i++) {
		$h .= $n[$i];
		if(($i + 1) % 6 == 0) {	
			$konter++;
			$hasil = decbin(set_sbox($h,$konter));
			
			$u = strlen($hasil);
			if(strlen($hasil) < 4) {
				for($j = 0 ; $j < 4 - $u ; $j++) {
					$hasil = "0" . $hasil;
				}
			}

			$arrHasil[] = $hasil;
			
			$h = "";
		}
	}

	return implode($arrHasil);
}

function set_sbox($na,$pos) {
	$fileku = file("setting_box.php");
	if($pos == 1) {
		$mulai = 2;
	} else if($pos == 2) {
		$mulai = 8;
	} else if($pos == 3) {
		$mulai = 14;
	} else if($pos == 4) {
		$mulai = 20;
	} else if($pos == 5) {
		$mulai = 26;
	} else if($pos == 6) {
		$mulai = 32;
	} else if($pos == 7) {
		$mulai = 38;
	} else {
		$mulai = 44;
	}

	$deter_row = bindec($na[0] . $na[5]);
	$deter_colum = bindec($na[1] . $na[2] . $na[3] . $na[4]);


	$mulai = $mulai + $deter_row - 1;

	$hasil = explode(" ",$fileku[$mulai]);
	
	//untuk menampilkan hasil sbox, 8 buah
	
	/*
	echo "----<br />";
	echo "$na<br /> Posisi $pos<br />";
	echo "Posisi Ambil : $mulai<br />";
	echo "Posisi Baris : " . $deter_row ."<br />";
	echo "Posisi Kolom : $deter_colum<br />";
	echo "----<br />";
	*/

	return $hasil[$deter_colum];
}

function get_indkey($in,$key) {
	$hasil = "";

	for($i = 0 ; $i < strlen($in) ; $i++) {
		if($in[$i] == $key[$i]) {
			$hasil .= "0";
		} else {
			$hasil .= "1";
		}
	}

	return $hasil;
}

function get_selection_table($n) {
	$hasil = array();
	$fileku = file("setting.php");
	$data = explode(" ", $fileku[14]);

	for($i = 0 ; $i < 48 ; $i++) {
		$h = $data[$i] - 1;
		$hasil[] = $n[$h];
	}

	return implode($hasil);
}

function get_half_input($n) {
	$jum = strlen($n) / 2;
	$pertama = "";
	for($i = 0 ; $i < $jum ; $i++) {
		$pertama .= $n[$i];
	}
	
	$kedua = "";
	for($i = $jum ; $i < strlen($n) ; $i++) {
		$kedua .= $n[$i];
	}
	
	$arrHasil = array($pertama,$kedua);
	return $arrHasil;
}
function get_leftCS($c,$d,$posisi) {
	$fileku = file("setting.php");
	$data = explode(" ",$fileku[8]);
	$data = $data[$posisi];

	for($i = 0 ; $i < $data ; $i++) {
		$set_c = $c[0];
		$set_d = $d[0];

		$hasil_c = "";
		$hasil_d = "";
		
		for($j = 1 ; $j < strlen($c) ; $j++) {
			$hasil_c .= $c[$j];
			$hasil_d .= $d[$j];
		}


		$c = $hasil_c . $set_c ; 
		$d = $hasil_d . $set_d ;
	}

	return $c.$d;
}

function getPC2($n) {
	$hasil = array();
	$fileku = file("setting.php");
	$data = explode(" ", $fileku[11]);

	for($i = 0 ; $i < 48 ; $i++) {
		$h = $data[$i] - 1;
		$hasil[] = $n[$h];
	}

	return implode($hasil);
}

function getPC1($n) {
	$kunci = array();
	$kunci_c = "";
	$kunci_d = "";

	$fileku = file("setting.php");
	$set_c = explode(" ", $fileku[4]);		
	$set_d = explode(" ", $fileku[5]);

	for($i = 0 ; $i < count($set_c) ; $i++) {
		$h1 = $set_c[$i] - 1;
		$h2 = $set_d[$i] - 1;

		$kunci_c .= $n[$h1];
		$kunci_d .= $n[$h2];
	}

	$kunci[0] = $kunci_c;
	$kunci[1] = $kunci_d;

	return $kunci;
}

function getIP($n) {
	$hasil = array();
	$fileku = file("setting.php");
	$data = explode(" ", $fileku[1]);

	for($i = 0 ; $i < 64 ; $i++) {
		$h = $data[$i] - 1;
		$hasil[] = $n[$h];
	}

	return implode($hasil);
}

function setChr_to_bin($n) {
	$arrHasil = array();
	$hasil = "";

	$sisa = ((strlen($n) - 1) % 8); 
	for($i = $sisa ; $i < 8 ; $i++) {
		$n = $n . " ";
	}

	for($i = 0 ; $i < strlen($n) - 1 ; $i++) {
		$data = decbin(ord($n[$i]));

		if(strlen($data) < 8) {
			for($j = 0 ; $j <= 8 - strlen($data) ; $j++) {
				$data = "0" . $data;
			}
			$hasil .= $data;
		}

		if(($i + 1) % 8 == 0) {
			$arrHasil[] = $hasil;
			$hasil = "";
		}
	}

	return $arrHasil;
}

?>