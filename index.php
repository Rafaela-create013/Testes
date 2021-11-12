<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8"/>
	<title>Painel de chamada</title>
	<script type="text/javascript" src="js/jquery-3.6.0.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="https://kit.fontawesome.com/b5987e7317.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<script type="text/javascript">
        //funcao que marca o id do botao selecionado e envia para a 
        //outra URL
       function reload(e) {      
            console.log(e.value);
            window.open(`chamou.php?id=${e.value}`);
        }
	$(document).ready(function(){

    //Aqui a ativa a imagem de load
    function loading_show(){
		$('#loading').html("<img src='img/loading.gif'/>").fadeIn('fast');
    }
    
    //Aqui desativa a imagem de loading
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }       
    
    
    // aqui a fun��o ajax que busca os dados em outra pagina do tipo html, n�o � json
    function load_dados(valores, page, div)
    {
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){//Chama o loading antes do carregamento
		              loading_show();
				},
                data: valores,
                success: function(msg)
                {
                    loading_hide();
                    var data = msg;
			        $(div).html(data).fadeIn();				
                }
            });
    }
    
    //Aqui eu chamo o metodo de load pela primeira vez sem parametros para pode exibir todos
    load_dados(null, 'pesquisa.php', '#MostraPesq');
    
    
    //Aqui uso o evento key up para pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#pesquisaPaciente').keyup(function(){
        
        var valores = $('#form_pesquisa').serialize()//o serialize retorna uma string pronta
        
        //pegando os valores do input "pesquisaPaciente"
        var $parametro = $(this).val();
        
        if($parametro.length >= 1)
        {
            load_dados(valores, 'pesquisa.php', '#MostraPesq');
        }else
        {
            load_dados(null, 'pesquisa.php', '#MostraPesq');
        }
    });

	});
	</script>	
</head>
<body>
		<form name="form_pesquisa" id="form_pesquisa" method="post" action="">
            <ul>
            <p>Painel de atendimentos</p>
                    <li>
                        <div class="input-prepend">
                            <span class="add-on" ><i class="icon-search"></i></span>
                            <input type="text" name="pesquisaPaciente" id="pesquisaPaciente" value=""  placeholder="Pesquisar cliente..." />    
                        </div>
                    <div class="input-group mb-3">
                </li>
            </ul>
            
		</form>
           
			<div id="contentLoading">
				<div id="loading"></div>
			</div>
            
			<section class="jumbotron">
				<div id="MostraPesq"></div>
			</section>
</body>
</html>
