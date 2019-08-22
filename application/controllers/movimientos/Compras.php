<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->permisos = $this->backend_lib->control();
        
        $this->load->model('Compras_model');
        $this->load->model("Ventas_model");
        $this->load->model("Proveedores_model");
        $this->load->model("Productos_model");
        $this->load->model("TipoCliente_model");
    }
    
    public function index(){
        $data = array(
            'permisos' => $this->permisos,
            'compras' => $this->Compras_model->getCompras(),
        );

        $this->load->view("layouts/header");
        $this->load->view("layouts/aside");
        $this->load->view("admin/compras/list", $data);
        $this->load->view("layouts/footer");
    }

    public function add(){
        
        $data = array(
          "tipocomprobantes" => $this->Ventas_model->getComprobantes(),
          "proveedores" => $this->Proveedores_model->getProveedores(),
          "tipoclientes" => $this->TipoCliente_model->getTipoCliente()
        );
        
        $this->load->view("layouts/header");
        $this->load->view("layouts/aside");
        $this->load->view("admin/compras/add", $data);
        $this->load->view("layouts/footer");

    }

    public function getproductos(){

        $valor = $this->input->post("valor");
        $productos = $this->Ventas_model->getproductos($valor);
        echo json_encode($productos); 

    }

    public function store(){

        $idcomprobante = $this->input->post("comprobantes_compras");
        $serie = $this->input->post("serie");
        $numero = $this->input->post("numero");
        $fecha = $this->input->post("fecha");
        $proveedor = $this->input->post("proveedor");
        $idusuario = $this->session->userdata("id");
        $lote = $this->session->userdata("lote");
        
        
        $igv = $this->input->post("igv");
        $descuento = $this->input->post("descuento");
        $subtotal = $this->input->post("subtotal");
        $total = $this->input->post("total");

        $idproductos = $this->input->post("idproductos");
        $precios = $this->input->post("precios");
        $cantidades = $this->input->post("cantidades");
        $importes = $this->input->post("importes");


        $data = array(
            'tipo_comprobante_id' => $idcomprobante,
            'num_serie' => $serie,
            'num_comprobante' => $numero,
            'fecha_compra' => $fecha,
            'proveedor_id'=> $proveedor,
            'usuario_id' => $idusuario,
            
            'subtotal' => $subtotal,
            'igv' => $igv,
            'descuento' => $descuento,
            'total' => $total
        );

        if($this->Compras_model->save($data)){
            $idcompra = $this->Compras_model->lastID();
            
            $this->save_detalle($idproductos, $idcompra, $precios, $cantidades, $importes);
            redirect(base_url()."movimientos/compras");
        }else{
            redirect(base_url()."movimientos/compras/add");
        }
        
    }

    protected function save_detalle($productos, $idcompra, $precios, $cantidades, $importes){
        for ($i = 0; $i < count($productos) ; $i++) {
            $data = array(
                'compras_id' => $idcompra,
                'producto_id' => $productos[$i],
                'precio_compra_unidad' => $precios[$i],
                'cantidad' => $cantidades[$i],
                'importe' => $importes[$i]
            );
            $this->Compras_model->save_detalle($data);
            //$this->updateProducto($productos[$i], $cantidades[$i]);
        }
    }

    public function view(){
        $idcompra = $this->input->post("id");
        $data = array(
            "compra" => $this->Compras_model->getCompra($idcompra),
            "detalles" => $this->Compras_model->getDetalle($idcompra)
        );
        $this->load->view("admin/compras/view", $data);
    }
   

}