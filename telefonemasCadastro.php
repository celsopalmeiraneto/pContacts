<?php
/*
 * Created on 07/01/2011
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 * Cadastro de Usu�rios
 */
 
 function cadastroTelefonemas(){
 	global $identificacaoEntidade;
 	$sRetorno = '';

   	$display[0][0] = 'Codigo';
 	$display[0][1] = 'telefonemas_codigo';
 	$display[0][2] = '40';
 	$display[0][3] = 'true';
 	$display[0][4] = 'center';

 	$display[1][0] = 'Data';
 	$display[1][1] = 'telefonemas_data';
 	$display[1][2] = '150';
 	$display[1][3] = 'true';
 	$display[1][4] = 'center';

 	$display[2][0] = 'Nome';
 	$display[2][1] = 'telefonemas_contato_nome';
 	$display[2][2] = '300';
 	$display[2][3] = 'true';
 	$display[2][4] = 'left';

 	$display[3][0] = 'Assunto';
 	$display[3][1] = 'telefonemas_assunto';
 	$display[3][2] = '360';
 	$display[3][3] = 'true';
 	$display[3][4] = 'left';

 	$display[4][0] = 'Estado';
 	$display[4][1] = 'telefonemas_estado';
 	$display[4][2] = '68';
 	$display[4][3] = 'true';
 	$display[4][4] = 'left';

 	if(true){  //Mais tarde aki posso inserir n�veis de acesso e talz.
 		$buttons[0][0] = 'Incluir';
		$buttons[0][1] = 'add';
		$buttons[0][2] = 'test';

 		$buttons[1][0] = 'Pendentes';
		$buttons[1][1] = '';
		$buttons[1][2] = 'test';

 		$buttons[2][0] = 'Realizados';
		$buttons[2][1] = '';
		$buttons[2][2] = 'test';
 	}

/*
 	if(true){  //Mais tarde aki posso inserir n�veis de acesso e talz.
 		$buttons[1][0] = 'Excluir';
		$buttons[1][1] = 'delete';
		$buttons[1][2] = 'test';
 	}
*/
	$search[0][0] = htmlentities('C�digo');
 	$search[0][1] = 'telefonemas_codigo';
 	$search[0][2] = 'false';
 	$search[0][3] = '';

 	$search[1][0] = 'Nome';
 	$search[1][1] = 'telefonemas_contato_nome';
 	$search[1][2] = 'true';
 	$search[1][3] = '';

 	$search[2][0] = 'Assunto';
 	$search[2][1] = 'telefonemas_assunto';
 	$search[2][2] = 'false';
 	$search[2][3] = '';

 	$search[3][0] = 'Data';
 	$search[3][1] = 'telefonemas_data';
 	$search[3][2] = 'false';
 	$search[3][3] = 'mask-data';

 	$order     = 'telefonemas_data';
 	$sortOrder = 1;
 	$title     = htmlentities("Cadastro de Telefonemas");
 	$width     = 980;
 	$height    = 255;
 	$internId  = $display[0][1];
 	$table     = "telefonemas".$identificacaoEntidade->getcodigo();
 	$onClick   = 'altera';
 	$exibeBotoes  = true;
 	$exibeProcura = true;
 	//$filtro[0] = 'telefonemas_situacao';
 	//$filtro[1] = 'true';

 	$gridTelefonemas = new flexigrid('post2.php',$display,$buttons,$search,$order,1,$title,$width,$height,$internId,$table,$onClick,$exibeBotoes,$exibeProcura,null);
 	$sRetorno = $gridTelefonemas->toSring();
 	return $sRetorno;
 }

/**
 * Faz a busca do telefonema do par�metro e retorna o objeto telefonema.
 */
