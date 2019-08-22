<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores_model extends CI_Model {

	public function getProveedores(){
		$this->db->select("*");
		$this->db->from("proveedor");

		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getCliente($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("clientes");
		return $resultado->row();
	}

	public function save($data){
		return $this->db->insert("proveedor",$data);
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("clientes",$data);
	}

	public function getTipoClientes(){
		$resultados = $this->db->get("tipo_cliente");
		return $resultados->result();
	}

	public function getTipoDocumentos(){
		$resultados = $this->db->get("tipo_documento");
		return $resultados->result();
	}

}