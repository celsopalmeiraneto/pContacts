<?php
/*
 * Created on 07/01/2011
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 * Cadastro de Usu�rios
 */
 
 function cadastroContatos($filtro,$tamanho){
 	global $identificacaoEntidade;
 	$sRetorno = '';
	
	$display[0][0] = 'Codigo';
 	$display[0][1] = 'contatos_codigo';
 	$display[0][2] = '40';
 	$display[0][3] = 'true';
 	$display[0][4] = 'center';

 	$display[1][0] = 'Nome';
 	$display[1][1] = 'contatos_nome';
 	$display[1][2] = '590';
 	$display[1][3] = 'true';
 	$display[1][4] = 'left';

 	$display[2][0] = 'Telefone 1';
 	$display[2][1] = 'contatos_telefone';
 	$display[2][2] = '150';
 	$display[2][3] = 'true';
 	$display[2][4] = 'center';

 	$display[3][0] = 'Celular 1';
 	$display[3][1] = 'contatos_celular';
 	$display[3][2] = '150';
 	$display[3][3] = 'true';
 	$display[3][4] = 'center';
  
 	
 	if(true){  //Mais tarde aki posso inserir n?veis de acesso e talz.
 		$buttons[0][0] = 'Incluir';
		$buttons[0][1] = 'add';
		$buttons[0][2] = 'test';

 		$buttons[1][0] = 'Aniversariantes';
		$buttons[1][1] = '';
		$buttons[1][2] = 'filtraAniversariantes';
 	}

/*
 	if(true){  //Mais tarde aki posso inserir n?veis de acesso e talz.
 		$buttons[1][0] = 'Excluir';
		$buttons[1][1] = 'delete';
		$buttons[1][2] = 'test';
 	}
*/
	$search[0][0] = htmlentities('C�digo');
 	$search[0][1] = 'contatos_codigo';
 	$search[0][2] = 'false';
 	$search[0][3] = '';

 	$search[1][0] = 'Nome';
 	$search[1][1] = 'contatos_nome';
 	$search[1][2] = 'false';
 	$search[1][3] = '';

 	$search[2][0] = htmlentities('Din�mica');
 	$search[2][1] = 'dynamicSearchContatos01';
 	$search[2][2] = 'true';
 	$search[2][3] = '';

 	$order     = 'contatos_nome';
 	$sortOrder = 1;
 	$title     = htmlentities("Cadastro de Contatos");
 	if(is_array($tamanho)){
 		$width  = $tamanho[0];	
 		$height = $tamanho[1];	
 	}else{
	 	$width     = 980;
 		$height    = 255;
 	}
 	$internId  = $display[0][1];
 	$table     = 'contatos'.$identificacaoEntidade->getcodigo();
 	$onClick   = 'altera';
 	$exibeBotoes  = true;
 	$exibeProcura = true;
	
 	

 	$gridContatos = new flexigrid('post2.php',$display,$buttons,$search,$order,1,$title,$width,$height,$internId,$table,$onClick,$exibeBotoes,$exibeProcura,(is_array($filtro)?$filtro:null));
 	$sRetorno = $gridContatos->toSring();
 	return $sRetorno;
 }
 

