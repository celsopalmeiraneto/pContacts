<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of perfilCadastro
 *
 * @author Celso Neto
 * Desenvolvido por Celso Palmeira dos Santos Neto
 * E-mail:  xxxxxxx@celsoneto.com
 * Tel.: (xx) xxxx-xxxx
 * Criado em: 
 * 
 */
class PerfilCadastro {
	//put your code here
	protected $opcoes;
	
	function __construct() {
		$this->opcoes[]= new Perfil(1,"Inicio"                 , "inicio.php", "","");
		$this->opcoes[]= new Perfil(2,"Contatos"               ,"inicio.php?goTo=contatos", "","");
		$this->opcoes[]= new Perfil(3,"Telefonemas"            ,"inicio.php?goTo=telefonemas", "","");
		$this->opcoes[]= new Perfil(4,htmlentities("Usu�rios") ,"inicio.php?goTo=usuarios", "","");
		$this->opcoes[]= new Perfil(7,htmlentities("Log") ,"inicio.php?goTo=logs", "","");
		$this->opcoes[]= new Perfil(8,htmlentities("Back-Up") ,"inicio.php?goTo=backup", "","");
		//$this->opcoes[]= new Perfil(5,"Sugest", "inicio.php?goTo=email", "","");
		$this->opcoes[]= new Perfil(6,"Sair","#","",'onclick="Sair()"');
	}
	
	/**
	 *
	 * @param array $modulosUsuario
	 * Array com cujos indices ser�o os menus que o usu�rio tem acesso.
	 * @return String
	 * Html com menu j� aplicado o perfil de acesso como uma lista html.
	 */
	function toStringMenu($modulosUsuario){
		$sReturn  = "<ul>";
		foreach($this->opcoes as $i){
			if(isset($modulosUsuario[$i->getId()]))
				$sReturn .= $i->toStringMenu();
		}
		$sReturn .= "</ul>";
		//htmlentities($string);
		return $sReturn;
	}
	
	function toStringCheckBox(usuarios $usuario){
		$sReturn = "";
		foreach($this->opcoes as $i){
			$modulos = $usuario->getModulos();
			$checked = " ";
			if(isset($modulos[$i->getId()]))
				$checked = 'checked="checked"';  
			$sReturn .= '<input type="checkbox" name="perf['.$i->getId().']" id="perfil'.$i->getId().'" value="'.$i->getId().'" '.$checked.'>';
			$sReturn .= '<label for="perfil'.$i->getId().'">'.($i->getExibicao()).'</label><br>';
		}
		return $sReturn;
	}
	
	function haOpcaoId($id){
		foreach($this->opcoes as $i){
			if($i->getId()==$id)
				return true;
		}
		return false;
	}
}

?>
