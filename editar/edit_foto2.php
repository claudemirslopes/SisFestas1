<?php
sleep(1);
$id = $_POST['id'];
include_once '../config/dbconfig.php';
$sql = $pdo->query("SELECT * FROM usuarios WHERE id = $id");
if($sql->rowCount() > 0 ){

$info = $sql->fetch();
date_default_timezone_set('America/Sao_Paulo');
$date = date('d-m-Y H:i');

?>
					 
	<form action="../processa/proc_edit_foto2" method="POST" class="form-horizontal" enctype="multipart/form-data"> 

		<div class="form-group col-md-12">
			<input type="hidden" name="id" value="<?php echo $info['id']; ?>">
			<input type="hidden" name="foto_antiga" value="<?php echo $info['foto']; ?>">
			<input type="file" class="form-control form-control-sm form-control-file" id="exampleFormControlFile1" name="foto">
		</div>

		<div class="card-text text-sm-center">
			<input type="submit" class="btn btn-outline-primary" name="SendEditFoto2" value="Atualizar foto">
		</div>
			
	</form>
		
<?php
}
?>