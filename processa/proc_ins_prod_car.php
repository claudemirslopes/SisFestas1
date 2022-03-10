<?php
if(!isset($seguranca)){exit;}
//Recuperar o ID
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
//Se vem o id acessa o IF
if($id){
    //Recupera o id do produto
    $prod = filter_input(INPUT_GET, 'prod', FILTER_SANITIZE_NUMBER_INT);
    if($prod){
        //Verificar se o produto existe no BD
        $result_prod = "SELECT id, nome prod_nome, valor_venda FROM produtos WHERE id='$prod' LIMIT 1";
        $resultado_prod = mysqli_query($conn, $result_prod);
        //Verificar se encontrou algum algum produto no BD
        if(($resultado_prod) AND ($resultado_prod->num_rows != 0)){
            $row_prod = mysqli_fetch_assoc($resultado_prod);
            //echo "Nome: ". $row_prod['prod_nome'];
            //Verificar se o produto não está cadastrsdo no carrinho
            $result_car_prod = "SELECT carprod.id,
                    prod.nome nome_prod
                    FROM carrinhos_produtos carprod
                    INNER JOIN carrinhos car ON car.id=carprod.carrinho_id
                    INNER JOIN produtos prod ON prod.id=carprod.produto_id
                    WHERE car.usuario_id='$id' AND carprod.produto_id='$prod'
                    LIMIT 1";
            $resultado_car_prod = mysqli_query($conn, $result_car_prod);
            $row_car_prod = mysqli_fetch_assoc($resultado_car_prod);
            //var_dump($row_car_prod);
            
            if(($resultado_car_prod) AND ($resultado_car_prod->num_rows != 0)){
                $_SESSION['msg'] = "<div class='alert alert-danger'>O Produto Já está no carrinho: ".$row_prod['prod_nome']."</div>";
                $url_destino = pg . "/cadastrar/cad_car?id=".$id;
                header("Location: $url_destino");
            }else{
                //Pesquisar o carrinho do usuario
                $result_car = "SELECT id FROM carrinhos WHERE usuario_id='$id' LIMIT 1";
                $resultado_car = mysqli_query($conn, $result_car);
                $row_car = mysqli_fetch_assoc($resultado_car);
                
                //Inserir o produto no carrinho do usuário
                $result_ins_prod_car = "INSERT INTO carrinhos_produtos
                        (valor_cotacao, valor_venda, qnt_produto, produto_id, carrinho_id, created) VALUES
                        (
                        '".$row_prod['valor_venda']."',
                        '".$row_prod['valor_venda']."',
                        '1',
                        '$prod',
                        '".$row_car['id']."',
                        NOW()
                        )";
                $resultado_ins_prod_car = mysqli_query($conn, $result_ins_prod_car);
                if(mysqli_insert_id($conn)){
                    $_SESSION['msg'] = "<div class='alert alert-success'>O Produto colocado no carrinho com sucesso: ".$row_prod['prod_nome']."</div>";
                    $url_destino = pg . "/cadastrar/cad_car?id=".$id;
                    header("Location: $url_destino");
                }else{
                    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao colocar o produto no carrinho: ".$row_prod['prod_nome']."</div>";
                    $url_destino = pg . "/cadastrar/cad_car?id=".$id;
                    header("Location: $url_destino");
                }
            }
        }
    }else{
        $_SESSION['msg'] = "<div class='alert alert-danger'>Produto Inválido!</div>";
        $url_destino = pg . "/cadastrar/cad_car?id=".$id;
        header("Location: $url_destino");
    }
}else{
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao carregar o usuário!</div>";
    $url_destino = pg . "/listar/list_usuarios";
    header("Location: $url_destino");
}