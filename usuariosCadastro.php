<?php
/*
 * Created on 07/01/2011
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 * Cadastro de Usu�rios
 */
 
 function cadastroUsuarios(){
 	global $identificacaoEntidade;
 	$sRetorno = '';

   	$display[0][0] = 'Codigo';
 	$display[0][1] = 'usuarios_codigo';
 	$display[0][2] = '40';
 	$display[0][3] = 'true';
 	$display[0][4] = 'center';

 	$display[1][0] = 'Login';
 	$display[1][1] = 'usuarios_login';
 	$display[1][2] = '300';
 	$display[1][3] = 'true';
 	$display[1][4] = 'left';

 	$display[2][0] = 'Nome';
 	$display[2][1] = 'usuarios_nome';
 	$display[2][2] = '300';
 	$display[2][3] = 'true';
 	$display[2][4] = 'left';
  
 	
 	if(true){  //Mais tarde aki posso inserir n�veis de acesso e talz.
 		$buttons[0][0] = 'Incluir';
		$buttons[0][1] = 'add';
		$buttons[0][2] = 'test';
 	}

/*
 	if(true){  //Mais tarde aki posso inserir n�veis de acesso e talz.
 		$buttons[1][0] = 'Excluir';
		$buttons[1][1] = 'delete';
		$buttons[1][2] = 'test';
 	}
*/
	$search[0][0] = 'Codigo';
 	$search[0][1] = 'usuarios_codigo';
 	$search[0][2] = 'false';
 	$search[0][3] = '';

 	$search[1][0] = 'Login';
 	$search[1][1] = 'usuarios_login';
 	$search[1][2] = 'true';
 	$search[1][3] = '';

 	$search[2][0] = 'Nome';
 	$search[2][1] = 'usuarios_nome';
 	$search[2][2] = 'false';
 	$search[2][3] = '';
 	
 	$order     = 'usuarios_login';
 	$sortOrder = 1;
 	$title     = htmlentities("Cadastro de Usu�rios");
 	$width     = 980;
 	$height    = 255;
 	$internId  = $display[0][1];
 	$table     = 'usuarios'.$identificacaoEntidade->getcodigo();
 	$onClick   = 'altera';
 	$exibeBotoes = true;
 	$exibeProcura = true;

 	$gridUsuarios = new flexigrid('post2.php',$display,$buttons,$search,$order,1,$title,$width,$height,$internId,$table,$onClick,$exibeBotoes,$exibeProcura,null);
 	$sRetorno = $gridUsuarios->toSring();
 	return $sRetorno;
 }
 
function buscaUsuarioPorLogin($loginProcura){
 	global $identificacaoEntidade;
	global $bancoOO;
	$newQuery = "select * from usuarios".$identificacaoEntidade->getcodigo()." where usuarios_login='".$bancoOO->escape_string($loginProcura)."'";
	$resultado = $bancoOO->query($newQuery);
	if($resultado->num_rows==0){
		return -1;
	}
	$vetor = $resultado->fetch_assoc();
	$retorno = new usuarios($vetor['usuarios_codigo'],
							$vetor['usuarios_login'],
							$vetor['usuarios_nome'],
							$vetor['usuarios_senha'],
							$vetor['usuarios_dataRegistro'],
							$vetor['usuarios_horaRegistro'],
							$vetor['usuarios_ativo']);
	$modulos = json_decode($vetor['usuarios_modulos'],true);
	$retorno->setModulos($modulos);
	return $retorno;                        
}

function buscaUsuarioPorCodigo($codigoProcura){
 	global $identificacaoEntidade;
	global $bancoOO;
	$newQuery = "select * from usuarios".$identificacaoEntidade->getcodigo()."  where usuarios_codigo='".$bancoOO->escape_string($codigoProcura)."'";
	$resultado = $bancoOO->query($newQuery);
	if($resultado->num_rows==0){
		return -1;//N�o encontrado.
	}
	$vetor = $resultado->fetch_assoc();
	$retorno = new usuarios($vetor['usuarios_codigo'],
							$vetor['usuarios_login'],
							$vetor['usuarios_nome'],
							$vetor['usuarios_senha'],
							$vetor['usuarios_dataRegistro'],
							$vetor['usuarios_horaRegistro'],
							$vetor['usuarios_ativo']);
	$modulos = json_decode($vetor['usuarios_modulos'],true);
	$retorno->setModulos($modulos);
	return $retorno;                        
}

