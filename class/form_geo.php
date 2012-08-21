<?php
/**
 * Classe para geração das listas.
 *
 * @author Alan Raphael <alan@xr1.com.br>
 * @version 1.0
 */

class form_geo extends GEO{

	public function __construct(){
		parent::__construct('PT-BR');
	}

	/**
	 * @return string
	 */
	public function form_paises(){
		$seleciona = false;
		if(isset($_REQUEST['country']))
			$seleciona = $_REQUEST['country'];

		$form = '<select name="country" id="country">';
		foreach($this->paises() as $info){
			if($seleciona == $info->iso)
				$marcacao = ' selected="selected"';
			else
				$marcacao = '';

			$form .= '<option value="'.$info->iso.'"'.$marcacao.'>'.$info->pais.'</option>';
		}
		$form .= '</select>';
		return $form;
	}

	/**
	 * @param string $pais recebe o código ISO do país.
	 * @return string
	 */
	public function form_estados($pais){
		if($estados = $this->estados($pais)){
			$seleciona = false;
			if(isset($_REQUEST['state']))
				$seleciona = $_REQUEST['state'];

			$form = '<select name="state" id="state">';
			foreach($estados as $chave => $nome){
				if($seleciona == $chave)
					$marcacao = ' selected="selected"';
				else
					$marcacao = '';

				$form .= '<option value="'.$chave.'"'.$marcacao.'>'.$nome.'</option>';
			}
			$form .= '</select>';
			return $form;
		}
	}

	/**
	 * @param string $pais recebe o código ISO do país.
	 * @param mixed $chave_estado recebe a chave correspondente ao estado do país.
	 * @return string
	 */
	public function form_cidades($pais, $chave_estado){
		if($cidades = $this->cidades($pais, $chave_estado)){
			$seleciona = false;
			if(isset($_REQUEST['city']))
				$seleciona = $_REQUEST['city'];

			$form = '<select name="city" id="city">';
			foreach($cidades as $chave => $nome){
				if($seleciona == $chave)
					$marcacao = ' selected="selected"';
				else
					$marcacao = '';

				$form .= '<option value="'.$chave.'"'.$marcacao.'>'.$nome.'</option>';
			}
			$form .= '</select>';
			return $form;
		}
	}

	/**
	 * Retorna os nomes referente aos códigos.
	 *
	 * @param string $pais recebe o código ISO do país.
	 * @param mixed $chave_estado recebe a chave correspondente ao estado do país.
	 * @param integer $chave_cidade recebe a chave correspondente a cidade do estado.
	 * @return array
	 */
	public function resultado($iso_pais, $chave_estado, $chave_cidade){
		$paises = $this->paises();
		foreach($paises as $info){
			if($info->iso == $iso_pais){
				$nome_pais = $info->pais;
				break;
			}
		}

		if($estado = $this->estados($iso_pais))
			$estado = $estado[$chave_estado];
		else
			$estado = NULL;

		if($cidade = $this->cidades($iso_pais, $chave_estado))
			$cidade = $cidade[$chave_cidade];
		else
			$cidade = NULL;

		return array('pais' => $nome_pais, 'estado' => $estado, 'cidade' => $cidade);
	}
}
?>