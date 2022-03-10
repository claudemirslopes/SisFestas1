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
					 
		 <form class="form-vertical">
			<div class="form-group">
				<input type="hidden" class="form-control" id="id_banner" value="<?php $info['id']; ?>" name="id">
				<div class="col-sm-12" style="margin-top: 13px;">
				
				 
				 <div class="fileinput fileinput-new" data-provides="fileinput">
								  <div class="fileinput-new thumbnail text-center" style="max-width: 100%;">
									  <img class="img-rounded" src="../assets/images/usuario/<?php echo $info['id']; ?>/<?php echo $info['foto']; ?>" style="width:50%; max-height: 188px;border-radius: 50%;"/>
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 250px;"></div>
								  <div>
								  <div class="form-group col-md-12">
                                        <label for="inputEmail4">Foto</label>
                                        <input type="hidden" name="foto_antiga" value="<?php echo $info['foto']; ?>">
                                        <input type="file" class="form-control form-control-sm form-control-file" id="exampleFormControlFile1" name="foto">
                                    </div>
									

									<div class="modal-footer text">
									   <button class="btn btn-secondary fileinput-exists" type="button" data-dismiss="modal">Cancelar</button>
									   <input type="submit" value="Alterar foto" name="SendEditUsuario" class="btn btn-success">
									</div>
								  </div>
					</div>
					<div class="upload-msg"></div>
				
			
			  </div>
			  
			
			  
			 
			  
			  
		 </form>
		</div><?php

}
?>