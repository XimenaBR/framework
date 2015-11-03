<?php

Abstract class appController
{

protected $_view;
/**
 * Función __Construct
 * Instancia las variables de la clase PDO
 * @return type
 */
	public function  __construct()
	{
		$this->_view = new View(new Request);
		$this->db = new ClassPDO();
	}
	abstract public function index();

	protected function redirect($url = array())
	{
		$path ="";
			if ($url["controller"]) {
				$path .= $url["controller"];
			}
			if ($url["action"]) {
				$path .= "/".$url["action"];
			}
			header("LOCATION: ".APP_URL.$path);
	}
}