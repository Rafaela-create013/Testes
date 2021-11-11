<?php
	//recebemos nosso par�metro vindo do form
	$parametro = isset($_POST['pesquisaPaciente']) ? $_POST['pesquisaPaciente'] : null;
	$parametro = isset($_POST['pesquisaPaciente']) ? $_POST['pesquisaPaciente'] : null;
	$msg = "";
	//come�amos a concatenar nossa tabela
	$msg .="<table class='table table-hover'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th>Atendimento</th>";
	$msg .="			<th>Setor</th>";
	$msg .="			<th>Leito</th>";
	$msg .="		</tr>";
	$msg .="	</thead>";
	$msg .="	<tbody>";
				
				//requerimos a classe de conex�o
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
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {
	$msg .="				<tr>";
	$msg .="					<td>".$res['id_paciente']."</td>";
	$msg .="					<td>".$res['nm_setor']."</td>";
	$msg .="					<td>".$res['nm_leito']."</td>";
	$msg .="				<td><button onClick='recarrega(this)' value=".$res['id_paciente']."> Chamar Paciente </button><td>";
	$msg .="				</tr>";
							}
						}
						else{
							$msg = "";
							$msg .="Nenhum resultado foi encontrado...";
						}
	$msg .="	</tbody>";
	$msg .="</table>";
	//retorna a msg concatenada
	echo $msg;
?>
