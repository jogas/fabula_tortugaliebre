<?php 
	/**
	 * 
	 * 
	 * @author joga Jose Gaytan <jomanetos@gmail.com>
	 *
	 */
	session_start();

	$_SESSION['dormir']	=	FALSE;
	$_SESSION['tiempo_arrogante']	=	0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />
	<script type="text/javascript" src="libs/jquery.js"></script>
	
	<title>Simulación - Fábula Tortuga y la Liebre</title>
	
</head>
<style>
<!-- 
	.libre{
		position : relative;
		width:	80px;
	}
	.pista{
		width: 810px;
		border-left: 3px solid #000;
	}
-->
</style>
<script language="javascript" type="text/javascript">

	var	continua	=	true;
	const intervalo	=	1000;
	const dist_meta	=	810;
	const tiempo_meta=	460;
	var psdo_segundo=	1;
	var segundo_sleep=	0;
	var timeouts = [];

	var seg_max		=	37;
	var seg_min		=	2;
	
	function actualizar_carrera(){

		$('#tiempo').html('Tiempo: '+psdo_segundo+' segundos.');
		$('#tiempo_dormido').html('Tiempo donde se dormirá la liebre: '+segundo_sleep+' segundos.');
		
		dist_tor	=	parseFloat(	$('#tortuga').css('left')	);
		dist_lieb	=	parseFloat(	$('#liebre').css('left')	);
		$.ajax({
				async:false, 
				url: "fabula.php?segundo="	+	((intervalo*psdo_segundo)/1000)	
						+	"&dt="	+	dist_tor	+	"&dl="	+	dist_lieb
						+	"&ssleep="	+	segundo_sleep, 
				success: function(result){
					datos	=	JSON.parse(result);
					if (	datos.posicion_1	!=	undefined	&&	datos.posicion_2	!=	undefined	){
						$('#tortuga').css(	'left',	datos.posicion_1	+	'px'	);
						$('#liebre').css(	'left',	datos.posicion_2	+	'px'	);
						if (	datos.posicion_1	>=	dist_meta	||	datos.posicion_2	>=	dist_meta	)
							continua	=	false;
					}
					
	    		}
			});
		
		if (	continua	){
			timeouts.push(	setTimeout(	'actualizar_carrera()',	intervalo	)	);
			psdo_segundo++;
			if (	psdo_segundo	>=	tiempo_meta	)
				continua	=	false;
		}
	}


	function go_start(){
		$('#tortuga').css(	'left',	'0px'	);
		$('#liebre').css(	'left',	'0px'	);
		psdo_segundo	=	1;
		continua		=	true;

		segundo_sleep 	= 	Math.random() * (seg_max - seg_min);
		segundo_sleep	=	Math.round(	segundo_sleep + seg_min );

		for (var i = 0; i < timeouts.length; i++) {
		    clearTimeout(	timeouts[i]	);
		}
		timeouts = [];
		timeouts.push(	setTimeout(	'actualizar_carrera()',	1000	)	);
	}


</script>
<body>
<div id='pista' class="pista">
	<img src="images/tortuga.png" id='tortuga' class="libre"/>
	<br />
	<img src="images/liebre.png" id='liebre' class="libre"/>
</div>
<div style="border-right: 3px solid rgb(0, 0, 0); width: 80px; top: 0px; position: absolute; left: 819px; height: 200px;"></div>
<br />
<br />
<div id='tiempo'></div>
<div id='tiempo_dormido'></div>
<div id='tiempo_despierta'>Tiempo donde se despertará la liebre: 448 segundos.</div>
<br />
<br />
<center>
	<input type="button" id='start' onclick="js:go_start();" value='Comenzar'/>
</center>

</body>
</html>