function registraLogin($idSession,$codigoUsuario){
 	global $identificacaoEntidade;
	global $bancoOO;
	$newQuery = "insert into sessoes".$identificacaoEntidade->getcodigo()."  (sessoes_id,sessoes_usuario,sessoes_data,sessoes_hora) ".
				"values ('".$idSession."',".$codigoUsuario.",'".date("Ymd")."','".date("His")."')";
	//echo '</br> '.$newQuery;			
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao registrar sess�o. Acione o suporte!");
	}
	$log = new logs(0,$_SESSION['codigoUsuario'],'Login','Login no Sistema',"",date('Ymd'),date('His'));
	incluiLog($log);
}

function incluiUsuario($usuarioNovo){
	global $bancoOO;
	global $identificacaoEntidade;
	$newQuery =	"insert into usuarios".$identificacaoEntidade->getcodigo()."  (usuarios_codigo,usuarios_login,usuarios_nome,usuarios_senha,usuarios_dataRegistro,usuarios_horaRegistro,usuarios_ativo,usuarios_identificacao_entidade) ".
				"values (0,'".$bancoOO->escape_string($usuarioNovo->getlogin())."',".
						"'".$bancoOO->escape_string($usuarioNovo->getnome())."',".
						"'".$bancoOO->escape_string(md5($usuarioNovo->getsenha()))."',".
						"'".$bancoOO->escape_string($usuarioNovo->getdataRegistro())."',".
						"'".$bancoOO->escape_string($usuarioNovo->gethoraRegistro())."',".
						"".$bancoOO->escape_string($usuarioNovo->getativo()).",1)";
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao incluir usu�rio. Acione o suporte!<br>".$bancoOO->error);
	}
	$log = new logs(0,$_SESSION['codigoUsuario'],'Usuarios','Inc de Usuario '.$usuarioNovo->getnome(),$newQuery,date('Ymd'),date('His'));
	incluiLog($log);
}

function alteraUsuario($usuarioNovo,$atualizaSenha){
 	global $identificacaoEntidade;
	global $bancoOO;
	$newQuery =	"update usuarios".$identificacaoEntidade->getcodigo()."  set ".
						"usuarios_nome = '".$bancoOO->escape_string($usuarioNovo->getnome())."'";
	if($atualizaSenha){
		$newQuery .= ", usuarios_senha = '".$bancoOO->escape_string($usuarioNovo->getsenha())."'";
	}
	$newQuery .= " where usuarios_codigo = ".$bancoOO->escape_string($usuarioNovo->getcodigo());
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao atualizar usu�rio. Acione o suporte e informe a seguinte mensagem:<br>".$bancoOO->error);
	}
	$log = new logs(0,$_SESSION['codigoUsuario'],'Usuarios','Alt de Usuario '.$usuarioNovo->getnome(),$newQuery,date('Ymd'),date('His'));
	incluiLog($log);
}

function mudaSenha($codUsuario,$senhaOld,$senhaNew){
	$usuario = buscaUsuarioPorCodigo($codUsuario);
	if($usuario->verificaSenha($senhaOld)){
		$senhaNew = md5($senhaNew);
		$usuario->setSenha($senhaNew);
		alteraUsuario($usuario,true);
		return htmlentities("Senha alterada com sucesso!");
	}else{
		return htmlentities("Senha Inv�lida!");
	}
}

function mudaPerfil($usuario,$perfil){
	global $identificacaoEntidade;
	global $bancoOO;
	$perfil = json_encode($perfil);
	$query = "update usuarios".$identificacaoEntidade->getcodigo()." set usuarios_modulos = '".$bancoOO->real_escape_string($perfil)."' where usuarios_codigo=$usuario";
	$ret = $bancoOO->query($query);
	if(!$ret)
		Die("Falha ao atualizar usuario.<br>".$query.'<br>'.$bancoOO->error);
	$log = new logs(0,$_SESSION['codigoUsuario'],'Usu�rios','Altera��o de Perfil de Acesso',$query,date('Ymd'),date('His'));
	return 'Perfil atualizado com sucesso.';
}

