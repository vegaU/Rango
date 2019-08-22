<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {

	private $permisos;

	public function __construct(){
		parent::__construct();
		//crearemos la libreria Backend_lib
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Marcas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'marcas' => $this->Marcas_model->getMarcas()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/marcas/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/marcas/add");
		$this->load->view("layouts/footer");
	}

	public function store(){
		$marca = $this->input->post("marca");

		$this->form_validation->set_rules("marca","Marca","required|is_unique[marcas.marca]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'marca' => $marca,
				'estado' => "1"
			);

			if ($this->Marcas_model->save($data)) {
				redirect(base_url()."mantenimiento/marcas");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/marcas/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/categorias/add");*/
			$this->add();
		}
		
	}

	public function edit($id){
	    
		$data  = array(
			'marca' => $this->Marcas_model->getMarca($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/marcas/edit",$data);
		$this->load->view("layouts/footer");
		
	}

	public function update(){
	    
		$idMarca = $this->input->post("idMarca");
		$marca = $this->input->post("marca");

		$marcaactual = $this->Marcas_model->getMarca($idMarca);

		if ($marca == $marcaactual->marca) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[marcas.marca]";
		}
	
		$this->form_validation->set_rules("marca","Marca","required".$is_unique);
	

		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'marca' => $marca,
			);

			if ($this->Marcas_model->update($idMarca,$data)) {
				redirect(base_url()."mantenimiento/marcas");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/marcas/edit/".$idMarca);
			}
		}else{
			$this->edit($idMarca);
		}
	
	}

	public function view($id){
		$data  = array(
			'categoria' => $this->Categorias_model->getCategoria($id), 
		);
		$this->load->view("admin/categorias/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Categorias_model->update($id,$data);
		echo "mantenimiento/categorias";
	}
	
}