function cadastroContatosAniversario($tamanho){
	global $identificacaoEntidade;
	$sRetorno = '';
	
	if($tamanho==0){
	  	$display[0][0] = 'Codigo';
		$display[0][1] = 'contatos_codigo';
		$display[0][2] = '40';
		$display[0][3] = 'true';
		$display[0][4] = 'center';

		$display[1][0] = 'Nome';
		$display[1][1] = 'contatos_nome';
		$display[1][2] = '590';
		$display[1][3] = 'true';
		$display[1][4] = 'left';
	}else{
	   $display[0][0] = 'Codigo';
 		$display[0][1] = 'contatos_codigo';
 		$display[0][2] = '40';
 		$display[0][3] = 'true';
 		$display[0][4] = 'center';

	 	$display[1][0] = 'Nome';
 		$display[1][1] = 'contatos_nome';
 		$display[1][2] = '590';
 		$display[1][3] = 'true';
 		$display[1][4] = 'left';

	 	$display[2][0] = 'Telefone 1';
 		$display[2][1] = 'contatos_telefone';
 		$display[2][2] = '150';
 		$display[2][3] = 'true';
 		$display[2][4] = 'center';

	 	$display[3][0] = 'Celular 1';
 		$display[3][1] = 'contatos_celular';
 		$display[3][2] = '150';
 		$display[3][3] = 'true';
 		$display[3][4] = 'center';
		
	}

 	
	if(true){  //Mais tarde aki posso inserir n?veis de acesso e talz.
		$buttons[0][0] = 'Incluir';
		$buttons[0][1] = 'add';
		$buttons[0][2] = 'test';
	}

/*
 	if(true){  //Mais tarde aki posso inserir n?veis de acesso e talz.
 		$buttons[1][0] = 'Excluir';
		$buttons[1][1] = 'delete';
		$buttons[1][2] = 'test';
 	}
*/
	$search[0][0] = htmlentities('C�digo');
 	$search[0][1] = 'contatos_codigo';
 	$search[0][2] = 'false';
 	$search[0][3] = '';

 	$search[1][0] = 'Nome';
 	$search[1][1] = 'contatos_nome';
 	$search[1][2] = 'true';
 	$search[1][3] = '';

	$search[2][0] = htmlentities('Data Anivers�rio');
 	$search[2][1] = 'contatos_aniversario';
 	$search[2][2] = 'false';
 	$search[2][3] = 'mask-data';

 	$order     = 'contatos_nome';
 	$sortOrder = 1;
 	$title     = htmlentities("Aniversariantes do Dia");
 	if($tamanho==0){
	 	$width     = 485;
		$height    = 224;
 	}else{
		$width     = 980;
		$height    = 255;
 	}
 	$internId  = $display[0][1];
 	$table     = 'contatos'.$identificacaoEntidade->getcodigo();
 	if($tamanho==0){
	 	$onClick   = 'goAniversarianteSelecionado';
 	}else{
	 	$onClick   = 'altera';
 	}
 	$exibeBotoes  = false;
 	$exibeProcura = true;
 	$filtro[0] = "day(contatos_aniversario)";
 	$filtro[1] = "day(CurDate())";
 	$filtro[2] = "month(contatos_aniversario)";
 	$filtro[3] = "month(CurDate())";
 	

 	$gridContatos = new flexigrid('post2.php',$display,$buttons,$search,$order,1,$title,$width,$height,$internId,$table,$onClick,$exibeBotoes,$exibeProcura,$filtro);
 	$sRetorno = $gridContatos->toSring();
 	return $sRetorno;
}
 


function buscaContatoPorCodigo($codigoProcura){
 	global $identificacaoEntidade;
	global $bancoOO;
	$newQuery = "select * from contatos".$identificacaoEntidade->getcodigo()."  where contatos_codigo='".$codigoProcura."'";
	$resultado = $bancoOO->query($newQuery);
	if($resultado->num_rows==0){
		return -1;//N?o encontrado.
	}
	$vetor = $resultado->fetch_assoc();

/*$newCodigo, $newNome, $newAniversario, $newTratamento,
							$newTitulo, $newCargo, $newEntidade,$newEndereco,
							$newCidade, $newCep, $newEstado, $newPais, $newEmail,
							$newObs, $newConjugue, $newConjugueTratamento, $newEnderecoResidencial,
							$newCidadeResidencial, $newCepResidencial, $newEstadoResidencial, $newPaisResidencial,
							$newClassificacao, $newReferencia, $newDataInclusao, $newUsuarioInclusao,
							$newHoraInclusao, $newTelefone, $newCelular*/
	$retorno = new contatos($vetor['contatos_codigo'],
							$vetor['contatos_nome'],
							$vetor['contatos_aniversario'],
							$vetor['contatos_tratamento'],
							$vetor['contatos_titulo'],
							$vetor['contatos_cargo'],
							$vetor['contatos_entidade'],
							$vetor['contatos_endereco'],
							$vetor['contatos_cidade'],
							$vetor['contatos_cep'],
							$vetor['contatos_estado'],
							$vetor['contatos_pais'],
							$vetor['contatos_email'],
							$vetor['contatos_obs'],
							$vetor['contatos_conjugue'],
							$vetor['contatos_conjugue_tratamento'],
							$vetor['contatos_endereco_residencial'],
							$vetor['contatos_cidade_residencial'],
							$vetor['contatos_cep_residencial'],
							$vetor['contatos_estado_residencial'],
							$vetor['contatos_pais_residencial'],
							$vetor['contatos_classificacao'],
							$vetor['contatos_referencia'],
							$vetor['contatos_data_inclusao'],
							$vetor['contatos_usuario_inclusao'],
							$vetor['contatos_hora_inclusao'],
							$vetor['contatos_telefone'],
							$vetor['contatos_celular'],
							$vetor['contatos_tratamento2'],
							$vetor['contatos_cargo2'],
							$vetor['contatos_conjugue_tratamento2'],
							$vetor['contatos_conjugue_tratamento3']);
	return $retorno;                        
}

