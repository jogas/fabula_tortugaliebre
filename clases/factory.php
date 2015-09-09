<?php

	/**
	 * 
	 * 
	 * @author joga Jose Gaytan <jomanetos@gmail.com>
	 *
	 */

	class factory{
		
		private static $_instancia	=	NULL;
		private static $_liebre		=	NULL;
		private static $_tortuga	=	NULL;
		
		public static function instancia(){
			
			if (	self::$_instancia	==	NULL	)
				self::$_instancia	=	new self();
			return self::$_instancia;
			
		}
		
		public static function liebre(){
			if (	self::$_liebre	==	NULL	){
				self::$_liebre	=	self::getObjeto(	"liebre"	);
			}
			return self::$_liebre;
   		}
   		
		public static function tortuga(){
			if (	self::$_tortuga	==	NULL	){
				self::$_tortuga	=	self::getObjeto(	"tortuga"	);
			}
			return self::$_tortuga;
   		}
   		
   		
		public function &getObjeto(	$strClass	){
			
			if (	!class_exists(	$strClass	,	FALSE	)	)
				require_once $strClass.".php";
         		
			if (	strpos(	$strClass,	"/"	)	!==	FALSE){
				$cadReves		=	strrev(	$strClass	);
				$strClass		=	strrev(	substr(	$cadReves,	0,	strpos(	$cadReves,	"/"	)	)	);
			}
			
      		if (	class_exists(	$strClass,	FALSE	)	){
         		$obj_ref 		=	new $strClass();
         		if (	$obj_ref	) {
            		return $obj_ref;
         		}
      		}
		}
		
	}