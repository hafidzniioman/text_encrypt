<?php 
	require 'machine.php';
	$machine = new IRF_machine();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Matriks - Hill Cipher</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-danger">
					<div class="panel-body">
						<center><h3>MATRIKS - HILL CIPHER</h3></center>
						<h5>Dibuat Oleh :</h5>
						<ul>
							<li>M. Iqbal Musyaffa</li>
							<li>Rangga Djatikusuma Lukman</li>
							<li>Farhan Mubarok</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">
							PlainText
						</h3>
					</div>
					<div class="panel-body">
						<form action="" method="POST">
							<div class="form-group">
								<input type="text" class="form-control" name="dec_teks" value="<?php echo empty($_POST['dec_teks']) ? "" : $_POST['dec_teks']; ?>">
							</div>
							<div class="form-group">
								<button class="btn btn-block btn-danger" name="enc" type="submit">Enkripsi</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">
							CipherText
						</h3>
					</div>
					<div class="panel-body">
						<form action="" method="POST">
							<div class="form-group">
								<input type="text" class="form-control" value="<?php 
										if(isset($_POST['enc'])){
											$dec_teks = isset($_POST['dec_teks']) ? $_POST['dec_teks'] : "";
											echo $machine->encrypt($dec_teks);
										}
									?>">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">
							CipherText
						</h3>
					</div>
					<div class="panel-body">
						<form action="" method="POST">
							<div class="form-group">
								<input type="text" class="form-control" name="enc_teks" value="<?php echo empty($_POST['enc_teks']) ? "" : $_POST['enc_teks']; ?>">
							</div>
							<div class="form-group">
								<button class="btn btn-block btn-success" name="dec" type="submit">Dekripsi</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">
							PlainText
						</h3>
					</div>
					<div class="panel-body">
						<form action="" method="POST">
							<div class="form-group">
								<input type="text" class="form-control" value="<?php 
										if(isset($_POST['dec'])){
											$enc_teks = isset($_POST['enc_teks']) ? $_POST['enc_teks'] : "";
											echo $machine->decrypt($enc_teks);
										}
									?>">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>