function incluiContato($contatoNovo){
 	global $identificacaoEntidade;
	global $bancoOO;
	$newQuery = "INSERT INTO contatos".$identificacaoEntidade->getcodigo()." 
		(contatos_codigo,
		contatos_nome,";
		$newQuery .= (strlen($contatoNovo->getaniversarioUS())>0?"contatos_aniversario,":"");
		$newQuery .= "contatos_tratamento,
		contatos_titulo,
		contatos_cargo,
		contatos_entidade,
		contatos_endereco,
		contatos_cidade,
		contatos_cep,
		contatos_estado,
		contatos_pais,
		contatos_email,
		contatos_obs,
		contatos_conjugue,
		contatos_conjugue_tratamento,
		contatos_endereco_residencial,
		contatos_cidade_residencial,
		contatos_cep_residencial,
		contatos_estado_residencial,
		contatos_pais_residencial,
		contatos_classificacao,
		contatos_referencia,
		contatos_data_inclusao,
		contatos_usuario_inclusao,
		contatos_hora_inclusao,
		contatos_telefone,
		contatos_celular,
		contatos_tratamento2,
		contatos_cargo2,
		contatos_conjugue_tratamento2,
		contatos_conjugue_tratamento3)
		VALUES (".
		$bancoOO->escape_string($contatoNovo->getcodigo()).",".
		"'".$bancoOO->escape_string($contatoNovo->getnome())."',";
		$newQuery .= (strlen($contatoNovo->getaniversarioUS())>0?"'".$bancoOO->escape_string($contatoNovo->getaniversarioUS())."',":""); //US
		$newQuery .= "'".$bancoOO->escape_string($contatoNovo->gettratamento())."',".
		"'".$bancoOO->escape_string($contatoNovo->gettitulo())."',".
		"'".$bancoOO->escape_string($contatoNovo->getcargo())."',".
		"'".$bancoOO->escape_string($contatoNovo->getentidade())."',".
		"'".$bancoOO->escape_string($contatoNovo->getendereco())."',".
		"'".$bancoOO->escape_string($contatoNovo->getcidade())."',".
		"'".$bancoOO->escape_string($contatoNovo->getcep())."',".
		"'".$bancoOO->escape_string($contatoNovo->getestado())."',".
		"'".$bancoOO->escape_string($contatoNovo->getpais())."',".
		"'".$bancoOO->escape_string($contatoNovo->getemail())."',".
		"'".$bancoOO->escape_string($contatoNovo->getobs())."',".
		"'".$bancoOO->escape_string($contatoNovo->getconjugue())."',".
		"'".$bancoOO->escape_string($contatoNovo->getconjugue_tratamento())."',".
		"'".$bancoOO->escape_string($contatoNovo->getendereco_residencial())."',".
		"'".$bancoOO->escape_string($contatoNovo->getcidade_residencial())."',".
		"'".$bancoOO->escape_string($contatoNovo->getcep_residencial())."',".
		"'".$bancoOO->escape_string($contatoNovo->getestado_residencial())."',".
		"'".$bancoOO->escape_string($contatoNovo->getpais_residencial())."',".
		"'".$bancoOO->escape_string($contatoNovo->getclassificacao())."',".
		"'".$bancoOO->escape_string($contatoNovo->getreferencia())."',".
		"'".$bancoOO->escape_string($contatoNovo->getdata_inclusao())."',".
		$bancoOO->escape_string($contatoNovo->getusuario_inclusao()).",".
		"'".$bancoOO->escape_string($contatoNovo->gethora_inclusao())."',".
		"'".$bancoOO->escape_string($contatoNovo->gettelefone())."',".
		"'".$bancoOO->escape_string($contatoNovo->getcelular())."',".
		"'".$bancoOO->escape_string($contatoNovo->gettratamento2())."',".
		"'".$bancoOO->escape_string($contatoNovo->getcargo2())."',".
		"'".$bancoOO->escape_string($contatoNovo->getconjugue_tratamento2())."',".
		"'".$bancoOO->escape_string($contatoNovo->getconjugue_tratamento3())."')";
		//die(var_dump($bancoOO->get_charset()  )  );
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao registrar contato. Acione o suporte!".$bancoOO->error);
	}
	$codigoContato = $bancoOO->insert_id;

	$log = new logs(0,$_SESSION['codigoUsuario'],'Contatos','Inc de Contato '.$contatoNovo->getnome(),$newQuery,date('Ymd'),date('His'));
	incluiLog($log);
	
	$telTmp = new telefones(0,$codigoContato,$contatoNovo->gettelefone(),'Telefone',true);
	incluiTelefone($telTmp);
	$celTmp = new telefones(0,$codigoContato,$contatoNovo->getcelular(),'Celular',true);
	incluiTelefone($celTmp);

}

