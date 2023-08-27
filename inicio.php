<?php
/*
 * Created on 08/01/2011
 *
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 * Tela principal do programa.
 */
session_start();

include_once 'usuarios.php';
include_once 'usuariosCadastro.php';
include_once 'contatos.php';
include_once 'contatosCadastro.php';
include 'logs.php';
include 'logsCadastro.php';
include 'telefonemas.php';
include 'telefonemasCadastro.php';
include 'telefones.php';
include 'telefonesCadastro.php';
include 'entidades.php';
include 'entidadesCadastro.php';
include 'perfil.php';
include 'perfilCadastro.php';
include 'banco.php';
include 'util.php';
include 'flexigrid.php';
include 'backup.php';
//Aki ficar� a valida��o das requisi��es e chamada para outros php's'.

$bancoOO = new mysqli(Banco::$endereco_,Banco::$usuario_,Banco::$senha_,Banco::$banco_);
if(mysqli_connect_errno()>0){
	die('Problemas ao Conectar ao banco.');
}
if(!$bancoOO->set_charset("utf8")){
	Die("Erro ao selecionar codific. do banco.");
}

if(isset($_SESSION['fatorIdentificador'])){
	$identificacaoEntidade = buscaEntidadePorFatorIdentificador($_SESSION['fatorIdentificador']);///Voltar.
	if(is_int($identificacaoEntidade) && $identificacaoEntidade==-1){ ///Voltar.
		emailNeto();
		header("Location: index.php");
	}
}else{
	header("Location: index.php");
	emailNeto();
}
	


//Chamadas Em ajax!
if(isset($_GET['altSenha'])){
	echo mudaSenha($_GET['usuSenha'],$_GET['oldSenha'],$_GET['newSenha']);
	die();
}
if(isset($_GET['altPerfil'])){
	$perfil = $_GET['perf'];
	echo mudaPerfil($_GET['usu'],$perfil);
	die();
}
if(isset($_GET['geraBkp'])){
	rotinaBackUp(true);
	die();
}
if(isset($_GET['apagaBkp'])){
	apagaBkp($_GET['apagaBkp']);
	die();
}
if(isset($_GET['ajaxRequest'])){
	//Chamadas relacionadas a usuarios.
	if(isset($_GET['tela']) && $_GET['tela']=='usuarios'){
		if(isset($_GET['action']) && $_GET['action']=='incluir'){
			echo telaUsuarios(0);
		}
		if(isset($_GET['action']) && $_GET['action']=='alterar'){
			echo telaUsuarios(strval($_GET['elemento']));
		}
		if(isset($_GET['action']) && $_GET['action']=='alteraSenha'){
			echo formMudaSenha("document.tmp.retorno.value");
		}
		if(isset($_GET['action']) && $_GET['action']=='inativar'){
			echo ativaInativaUsuario(strval($_GET['elemento']));
		}
	//FIM - Chamadas relacionadas a usuarios.
	}
	//Chamadas relacionadas a telefonemas.
	if(isset($_GET['tela']) && $_GET['tela']=='telefonemas'){
		if(isset($_GET['action']) && $_GET['action']=='incluir'){
			echo telaTelefonemas(0);
		}
		if(isset($_GET['action']) && $_GET['action']=='alterar'){
			echo telaTelefonemas(strval($_GET['elemento']));
		}
		if(isset($_GET['action']) && $_GET['action']=='excluir'){
			$ret = excluiTelefonema(strval($_GET['elemento']));
			if($ret==-1){
				echo htmlentities("Telefonema n�o encontrado.");
			}else{
				echo htmlentities("Telefonema exclu�do com sucesso!");
			}
		}
	//FIM - Chamadas relacionadas a usuarios.
	}
	//Chamadas relacionadas a contatos.
	//echo var_dump($_GET);
	if(isset($_GET['tela']) && $_GET['tela']=='contatos'){
		if(isset($_GET['action']) && $_GET['action']=='incluir'){
			echo dadosContatos(0);
		}
		if(isset($_GET['action']) && $_GET['action']=='alterar'){
			echo telaContatos(strval($_GET['elemento']));
		}
		if(isset($_GET['action']) && $_GET['action']=='alterar2'){
			echo dadosContatos(strval($_GET['elemento']));
		}
		if(isset($_GET['action']) && $_GET['action']=='alterar3'){
			echo dadosTelefones(strval($_GET['elemento']),strval($_GET['contato']));
		}
		if(isset($_GET['action']) && $_GET['action']=='excluir'){
			$ret = excluiContato(strval($_GET['elemento']));
			if($ret==-1){
				echo htmlentities("Contato n�o encontrado.");
			}else{
				echo htmlentities("Contato exclu�do com sucesso!");
			}
		}
	//FIM - Chamadas relacionadas a contatos.
	}
	if(isset($_GET['tela']) && $_GET['tela']=='telefones'){
		if(isset($_GET['action']) && $_GET['action']=='excluir'){
			$ret = excluiTelefone(strval($_GET['elemento']));
			if($ret==-1){
				echo htmlentities("Telefone n�o encontrado.");
			}else{
				echo telaContatos($_GET['contato']);
			}
		}
	}
	die();
}
//Fim - Chamadas Em ajax!
if(isset($_GET['exportaTxt'])){
	exportaTxtContatos();
}


