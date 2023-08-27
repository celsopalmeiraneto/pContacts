<?php
/*
 * Created on 07/01/2011
 * Desenvolvido por: Celso Palmeira dos S. Neto
 * E-Mail:  xxxxxxx@celsoneto.com
 * Telefone: (xx) xxxx-xxxx
 * Cadastro de Usu�rios
 */
 
 function cadastroEntidades(){
 	$sRetorno = '';

   	$display[0][0] = 'Codigo';
 	$display[0][1] = 'entidades_codigo';
 	$display[0][2] = '40';
 	$display[0][3] = 'true';
 	$display[0][4] = 'center';

 	$display[1][0] = 'Fantasia';
 	$display[1][1] = 'entidades_fantasia';
 	$display[1][2] = '300';
 	$display[1][3] = 'true';
 	$display[1][4] = 'left';

 	$display[2][0] = 'Ativo';
 	$display[2][1] = 'entidades_ativo';
 	$display[2][2] = '30';
 	$display[2][3] = 'true';
 	$display[2][4] = 'left';
  
 	
 	if(true){  //Mais tarde aki posso inserir n�veis de acesso e talz.
 		$buttons[0][0] = 'Incluir';
		$buttons[0][1] = 'add';
		$buttons[0][2] = 'inclui';
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

 	$search[1][0] = 'Fantasia';
 	$search[1][1] = 'entidades_fantasia';
 	$search[1][2] = 'true';

 	$order     = 'entidades_fantasia';
 	$sortOrder = 1;
 	$title     = htmlentities("Cadastro de Entidades");
 	$width     = 980;
 	$height    = 255;
 	$internId  = $display[0][1];
 	$table     = 'entidades';
 	$onClick   = 'altera';
 	$exibeBotoes = true;
 	$exibeProcura = true;

 	$gridUsuarios = new flexigrid('post2.php',$display,$buttons,$search,$order,1,$title,$width,$height,$internId,$table,$onClick,$exibeBotoes,$exibeProcura,null);
 	$sRetorno = $gridUsuarios->toSring();
 	return $sRetorno;
 }
 
function buscaEntidadePorLogin($loginProcura){
	global $bancoOO;
	$newQuery = "select * from usuarios where usuarios_login='".$bancoOO->escape_string($loginProcura)."'";
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
	return $retorno;                        
}

function buscaEntidadePorCodigo($codigoProcura){
	global $bancoOO;
	$newQuery = "select * from entidades where entidades_codigo='".$bancoOO->escape_string($codigoProcura)."'";
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado)
		die($bancoOO->error);
	if($resultado->num_rows==0){
		return -1;//N�o encontrado.
	}
	$vetor = $resultado->fetch_assoc();
	$retorno = new entidades($vetor['entidades_codigo'],
							$vetor['entidades_fantasia'],
							$vetor['entidades_razao'],
							$vetor['entidades_endereco'],
							$vetor['entidades_numero'],
							$vetor['entidades_complemento'],
							$vetor['entidades_bairro'],
							$vetor['entidades_cidade'],
							$vetor['entidades_uf'],
							$vetor['entidades_cep'],
							$vetor['entidades_cpf'],
							$vetor['entidades_cnpj'],
							$vetor['entidades_email'],
							$vetor['entidades_ie'],
							$vetor['entidades_contato'],
							$vetor['entidades_telefone01'],
							$vetor['entidades_telefone02'],
							$vetor['entidades_fator_identificador'],
							$vetor['entidades_ativo']);
	return $retorno;                        
}

/**
 * function buscaEntidadePorFatorIdentificador($fatorProcura)
 * Retorna um objeto do tipo entidade buscando pelo fator �nico de cada entidade (cliente) ou inteiro -1 se n�o encontrar.
 */
