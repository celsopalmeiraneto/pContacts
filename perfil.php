<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of perfil
 *
 * @author Celso Neto
 * Desenvolvido por Celso Palmeira dos Santos Neto
 * E-mail:  xxxxxxx@celsoneto.com
 * Tel.: (xx) xxxx-xxxx
 * Criado em: 
 * 
 */
class Perfil {
	//put your code here
	protected $id;
	protected $exibicao;
	protected $link;
	protected $obs;
	protected $aAttributes;
	
	function __construct($id, $exibicao, $link, $obs, $aAttributes) {
		$this->id = $id;
		$this->exibicao = $exibicao;
		$this->link = $link;
		$this->obs = $obs;
		$this->aAttributes = $aAttributes;
	}
	
	function toStringMenu(){
		//<li><a href="inicio.php?goTo=telefonemas">Telefonemas</a></li>
		return '<li>
					<a href="'.$this->link.'" '.
					' '.$this->aAttributes.' '
					.'>'.$this->exibicao.'</a></li>';
	}
	
	public function getId() {
		return $this->id;
	}

	public function getExibicao() {
		return $this->exibicao;
	}
	
	public function setExibicao($exibicao){
		$this->exibicao = $exibicao;
	}

	public function getLink() {
		return $this->link;
	}

	public function getObs() {
		return $this->obs;
	}

	public function getAAttributes() {
		return $this->aAttributes;
	}



	
}

?>
