<?php
/*
 * Created on 05/01/2011
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 * Tela de login / autentica��o.
 */
session_start();
session_regenerate_id();

include 'banco.php';
include 'logs.php';
include 'logsCadastro.php';

//$this->link = mysql_connect('', '', '')
//$bancoOO = new mysqli('','','','');
//$bancoOO = new mysqli('', '', '','');
//echo Banco::$endereco_.Banco::$usuario_.Banco::$senha_.Banco::$banco_;

$bancoOO = new mysqli(Banco::$endereco_,Banco::$usuario_,Banco::$senha_,Banco::$banco_);
if(mysqli_connect_errno()>0){
	die('Problemas ao Conectar ao banco.');
}
if(!$bancoOO->set_charset("latin1")){
	Die("Erro ao selecionar codific. do banco.");
}

//$bancoOO = new mysqli('','','','');
include 'usuarios.php';
include 'usuariosCadastro.php';
include 'entidades.php';
include 'entidadesCadastro.php';
 
 
 
if(isset($_POST['initialLogin'])){
	$identificacaoEntidade = buscaEntidadePorCodigo(1);///Isso pq a entrada do Gabinete vai ser �nica. Tenho que desenvolver uma geral.
	//echo var_dump($identificacaoEntidade);
	if($identificacaoEntidade==-1)
		Die('Entidade inv�lida.');
	$usuario = buscaUsuarioPorLogin(($_POST['login']));
	if(is_int($usuario)){
		if($usuario==-1)
			erroLogin('-1');
			die;
	}
 	$senha = $_POST['senha'];
 	if($usuario->verificaSenha($senha)){
 		if($usuario->getativo()){
 			$_SESSION['codigoUsuario'] = $usuario->getcodigo();
 			$_SESSION['fatorIdentificador'] = geraFatorIdentificador($identificacaoEntidade->getcodigo());
 			registraLogin(session_id(),$_SESSION['codigoUsuario']); 
	 		header('Location: inicio.php');
 		}else{
 			erroLogin('-2');
 		}
 	}else{
 		erroLogin('-1');
 	}	
 }
 if(isset($_GET['sessionMsg'])){
	 $err = $_GET['sessionMsg'];
	 if($err=='1'){
		 emailNeto("Nao encontrou entidade.");
	 }
	 if($err=='2'){
		 emailNeto("Sessao nao registrada.");
	 }
 }
 
 function erroLogin($motivo){
 	header('Location: index.php?falhaLogin='.$motivo);
 }
function emailNeto($msg){
	$to       = 'xxxxxxxx@celsoneto.com';
	$subject  = 'Falha na sessao. '.date('d/m/Y').' as '.date('H:i:s');
	$message  = '<html><body>Codigo Usuario: <br>'.$msg;
	$message .= '</body></html>';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$resultado = mail($to, $subject, $message, $headers);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="Content-Language" content="en">
	<meta name="GENERATOR" content="PHPEclipse 1.2.0">
	<title>pContacts - Login</title>
	<link rel ="stylesheet" href="scripts/geral.css">
	<style type="text/css">
		#imgpos {
		position:absolute;
		left:50%;
		top:50%;
		margin-left:-312px;
		margin-top:-200px;
		}
		.topo-dir {
		background: url(img/topo-dir.jpg) 100% 0 no-repeat; 
		width:675px;
		}
		.baixo-esq {
		background: url(img/baixo-esq.jpg) 0 100% no-repeat;
		}
		.baixo-dir {
		background: url(img/baixo-dir.jpg) 100% 100% no-repeat; 
		padding:0 27px 27px 0;
		}
		.texto {
		background:white; 
		border:12px solid #333;
		}
		.texto h3 {
		text-align:center; 
		margin:0.5em 0;
		}
		p {
		margin-bottom:0;
		font: 0.8em Verdana, Arial, Times, serif;
		padding:0 10px 10px; 
		text-align:justify; 
		}
		label, input{
			display: block;
			float: left;
		}
		fieldset{
			border: solid 1px #000;
		}
		br{
			clear: left;
		}

		label {
		margin-bottom:0;
		font: 0.8em Verdana, Arial, Times, serif;
		/*padding:0 10px 10px;*/ 
		padding-right: 20px;
		padding-bottom:10px;
		text-align:right; 
		}
	</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  // _gaq.push(['_setAccount', 'UA-30234882-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
	<div id="imgpos">
		<div class="topo-dir">
 			<div class="baixo-esq">
  				<div class="baixo-dir">
   					<div class="texto">
    					<h3><img src="img/inicio.jpg" alt="pContacs"></h3>
    					<?php
    						if(isset($_GET['falhaLogin'])){
    							if($_GET['falhaLogin']=='-1'){
    								echo '<p> <font color=red>Login e/ou Senha incorretos!</font></p>';
    							}
    							if($_GET['falhaLogin']=='-2'){
    								echo '<p> <font color=red>Conta inativa!</font></p>';
    							}
    						}
    					?>
     					<p>Bem vindo! Digite abaixo seu login e senha:</p>
    					<form name="formLogin" action="index.php" method="post">
    						<fieldset>
    						<label for="usuario">Login:&nbsp;</label>
    						<input type="hidden" name="initialLogin" value="initialLogin">
    						<input type="text" class="text" name="login" size="30" id="usuario"/>
    						<br>
    						<label for="usuario">Senha:</label>
    						<input type="password" class="text" name="senha" size="20" id="senha"/>
    						<input type="submit" class="button" name="vai" value="Entrar" />
    						</fieldset>
						</form>
						<script language='JavaScript' type='text/javascript'>
							document.formLogin.login.focus()
						</script>
   					</div>
  				</div>
 			</div>
		</div>
	</div>
</body>
</html>
