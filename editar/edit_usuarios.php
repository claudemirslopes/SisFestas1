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
  <style type="text/css">
    #container {
      display: inline-block;
      position: relative;
    }

    #container figcaption {
      position: absolute;
      top: 110px;
      right: 40px;
      font-size: .8em;
      color: #F2F2F2;
      font-weight: bolder;
      text-shadow: 0px 0px 5px black;
    }
  </style>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-4" style="border-right: 1px solid #e3e6f0;">
        <div class="text-center">
           <a href="javascript:;" onclick="editarFoto2('<?php echo $info['id']; ?>')">
            <figure id="container">
              <img class="rounded-circle" src="../assets/images/usuario/<?php echo $info['id']; ?>/<?php echo $info['foto']; ?>" alt="Generic placeholder image" width="140" height="140"></a>
              <figcaption>trocar foto</figcaption>
            </figure>
        </div>
        <h5 class="text-center" style="padding-top: 15px;"><?php echo $info['nome']; ?></h5>
        <p class="text-center"><b>E-mail:</b> <?php echo $info['email']; ?> </p>
        <p class="text-center"><a class="btn btn-danger" href="javascript:;" onclick="editarSenha2('<?php echo $info['id']; ?>')" title="Alterar senha" role="button">Alterar senha &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-8">
        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $info['id']; ?>" class="form-control">
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="inputEmail4">Nome</label>
              <input type="text" name="nome" value="<?php echo $info['nome']; ?>" class="form-control" id="inputEmail4" style="border: none; border-bottom: 1px dotted #bbb;">
            </div>
            <div class="form-group col-md-4">
              <label for="inputPassword4">E-mail</label>
              <input type="email" name="email" value="<?php echo $info['email']; ?>" class="form-control" id="inputPassword4" style="border: none; border-bottom: 1px dotted #bbb;">
            </div>
            <div class="form-group col-md-5">
              <label for="inputPassword4">Usuário</label>
              <input type="text" name="usuario" value="<?php echo $info['usuario']; ?>" class="form-control" id="inputPassword4" style="border: none; border-bottom: 1px dotted #bbb;">
            </div>
            <?php
            $sql = $pdo->query("SELECT * FROM niveis_acessos ORDER BY nome_nivel_acesso ASC");
            $niveis = $sql->fetchAll();
            ?>
            <div class="form-group col-md-4">
                <label for="inputEmail4">Nível de Acesso</label>
                <select class="form-control" name="niveis_acesso_id" id="inputEmail4" style="border: none; border-bottom: 1px dotted #bbb;">
                    <option value="">Selecione</option>
                    <?php foreach($niveis as $nivel): ?>
                        <option value="<?php echo $nivel['id']; ?>" <?php echo ($nivel['id'] == $info['niveis_acesso_id'] ? 'selected' : ''); ?>><?php echo $nivel['nome_nivel_acesso'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php
            $sql = $pdo->query("SELECT * FROM situacoes_usuarios ORDER BY nome_situacao ASC");
            $situacoes = $sql->fetchAll();
            ?>
            <div class="form-group col-md-3">
                <label for="inputEmail4">Situação</label>
                <select class="form-control" name="situacoes_usuario_id" id="inputEmail4" style="border: none; border-bottom: 1px dotted #bbb;">
                    <option value="">Selecione</option>
                    <?php foreach($situacoes as $situacao): ?>
                        <option value="<?php echo $situacao['id']; ?>" <?php echo ($situacao['id'] == $info['situacoes_usuario_id'] ? 'selected' : ''); ?>><?php echo $situacao['nome_situacao'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputEmail4">Observação</label>
              <textarea name="obs" class="form-control" id="inputPassword4" style="border: none; border-bottom: 1px dotted #bbb;" rows="4"><?php echo $info['obs']; ?></textarea>
            </div>
          </div>
          <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
             <input type="submit" value="Atualizar perfil" class="btn btn-warning">
          </div>
        </form>
      </div><!-- /.col-lg-4 -->
    </div>
  </div>
	<?php

}
?>