function buscaEntidadePorFatorIdentificador($fatorProcura){
	global $bancoOO;
	$newQuery = "select * from entidades where entidades_fator_identificador='".$bancoOO->escape_string($fatorProcura)."'";
	$resultado = $bancoOO->query($newQuery);
	if($resultado->num_rows==0){
		return -1;//N�o encontrado.
	}
	$vetor = $resultado->fetch_assoc();
	$retorno = new entidades($vetor['entidades_codigo'],
							$vetor['entidades_fantasia'],
							$vetor['entidades_razao'],
							$vetor['entidades_endereco'],
							$vetor['entidades_numero'],
							$vetor['entidades_complemento'],
							$vetor['entidades_bairro'],
							$vetor['entidades_cidade'],
							$vetor['entidades_uf'],
							$vetor['entidades_cep'],
							$vetor['entidades_cpf'],
							$vetor['entidades_cnpj'],
							$vetor['entidades_email'],
							$vetor['entidades_ie'],
							$vetor['entidades_contato'],
							$vetor['entidades_telefone01'],
							$vetor['entidades_telefone02'],
							$vetor['entidades_fator_identificador'],
							$vetor['entidades_ativo']);
	return $retorno;                        
}

function retornaEntidadeEmBranco(){
	$retorno = new entidades('',
							'',
							'',
							'',
							"",
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							false);
	return $retorno;                        
}

function incluiEntidade($entidadeNovo){
	global $bancoOO;
	$newQuery =	"insert into entidades (entidades_codigo," .
				"entidades_fantasia," .
				"entidades_razao," .
				"entidades_endereco," .
				"entidades_numero," .
				"entidades_complemento," .
				"entidades_bairro," .
				"entidades_cidade," .
				"entidades_uf," .
				"entidades_cep," .
				"entidades_cpf," .
				"entidades_cnpj," .
				"entidades_email," .
				"entidades_ie," .
				"entidades_contato," .
				"entidades_telefone01," .
				"entidades_telefone02," .
				"entidades_ativo) ".
				"values (0,'".$bancoOO->escape_string($entidadeNovo->getfantasia())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getrazao())."',".
						"'".$bancoOO->escape_string(md5($entidadeNovo->getendereco()))."',".
						"'".$bancoOO->escape_string($entidadeNovo->getnumero())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getcomplemento())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getbairro())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getcidade())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getuf())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getcep())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getcpf())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getcnpj())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getemail())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getie())."',".
						"'".$bancoOO->escape_string($entidadeNovo->getcontato())."',".
						"'".$bancoOO->escape_string($entidadeNovo->gettelefone01())."',".
						"'".$bancoOO->escape_string($entidadeNovo->gettelefone02())."',".
						"".$bancoOO->escape_string($entidadeNovo->getativo()).")";
	$resultado = $bancoOO->query($newQuery);
	if(!$resultado){
		die("Falha ao incluir usu�rio. Acione o suporte! ".$bancoOO->error);
	}
}

function alteraEntidade($usuarioNovo,$atualizaSenha){
	global $bancoOO;
	$newQuery =	"update usuarios set ".
						"usuarios_nome = '".$bancoOO->escape_string($usuarioNovo->getnome())."'";
	if($atualizaSenha){
		$newQuery .= ", usuarios_senha = ".$bancoOO->escape_string($usuarioNovo->getsenha());
	}
	$newQuery .= " where usuarios_codigo = ".$bancoOO->escape_string($usuarioNovo->getcodigo());
	$resultado = $bancoOO->query($newQuery);
	$log = new logs(0,$_SESSION['codigoUsuario'],'Usu�rios','Inclus�o de Usu�rio',$newQuery,date('Ymd'),date('His'));
	incluiLog($log);
	if(!$resultado){
		die("Falha ao atualizar usu�rio. Acione o suporte!");
	}
}

/**
 * Fun��o geraFatorIdentificador.
 * Gera o fator que ser� utilizado para fazer valida��es de usu�rio / banco.
 * Isso para um usu�rio de uma entidade n�o acessar os dados/sistema da outra.
 */
function geraFatorIdentificador($int){
	return md5(dechex($int*17));
}

