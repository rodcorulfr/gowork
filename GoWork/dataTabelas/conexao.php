<?php

$conexao2 = mysqli_connect('localhost', 'root', '', 'tcc');
mysqli_set_charset($conexao2,"utf8");
if(!$conexao2){
    echo mysqli_error($conexao2);
    die();
}
?>
