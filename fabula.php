<?php

	/**
	 * 
	 * 
	 * @author joga Jose Gaytan <jomanetos@gmail.com>
	 *
	 */
	session_start();
	
	require_once 'clases/factory.php';
	
	// 1.788888889   810.366666667 453
	// 19.444444444  810.666666648 42
	class pista{
		
		protected $_arr_animales	=	array();
		protected $_tiempo_trans	=	0;
		protected $_arr_distan		=	array();
		protected $_segundo_sleep	=	0;
		
		protected $_arr_request		=	array(	'error'	=>	'',	'posicion_1'	=>	0,	'posicion_2'	=>	0,	
												'dormido1'	=>	FALSE,	'dormido2'	=>	FALSE	);
		
		CONST TIEMPO_META_NOA		=	448;
		CONST TIEMPO_META_A			=	42;
		
		public function __construct(	$tiempo_sleep	){
			
			array_push(	$this->_arr_animales,	factory::tortuga()	);
			array_push(	$this->_arr_animales,	factory::liebre()	);
			
			$this->_segundo_sleep	=	$tiempo_sleep;
			
		}
		
		public function set_tiempo(	$segundo	){
			
			$this->_tiempo_trans	=	$segundo;
			
		}
		
		public function posiciones_animales(	array	$arr_dist	){
			
			$animal_arrog	=	NULL;
			$pos			=	0;
			$this->_get_animal(	$animal_arrog,	$pos	);
			$dist_arrogante	=	$arr_dist[$pos];
			
			$animal_noarrog	=	NULL;
			$posnoa			=	0;
			$this->_get_animal(	$animal_noarrog,	$posnoa,	FALSE	);
			$dist_noarrogante	=	$arr_dist[$posnoa];
			
			if (	@$_SESSION['dormir']	)
				$animal_arrog->duerme();
			else
				$animal_arrog->despierta();
			
			
			$this->_arr_request['posicion_1']	=	$animal_noarrog->get_corre_en_mxs()	*	$this->_tiempo_trans;
		
			if (	$this->_tiempo_trans	==	$this->_segundo_sleep	||	$animal_arrog->dormido()	){
				$this->_arr_request['posicion_2']	=	$dist_arrogante;
				$animal_arrog->duerme();
				$_SESSION['dormir']	=	$animal_arrog->dormido();
				$_SESSION['tiempo_arrogante']	=	$this->_segundo_sleep;
			}else
				if (	$this->_tiempo_trans	<	$this->_segundo_sleep	)
					$this->_arr_request['posicion_2']	=	$animal_arrog->get_corre_en_mxs()	*	$this->_tiempo_trans;
			else{
				$_SESSION['tiempo_arrogante']	=	isset(	$_SESSION['tiempo_arrogante']	)
														?	$_SESSION['tiempo_arrogante']	+	1
														:	$this->_segundo_sleep	+	1;
				$this->_arr_request['posicion_2']	=	$animal_arrog->get_corre_en_mxs()	*	$_SESSION['tiempo_arrogante'];
			}
		
		
			$this->_arr_request['dormido1']			=	$animal_noarrog->dormido();
			$this->_arr_request['dormido2']			=	$animal_arrog->dormido();
				
			if (	$this->_tiempo_trans	==	self::TIEMPO_META_NOA	){
				$animal_arrog->despierta();
				$_SESSION['dormir']	=	$animal_arrog->dormido();
			}
				
		}
		
		protected function _get_animal(	&$obj,	&$pos,	$arrogante	=	TRUE	){
			
			foreach (	$this->_arr_animales	as	$indice	=>	$animal	)
				if (	$animal->get_es_arrogante()	==	$arrogante	){
					$obj	=	$animal;
					$pos	=	$indice;
					break;
				}
		}
		
		public function get_request(){
			
			return $this->_arr_request;
			
		}
		
	}
	
	
	$tiempo	=	$_REQUEST['segundo']	?	$_REQUEST['segundo']	:	0;
	$dt		=	$_REQUEST['dt']			?	$_REQUEST['dt']			:	0;
	$dl		=	$_REQUEST['dl']			?	$_REQUEST['dl']			:	0;
	$ssleep	=	$_REQUEST['ssleep']		?	$_REQUEST['ssleep']		:	0;
	
	$pista	=	new	pista(	$ssleep	);
	$pista->set_tiempo(	$tiempo	);
	$pista->posiciones_animales(	array(	$dt,	$dl	)	);
	
	echo json_encode(	$pista->get_request()	);
	die;
	
	
	
	
	
	
	
	
	
	
	
	