function buscaTelefonemaPorCodigo($codigoProcura){
	global $bancoOO,$identificacaoEntidade;
	$newQuery = "select * from telefonemas".$identificacaoEntidade->getcodigo()."  where telefonemas_codigo='".$bancoOO->escape_string($codigoProcura)."'";
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		return -1;//N�o encontrado.
	}
	$vetor = $resultado->fetch_assoc();

	/*function __construct($newCodigo, $newData, $newHora,$newContatoCodigo, $newContatoNome, $newTelefone1,
							$newTelefone2, $newAssunto, $newProvidencias, $newOrigem,
							$newEstado, $newSituacao){
							*/

	$retorno = new telefonemas($vetor['telefonemas_codigo'],
							$vetor['telefonemas_data'],
							$vetor['telefonemas_hora'],
							$vetor['telefonemas_contato_codigo'],
							$vetor['telefonemas_contato_nome'],
							$vetor['telefonemas_telefone1'],
							$vetor['telefonemas_telefone2'],
							$vetor['telefonemas_assunto'],
							$vetor['telefonemas_providencias'],
							$vetor['telefonemas_origem'],
							$vetor['telefonemas_estado'],
							$vetor['telefonemas_situacao']);
	return $retorno;                        
}

function incluiTelefonema($telefonemaNovo){
	global $bancoOO,$identificacaoEntidade;
	$newQuery = "INSERT INTO telefonemas".$identificacaoEntidade->getcodigo()." 
				(telefonemas_codigo,
				telefonemas_data,
				telefonemas_hora,
				telefonemas_contato_codigo,
				telefonemas_contato_nome,
				telefonemas_telefone1,
				telefonemas_telefone2,
				telefonemas_assunto,
				telefonemas_providencias,
				telefonemas_origem,
				telefonemas_estado,
				telefonemas_situacao)
				VALUES
				(
				".$bancoOO->escape_string($telefonemaNovo->getcodigo()).",
				'".$bancoOO->escape_string($telefonemaNovo->getdataUS())."',
				'".$bancoOO->escape_string($telefonemaNovo->gethora())."',
				".$bancoOO->escape_string($telefonemaNovo->getcontato_codigo()).",
				'".$bancoOO->escape_string($telefonemaNovo->getcontato_nome())."',
				'".$bancoOO->escape_string($telefonemaNovo->gettelefone1())."',
				'".$bancoOO->escape_string($telefonemaNovo->gettelefone2())."',
				'".$bancoOO->escape_string($telefonemaNovo->getassunto())."',
				'".$bancoOO->escape_string($telefonemaNovo->getprovidencias())."',
				".$bancoOO->escape_string($telefonemaNovo->getorigem()).",
				".$bancoOO->escape_string($telefonemaNovo->getestado()).",
				".($bancoOO->escape_string($telefonemaNovo->getsituacao()?"true":"false")).")";
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao registrar telefonema. Acione o suporte!");
	}
	$log = new logs(0,$_SESSION['codigoUsuario'],'Telefonemas','Inc de Telefonema',$newQuery,date('Ymd'),date('His'));
	incluiLog($log);
	return 0;
}

function alteraTelefonema($telefonemaNovo){
	global $bancoOO,$identificacaoEntidade;
	$newQuery =	"UPDATE telefonemas".$identificacaoEntidade->getcodigo()."  SET
				telefonemas_data = '".$bancoOO->escape_string($telefonemaNovo->getdataUS())."',
				telefonemas_hora = '".$bancoOO->escape_string($telefonemaNovo->gethora())."',
				telefonemas_contato_codigo = ".$bancoOO->escape_string($telefonemaNovo->getcontato_codigo()).",
				telefonemas_contato_nome = '".$bancoOO->escape_string($telefonemaNovo->getcontato_nome())."',
				telefonemas_telefone1 = '".$bancoOO->escape_string($telefonemaNovo->gettelefone1())."',
				telefonemas_telefone2 = '".$bancoOO->escape_string($telefonemaNovo->gettelefone2())."',
				telefonemas_assunto = '".$bancoOO->escape_string($telefonemaNovo->getassunto())."',
				telefonemas_providencias = '".$bancoOO->escape_string($telefonemaNovo->getprovidencias())."',
				telefonemas_origem = ".$bancoOO->escape_string($telefonemaNovo->getorigem()).",
				telefonemas_estado = ".$bancoOO->escape_string($telefonemaNovo->getestado()).",
				telefonemas_situacao = ".$bancoOO->escape_string(($telefonemaNovo->getsituacao()?"true":"false"))."
				WHERE telefonemas_codigo=".$bancoOO->escape_string($telefonemaNovo->getcodigo());
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao atualizar telefonema. Acione o suporte!");
	}
	$log = new logs(0,$_SESSION['codigoUsuario'],'Telefonemas','Alt de Telefonema',$newQuery,date('Ymd'),date('His'));
	incluiLog($log);
	return 0;
}

