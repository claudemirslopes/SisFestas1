<?php

if (!isset($seguranca)) {
    exit;
}

function limparurl($conteudo) {
    $formato_a = '"!@#$%*()-+{[}];:,\\\'<>°ºª';
    $formato_b = '_____________________________';
    $conteudo_ct = strtr($conteudo, $formato_a, $formato_b);

    $conteudo_br = str_ireplace(" ", "", $conteudo_ct);

    $conteudo_st = strip_tags($conteudo_br);

    $conteudo_lp = trim($conteudo_st);
    //1' OR '1=1
    //1OR11
    return $conteudo_lp;
}

function limparSenha($conteudo) {
    $formato_a = '"#&*()-+={[}]/?;:,\\\'<>°ºª';
    $formato_b = '                          ';
    $conteudo_ct = strtr($conteudo, $formato_a, $formato_b);

    $conteudo_br = str_ireplace(" ", "", $conteudo_ct);

    $conteudo_st = strip_tags($conteudo_br);

    $conteudo_lp = trim($conteudo_st);
    //1' OR '1=1
    //1OR11
    return $conteudo_lp;
}

function vazio($dados) {
    $dados_st = array_map('strip_tags', $dados);
    $dados_tr = array_map('trim', $dados_st);
    if (in_array('', $dados_tr)) {
        return false;
    } else {
        return $dados_tr;
    }
}

function validarEmail($email) {
    $condicao = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';
    if (preg_match($condicao, $email)) {
        return true;
    } else {
        return false;
    }
}

//validar exetensão da imagem
function validarExtesao($foto){
    switch ($foto):
        case 'image/png';
        case 'image/x-png';
            return true;
            break;
        case 'image/jpeg';
        case 'image/pjpeg';
            return true;
            break; 
        default:
            return false;
    endswitch;
}

//Retirar caracter especial
function caracterEspecial($nome_imagem){
    //Substituir os caracteres especiais
    $original = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
    $substituir = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';
    
    $nome_imagem_es = strtr(utf8_decode($nome_imagem), utf8_decode($original), $substituir);
     
    //Substituir o espaco em branco pelo traco
    $nome_imagem_br = str_replace(' ', '-', $nome_imagem_es);
    
    $nome_imagem_tr = str_replace(array('----','---','--'), '-', $nome_imagem_br);
    
    //Converter para minusculo
    $nome_imagem_mi = strtolower($nome_imagem_tr);
    
    return $nome_imagem_mi;
}

//Upload de foto
function upload($foto, $destino, $largura, $altura){
    mkdir($destino, 0755);
    switch ($foto['type']){
        case 'image/png';
        case 'image/x-png';
            $imagem_temporaria = imagecreatefrompng($foto['tmp_name']);
            
            $imagem_redimensionada = redimensionarImagem($imagem_temporaria, $largura, $altura);
            
            imagepng($imagem_redimensionada, $destino . $foto['name']);
            break;
        case 'image/jpeg';
        case 'image/pjpeg';
            $imagem_temporaria = imagecreatefromjpeg($foto['tmp_name']);
            
            $imagem_redimensionada = redimensionarImagem($imagem_temporaria, $largura, $altura);
            
            imagejpeg($imagem_redimensionada, $destino . $foto['name']);
            break; 
    }
}

//Redimensionar imagem
function redimensionarImagem($imagem_temporaria, $largura, $altura){
    $largura_original = imagesx($imagem_temporaria);    
    $altura_original = imagesy($imagem_temporaria);
    
    $nova_largura = $largura ? $largura : floor(($largura_original / $altura_original) * $altura);
    
    $nova_altura = $altura ? $altura : floor(($altura_original / $largura_original) * $largura);
    
    $imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);

    imagealphablending($imagem_redimensionada, false);
    imagesavealpha($imagem_redimensionada, true);
    
    $transparent = imagecolorallocatealpha($imagem_redimensionada, 255, 255, 255, 127);
    imagefilledrectangle($imagem_redimensionada, 0, 0, $largura_original, $altura_original, $transparent);
    
    imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
    
    return $imagem_redimensionada;
    
}

//Apagar foto
function apagarFoto($foto){
    if(file_exists($foto)){
        unlink($foto);
    }
}

// Função para validar CPF
function validaCPF($cpf_v) { 
    // Extrai somente os números
    $cpf_v = preg_replace( '/[^0-9]/is', '', $cpf_v );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf_v) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf_v)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf_v[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf_v[$c] != $d) {
            return false;
        }
    }
    return true;
}

// Função para gerar Código de Barras 
function geraCodigoBarra($numero){
    $fino = 1;
    $largo = 3;
    $altura = 50;
    
    $barcodes[0] = '00110';
    $barcodes[1] = '10001';
    $barcodes[2] = '01001';
    $barcodes[3] = '11000';
    $barcodes[4] = '00101';
    $barcodes[5] = '10100';
    $barcodes[6] = '01100';
    $barcodes[7] = '00011';
    $barcodes[8] = '10010';
    $barcodes[9] = '01010';
    
    for($f1 = 9; $f1 >= 0; $f1--){
        for($f2 = 9; $f2 >= 0; $f2--){
            $f = ($f1*10)+$f2;
            $texto = '';
            for($i = 1; $i < 6; $i++){
                $texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
            }
            $barcodes[$f] = $texto;
        }
    }
    
    echo '<img src="../assets/images/produto/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
    echo '<img src="../assets/images/produto/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
    echo '<img src="../assets/images/produto/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
    echo '<img src="../assets/images/produto/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
    
    echo '<img ';
    
    $texto = $numero;
    
    if((strlen($texto) % 2) <> 0){
        $texto = '0'.$texto;
    }
    
    while(strlen($texto) > 0){
        $i = round(substr($texto, 0, 2));
        $texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));
        
        if(isset($barcodes[$i])){
            $f = $barcodes[$i];
        }
        
        for($i = 1; $i < 11; $i+=2){
            if(substr($f, ($i-1), 1) == '0'){
                  $f1 = $fino ;
              }else{
                  $f1 = $largo ;
              }
              
              echo 'src="../assets/images/produto/p.gif" width="'.$f1.'" height="'.$altura.'" border="0">';
              echo '<img ';
              
              if(substr($f, $i, 1) == '0'){
                $f2 = $fino ;
            }else{
                $f2 = $largo ;
            }
            
            echo 'src="../assets/images/produto/b.gif" width="'.$f2.'" height="'.$altura.'" border="0">';
            echo '<img ';
        }
    }
    echo 'src="../assets/images/produto/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />';
    echo '<img src="../assets/images/produto/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
    echo '<img src="../assets/images/produto/p.gif" width="1" height="'.$altura.'" border="0" />';
}
