<?php

class View
{
	private $_controlador;

public function __construct(Request $peticion)
{
	$this->_controlador = $peticion->getControlador();
	$this->_metodo=$peticion->getMetodo();
}
/**
 * MEtodo que redirecciona a las vistas
 * @param type $vista 
 * @return type
 */
	public function renderizar($vista)
	{
		$_layoutParams = array
		(
			'ruta_css'=>APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/css/',
			'ruta_img'=> APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/img/',
			'ruta_js' => APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/js/'
		);

		$rutaView = ROOT . 'views' . DS .$this->_controlador.DS.$vista.'.phtml';

		if ($this->_metodo=='login') {
			$layaout ='login';
		}else
		{
			$layaout = DEFAULT_LAYOUT;
		}

		if (is_readable($rutaView)) 
		{
			require_once ROOT.'views'.DS.'layouts'.DS.	$layaout.DS.'header.php';
			require_once $rutaView;
			require_once ROOT.'views'.DS.'layouts'.DS.	$layaout.DS.'footer.php';
					
		}else
		{
			throw new Exception('Error de vista');
			
		}

	}
}