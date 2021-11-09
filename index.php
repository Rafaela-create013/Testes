<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8"/>
	<title>Sistema Pesquisa</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<style type="text/css">
        *{
            margin: 0%;
        }
		#pesquisaPaciente{
			width:200px;
		}
        ul {
            list-style-type: none;
            overflow: hidden;
            color: #383838;
            border-bottom: 1px solid #DCDCDC;
            background-color: antiquewhite;
            margin: 0%;
        }
        li {
            float: left;
            display: block;
            overflow: hidden;
        }                
        input{
            min-width: 300px;
        }
	</style>
	<script type="text/javascript" src="js/jquery-3.6.0.js"></script>

	<script type="text/javascript">
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
    
    
    //Aqui uso o evento key up para come�ar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#pesquisaPaciente').keyup(function(){
        
        var valores = $('#form_pesquisa').serialize()//o serialize retorna uma string pronta para ser enviada
        
        //pegando o valor do campo #pesquisaPaciente
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
                <label>Painel de atendimentos</label>
                    <li>
                        <div class="input-prepend">
                            <span class="add-on" ><i class="icon-search"></i></span>
                            <input type="text" name="pesquisaPaciente" id="pesquisaPaciente" value=""  placeholder="Pesquisar cliente..." />
                        </div>
                    <div class="input-group mb-3">
                </ul>
            </li>
		</form>
           
			<div id="contentLoading">
				<div id="loading"></div>
			</div>
            
			<section class="jumbotron">
				<div id="MostraPesq"></div>
			</section>
</body>
</html>