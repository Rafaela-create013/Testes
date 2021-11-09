<?php
	//recebemos nosso par�metro vindo do form
	$parametro = isset($_POST['pesquisaPaciente']) ? $_POST['pesquisaPaciente'] : null;
	$msg = "";
	//come�amos a concatenar nossa tabela
	$msg .="<table class='table table-hover'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th>Atendimento</th>";
	$msg .="			<th>Nome</th>";
	$msg .="			<th>Idade</th>";
	$msg .="		</tr>";
	$msg .="	</thead>";
	$msg .="	<tbody>";
				
				//requerimos a classe de conex�o
				require_once('class/Conexao.class.php');
					try {
						$pdo = new Conexao(); 
						$resultado = $pdo->select("SELECT * FROM tb_paciente 
													WHERE id_paciente LIKE '$parametro%' 
													OR nm_paciente LIKE '$parametro%' 
													OR idade_paciente LIKE '$parametro%' 
													ORDER BY nm_paciente ASC");
						$pdo->desconectar();
								
						}catch (PDOException $e){
							echo $e->getMessage();
						}	
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {

	$msg .="				<tr>";
	$msg .="					<td>".$res['id_paciente']."</td>";
	$msg .="					<td>".$res['nm_paciente']."</td>";
	$msg .="					<td>".$res['idade_paciente']."</td>";
	$msg .="				</tr>";
							}	
						}else{
							$msg = "";
							$msg .="Nenhum resultado foi encontrado...";
						}
	$msg .="	</tbody>";
	$msg .="</table>";
	//retorna a msg concatenada
	echo $msg;
?>