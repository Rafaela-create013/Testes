<?php
	$parametro = isset($_POST['pesquisaPaciente']) ? $_POST['pesquisaPaciente'] : null;
	$msg = "";

	$msg .="<table class='table table-hover'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th>Atendimento</th>";
	$msg .="			<th>Setor</th>";
	$msg .="			<th>Leito</th>";
	$msg .="		</tr>";
	$msg .="	</thead>";
	$msg .="	<tbody>";
				
				
				require_once('class/Conexao.class.php');
					try {
						$pdo = new Conexao(); 
						$resultado = $pdo->select("SELECT * FROM tb_setor 
													WHERE id_paciente LIKE '$parametro%' 
													OR nm_leito LIKE '$parametro%' 
													OR nm_setor LIKE '$parametro%' 
													ORDER BY nm_leito ASC");
						$pdo->desconectar();
								
						}catch (PDOException $e){
							echo $e->getMessage();
						}	
						if(count($resultado)){
							foreach ($resultado as $res) {
	$msg .="				<tr>";
	$msg .="					<td>".$res['id_paciente']."</td>";
	$msg .="					<td>".$res['nm_setor']."</td>";
	$msg .="					<td>".$res['nm_leito']."</td>";
	$msg .="				<td><button>Chamar paciente</button><td>";
	$msg .="				</tr>";
							
							}
						}
						else{
							$msg = "";
							$msg .="Nenhum resultado foi encontrado...";
						}
	$msg .="	</tbody>";
	$msg .="</table>";
	echo $msg;
?>
