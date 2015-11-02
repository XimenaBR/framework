<?php

class Bootstrap
{
	public static function run(Request $peticion)
	{
		$controller = $peticion-> getControlador().'controller';
		$rutaControlador = ROOT.'controllers'.DS.$controller.'.php';
		$metodo = $peticion-> getMetodo();
		$args = $peticion-> getArgs();

		if (is_readable($rutaControlador)) 
		{
			
			require_once $rutaControlador;

			$controlador = new $controller;
			if (is_callable(array($controlador, $metodo))) 
			{
				$metodo = $peticion->getMetodo();
			}else
			{
				$metodo = 'index';
			}


			if ($metodo=="login") {
				}else{
					Authorization::logged();
				}




				if (isset($args)) {
					call_user_func_array(array($controlador, $metodo),$args);
				}else
				{
					call_user_func(array($controlador, $metodo));
				}
		}else
		{
			throw new Exception('Controlador no encontrado :(');
			
		}
	}
}