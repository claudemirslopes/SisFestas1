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
	<form method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $info['id']; ?>" class="form-control">
	    <div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputEmail4">Nova senha <span style="font-size: 0.8em;">{mínimo 6 dígitos alfanuméricos}</span></label>
            <input type="password" name="senha" class="form-control" id="inputPassword4" style="font-size: 0.9em;">
          </div>
      </div>
		<div class="modal-footer">
		   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
		   <input type="submit" value="Alterar senha" class="btn btn-primary">
		</div>
	</form>
	<?php

}
?>
