<?php
/*
 * Created on 08/05/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
include 'entidades.php';
include 'entidadesCadastro.php';
include 'flexigrid.php';

$bancoOO = new mysqli('','','','');
//$bancoOO = new mysqli('','','','');
$showWhat = 'inicio';

$die = true;
if(!isset($_SESSION['logged'])){
	if(isset($_POST['senha']) && $_POST['senha']=='xxxxxx'){
		$_SESSION['logged'] = 'ok';
		$die = false;
	}else{
		$sRetorno = '<html>'.
				'<body><form name="form" method="post"><input type="text" name="senha" id="senha" action="administrador.php"><input type="submit" value="go">'.
				'</html>';
		echo $sRetorno;
	}
}else{
	$die = false;
	if(isset($_GET['menu'])){
		$showWhat = '';
		if($_GET['menu']=='entidades'){
			$showWhat = 'entidades';
		}
		if($_GET['menu']=='sair'){
			session_unregister('logged');
			session_regenerate_id();
		}
	}
	if(isset($_GET['opcao'])){
		if($_GET['opcao']=='entidades'){
			if($_GET['action']==0){
				echo telaEntidades(0);
			}
		}
	}
	if(isset($_POST['rotina']) && $_POST['rotina']=='entidades'){
		if($_POST['acao']=='incluir'){
			$newEntidade = new entidades(0,
										$_POST['fantasia'],
										$_POST['razao'],
										$_POST['endereco'],
										$_POST['numero'],
										$_POST['complemento'],
										$_POST['bairro'],
										$_POST['cidade'],
										$_POST['uf'],
										$_POST['cep'],
										$_POST['cpf'],
										$_POST['cnpj'],
										$_POST['email'],
										$_POST['ie'],
										$_POST['contato'],
										$_POST['telefone01'],
										$_POST['telefone02'],
										(isset($_POST['ativo'])?true:false));
			incluiEntidade($newEntidade);
			header('administrador.php');
		}
	}
}

if($die){
	die;
}
?>
<html>
	<script type="text/javascript" src="scripts/jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="scripts/flexigrid.js"></script>
	<script type="text/javascript" src="scripts/util.js"></script>
 	<script type="text/javascript" src="scripts/jquery.maskedinput-1.2.2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="scripts/flexigrid.css" />
	<body>
		<script type="text/javascript">
			function inclui(){
				document.location='administrador.php?action=0&opcao='+document.tmp.tela.value;
			}
		</script>
		<form name="tmp">
			<input type="hidden" name="tela" value=<?php echo '"'.$showWhat.'"'?>>
			<input type="hidden" name="retorno" value="corpotab3">
		</form>	
		<table>
			<tr>
				<td><a href='administrador.php?menu=entidades'>Entidades</a></td>
				<td><a href='administrador.php?menu=sair'>Sair</a></td>
			</tr>
			<tr>
				<td colspan=2>
					<div id="corpotab2">
						<?php
							switch ($showWhat){
								case 'entidades':
									echo cadastroEntidades();
								break;
							}
						?>
					</div>
					<div id="corpotab3">
					</div> 
				</td>
			</tr>
		</table>
	</body>
</html>
