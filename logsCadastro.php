<?php
/**
 * Created on 08/05/2011
 * Rotina de Logs.
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 */

function incluiLog($log){
	global $bancoOO;
	global $identificacaoEntidade;
	$newQuery = "insert into logs".$identificacaoEntidade->getcodigo()."(logs_codigo,logs_usuario,logs_rotina,logs_descricao,logs_sqlquery,logs_data,logs_hora) values(" .
			"".$bancoOO->escape_string($log->getcodigo()).",".
			"'".$bancoOO->escape_string($log->getusuario())."',".
			"'".$bancoOO->escape_string($log->getrotina())."',".
			"'".$bancoOO->escape_string($log->getdescricao())."',".
			"'".$bancoOO->escape_string($log->getsqlquery())."',".
			"".$bancoOO->escape_string($log->getdata()).",".
			"'".$bancoOO->escape_string($log->gethora())."')";
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao incluir log.".$bancoOO->error.$newQuery);
	}
	return 0;
}
 function cadastroLogs(){
 	global $identificacaoEntidade;
 	$sRetorno = '';

   $display[0][0] = 'Codigo';
 	$display[0][1] = 'logs_codigo';
 	$display[0][2] = '40';
 	$display[0][3] = 'true';
 	$display[0][4] = 'center';

 	$display[1][0] = 'Data';
 	$display[1][1] = 'logs_data';
 	$display[1][2] = '80';
 	$display[1][3] = 'true';
 	$display[1][4] = 'center';

 	$display[2][0] = 'Hora';
 	$display[2][1] = 'logs_hora';
 	$display[2][2] = '60';
 	$display[2][3] = 'true';
 	$display[2][4] = 'left';

 	$display[3][0] = 'Rotina';
 	$display[3][1] = 'logs_rotina';
 	$display[3][2] = '120';
 	$display[3][3] = 'true';
 	$display[3][4] = 'left';

	$display[4][0] = htmlentities('Usu�rio');
 	$display[4][1] = 'logs_usuario';//'@USU := concat(logs_usuario," - ",(select usuarios_nome from usuarios'.$identificacaoEntidade->getcodigo().' where usuarios_codigo=logs_usuario limit 1))';
 	$display[4][2] = '120';
 	$display[4][3] = 'true';
 	$display[4][4] = 'left';

 	$display[5][0] = 'Descricao';
 	$display[5][1] = 'logs_descricao';
 	$display[5][2] = '600';
 	$display[5][3] = 'true';
 	$display[5][4] = 'left';


/*
 	if(true){  //Mais tarde aki posso inserir n�veis de acesso e talz.
 		$buttons[1][0] = 'Excluir';
		$buttons[1][1] = 'delete';
		$buttons[1][2] = 'test';
 	}
*/
	$search[0][0] = htmlentities('Din�mica');
 	$search[0][1] = 'dynamicSearchLogs01';
 	$search[0][2] = 'true';
 	$search[0][3] = '';

 	$search[1][0] = 'Data';
 	$search[1][1] = 'logs_data';
 	$search[1][2] = 'false';
 	$search[1][3] = 'mask-data';

 	$order     = 'logs_codigo';
 	$sortOrder = 2;
 	$title     = htmlentities("Cadastro de Logs");
 	$width     = 980;
 	$height    = 255;
 	$internId  = $display[0][1];
 	$table     = "logs".$identificacaoEntidade->getcodigo();
 	$onClick   = 'altera';
 	$exibeBotoes  = false;
 	$exibeProcura = true;
 	//$filtro[0] = 'telefonemas_situacao';
 	//$filtro[1] = 'true';

 	$gridTelefonemas = new flexigrid('post2.php',$display,null,$search,$order,$sortOrder,$title,$width,$height,$internId,$table,$onClick,$exibeBotoes,$exibeProcura,null);
 	$sRetorno = $gridTelefonemas->toSring();
 	return $sRetorno;
}

?>
