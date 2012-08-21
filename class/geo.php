<?php
/**
 * Classe para recuperação dos GeoNames.
 *
 * @author Alan Raphael <alan@xr1.com.br>
 * @version 1.0
 */

class GEO{

	private $bd_diretorio = '/GEO/geo'; # Diretório com a base de dados.
	private $idioma;
	private $ext = '.json'; # Extensão da base de dados.

	/**
	 * @param string $l recebe a sigla do idioma correspondente ao que está no nome da base de países.
	 */
	public function __construct($l){
		$this->idioma = $l;
		$this->bd_diretorio = $_SERVER['DOCUMENT_ROOT'].$this->bd_diretorio;
	}

	/**
	 * @param string $dir
	 * @return string
	 */
	private function dados($dir){
		return file_get_contents($dir);
	}

	/**
	 * Obtém os países.
	 *
	 * @return array
	 */
	public function paises(){
		$dir = $this->bd_diretorio.'/countries/paises_'.$this->idioma.$this->ext;
		$bd = $this->dados($dir);
		$bd = json_decode($bd);
		asort($bd);
		return $bd;
	}

	/**
	 * Recupera os estados do país selecionado.
	 *
	 * @param string $pais recebe o código ISO do país.
	 * @return array
	 */
	public function estados($pais){
		if(!empty($pais)){
			$pais = strtoupper($pais);
			$dir = $this->bd_diretorio.'/states/'.$pais.$this->ext;
			if(file_exists($dir)){
				$bd = $this->dados($dir);
				$estados = json_decode($bd, true);
				asort($estados);
				return $estados;
			}
		}
	}

	/**
	 * Recupera as cidades correspondente ao estado do país selecionado.
	 *
	 * @param string $pais recebe o código ISO do país.
	 * @param mixed $chave_estado recebe a chave correspondente ao estado do país.
	 * @return array
	 */
	public function cidades($pais, $chave_estado){
		if(!empty($pais) && !empty($chave_estado)){
			$pais = strtoupper($pais);
			$chave_estado = strtoupper($chave_estado);
			$dir = $this->bd_diretorio.'/cities/'.$pais.'/'.$chave_estado.$this->ext;
			if(file_exists($dir)){
				$bd = $this->dados($dir);
				$cidades = json_decode($bd);
				asort($cidades);
				return $cidades;
			}
		}
	}
}
?>