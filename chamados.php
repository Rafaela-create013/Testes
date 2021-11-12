<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8"/>
	<title>Painel de pacientes</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/styleI.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
        <ul>
            <p>Painel de pacientes</p>
        </ul>
<?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $tela = "";

    require_once('class/Conexao.class.php');
        try{
            $pdo = new Conexao();
            $result = $pdo->select("SELECT * FROM tb_paciente 
                                    WHERE id_paciente = '$id'");
            $pdo->desconectar();
        }
        catch (PDOException $a){
            echo $a->getMessage();
        }
        //concatenando e mostrando
$tela .="<table class='table table-hover'>";
$tela .="	<thead>";
$tela .="		<tr>";
$tela .="			<th>Atendimento</th>";
$tela .="			<th>Paciente</th>";
$tela .="			<th>Idade</th>";
$tela .="		</tr>";
$tela .="	</thead>";
$tela .="	<tbody>";

        if(count($result)){
            foreach($result as $dados){
$tela .="				<tr>";
$tela .="					<td id='tds'>".$dados['id_paciente']."</td>";
$tela .="					<td id='tds'>".$dados['nm_paciente']."</td>";
$tela .="					<td id='tds'>".$dados['idade_paciente']." anos </td>";
$tela .="				</tr>";
            }

        }
        else{
            $tela .="Parece que ocorreu um erro...";
        }
    echo $tela;
?>
<textarea></textarea>



