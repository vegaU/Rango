<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_model extends CI_Model {

	public function getCompras(){
		$this->db->select("c.id, tc.nombre as tipo_comprobante, c.num_serie, c.num_comprobante, c.fecha_compra, p.razon_social as proveedor, c.total");
		$this->db->from("compras c");
		$this->db->join("proveedor p", "c.proveedor_id = p.id");
		$this->db->join("tipo_comprobante tc", "c.tipo_comprobante_id = tc.id");
    
		$resultados = $this->db->get();

		if($resultados->num_rows()){
			return $resultados->result();
		}else{
			return false;
		}
	}
    
    public function getVentasbyDate($fechainicio, $fechafin){
    	$this->db->select("v.*, c.nombre, tc.nombre as tipocomprobante");
		$this->db->from("ventas v");
		$this->db->join("clientes c", "v.cliente_id = c.id");
		$this->db->join("tipo_comprobante tc", "v.tipo_comprobante_id = tc.id");
		$this->db->where("v.fecha >=", $fechainicio);
		$this->db->where("v.fecha <=", $fechafin);
		$resultados = $this->db->get();

		if($resultados->num_rows() > 0){
			return $resultados->result();
		}else{
			return false;
		}
    }

	public function getCompra($id){

        $this->db->select("c.id, tc.nombre as tipo_comprobante, c.num_serie, c.num_comprobante, c.fecha_compra, p.razon_social as proveedor,c.igv, c.descuento, c.subtotal, c.total");
        $this->db->from("compras c");
        $this->db->join("proveedor p", "c.proveedor_id = p.id");
        $this->db->join("tipo_comprobante tc", "c.tipo_comprobante_id = tc.id");
		$this->db->where("c.id", $id);
		$resultado = $this->db->get();
		return $resultado->row();

	}

	public function getDetalle($id){

		$this->db->select("dt.*, p.codigo, p.nombre, dt.precio_compra_unidad, dt.cantidad, dt.importe");
		$this->db->from("detalle_compras dt");
		$this->db->join("productos p", "dt.producto_id = p.id");
		$this->db->where("dt.compras_id", $id);
	  	$resultados = $this->db->get();
	  	return $resultados->result();

	}

    public function getComprobantes(){
        $resultados = $this->db->get("tipo_comprobante");
        return $resultados->result();
    }

    public function getComprobante($idcomprobante){

    	$this->db->where("id", $idcomprobante);
    	$resultado = $this->db->get("tipo_comprobante");
    	return $resultado->row();

    }

    public function getproductos($valor){
        $this->db->select("id, codigo, nombre as label, precio, stock");
        $this->db->from("productos");
        $this->db->like("nombre", $valor);
        $resultados = $this->db->get();
        return $resultados->result_array();
    }

    public function save($data){
    	return $this->db->insert("compras", $data);
    }

    public function lastID(){
    	return $this->db->insert_id();
    }


    public function updateComprobante($idcomprobante, $data){
    	$this->db->where("id", $idcomprobante);
    	$this->db->update("tipo_comprobante", $data);
    }

    public function save_detalle($data){
    	$this->db->insert("detalle_compras", $data);
    }

    public function years(){

    	$this->db->select("YEAR(fecha) as year");
    	$this->db->from("ventas");
    	$this->db->group_by("year");
    	$this->db->order_by("year", "desc");
    	$resultados = $this->db->get();
    	return $resultados->result();

    }

    public function montos($year){
    	
    	$this->db->select("MONTH(fecha) as mes, SUM(total) as monto");
    	$this->db->from("ventas");
    	$this->db->where("fecha >=", $year."-01-01");
    	$this->db->where("fecha <=", $year."-12-31");
    	$this->db->group_by("mes");
    	$resultados = $this->db->get();
    	return $resultados->result();
    }
    
}
