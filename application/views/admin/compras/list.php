<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Compras
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <?php if($permisos->insert == 1): ?>
                    <div class="col-md-12">
                        <a href="<?php echo base_url();?>movimientos/compras/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Compra</a>
                    </div>
                    <?php endif; ?>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo Comprobante</th>
                                    <th>Numero de Serie</th>
                                    <th>Numero de comprobante</th>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($compras)): ?>
                                    <?php foreach($compras as $compra): ?>
                                        <tr>
                                            <td><?php echo $compra->id; ?></td>
                                            <td><?php echo $compra->tipo_comprobante; ?></td>
                                            <td><?php echo $compra->num_serie; ?></td>
                                            <td><?php echo $compra->num_comprobante; ?></td>
                                            <td><?php echo $compra->fecha_compra; ?></td>
                                            <td><?php echo $compra->proveedor; ?></td>
                                            <td><?php echo $compra->total; ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-view-compra" value="<?php echo $compra->id; ?>" data-toggle="modal" data-target="#modal-default"><span class="fa fa-search"></span></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Información de la Compra</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary btn-print" type="button"><span class="fa fa-print"> Imprimir</span></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