function alteraContato($contatoNovo){
 	global $identificacaoEntidade;
	global $bancoOO;
	$newQuery =	"UPDATE contatos".$identificacaoEntidade->getcodigo()."  SET
	contatos_nome  = '".$bancoOO->escape_string($contatoNovo->getnome())."',";
	If(strlen($contatoNovo->getaniversarioUS())>0)
		$newQuery .= "contatos_aniversario  = '".$bancoOO->escape_string($contatoNovo->getaniversarioUS())."',";
	$newQuery .= "contatos_tratamento  = '".$bancoOO->escape_string($contatoNovo->gettratamento())."',
	contatos_titulo  = '".$bancoOO->escape_string($contatoNovo->gettitulo())."',
	contatos_cargo  = '".$bancoOO->escape_string($contatoNovo->getcargo())."',
	contatos_entidade  = '".$bancoOO->escape_string($contatoNovo->getentidade())."',
	contatos_endereco  = '".$bancoOO->escape_string($contatoNovo->getendereco())."',
	contatos_cidade  = '".$bancoOO->escape_string($contatoNovo->getcidade())."',
	contatos_cep  = '".$bancoOO->escape_string($contatoNovo->getcep())."',
	contatos_estado  = '".$bancoOO->escape_string($contatoNovo->getestado())."',
	contatos_pais  = '".$bancoOO->escape_string($contatoNovo->getpais())."',
	contatos_email  = '".$bancoOO->escape_string($contatoNovo->getemail())."',
	contatos_obs  = '".$bancoOO->escape_string($contatoNovo->getobs())."',
	contatos_conjugue  = '".$bancoOO->escape_string($contatoNovo->getconjugue())."',
	contatos_conjugue_tratamento  = '".$bancoOO->escape_string($contatoNovo->getconjugue_tratamento())."',
	contatos_endereco_residencial  = '".$bancoOO->escape_string($contatoNovo->getendereco_residencial())."',
	contatos_cidade_residencial  = '".$bancoOO->escape_string($contatoNovo->getcidade_residencial())."',
	contatos_cep_residencial  = '".$bancoOO->escape_string($contatoNovo->getcep_residencial())."',
	contatos_estado_residencial  = '".$bancoOO->escape_string($contatoNovo->getestado_residencial())."',
	contatos_pais_residencial  = '".$bancoOO->escape_string($contatoNovo->getpais_residencial())."',
	contatos_classificacao  = '".$bancoOO->escape_string($contatoNovo->getclassificacao())."',
	contatos_referencia  = '".$bancoOO->escape_string($contatoNovo->getreferencia())."',
	contatos_tratamento2  = '".$bancoOO->escape_string($contatoNovo->gettratamento2())."',
	contatos_cargo2  = '".$bancoOO->escape_string($contatoNovo->getcargo2())."',
	contatos_conjugue_tratamento2  = '".$bancoOO->escape_string($contatoNovo->getconjugue_tratamento2())."',
	contatos_conjugue_tratamento3  = '".$bancoOO->escape_string($contatoNovo->getconjugue_tratamento3())."' 
	WHERE contatos_codigo = ".$bancoOO->escape_string($contatoNovo->getcodigo());
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao atualizar contato. Acione o suporte e informe a seguinte mensagem: <br>".$bancoOO->error);
	}
	$log = new logs(0,$_SESSION['codigoUsuario'],'Contatos','Alt de Contato '.$contatoNovo->getcodigo.' '.$contatoNovo->getnome(),$newQuery,date('Ymd'),date('His'));
	incluiLog($log);
}

