<?php
/*
 * Created on 07/01/2011
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 * Cadastro de Usu�rios
 */
 
function cadastroTelefones($codigo){
	global $identificacaoEntidade;
	$sRetorno = '';

 	$display[0][0] = htmlentities('Descri��o');
	$display[0][1] = 'telefones_descricao';
	$display[0][2] = '150';
	$display[0][3] = 'true';
	$display[0][4] = 'left';

	$display[1][0] = htmlentities('N�mero');
	$display[1][1] = 'telefones_numero';
	$display[1][2] = '100';
	$display[1][3] = 'true';
	$display[1][4] = 'left';

 	
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
	$search[0][0] = htmlentities('Descri��o');
	$search[0][1] = 'telefones_descricao';
	$search[0][2] = 'true';
 	
	$order     = 'telefones_descricao';
	$sortOrder = 1;
	$title     = htmlentities("Telefones");
	$width     = 500;
	$height    = 100;
	$internId  = $display[0][1];
	$table     = 'telefones'.$identificacaoEntidade->getcodigo();
	$onClick   = null;
	$exibeBotoes = false;
	$exibeProcura = false;
	$filtro[0] = 'telefones_contato';
	$filtro[1] = ''.$codigo;

	$gridUsuarios = new flexigrid('post2.php',$display,$buttons,$search,$order,$sortOrder,$title,$width,$height,$internId,$table,$onClick,$exibeBotoes,$exibeProcura,$filtro);
	$sRetorno = $gridUsuarios->toSring();
	return $sRetorno;
}

/**
 * A fun�ao matrizTelefonesPorContato retorna uma matriz de string's com dados do telefone.
 */
function matrizTelefonesPorContato($codigo){
	global $identificacaoEntidade;
	global $bancoOO;
	$retorno = null;
	$newQuery = "SELECT telefones_descricao,telefones_numero,telefones_codigo FROM telefones".$identificacaoEntidade->getcodigo()." WHERE telefones_contato=".$codigo;
	$resultado = $bancoOO->query($newQuery);
	$cont01 = 0;
	$retorno[$cont01][0] = '<b><a href="#" onclick="telefone('.$codigo.',0)">'.htmlentities("Adicionar Telefone").'</a></b>';
	$cont01++;
	if($resultado->num_rows==0){
		$retorno[$cont01][0] = '<b>'.htmlentities('Contato n�o h� telefones.').'<b>'; 
	}else{
		while($row = $resultado->fetch_assoc()){
			$cont02=0;
			foreach($row as $i){
				//echo var_dump($i).'<br>';
				if($cont02==02){
					$retorno[$cont01][$cont02] = '<b><a href="#" onclick="telefone('.$codigo.','.$row['telefones_codigo'].')">Editar</a></b>';
				}else{
					$retorno[$cont01][$cont02] = $i;
				}
				$cont02++;
			}
			$cont01++;						
		}
	}
	return $retorno;
} 

function buscaTelefonePorCodigo($codigoProcura){
	global $bancoOO,$identificacaoEntidade;
	$newQuery = "select * from telefones".$identificacaoEntidade->getcodigo()."  where telefones_codigo=".$codigoProcura;
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		return -1;//N�o encontrado.
	}
	$vetor = $resultado->fetch_assoc();

	$retorno = new telefones($vetor['telefones_codigo'],
							 $vetor['telefones_contato'],
							 $vetor['telefones_numero'],
							 $vetor['telefones_descricao'],
							 $vetor['telefones_special_rec']);
	return $retorno;                        
}

/**
 * N�o est� pronta a fun��o abaixo.
 * 
 */
function buscaTelefonePorContato($codigoProcura,$retornaTodos= null){
	global $bancoOO,$identificacaoEntidade;
	$newQuery = "select * from telefones".$identificacaoEntidade->getcodigo()."  where telefones_contato=".$codigoProcura;
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		return -1;//N�o encontrado.
	}
	if(!$retornaTodos){
		$vetor = $resultado->fetch_assoc();
	/*
	*  
		protected $codigo;
		protected $contato;
		protected $numero;
		protected $descricao;

	* */

		$retorno = new telefones($vetor['telefones_codigo'],
								$vetor['telefones_contato'],
								$vetor['telefones_numero'],
								$vetor['telefones_descricao'],
								$vetor['telefones_special_rec']);
		$consulta->fechaConexao();                        
	}else{
		while($row = $resultado->fetch_assoc()){
			$aux = new telefones($row['telefones_codigo'],
									$row['telefones_contato'],
									$row['telefones_numero'],
									$row['telefones_descricao'],
									$row['telefones_special_rec']);
			$retorno[] = $aux;
		}
	}
	return $retorno;                        
}

function incluiTelefone($telefoneNovo){
	global $bancoOO,$identificacaoEntidade;
	$contato = buscaContatoPorCodigo($telefoneNovo->getcontato());
	$newQuery = "INSERT INTO telefones".$identificacaoEntidade->getcodigo()." 
		(telefones_codigo,
		telefones_contato,
		telefones_numero,
		telefones_descricao,
		telefones_special_rec)
		VALUES(".
		$bancoOO->escape_string($telefoneNovo->getcodigo()).",".
		$bancoOO->escape_string($telefoneNovo->getcontato()).",".
		"'".$bancoOO->escape_string($telefoneNovo->getnumero())."',".
		"'".$bancoOO->escape_string($telefoneNovo->getdescricao())."',".
		$bancoOO->escape_string(($telefoneNovo->getspecial_rec()==true?'true':'false')).")";
	
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao registrar telefone. Acione o suporte!");
	}
	$log = new logs(0,$_SESSION['codigoUsuario'],'Telefones','Inc de Telefone '.$contato->getnome().' '.$telefoneNovo->getdescricao().' '.$telefoneNovo->getnumero(),$newQuery,date('Ymd'),date('His'));
	incluiLog($log);
}