function telaUsuarios($codigo){
	$nomeTmp = '';
	if($codigo!=0){
		$usuario = buscaUsuarioPorCodigo($codigo);
		$nomeTmp = ' value="'.htmlspecialchars($usuario->getnome()).'" ';
	}
	$sRetorno  = '<div id="telinhaFodona">';
	$sRetorno .= '<form name="dados" action="inicio.php" method="post">';
	$sRetorno .= '<fieldset>';
//	$sRetorno .= '<br>'.$usuario->getentidade();
	$sRetorno .= '<input type="hidden" name="codigo" id="codigo" value="'.($codigo==0?'':htmlspecialchars($codigo)).'">';
	$sRetorno .= '<input type="hidden" name="rotina" value="usuarios">';
	$sRetorno .= '<input type="hidden" name="acao"   value="'.($codigo==0?'incluir':'alterar').'">';
	$sRetorno .= '<label for="nome">Nome:</label><input type="text" class="text" name="nome" id="nome" size=100 maxlenght=150 '.$nomeTmp.'/><br>';
	if($codigo==0){
		$sRetorno .= '<label for="login">Login:</label><input type="text" class="text" name="login" id="login" size=30/><br>';
		$sRetorno .= '<label for="senha">Senha:</label><input type="password" class="text" name="senha" id="senha" size=20/>';
	}
	$sRetorno .= '<input type="button" onclick="enviaForm()" class="button" name="vai" id="vai" value="'.($codigo==0?'Incluir':'Alterar').'"/>';
	if($codigo!=0){
		$sRetorno .= '<input type="button" onclick="alteraSenha('.$codigo.')" class="button" name="altSenha" value="Alterar Senha"/>';
		$sRetorno .= '<input type="button" onclick="perfilAcesso()" class="button" name="btperfilAcesso" value="Perfil de Acesso"/>';
		$sMenBtnInat = ($usuario->getativo()?"Inativar":"Ativar");
		$sRetorno .= '<input type="button" onclick="inativaUsuario()" class="button" name="inat" id="vai" value="'.htmlentities("$sMenBtnInat Usu�rio").'" />';
	}
	$sRetorno .= '</fieldset>';
	$sRetorno .= '</form>';
	$sRetorno .= '<div id="mudaSenha" style="display:none;">';
	$sRetorno .= formMudaSenha();
	$sRetorno .= '</div>';
	if($codigo!=0){
		$sRetorno .= '<div id="perfilAcesso" style="display:none;">';
		$sRetorno .= formPerfilAcesso($usuario);
		$sRetorno .= '</div>';
	}else{
		$sRetorno .=htmlentities("O perfil de acesso poder� ser definido ap�s a inclus�o do usu�rio.");
	}
	$sRetorno .= '</div>';
	
	return $sRetorno;
}

function formMudaSenha($destinoRetorno = null){
	if($destinoRetorno == null)
		$destinoRetorno = "";
	$sRetorno  = '<form name="altSenha">';
	$sRetorno .= '<fieldset>';
	$sRetorno .= '<label for="senhaAtual">Senha Atual:</label><input type="password" class="text" name="senhaAtual" id="senhaAtual" size=30 maxlenght=20/><br>';
	$sRetorno .= '<label for="novaSenha">Nova Senha:</label><input type="password" class="text" name="novaSenha" id="novaSenha" size=30 maxlenght=20/><br>';
	$sRetorno .= '<label for="confSenha">Conf. Senha:</label><input type="password" class="text" name="confSenha" id="confSenha" size=30 maxlenght=20/><br>';
	$sRetorno .= '<input type="button" onclick="validaNovaSenha('.$destinoRetorno.')" class="button" name="enviaNovaSenha" value="Confirmar"/>';
	$sRetorno .= '</fieldset>';
	$sRetorno .= '</form>';
	return $sRetorno;
}

function formPerfilAcesso($usuario){
	$menu = new PerfilCadastro();
	$sRetorno = '<form name="altPerfil" id="formPerfil">';
	$sRetorno .= '<fieldset>';
	$sRetorno .= '<legend>Perfil de Acesso</legend>';
	$sRetorno .= $menu->toStringCheckBox($usuario);
	$sRetorno .= '<input type="button" onclick="vaiPerfilAcesso()" class="button" name="btPerfilAcesso" value="Confirmar"/>';
	$sRetorno .= '</fieldset>';
	$sRetorno .= '</form>';
	return $sRetorno;
}

/**
 * Muda o status do usu�rio. Se estiver ativo, fica ativo, e vice-versa.
 * @global mysqli $bancoOO
 * @global entidade $identificacaoEntidade
 * @param int $codigo C�digo do usu�rio a ser "toggled".
 */
function ativaInativaUsuario($codigo){
	global $bancoOO,$identificacaoEntidade;
	$usuario = buscaUsuarioPorCodigo($codigo);
	$atv = ($usuario->getativo()?"0":"1");
	$strAtv = ($atv=="1"?"Ativ.":"Inat.");
	$sQuery = "update usuarios".$identificacaoEntidade->getcodigo()." set usuarios_ativo=$atv";
	//echo $sQuery;
	$res = $bancoOO->query($sQuery);
	if(!$res)
		Die("Falha ao mudar status do usu�rio. Entre em contato com o suporte e informe a mensagem abaixo:<br>".$bancoOO->error);
	$log = new logs(0,$_SESSION['codigoUsuario'],"Usuarios","$strAtv Usuario ".$usuario->getnome(),$sQuery,Date("Ymd"),Date("His"));
	incluiLog($log);
}
 
?>
