<?php

class usuariosController extends APPController
{
	public function __construct()
	{
		parent:: __construct();
	}
	public function index()
	{
		$this->_view->usuarios = $this->db->find('usuarios','all');
		$this->_view->renderizar('index');
	}
	public function add()
	{
		if ($_POST){

		$pass = new Password();
		$_POST['password'] = $pass->getPassword($_POST['password']);
		
		if ($this->db->save("usuarios", $_POST)) {
		$this->redirect(array('controller'=>'usuarios', 'action'=>'add'));
		}else{
		
		$this->redirect(array('controller'=>'usuarios', 'action'=>'add'));
		}
		}else{
		$this->_view->titulo = "Agregar usuario";

		$this->_view->renderizar('add');

			}

		}
		
	public function edit($id = null){

		if ($_POST){

		if (!empty($_POST['pass'])) {

		$pass = new Password();

		$_POST['password'] = $pass->getPassword($_POST['pass']);

			}

		if ($this->db->update("usuarios", $_POST))
		{
			$this->redirect(array('controller'=>'usuarios', 'action'=>'index'));
		}else{
		
			$this->redirect(array('controller'=>'usuarios', 'action'=>'edit'));
		}

		}else{

			$this->_view->titulo = "Editar usuario";

			$this->_view->usuario = $this->db->find('usuarios', 'first',array('conditions'=>'id='.$id));

			$this->_view->renderizar('edit');

			}
		}
	public function delete()
	{
		$conditions = 'id='.$id;
		if ($this->db->delete('usuarios', $conditions)){
			$this->redirect(array('controller'=>'usuarios', 'action'=>'index'));
		}
	}
	public function login()
	{
		if ($_POST) {
			$pass = new Password();
			$filter = new Validations();
			$auth= new Authorization();  

			$username = $filter->sanitizeText($_POST['username']);
			$password = $filter->sanitizeText($_POST['password']);

			$options = array('conditions'=>"username= '$username'");
			$usuario= $this->db->find('usuarios','first', $options);

			if ($pass->isValid($password, $usuario['password']))
			{
				$auth->login($usuario);
				$this->redirect(array('controller'=>'tareas'));
			}else
			{
				echo "usuario invalido";
			}
		}
		$this->_view->renderizar('login');
	}

	public function logout()
	{
		$auth =new Authorization();
		$auth->logout();

	}
}
