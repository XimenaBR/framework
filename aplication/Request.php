<?php

class Request
{
	private $_controlador;
	private $_metodo;
	private $_argumentos;
/**
 * Metodo para sanitizar
 * @return type
 */
	public function __construct()
	{
		if (isset($_GET['url'])) 
		{
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			$url = array_filter($url);

			$this->_controlador= strtolower(array_shift($url));
			$this->_metodo= strtolower(array_shift($url));
			$this->_argumentos = $url;
		}

		if (!$this-> _controlador) 
		{
			$this-> _controlador = DEFAULT_CONTROLLER;
		}

		if (!$this-> _metodo)
		{
			$this-> _metodo = 'index';
		}
		if (!isset($this-> _argumentos)) {
			$this-> _argumentos = array();
		}
	}
	/**
	 * 
	 * @return type
	 */
		public function getControlador()
		{
			return $this-> _controlador;
		}
/**
 * PErmite obtener el valor del método
 * @return type
 */
		public function getMetodo()
		{
			return $this-> _metodo;
		}
/**
 * Ayuda a obtener los valores de los argumentos 
 * @return type
 */
		public function getArgs()
		{
			return $this-> _argumentos;
		}
}