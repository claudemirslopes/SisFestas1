<?php
sleep(1);
$id = $_POST['id'];
include_once '../config/dbconfig.php';
// $pdo = new PDO("mysql:dbname=sisfestas;host=localhost", "root", "");
$sql = $pdo->query("SELECT * FROM paginas WHERE id = $id");
if($sql->rowCount() > 0 ){

	$info = $sql->fetch();
	date_default_timezone_set('America/Sao_Paulo');
    $date = date('d-m-Y H:i');

	?>
	<form method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $info['id']; ?>" class="form-control form-control-sm forp">
		<fieldset class="border p-3 fset" style="margin-top: 10px;">
			<legend class="font-small">&nbsp;&nbsp;<i class="fa fa-file-text"></i>&nbsp;&nbsp;Página</legend>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputEmail4">Endereço <small>(URL da Página)</small></label>
					<input type="text" name="endereco" value="<?php echo $info['endereco']; ?>" class="form-control form-control-sm forp" style="font-size: .8em;">
				</div>
				<div class="form-group col-md-6">
					<label for="inputEmail4">Nome da Página</label>
					<input type="text" name="nome_pagina" value="<?php echo $info['nome_pagina']; ?>" class="form-control form-control-sm forp" style="font-size: .8em;">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="inputEmail4">OBS</label>
					<textarea name="obs" rows="4" class="form-control form-control-sm forp" style="font-size: .8em;"><?php echo $info['obs']; ?></textarea>
				</div>
			</div>
		</fieldset>
		<div class="modal-footer">
		   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
		   <input type="submit" value="Atualizar página" class="btn btn-primary">
		</div>
	</form>
	<?php

}
?>
