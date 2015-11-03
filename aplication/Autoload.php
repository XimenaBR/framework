<?php
/**
 * Funsión AutoLoad
 * Llama los documentos de la carpeta Libs
 * @param type $name 
 * @return type
 */
function __autoload($name)
{
	require_once ROOT."libs".DS.$name.".php";
}