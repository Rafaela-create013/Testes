<?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $tela = "";

    require_once('class/Conexao.class.php');
        try{
            $pdo = new Conexao();
            $result = $pdo->select("SELECT ")
        }
    

?>
