<?php

	/**
	 * 
	 * 
	 * @author joga Jose Gaytan <jomanetos@gmail.com>
	 *
	 */
	require_once 'animal.php';

	class tortuga extends animal{
		
		public function __construct(){
			
			$this->familia	=	"estudinidae";
			$this->vel_promedio_kmxh	=	6.44;
			
		}
		
	}