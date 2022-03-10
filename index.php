<?php
session_start();
ob_start();
//Seguranca do Painel Administrativo
$seguranca = true;
include_once("config/seguranca.php");
seguranca();

//Biblioteca auxiliares
include_once("config/config.php");
include_once("config/conexao.php");
include_once("lib/lib_valida.php");
include_once("lib/lib_permissao.php");
?>
<?php include_once('include/header.php'); ?>
    <?php include_once('include/sidebar.php'); ?>

        <!-- Conteúdo principal -->
        <div class="content-wrapper">
            <?php
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING);
            $arquivo_or = (!empty($url)) ? $url : 'home';
            $arquivo = limparurl($arquivo_or);
            $niveis_acesso_id = $_SESSION['niveis_acesso_id'];

            $result_pagina = "SELECT pg.id, 
            nivpg.id id_nivpg, nivpg.permissao 
            FROM paginas pg
            INNER JOIN niveis_acessos_paginas nivpg on nivpg.pagina_id=pg.id
            WHERE pg.endereco='$arquivo' AND nivpg.pagina_id=pg.id AND nivpg.niveis_acesso_id='$niveis_acesso_id' AND nivpg.permissao=1 LIMIT 1";

            $resultado_pagina = mysqli_query($conn, $result_pagina);
            if (($resultado_pagina) AND ( $resultado_pagina->num_rows != 0)) {
                $row_pagina = mysqli_fetch_assoc($resultado_pagina);
                $file = $arquivo . '.php';
                if (file_exists($file)) {
                    include $file;
                } else {
                    include_once("visualizar/home.php");
                }
            } else {
                //$_SESSION['msg']= "<div class='alert alert-danger'>Seu nivel de acesso não permite acessar essa função!</div>";
                include_once("visualizar/home.php");
            }
            ?>
        </div>
        <!-- Fim do conteúdo principal -->
            <!-- Fim de todo o conteúdo -->
              
<?php include_once('include/footer.php'); ?>
