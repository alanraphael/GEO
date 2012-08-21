<?php
require("../class/geo.php");
require("../class/form_geo.php");

$form = new form_geo;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GEO</title>

<style type="text/css">
body{font-family:Verdana, Geneva, sans-serif;}
#form{
	width:500px;
	margin:0 auto;
	background-color:#F6F6F6;
	padding:15px;
	font-size:14px;
	border:1px solid #666;
}
</style>

</head>

<body>

<div id="form">
	<form method="get" action="">
		<table>
			<tr><td>Selecione o país:</td><td><?php echo $form->form_paises(); ?></td></tr>
			<?php
			if(isset($_GET['country'])){
				if($lista = $form->form_estados($_GET['country']))
					echo '<tr><td>Selecione o estado:</td><td>'.$lista.'</td></tr>';
			}
			
			if(isset($_GET['state'])){
				if($lista = $form->form_cidades($_GET['country'], $_GET['state']))
			 		echo '<tr><td>Selecione a cidade:</td><td>'.$lista.'</td></tr>';
			}
			?>

			<tr><td>&nbsp;</td><td><input type="submit" value="Próximo &gt;&gt;" /></td></tr>
		</table>
	</form>

	<?php 
	if(isset($_GET['city'])){
		$resul = $form->resultado($_GET['country'], $_GET['state'], $_GET['city']);
		echo '<div id="resul"><strong>Localidade:</strong> '.$resul['cidade'].', '.$resul['estado'].', '.$resul['pais'].'</div>';
	}
	?>
</div>

</body>
</html>
