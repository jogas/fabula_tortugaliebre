<?php

	/**
	 * 
	 * 
	 * @author joga Jose Gaytan <jomanetos@gmail.com>
	 *
	 */

	 abstract class animal implements animales{
		
		public $familia;
		protected $vel_promedio_kmxh;
		
		protected $_es_arrogante	=	FALSE;
		protected $_dormido			=	FALSE;
		
		public function get_corre_en_mxs(){
			
			if (	$this->vel_promedio_kmxh	)
				return $this->vel_promedio_kmxh	*	1000	/	3600;
			else
				return 0;
			
		}
		
		public function set_es_arrogante(	$es_arrogante	=	TRUE	){
			
			$this->_es_arrogante	=	$es_arrogante;
			
		}
	 	public function get_es_arrogante(){
			
			return $this->_es_arrogante;
			
		}
		
		public function duerme(){
			$this->_dormido	=	TRUE;
		}
	 	public function despierta(){
			$this->_dormido	=	FALSE;
		}
	 	public function dormido(){
			return $this->_dormido;
		}
		
	}
	
	
	
	interface animales{
	
		public function get_corre_en_mxs();
		public function set_es_arrogante();
		public function get_es_arrogante();
		public function duerme();
	 	public function despierta();
	 	public function dormido();
		
	}