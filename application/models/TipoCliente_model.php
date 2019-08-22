<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoCliente_model extends CI_Model {

	public function getTipoCliente(){
		$this->db->select('tc.*');
		$this->db->from('tipo_cliente tc');
		$resultados = $this->db->get();
		return $resultados->result();
	}

	

}