function alteraTelefone($telefoneNovo){
	global $bancoOO,$identificacaoEntidade;
	$contato = buscaContatoPorCodigo($telefoneNovo->getcontato());
	$newQuery =	"UPDATE telefones".$identificacaoEntidade->getcodigo()."  SET
	telefones_numero  = '".$bancoOO->escape_string($telefoneNovo->getnumero())."',
	telefones_descricao  = '".$bancoOO->escape_string($telefoneNovo->getdescricao())."' 
	WHERE telefones_codigo = ".$bancoOO->escape_string($telefoneNovo->getcodigo());
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao atualizar telefone. Acione o suporte!");
	}
	$log = new logs(0,$_SESSION['codigoUsuario'],'Telefones','Alt de Telefone '.$contato->getnome().' '.$telefoneNovo->getdescricao().' '.$telefoneNovo->getnumero(),$newQuery,date('Ymd'),date('His'));
	incluiLog($log);

	if($telefoneNovo->getspecial_rec()==true){
		$newQuery = "UPDATE contatos".$identificacaoEntidade->getcodigo()."  SET " .
					"contatos_".($telefoneNovo->getdescricao()=='Telefone'?'telefone':'celular')." = '".$bancoOO->escape_string($telefoneNovo->getnumero())."' ".
					"WHERE contatos_codigo = ".$bancoOO->escape_string($telefoneNovo->getcontato());
		$resultado = $bancoOO->query($newQuery);
		if(!$resultado){
			die("Falha ao atualizar telefone. Acione o suporte!");
		}
		//$log = new logs(0,$_SESSION['codigoUsuario'],'Telefones','Alt de Telefone - Contato',$newQuery,date('Ymd'),date('His'));
		//incluiLog($log);
	}
}

function excluiTelefone($telefone){
	global $bancoOO,$identificacaoEntidade;
	$tel = buscaTelefonePorCodigo($telefone);
	if(is_int($tel))
		return -1;
	$contato = buscaContatoPorCodigo($tel->getcontato());
	$sQuery = "delete from telefones".$identificacaoEntidade->getcodigo()." where telefones_codigo=".$telefone;
	$resultado = $bancoOO->query($sQuery);
	If(!$resultado){
		Die("Falha ao deletar telefone. Entre contato com o suporte com as informacoes abaixo:<br>".$bancoOO->error);
	}
	$log = new logs(0,$_SESSION['codigoUsuario'],'Telefones','Exc de Telefone - Contato '.$tel->getcontato()." ".$contato->getnome()." ".$tel->getnumero(),$sQuery,date('Ymd'),date('His'));
	incluiLog($log);
}


function dadosTelefones($codigo,$contato){
	if($codigo!=0){
		$telefone = buscaTelefonePorCodigo($codigo);
	}else{
		$telefone = new telefones('',$contato,'','',false);
	}
	$contato  = buscaContatoPorCodigo($contato);
	

	$sRetorno  = '<div id="telinhaFodona">';
	$sRetorno .= '<form name="dados" action="inicio.php" method="post" id="formTelefones">';
	$sRetorno .= '<input type="hidden" name="rotina" value="telefones">';
	$sRetorno .= '<input type="hidden" name="acao"   value="'.($codigo==0?'incluir':'alterar').'">';

	$sRetorno .= '<fieldset>';
	$sRetorno .= '<legend Align="left">Dados Gerais:</legend>';
	$sRetorno .= '<br>';
	$sRetorno .= '<input type="hidden" name="codigo" readonly="readonly" id="codigo" value="'.$telefone->getcodigo().'" size=4/>';
	$sRetorno .= '<input type="hidden" name="contato" readonly="readonly" id="contato" value="'.$telefone->getcontato().'" size=4/>';
	$sRetorno .= '<input type="hidden" name="nomeContato" readonly="readonly" id="nomeContato" value="'.$contato->getnome().'">';
	$sRetorno .= '<input type="hidden" name="special_rec" readonly="readonly" id="special_rec" value="'.$telefone->getspecial_rec().'"/>';

	$sRetorno .= 'Contato: '.htmlentities($contato->getnome(),ENT_QUOTES,"UTF-8").'</br>';
	$sRetorno .= '<label for="numero">'.htmlentities('N�mero').':</label>';
	$sRetorno .= '<input type="text" name="numero" id="numero"  value="'.$telefone->getnumero().'" maxlength=50 size=30/>';
	$sRetorno .= '<br>';

	$sRetorno .= '<label for="descricao">'.htmlentities('Descri��o').':</label>';
	$sRetorno .= '<input type="text" name="descricao" id="descricao" '.($telefone->getspecial_rec()==true?'readonly="readonly"':'').' value="'.$telefone->getdescricao().'" maxlength=50 size=45/>';
	$sRetorno .= '<br>';


	$sRetorno .= '<input type="button" class="button" name="vai" onclick="enviaFormTelefones()" value="Gravar">';
	//S� deixa exluir se n�o for o telefone "especial" (tel1, cel1).
	if(!$telefone->getspecial_rec())
		$sRetorno .= '<input type="button" class="button" name="deleta" onclick="excluiTelefone()" value="Excluir">';
	$sRetorno .= '</fieldset>';

	$sRetorno .= '</form>';
	
	$sRetorno .= '</div>';

	return $sRetorno;
}

function telefoneEmBranco(){
	$retorno = new telefones('','','','');
	return $retorno;
}

?>
