<?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $tela = "";

    require_once('class/Conexao.class.php');
        try{
            $pdo = new Conexao();
            $result = $pdo->select("SELECT * FROM vw_atendimento 
                                    WHERE id_paciente = '$id'");
            $pdo->desconectar();
        }
        catch (PDOException $a){
            echo $a->getMessage();
        }
        //concatenando e mostrando
        if(count($result)){
            foreach($result as $dados){
$tela .="				<tr>";
$tela .="					<td>".$dados['id_paciente']."</td>";
$tela .="					<td>".$dados['nm_paciente']."</td>";
$tela .="					<td>".$dados['nm_setor']."</td>";
$tela .="					<td>".$dados['nm_leito']."</td>";
$tela .="				</tr>";
            }
        }
        else{
            $msg .="Parece que ocorreu um erro...";
        }
    echo $tela;
?>
