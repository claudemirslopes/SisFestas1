<?php
sleep(1);
$id = $_POST['id'];
include_once '../config/dbconfig.php';
// $pdo = new PDO("mysql:dbname=sisfestas;host=localhost", "root", "");
$sql = $pdo->query("SELECT * FROM niveis_acessos WHERE id = $id");
if($sql->rowCount() > 0 ){

	$info = $sql->fetch();
	date_default_timezone_set('America/Sao_Paulo');
    $date = date('d-m-Y H:i');

	?>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
        <input type="hidden" name="ordem" value="<?php echo $info['ordem']; ?>">
        <fieldset class="border p-3 fset" style="margin-top: 10px;">
            <legend class="font-small">&nbsp;&nbsp;<i class="fa fa-unlock"></i>&nbsp;&nbsp;Níveis de Acessos</legend>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Nome</label>
                            <input type="text" name="nome_nivel_acesso" class="form-control form-control-sm forp" placeholder="Nome do nível de acesso" value="<?php echo $info['nome_nivel_acesso']; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="modal-footer">
		   <input type="submit" value="Atualizar nível de acesso" class="btn btn-primary btn-sm">
		</div>
    </form>
	<?php

}
?>