/*function telaTelefonema($codigo){
	$nomeTmp = '';
	$contato = buscaContatoPorCodigo($codigo);
	$_SESSION['contato'] = $codigo;
	$sRetorno  = '<div id="telinhaFodona">';

	$matrizCampos[0][0] = htmlentities('C�digo: ');
	$matrizCampos[0][1] = $contato->getcodigo();
	 
	$matrizCampos[1][0] = htmlentities('Nome: ');
	$matrizCampos[1][1] = $contato->getnome();
	
	$sRetorno .= geraTabelinha($matrizCampos); 

	$sRetorno .= 'Telefones:<br>';
	$sRetorno .= geraTabelinha(matrizTelefonesPorContato($contato->getcodigo())); //cadastroTelefones($contato->getcodigo());
	$sRetorno .= '<br><a href="#" onclick="altera2('.$contato->getcodigo().')">Mais...</a>';
	$sRetorno .= '</div>';
//<a href="#dialog" name="modal">Janela Modal Simples</a>

	return $sRetorno;
}
*/

function telaTelefonemas($codigo){
	$nomeTmp = '';
	if($codigo!=0){
		$telefonema = buscaTelefonemaPorCodigo($codigo);
	}else{
		$telefonema = telefonemaEmBranco();
	}
	
	//echo var_dump($telefonema);
	
	$sRetorno  = '<div id="telinhaFodona">';
	$sRetorno .= '<fieldset>';
	$sRetorno .= '<form name="dados" action="inicio.php" method="post">';
	$sRetorno .= '<input type="hidden" name="rotina" value="telefonemas">';
	$sRetorno .= '<input type="hidden" name="acao"   value="'.($codigo==0?'incluir':'alterar').'">';

	$sRetorno .= '<fieldset>';
	$sRetorno .= '<legend Align="left">Dados do Telefonema:</legend>';
	$sRetorno .= '<br>';
	//$sRetorno .= '<label for="codigo">'.htmlentities('C�digo').':</label>';
	$sRetorno .= '<input type="hidden" name="codigo" id="codigo" value="'.$telefonema->getcodigo().'" />';
	//$sRetorno .= '<br>';

	$sRetorno .= '<label for="data">'.htmlentities('Data').':</label>';
	$sRetorno .= '<input type="text" name="data" id="data" class="mask-data" value="'.$telefonema->getdataUK().'" maxlength=10 size=10/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="data">'.htmlentities('Hora').':</label>';
	$sRetorno .= '<input type="text" name="hora" id="hora" class="mask-hora" value="'.$telefonema->gethora().'" maxlength=08 size=10/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<input type="hidden" name="contato_codigo" value="'.($codigo==0?0:$telefonema->getcontato_codigo()).'"/>';

	$sRetorno .= '<label for="nome">'.htmlentities('Nome').':</label>';
	$sRetorno .= '<input type="text" name="contato_nome" id="contato_nome" value="'.$telefonema->getcontato_nome().'" maxlength=150 size=100/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="assunto">'.htmlentities('Assunto').':</label>';
	$sRetorno .= '<input type="text" name="assunto" id="assunto"  value="'.$telefonema->getassunto().'" maxlength=150 size=100/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="telefone1">'.htmlentities('Telefone 1').':</label>';
	$sRetorno .= '<input type="text" name="telefone1" id="telefone1" value="'.$telefonema->gettelefone1().'" maxlength=30 size=30/>';

	$sRetorno .= '<label for="telefone2">'.htmlentities('Telefone 2').':</label>';
	$sRetorno .= '<input type="text" name="telefone2" id="telefone2" value="'.$telefonema->gettelefone2().'" maxlength=30 size=30/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="providencias">'.htmlentities('Provid�ncias').':</label>';
	$sRetorno .= '<textarea name="providencias" id="providencias" wrap="on" rows="3" cols="100">'.$telefonema->getprovidencias().'</textarea>';
	$sRetorno .= '<br>';
	$sRetorno .= '</fieldset>';

	$sRetorno .= '<fieldset style="display: inline; float:left; width:20%;">';
	$sRetorno .= '<legend Align="left">Origem do Telefonema:</legend>';
	$sRetorno .= '<br>';
	$sRetorno .= '<input type="radio" name="origem" id="origem1" value="1" '.($telefonema->getorigem()==1?'checked="checked"':'').' '.($codigo==0?'checked="checked"':'').'>';
	$sRetorno .= '<label for="origem1">'.htmlentities('Chamei').'</label>';
	$sRetorno .= '<input type="radio" name="origem" id="origem2" value="2" '.($telefonema->getorigem()==2?'checked="checked"':'').'>';
	$sRetorno .= '<label for="origem2">'.htmlentities('Recebi').'</label>';
	
	$sRetorno .= '</fieldset>';

	$sRetorno .= '<fieldset style="display: inline; float:left; width:30%">';
	$sRetorno .= '<legend Align="left">Estado:</legend>';
	$sRetorno .= '<br>';
	$sRetorno .= '<div style="display: inline; float:left; width:40%;">';
	$sRetorno .= '<input type="radio" name="estado" id="estado1" value="1" '.($telefonema->getestado()==1?'checked="checked"':'').' '.($codigo==0?'checked="checked"':'').'>';
	$sRetorno .= '<label for="estado1">'.htmlentities('Falou').'</label>';
	$sRetorno .= '<br>';
	$sRetorno .= '<input type="radio" name="estado" id="estado3" value="3" '.($telefonema->getestado()==3?'checked="checked"':'').'>';
	$sRetorno .= '<label for="estado3">'.htmlentities('Recado').'</label>';
	$sRetorno .= '<br>';
	$sRetorno .= '<input type="radio" name="estado" id="estado5" value="5" '.($telefonema->getestado()==5?'checked="checked"':'').'>';
	$sRetorno .= '<label for="estado5">'.htmlentities('Ocupado').'</label>';
	$sRetorno .= '</div>';
	$sRetorno .= '<div style="display: inline; float:left; width:60%;">';
	$sRetorno .= '<input type="radio" name="estado" id="estado2" value="2" '.($telefonema->getestado()==2?'checked="checked"':'').'>';
	$sRetorno .= '<label for="estado2">'.htmlentities('N�o Completada').'</label>';
	$sRetorno .= '<br>';
	$sRetorno .= '<input type="radio" name="estado" id="estado4" value="4" '.($telefonema->getestado()==4?'checked="checked"':'').'>';
	$sRetorno .= '<label for="estado4">'.htmlentities('Cancelado').'</label>';
	$sRetorno .= '</div>';
	$sRetorno .= '</fieldset>';
	$sRetorno .= '<br>';
	$sRetorno .= '<label for="situacao">'.htmlentities('Pendente?').'</label>';
	$sRetorno .= '<input type="checkbox" name="situacao" '.($telefonema->getsituacao()==true?'checked="checked"':'').' value="x" />';

	$sRetorno .= '<br>';
	$sRetorno .= '<input type="button" class="button" name="vai" onclick="enviaForm()" value="Gravar">';
	if($codigo != 0)
		$sRetorno .= '<input type="button" class="button" name="exclui" onclick="excluiTelefonema()" value="Excluir Telefonema">';
	$sRetorno .= '</form>';
	$sRetorno .= '</fieldset>';
	
	$sRetorno .= '</div>';

	return $sRetorno;
}

function excluiTelefonema($codigo){
	global $bancoOO,$identificacaoEntidade;
	$telefonema = buscaTelefonemaPorCodigo($codigo);
	If(is_int($telefonema))
		return $telefonema;
	$sQuery = "delete from telefonemas".$identificacaoEntidade->getcodigo()." where telefonemas_codigo=".$codigo;
	$res = $bancoOO->query($sQuery);
	if(!$res)
		Die("Falha ao excluir telefonema. Contate o suporte com a mensagem abaixo:<br>".$bancoOO->error);
	$log = new logs(0,$_SESSION['codigoUsuario'], "Telefonemas", "Exc de Telefonema ".$telefonema->getassunto()." ".$telefonema->getcontato_nome(), $sQuery,Date("Ymd"), Date("His"));
	incluiLog($log);
	return 1;
}

function telefonemaEmBranco(){
	$retorno = new telefonemas('','','','','','','','','','','',true);
	return $retorno;
}
 
?>
