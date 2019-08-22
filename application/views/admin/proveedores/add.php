
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Proveedor
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                             </div>
                        <?php endif;?>
                        <form action="<?php echo base_url();?>mantenimiento/proveedores/store" method="POST">
                            <div class="form-group <?php echo form_error('ruc') != false ? 'has-error':''?>">
                                <label for="ruc">RUC:</label>
                                <input type="text" class="form-control" id="ruc" name="ruc" value="<?php echo set_value("ruc");?>">
                                <?php echo form_error("ruc","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group <?php echo form_error('razonSocial') != false ? 'has-error':''?>">
                                <label for="razonSocial">Razon Social</label>
                                <input type="text" class="form-control" id="razonSocial" name="razonSocial" value="<?php echo set_value("razonSocial");?>">
                                <?php echo form_error("razonSocial","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            <div class="form-group <?php echo form_error('contacto') != false ? 'has-error':''?>">
                                <label for="contacto">Contacto</label>
                                <input type="text" class="form-control" id="contacto" name="contacto" value="<?php echo set_value("contacto");?>">
                                <?php echo form_error("contacto","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group <?php echo form_error('telefono') != false ? 'has-error':''?>">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo set_value("telefono")?>">
                                <?php echo form_error("telefono","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group <?php echo form_error('celular') != false ? 'has-error':''?>">
                                <label for="celular">Celular:</label>
                                <input type="text" class="form-control" id="celular" name="celular" value="<?php echo set_value("celular")?>">
                                <?php echo form_error("celular","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