function telaContatos($codigo){
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
	$sRetorno .= '<br><input type="button" class="button" name="mais" value="Mais..." onclick="altera2('.$contato->getcodigo().')">';
	$sRetorno .= '</div>';
//<a href="#dialog" name="modal">Janela Modal Simples</a>

	return $sRetorno;
}

function dadosContatos($codigo){
	$nomeTmp = '';
	if($codigo!=0){
		$contato = buscaContatoPorCodigo($codigo);
	}else{
		$contato = contatoEmBranco();
	}
	
	$sRetorno  = '<div id="telinhaFodona">';
	$sRetorno .= '<form name="dados" action="inicio.php" method="post" id="formContatos">';
	$sRetorno .= '<input type="hidden" name="rotina" value="contatos">';
	$sRetorno .= '<input type="hidden" name="acao"   value="'.($codigo==0?'incluir':'alterar').'">';
	$sRetorno .= '<fieldset>';
	$sRetorno .= '<legend Align="left">Dados Gerais:</legend>';
	//$sRetorno .= '<label for="codigo">'.htmlentities('C?digo').':</label>';
	$sRetorno .= '<input type="hidden" name="codigo" id="codigo" value="'.$contato->getcodigo().'"/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="nome">'.htmlentities('Nome').':</label>';
	$sRetorno .= '<input type="text" name="nome" id="nome" value="'.htmlspecialchars($contato->getnome()).'" maxlength=150 size=100/>';
	$sRetorno .= '<br>';
	
	$sRetorno .= '<div '.($codigo>0?'style="display:none"':'').'>';

	$sRetorno .= '<label for="telefone">'.htmlentities('Telefone').':</label>';
	$sRetorno .= '<input type="text" name="telefone" id="telefone"'.($codigo>0?'readonly="readonly"':'').' value="'.$contato->gettelefone().'" maxlength=50 size=30/>';

	$sRetorno .= '<label for="celular">'.htmlentities('Celular').':</label>';
	$sRetorno .= '<input type="text" name="celular" id="celular"  '.($codigo>0?'readonly="readonly"':'').' value="'.$contato->getcelular().'" maxlength=50 size=30/>';
	$sRetorno .= '<br>';

	$sRetorno .= '</div>';

	$sRetorno .= '<label for="tratamento">'.htmlentities('Tratamento').':</label>';
	$sRetorno .= '<input type="text" name="tratamento" id="tratamento"  value="'.$contato->gettratamento().'" maxlength=80 size=25/>';

	$sRetorno .= '<label for="tratamento2">'.htmlentities('2� Tratamento').':</label>';
	$sRetorno .= '<input type="text" name="tratamento2" id="tratamento2"  value="'.$contato->gettratamento2().'" maxlength=80 size=25/>';

	$sRetorno .= '<label for="aniversario">'.htmlentities('Anivers�rio').':</label>';
	$sRetorno .= '<input type="text" name="aniversario" id="aniversario" class="mask-data" value="'.$contato->getaniversarioUK().'" maxlength=10 size=10/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="titulo">'.htmlentities('T�tulo').':</label>';
	$sRetorno .= '<input type="text" name="titulo" id="titulo" value="'.$contato->gettitulo().'" maxlength=40 size=25/>';

	$sRetorno .= '<label for="cargo">'.htmlentities('Cargo').':</label>';
	$sRetorno .= '<input type="text" name="cargo" id="cargo" value="'.$contato->getcargo().'" maxlength=60 size=25/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="entidade">'.htmlentities('Entidade').':</label>';
	$sRetorno .= '<input type="text" name="entidade" id="entidade" value="'.$contato->getentidade().'" maxlength=60 size=40/>';

	$sRetorno .= '<label for="cargo2">'.htmlentities('2� Cargo').':</label>';
	$sRetorno .= '<input type="text" name="cargo2" id="cargo2" value="'.$contato->getcargo2().'" maxlength=60 size=25/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="endereco">'.htmlentities('Endere�o').':</label>';
	$sRetorno .= '<input type="text" name="endereco" id="endereco" value="'.$contato->getendereco().'" maxlength=120 size=100/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="cidade">'.htmlentities('Cidade').':</label>';
	$sRetorno .= '<input type="text" name="cidade" id="cidade" value="'.$contato->getcidade().'" maxlength=40 size=25/>';

	$sRetorno .= '<label for="cep">'.htmlentities('CEP').':</label>';
	$sRetorno .= '<input type="text" name="cep" id="cep" value="'.$contato->getcep().'" maxlength=30 size=15/>';

	$sRetorno .= '<label for="estado">'.htmlentities('Estado').':</label>';
	$sRetorno .= '<input type="text" name="estado" id="estado" value="'.$contato->getestado().'" maxlength=3 size=2/>';

	$sRetorno .= '<label for="pais">'.htmlentities('Pa�s').':</label>';
	$sRetorno .= '<input type="text" name="pais" id="pais" value="'.$contato->getpais().'" maxlength=20 size=20/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="email">'.htmlentities('E-Mail').':</label>';
	$sRetorno .= '<input type="text" name="email" id="email" value="'.$contato->getemail().'" maxlength=80 size=80/>';

	$sRetorno .= '</fieldset>';

	$sRetorno .= '<fieldset>';
	$sRetorno .= '<legend Align="left">'.htmlentities('Dados Residenciais').':</legend>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="conjugue">'.htmlentities('Conjugue').':</label>';
	$sRetorno .= '<input type="text" name="conjugue" id="conjugue" value="'.$contato->getconjugue().'" maxlength=150 size=100/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="conjugue_tratamento">'.htmlentities('Trat. Conjugue').':</label>';
	$sRetorno .= '<input type="text" name="conjugue_tratamento" id="conjugue_tratamento" value="'.$contato->getconjugue_tratamento().'" maxlength=80 size=25/>';

	$sRetorno .= '<label for="conjugue_tratamento2">'.htmlentities('2� Tratamento').':</label>';
	$sRetorno .= '<input type="text" name="conjugue_tratamento2" id="conjugue_tratamento" value="'.$contato->getconjugue_tratamento2().'" maxlength=80 size=25/>';

	$sRetorno .= '<label for="conjugue_tratamento3">'.htmlentities('3� Tratamento').':</label>';
	$sRetorno .= '<input type="text" name="conjugue_tratamento3" id="conjugue_tratamento" value="'.$contato->getconjugue_tratamento3().'" maxlength=80 size=25/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="endereco_residencial">'.htmlentities('Endere�o').':</label>';
	$sRetorno .= '<input type="text" name="endereco_residencial" id="endereco_residencial" value="'.$contato->getendereco_residencial().'" maxlength=120 size=100/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="cidade_residencial">'.htmlentities('Cidade').':</label>';
	$sRetorno .= '<input type="text" name="cidade_residencial" id="cidade_residencial" value="'.$contato->getcidade_residencial().'" maxlength=40 size=25/>';

	$sRetorno .= '<label for="cep_residencial">'.htmlentities('CEP').':</label>';
	$sRetorno .= '<input type="text" name="cep_residencial" id="cep_residencial" value="'.$contato->getcep_residencial().'" maxlength=30 size=15/>';

	$sRetorno .= '<label for="estado_residencial">'.htmlentities('Estado').':</label>';
	$sRetorno .= '<input type="text" name="estado_residencial" id="estado_residencial" value="'.$contato->getestado_residencial().'" maxlength=3 size=2/>';

	$sRetorno .= '<label for="pais_residencial">'.htmlentities('Pa�s').':</label>';
	$sRetorno .= '<input type="text" name="pais_residencial" id="pais_residencial" value="'.$contato->getpais_residencial().'" maxlength=20 size=20/>';
	$sRetorno .= '</fieldset>';
	$sRetorno .= '<br>';
	$sRetorno .= '<fieldset>';
	$sRetorno .= '<label for="obs">'.htmlentities('Observa��es').':</label>';
	$sRetorno .= '<textarea name="obs" id="obs" wrap="on" rows="3" cols="100">'.$contato->getobs().'</textarea>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="classificacao">'.htmlentities('Classifica��o').':</label>';
	$sRetorno .= '<textarea name="classificacao" id="classificacao" wrap="on" rows="3" cols="100">'.$contato->getclassificacao().'</textarea>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="referencia">'.htmlentities('Refer�ncia').':</label>';
	$sRetorno .= '<textarea name="referencia" id="referencia" wrap="on" rows="3" cols="100">'.$contato->getreferencia().'</textarea>';
	$sRetorno .= '<br>';
	$sRetorno .= '<input type="button" class="button" name="vai" value="Gravar" onclick="enviaFormContatos()">';
	if($codigo != 0)
		$sRetorno .= '<input type="button" class="button" name="excluir" value="Excluir Contato" onclick="excluiContato()">';
	$sRetorno .= '</fieldset>';

	$sRetorno .= '</form>';
	
	$sRetorno .= '</div>';

	return $sRetorno;
}