//Chamadas diversas usando post.
if(isset($_POST['rotina'])){
	if($_POST['rotina']=='usuarios'){ //Se for a rotina de usuarios.
		if(isset($_POST['acao']) && $_POST['acao']=='incluir'){ //Se for rotina de usuarios, e for para incluir....
			$novo = new usuarios(	'0',
									$bancoOO->escape_string($_POST['login']),
									$bancoOO->escape_string($_POST['nome']),
									$bancoOO->escape_string($_POST['senha']),
									date('Ymd'),
									date('His'),
									'true');
			$resultado = incluiUsuario($novo);
		}
		if(isset($_POST['acao']) && $_POST['acao']=='alterar'){ //Se for rotina de usuarios, e for para incluir....
			$novo = new usuarios(	$_POST['codigo'],
									$_POST['login'],
									$_POST['nome'],
									$_POST['senha'],
									date('Ymd'),
									date('His'),
									'true');
			$resultado = alteraUsuario($novo);
		}
		header('Location: inicio.php?goTo=usuarios');
	}
	if($_POST['rotina']=='telefones'){ //Se for a rotina de telefones.
		if(isset($_POST['acao']) && $_POST['acao']=='incluir'){ //Se for rotina de usuarios, e for para incluir....
			$novo = new telefones(	'0',
									$_POST['contato'],
									$_POST['numero'],
									$_POST['descricao'],
									false);
			$resultado = incluiTelefone($novo);
		}
		if(isset($_POST['acao']) && $_POST['acao']=='alterar'){ //Se for rotina de usuarios, e for para incluir....
			$novo = new telefones(	$_POST['codigo'],
									$_POST['contato'],
									$_POST['numero'],
									$_POST['descricao'],
									($_POST['special_rec']?true:false));
			$resultado = alteraTelefone($novo);
		}
		//header('Location: inicio.php?goTo=contatos&elemento='.$_POST['codigo']);
		if($novo->getcodigo()>0)
			echo telaContatos($novo->getcontato());
		Die();
	}
	if($_POST['rotina']=='telefonemas'){ //Se for a rotina de telefonemas.
		//echo var_dump($_POST);
		if(isset($_POST['acao']) && $_POST['acao']=='incluir'){ //Se for rotina de telefonemas, e for para incluir....
			$novo = new telefonemas('0',
									$_POST['data'],
									$_POST['hora'],
									$_POST['contato_codigo'],
									$_POST['contato_nome'],
									$_POST['telefone1'],
									$_POST['telefone2'],
									$_POST['assunto'],
									$_POST['providencias'],
									$_POST['origem'],
									$_POST['estado'],
									true);
			$resultado = incluiTelefonema($novo);
		}
		if(isset($_POST['acao']) && $_POST['acao']=='alterar'){ //Se for rotina de usuarios, e for para incluir....
			$novo = new telefonemas($_POST['codigo'],
									$_POST['data'],
									$_POST['hora'],
									$_POST['contato_codigo'],
									$_POST['contato_nome'],
									$_POST['telefone1'],
									$_POST['telefone2'],
									$_POST['assunto'],
									$_POST['providencias'],
									$_POST['origem'],
									$_POST['estado'],
									(isset($_POST['situacao'])?true:false));
			$resultado = alteraTelefonema($novo);
		}
		header('Location: inicio.php?goTo=telefonemas');
	}
	if($_POST['rotina']=='contatos'){ //Se for a rotina de usuarios.
		if(isset($_POST['acao']) && $_POST['acao']=='incluir'){ //Se for rotina de usuarios, e for para incluir....
			$novo = new contatos(	0,
									$_POST['nome'],
									$_POST['aniversario'],
									$_POST['tratamento'],
									$_POST['titulo'],
									$_POST['cargo'],
									$_POST['entidade'],
									$_POST['endereco'],
									$_POST['cidade'],
									$_POST['cep'],
									$_POST['estado'],
									$_POST['pais'],
									$_POST['email'],
									$_POST['obs'],
									$_POST['conjugue'],
									$_POST['conjugue_tratamento'],
									$_POST['endereco_residencial'],
									$_POST['cidade_residencial'],
									$_POST['cep_residencial'],
									$_POST['estado_residencial'],
									$_POST['pais_residencial'],
									$_POST['classificacao'],
									$_POST['referencia'],
									date('Ymd'),
									$_SESSION['codigoUsuario'], //usuario n�o precisa... s� na inclus�o
									date('His'),
									$_POST['telefone'],
									$_POST['celular'],
									$_POST['tratamento2'],
									$_POST['cargo2'],
									$_POST['conjugue_tratamento2'],
									$_POST['conjugue_tratamento3']);
			$resultado = incluiContato($novo);
		}
		if(isset($_POST['acao']) && $_POST['acao']=='alterar'){ //Se for rotina de usuarios, e for para incluir....
			$novo = new contatos(	$_POST['codigo'],
									$_POST['nome'],
									$_POST['aniversario'],
									$_POST['tratamento'],
									$_POST['titulo'],
									$_POST['cargo'],
									$_POST['entidade'],
									$_POST['endereco'],
									$_POST['cidade'],
									$_POST['cep'],
									$_POST['estado'],
									$_POST['pais'],
									$_POST['email'],
									$_POST['obs'],
									$_POST['conjugue'],
									$_POST['conjugue_tratamento'],
									$_POST['endereco_residencial'],
									$_POST['cidade_residencial'],
									$_POST['cep_residencial'],
									$_POST['estado_residencial'],
									$_POST['pais_residencial'],
									$_POST['classificacao'],
									$_POST['referencia'],
									date('Ymd'),
									0, //usuario n�o precisa... s� na inclus�o
									date('His'),
									'',//telefone e celular s�o em suas rotinas.
									'',//telefone e celular s�o em suas rotinas.
									$_POST['tratamento2'],
									$_POST['cargo2'],
									$_POST['conjugue_tratamento2'],
									$_POST['conjugue_tratamento3']);
									//echo var_dump($novo);
									//die;
			$resultado = alteraContato($novo);
		}
		//header('Location: inicio.php?goTo=contatos');
		if($novo->getcodigo()>0)
			echo telaContatos($novo->getcodigo());
		Die();
	}
	if($_POST['rotina']=='email'){ //Se for a rotina de email.
		$to       = 'xxxx@celsoneto.com';
		$subject  = 'Mensagem pContacts '.date('d/m/Y').' as '.date('H:i:s');
		$message  = '<html><body>Codigo Usuario: '.$_SESSION['codigoUsuario'].'<br>';
		$message .= 'Nome: '.$_POST['nome'].'<br>';
		$message .= 'E-mail: '.$_POST['email'].'<br>';
		$message .= 'Mensagem: '.$_POST['mensagem'].'</body></html>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$resultado = mail($to, $subject, $message, $headers);
		header('Location: inicio.php?goTo=email&status='.($resultado?1:0));
	}
}

