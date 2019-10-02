<?php
function encrypt($str) {
    $kunci = '979a218e0632df2935317f98d47956c7';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
        $karakter = chr(ord($karakter)+ord($kuncikarakter));
        $hasil .= $karakter;
    }
    return urlencode(base64_encode($hasil));
}
function decrypt($str) {
    $str = base64_decode(urldecode($str));
    $hasil = '';
    $kunci = '979a218e0632df2935317f98d47956c7';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
        $karakter = chr(ord($karakter)-ord($kuncikarakter));
        $hasil .= $karakter;
    }
    return $hasil;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>harviacode.com</title>
    </head>
    <body>
        <?php
        $id='23';
        $id_encrypted =  encrypt($id);
        ?>
        Klik <a href="index.php?id=<?php echo $id_encrypted ?>">index.php?id=<?php echo $id; ?></a>
        <hr/>
        <?php
        if (isset($_GET['id'])) {
        ?>
        $id yang dikirim        : <?php echo $id ?> <br/>
        $id hasil encrypt       : <?php echo $id_encrypted ?> <br/>
        $id hasil $_GET['id']   : <?php echo $_GET['id'] ?> <br/>
        $id hasil decrypt       : <?php echo decrypt($_GET['id']) ?> <br/>
        <?php
        }
        ?>
    </body>
</html>