function buscaContatoPorAniversariante($dataProcura){
	return "";
}

function excluiContato($contato){
	global $bancoOO,$identificacaoEntidade;
	$contato = buscaContatoPorCodigo($contato);
	if(is_int($contato)){
		return $contato;
	}
	//Deletando os telefones....
	$telefones = buscaTelefonePorContato($contato->getcodigo(),true);
	foreach ($telefones as $i){
		excluiTelefone($i->getcodigo());		
	}
	//Deletando o contato:
	$sQuery = "delete from contatos".$identificacaoEntidade->getcodigo()." where contatos_codigo=".$contato->getcodigo();
	$res = $bancoOO->query($sQuery);
	if(!$res){
		Die("Falha ao excluir contato. Entre em contato com o suporte e descreva o erro abaixo:<br>".$bancoOO->error);
	}
	$log = new logs(0,$_SESSION['codigoUsuario'],"Contatos","Exc de Contato ".$contato->getcodigo()." ".$contato->getnome(),$sQuery,Date("Ymd"),Date("His"));
	incluiLog($log);
	return 1;
}

function contatoEmBranco(){
	$retorno = new contatos('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
	return $retorno;
}

function exportaTxtContatos(){
	echo 'entrei em exportaTxtContatos';
	global $bancoOO;
	global $identificacaoEntidade;
	$newQuery = "select contatos_nome,contatos_email from contatos".$identificacaoEntidade->getCodigo();
	$resultado = $bancoOO->query($newQuery);
	$fileHandler = false;
	while($linha = $resultado->fetch_row()){
		if(!$fileHandler){
			$fileHandler = fopen('tmp\\listaContatos.csv','wt');
		}
		fwrite($fileHandler,$linha[0].','.$linha[1].'\n');
	}
	if($fileHandler){
		fclose($fileHandler);
	}
	//header('tmp\\listaContatos.csv');
}
 
?>