//FIM - Chamadas diversas usando post.

//Carregamento completo...
$usuario = buscaUsuarioPorCodigo($_SESSION['codigoUsuario']);
$showWhat = 'inicio';
if(isset($_GET['goTo'])){
	$sOpc = $_GET['goTo'];
	switch($sOpc){
		case "usuarios":
			$showWhat = 'usuarios';
			$showWhatId = 4;
			break;
		case "contatos":
			$showWhat = 'contatos';
			$showWhatId = 2;
			break;
		case "telefonemas":
			$showWhat = 'telefonemas';
			$showWhatId = 3;
			break;
		case "email":
			$showWhat = 'email';
			break;
		case "logs":
			$showWhat = 'logs';
			$showWhatId = 7;
			break;
		case "backup":
			$showWhat = 'backup';
			$showWhatId = 8;
			break;
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="pt-br" />
	<meta name="GENERATOR" content="PHPEclipse 1.2.0" />
	<title>pContacts - Palmeira Softwares - Bem vindo(a) <?php echo $usuario->getlogin()?></title>
	<link rel="stylesheet" type="text/css" href="scripts/geral.css">
	<link rel="stylesheet" type="text/css" href="scripts/inicio.css?v=02">
	<link rel="stylesheet" type="text/css" href="scripts/flexigridNeto01.css" />
	<script type="text/javascript" src="scripts/jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="scripts/flexigridNeto02.js?v=01"></script>
	<script type="text/javascript" src="scripts/util.js?v=02"></script>
 	<script type="text/javascript" src="scripts/jquery.maskedinput-1.2.2.min.js"></script>
	<style>/* O z-index do div#mask deve ser menor que do div#boxes e do div.window */
	</style>
	<script language='JavaScript' type='text/javascript'>
	</script>
</head>
<body>
<form name="tmp">
	<input type="hidden" name="tela" value=<?php echo '"'.$showWhat.'"'?>>
	<input type="hidden" name="retorno" value="corpotab3">
</form>	
<div class=tabela1>
		<div class=cabtab1>
			<img class="valign" src="img/simbTopo.png"><font face="Verdana, Arial">Bem vindo(a) <?php echo $usuario->getnome()?></font>
		</div>
		<div class=corpotab1>
			<br/>
			<div id="menu">
				<?php
					//$neto = new Perfil(0, "wjiewj", "ijioj","iwjij",Array());
					//$netoVetor[] = $neto;
					//echo var_dump($netoVetor).'<br>';
					//$neto->setExibicao("heheheheheh");
					//echo var_dump($netoVetor);
					$menu = new PerfilCadastro();
					//echo print_r($usuario->getModulos());
					echo $menu->toStringMenu($usuario->getModulos());
				
				/*Menu velho.
				<ul>
					<li><a href="inicio.php">Inicio</a></li>
					<li><a href="inicio.php?goTo=contatos">Contatos</a></li>
					<li><a href="inicio.php?goTo=telefonemas">Telefonemas</a></li>
					<li><a href="inicio.php?goTo=usuarios">Usu&aacute;rios</a></li>
					<li><a href="inicio.php?goTo=email">D&uacute;vidas e Sugest&otilde;es</a></li>
					<li><a href="#" onclick="Sair()">Sair</a></li>
				</ul>*/
				?>
			</div>
		</div>
	<div class="corpotab2">
		<?php
			$modulos = $usuario->getModulos();
			switch ($showWhat){
				case 'usuarios':
					if(isset($modulos[$showWhatId])){
						echo cadastroUsuarios();
					}else{
						echo bemVindo();
					}
				break;
				case 'inicio':
					?><input type="hidden" name="codigo" id="codigo" value="<?php echo $usuario->getcodigo() ?>"><?php
					echo bemVindo();
				break;
				case 'contatos':
					if(isset($modulos[$showWhatId])){
						if(isset($_GET['aniversariante'])){
							echo cadastroContatosAniversario(1);
						}else{
							echo cadastroContatos(null,null);
							//echo '<div id="optionsBar"><a href="inicio.php?exportaTxt=true"><img src="img/table.jpg"></a></div>';
						}
					}else{
						echo bemVindo();
					}
				break;
				case 'telefonemas':
					if(isset($modulos[$showWhatId])){
						echo cadastroTelefonemas();
					}else{
						echo bemVindo();
					}
				break;
				case 'logs':
					if(isset($modulos[$showWhatId])){
						echo cadastroLogs();
					}else{
						echo bemVindo();
					}
				break;
				case 'backup':
					if(isset($modulos[$showWhatId])){
						rotinaBackUp(false);
					}else{
						echo bemVindo();
					}
				break;
				case 'email':
					echo emailNetim();
				break;
			}
		?>
	</div>
	<div id="corpotab3">
		<?php
			if(isset($_GET['aniversariante'])){
				echo dadosContatos($_GET['aniversariante']);
			}
		?>
	</div> 
	<script language='JavaScript' type='text/javascript'>
		window.status='pContacts - Palmeira Softwares - xxxxx@celsoneto.com';
	</script>
	<script language='JavaScript' type='text/javascript'>
		function Sair(){
			if(confirm('Tem certeza que deseja sair?')){
				document.location = 'index.php';
				//colocar pra sair.
			}
		}
	</script>
	<?php
	?>
</body>
</html>
<?php
	function bemVindo(){
		$sRetorno = '<div id="meio1">';
		$sRetorno .= '<p style="font-size:18px;">'.htmlentities('Bem vindo!').'</p>';
		$sRetorno .= '<p>'.htmlentities('Hoje s�o ').date('d/m/Y').'.</p>';
		$sRetorno .= '<p>'.htmlentities('Selecione uma op��o no menu acima, ou:').'</p>';
		$sRetorno .= '<ul><li><a href="#" onclick="alteraSenhaInicio()">'.htmlentities('Alterar Senha.').'</a></li></ul>';
		$sRetorno .= '<br><br><br><br><br><br><br><br><br><br>';
		//$sRetorno .= '<p>'.htmlentities('No nosso banco de dados temos ').getRecs().'registros. </p>';
		$sRetorno .= '</div>';
		$sRetorno .= '<div id="meio2">';
		$sRetorno .= cadastroContatosAniversario(0);
		$sRetorno .= '</div>';
		return $sRetorno;
	}
	function emailNetim(){
		$sRetorno = '<div id="telinhaFodona">';
		$sRetorno .= '<br>';
		$sRetorno .= '<fieldset>';
		if(isset($_GET['status'])){
			if($_GET['status']==1){
				$sRetorno .= '<p style="font-size: 13px;">'.htmlentities('E-mail enviado com sucesso! Obrigado!').'</p>';
			}else{
				$sRetorno .= '<p style="font-size: 13px;">'.htmlentities('Falha no envio! Tente novamente mais tarde!').'</p>';
			}
			return $sRetorno;
		}
		$sRetorno .= '<p style="font-size: 13px;">'.htmlentities('Digite nos campos abaixo sua mensagem e e-mail, o mais breve poss�vel seu e-mail ser� respondido:').'</p>';
		$sRetorno .= '<form name="dados" action="inicio.php" method="post">';
		//$sRetorno .= '<label for="codigo">'.htmlentities('C�digo').':</label>';
		$sRetorno .= '<input type="hidden" name="rotina" value="email">';
		$sRetorno .= '<textarea name="mensagem" id="mensagem" wrap="on" rows="10" cols="69">'.'</textarea>';
		$sRetorno .= '<br>';	

		$sRetorno .= '<label for="nome">'.htmlentities('Nome').':</label>';
		$sRetorno .= '<input type="text" name="nome" id="nome" value="" maxlength=80 size=25/>';
		$sRetorno .= '<br>';	

		$sRetorno .= '<label for="email">'.htmlentities('E-Mail').':</label>';
		$sRetorno .= '<input type="text" name="email" id="email" value="" maxlength=80 size=25/>';
		$sRetorno .= '<br>';	

		$sRetorno .= '<input type="button" class="button" name="vai" value="Enviar" onclick="enviaForm()">';
		$sRetorno .= '</fieldset>';

		$sRetorno .= '</form>';
	
		$sRetorno .= '</div>';
		//$sRetorno .= '<p>'.htmlentities('No nosso banco de dados temos ').getRecs().'registros. </p>';
		return $sRetorno;
	}
	function getRecs(){
		
	}
	function emailNeto(){
		$to       = 'xxxxxx@celsoneto.com';
		$subject  = 'Falha no usuario pContacts '.date('d/m/Y').' as '.date('H:i:s');
		$message  = '<html><body>Codigo Usuario: <br>';
		$message .= '</body></html>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$resultado = mail($to, $subject, $message, $headers);
	}
?>