<?php 
/**
 * Aplikasi Matriks - Hill Cipher
 * Tugas Besar Matematika Diskrit
 * Dosen :
 * 		Nelly Indriani W, S.Kom, M.Kom
 * Dibuat oleh :
 * 		M. Iqbal Musyaffa
 *   	Rangga DJjatikusuma Lukman
 *    	Farhan Mubarok
 */
class IRF_machine{
	protected $abjad = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890,. ";
	/**
	 * Fungsi Masukan adalah fungsi yang menerima inputan user dan akan diambil 2 huruf
	 * @param  String $teks variabel yang membungkus inputan dari user
	 * @return String       mengembalikan String array yang telah dibagi dua
	 *                      Array(
	 *                      	0 => Array(
	 *                      		0 => huruf satu,
	 *                      		1 => huruf dua
	 *                      	)
	 *                      )
	 */
	public function masukan($teks=NULL)
	{
		// pembagian dua teks
		$getTeks = array();
		for ($i=0; $i < strlen($teks); $i++) { 
			if(($i+1)==strlen($teks)){
				array_push($getTeks, $teks[$i]." ");
			}
			else{
				array_push($getTeks, $teks[$i].$teks[$i+1]);
			}
			
			$i = $i+1;
		}
		return $getTeks;
	}
	/**
	 * Fungsi getarray adalah mengkonversi kata dari fungsi masukan menjadi angka yang termasuk di dalam variabel $abjad
	 * @param  String $teks variabel yang membungkus inputan dari fungsi masukan
	 * @return String       mengembalikan String array dengan value berupa angka
	 *                      Array(
	 *                      	0 => Array(
	 *                      		0 => angka satu,
	 *                      		1 => angka dua
	 *                      	)
	 *                      )
	 */
	public function getarray($teks=NULL)
	{
		$arr = array();
		for ($j=0; $j < count($teks); $j++) { 
			for ($i=0; $i < strlen($teks[$j]); $i++) { 
				array_push($arr, array(
						0 => array_search($teks[$j][$i], str_split($this->abjad)),
						1 => array_search($teks[$j][$i+1], str_split($this->abjad))
					)
				);
				$i = $i+1;
			}
		}
		return $arr;
	}
	/**
	 * Fungsi perkalian_matriks adalah fungsi yang akan mengalikan matriks kunci 2x2 dengan matriks 1x1
	 * @param  String $a merupakan matriks kunci 2x2
	 * @param  String $b merupakan matriks inputan 1x1
	 * @return String    mengembalikan nilai perkalian matriks berupa array
	 */
	public function perkalian_matriks($a, $b) {
		$hasil   = array();
		
		$hasil[] = ($a[0][0]*$b[0])+($a[0][1]*$b[1]);
		$hasil[] = ($a[1][0]*$b[0])+($a[1][1]*$b[1]);
		return $hasil;
	}
	/**
	 * Fungsi mod_matriks adalah fungsi untuk mengalikan matriks hasil dari perkalian_matriks dengan mod
	 * @param  String  $a   matriks hasil perkalian
	 * @param  integer $mod banyaknya string dari Variabel $abjad tanpa symbol (., )
	 * @return String       mengembalikan nilai String hasil mod matriks
	 */
	public function mod_matriks($a, $mod = 65)
	{
		$hasil   = array();
		
		$hasil[] = $a[0] % $mod;
		$hasil[] = $a[1] % $mod;
		return $hasil;
	}
	public function invers_mod($a, $n = 65)
	{
		if ($n < 0) $n = -$n;
	    if ($a < 0) $a = $n - (-$a % $n);
		$t = 0; $nt = 1; $r = $n; $nr = $a % $n;
		while ($nr != 0) {
			$quot = intval($r/$nr);
			$tmp  = $nt;  $nt = $t - $quot*$nt;  $t = $tmp;
			$tmp  = $nr;  $nr = $r - $quot*$nr;  $r = $tmp;
		}
		if ($r > 1) return -1;
		if ($t < 0) $t += $n;
		return $t;
	}
	public function det_matriks($a)
	{
		$hasil = ($a[0][0]*$a[1][1])-($a[0][1]*$a[1][0]);
		return $hasil;
	}
	public function inv_mod_matriks($a, $n)
	{
		$hasil   = array();
		
		$hasil[] = array($a[1][1]*$n, ($a[1][0])*$n);
		$hasil[] = array(($a[0][1])*$n, $a[0][0]*$n);
		
		return $hasil;
	}
	public function mod_kunci($a, $mod = 65)
	{
		$hasil   = array();
		
		$hasil[] = array($a[0][0] % $mod, $mod - ($a[0][1] % $mod));
		$hasil[] = array($mod - ($a[1][0] % $mod), $a[1][1] % $mod);
		return $hasil;
	}
	/**
	 * Fungsi encrypt adalah fungsi untuk menkonversi pesan agar terenkripsi
	 * @param  String $teks merupakan string yang didapat dari inputan user
	 * @return String       mengembalikan string berupa enkripsi teks yang didapat dari metode Hill Cipher
	 */
	public function encrypt($teks=NULL)
	{
		$getTeks = $this->masukan($teks);
		$out     = $this->getarray($getTeks);
		
		$kunci   = array();
		$kunci[] = array("4","3");
		$kunci[] = array("3","2");
		//perkalian matriks
		$kali = array();
		foreach ($out as $key) {
			$kali[] = $this->perkalian_matriks($kunci, $key);
		}
		//mod matriks
		$mod = array();
		foreach ($kali as $row) {
			$mod[] = $this->mod_matriks($row);
		}
		//bangun teks
		$arr = str_split($this->abjad);
		$kata = array();
		foreach ($mod as $get) {
			$kata[] = $arr[$get[0]];
			$kata[] = $arr[$get[1]];
		}
		
		return implode("", $kata);
	}
	/**
	 * Fungsi Decrypt adalah fungsi untuk mengkonversi Encrpyt Teks ke Pesan Normal
	 * @param  String $teks merupakan string yang didapat dari inputan user
	 * @return String       mengembalikan string berupa enkripsi teks yang didapat dari metode Hill Cipher
	 */
	public function decrypt($teks=NULL)
	{
		$getTeks = $this->masukan($teks);
		$out     = $this->getarray($getTeks);
		
		$kunci   = array();
		$kunci[] = array("4","3");
		$kunci[] = array("3","2");
		$dev = $this->det_matriks($kunci);
		$inv_mod = $this->invers_mod($dev);
		$inv_mat = $this->inv_mod_matriks($kunci,$inv_mod);
		$matriks = $this->mod_kunci($inv_mat);
		//perkalian matriks
		$kali = array();
		foreach ($out as $key) {
			$kali[] = $this->perkalian_matriks($matriks, $key);
		}
		//mod matriks
		$mod = array();
		foreach ($kali as $row) {
			$mod[] = $this->mod_matriks($row);
		}
		//bangun teks
		$arr = str_split($this->abjad);
		$kata = array();
		foreach ($mod as $get) {
			$kata[] = $arr[$get[0]];
			$kata[] = $arr[$get[1]];
		}
		
		return implode("", $kata);
	}
}