function telaEntidades($codigo){
	$nomeTmp = '';
	if($codigo!=0){
		$entidade = buscaEntidadePorCodigo($codigo);
		$fantasiaTmp = htmlspecialchars($entidade->getfantasia()).'" ';
		$razaoTmp = htmlspecialchars($entidade->getrazao()).'" ';
	}else{
		$entidade = retornaEntidadeEmBranco();
		$fantasiaTmp = htmlspecialchars($entidade->getfantasia()).'" ';
		$razaoTmp = htmlspecialchars($entidade->getrazao()).'" ';
	}
	$sRetorno  = '<div id="telinhaFodona">';
	$sRetorno .= '<form name="dados" action="administrador.php" method="post">';
	$sRetorno .= '<fieldset>';
	$sRetorno .= '<input type="hidden" name="codigo" id="codigo" value="'.($codigo==0?'':htmlspecialchars($codigo)).'">';
	$sRetorno .= '<input type="hidden" name="rotina" value="entidades">';
	$sRetorno .= '<input type="hidden" name="acao"   value="'.($codigo==0?'incluir':'alterar').'">';
	$sRetorno .= '<label for="nome">Fantasia:</label><input type="text" class="text" name="fantasia" id="fantasia" value="'.$fantasiaTmp.'" size=100 maxlenght=300><br>';
	$sRetorno .= '<label for="razao">Razao:</label><input type="text" class="text" name="razao" id="razao" size=100 maxlenght=300 value="'.$razaoTmp.'"><br>';
	$sRetorno .= '<label for="endereco">Endere&ccedil;o:</label><input type="text" class="text" name="endereco" id="endereco" size=100 maxlenght=300 value="'.$entidade->getendereco().'"><br>';
	$sRetorno .= '<label for="numero">Numero:</label><input type="text" class="text" name="numero" id="numero" size=6 maxlenght=6 value="'.$entidade->getnumero().'"><br>';
	$sRetorno .= '<label for="complemento">Complemento:</label><input type="text" class="text" name="complemento" id="complemento" size=50 maxlenght=50 value="'.$entidade->getcomplemento().'"><br>';
	$sRetorno .= '<label for="bairro">Bairro:</label><input type="text" class="text" name="bairro" id="bairro" size=80 maxlenght=80 value="'.$entidade->getbairro().'"><br>';
	$sRetorno .= '<label for="cidade">Cidade:</label><input type="text" class="text" name="cidade" id="cidade" size=80 maxlenght=80 value="'.$entidade->getcidade().'"><br>';
	$sRetorno .= '<label for="uf">Uf:</label><input type="text" class="text" name="uf" id="uf" size=4 maxlenght=4 value="'.$entidade->getuf().'"><br>';
	$sRetorno .= '<label for="cep">Bairro:</label><input type="text" class="text" name="cep" id="cep" size=15 maxlenght=15 value="'.$entidade->getcep().'"><br>';
	$sRetorno .= '<label for="cpf">CPF:</label><input type="text" class="text" name="cpf" id="cpf" size=15 maxlenght=15 value="'.$entidade->getcpf().'"><br>';
	$sRetorno .= '<label for="cnpj">CNPJ:</label><input type="text" class="text" name="cnpj" id="cnpj" size=19 maxlenght=19 value="'.$entidade->getcnpj().'"><br>';
	$sRetorno .= '<label for="email">e-mail:</label><input type="text" class="text" name="email" id="email" size=100 maxlenght=300 value="'.$entidade->getemail().'"><br>';
	$sRetorno .= '<label for="ie">ie:</label><input type="text" class="text" name="ie" id="ie" size=40 maxlenght=40 value="'.$entidade->getie().'"><br>';
	$sRetorno .= '<label for="contato">contato:</label><input type="text" class="text" name="contato" id="contato" size=80 maxlenght=80 value="'.$entidade->getcontato().'"><br>';
	$sRetorno .= '<label for="telefone01">telefone01:</label><input type="text" class="text" name="telefone01" id="telefone01" size=45 maxlenght=45 value="'.$entidade->gettelefone01().'"><br>';
	$sRetorno .= '<label for="telefone02">telefone02:</label><input type="text" class="text" name="telefone02" id="telefone02" size=45 maxlenght=45 value="'.$entidade->gettelefone02().'"><br>';
	$sRetorno .= '<label for="ativo">'.htmlentities('Ativo?').'</label> <input type="checkbox" name="ativo" id="ativo" '.($entidade->getativo()==true?'checked="checked"':'').' value="x" />';
	$sRetorno .= '<input type="submit" class="button" name="vai" value="'.($codigo==0?'Incluir':'Alterar').'">';
	$sRetorno .= '</fieldset>';
	$sRetorno .= '</form>';
	$sRetorno .= '</div>';
	return $sRetorno;
}
 
?>
