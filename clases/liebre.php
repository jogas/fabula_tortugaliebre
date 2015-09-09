<?php

	/**
	 * 
	 * 
	 * @author joga Jose Gaytan <jomanetos@gmail.com>
	 *
	 */
	require_once 'animal.php';

	class liebre extends animal{
		
		public function __construct(){
			
			$this->familia	=	"leporidos";
			$this->vel_promedio_kmxh	=	70;
			$this->set_es_arrogante();
		}
		
	}