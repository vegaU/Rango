        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1
            </div>
            Sistema desarrollado por <strong>VEG@SYSTEM</strong>
        </footer>
    </div>
    <script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
<!-- Highcgarts-->

<script src="<?php echo base_url();?>assets/template/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/template/highcharts/exporting.js"></script>
<!-- jQuery Print -->
<script src="<?php echo base_url();?>assets/template/jquery-print/jquery.print.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<!-- Jquery UI js -->
<script src="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/template/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables Export -->
<!-- 

<script src="<?php echo base_url();?>assets/template/datatables-export/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.print.min.js"></script>
 -->
    <!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery-print/jquery.print.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/template/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables Export -->
<script src="<?php echo base_url();?>assets/template/datatables-export/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.print.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/template/dist/js/demo.js"></script>
<script>
    
$(document).ready(function () {
    var base_url= "<?php echo base_url();?>";

    var year = (new Date).getFullYear();
    datagrafico(base_url, year)
    $("#year").on("change", function(){
        yearselect = $(this).val()
        datagrafico(base_url, yearselect)
    })

    $(".btn-remove").on("click", function(e){
        e.preventDefault();
        var ruta = $(this).attr("href");
        //alert(ruta);
        $.ajax({
            url: ruta,
            type:"POST",
            success:function(resp){
                //http://localhost/ventas_ci/mantenimiento/productos
                window.location.href = base_url + resp;
            }
        });
    });
    $(".btn-view-producto").on("click", function(){
        var producto = $(this).val(); 
        //alert(cliente);
        var infoproducto = producto.split("*");
        html = "<p><strong>Codigo:</strong>"+infoproducto[1]+"</p>"
        html += "<p><strong>Nombre:</strong>"+infoproducto[2]+"</p>"
        html += "<p><strong>Descripcion:</strong>"+infoproducto[3]+"</p>"
        html += "<p><strong>Precio:</strong>"+infoproducto[4]+"</p>"
        html += "<p><strong>Stock:</strong>"+infoproducto[5]+"</p>"
        html += "<p><strong>Categoria:</strong>"+infoproducto[6]+"</p>";
        $("#modal-default .modal-body").html(html);
    });
  
    $(".btn-view-cliente").on("click", function(){
        var cliente = $(this).val(); 
        //alert(cliente);
        var infocliente = cliente.split("*");
        html = "<p><strong>Nombre:</strong>"+infocliente[1]+"</p>"
        html += "<p><strong>Tipo de Cliente:</strong>"+infocliente[2]+"</p>"
        html += "<p><strong>Tipo de Documento:</strong>"+infocliente[3]+"</p>"
        html += "<p><strong>Numero  de Documento:</strong>"+infocliente[4]+"</p>"
        html += "<p><strong>Telefono:</strong>"+infocliente[5]+"</p>"
        html += "<p><strong>Direccion:</strong>"+infocliente[6]+"</p>"
        $("#modal-default .modal-body").html(html);
    });

    $(".btn-view").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "mantenimiento/categorias/view/" + id,
            type:"POST",
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });

    $(".btn-view-usuario").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "administrador/usuarios/view/" + id,
            type:"POST",
            data: {idusuario:id},
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });
  
    //  reportes
    $('#example').DataTable({
       //Reporte para venta
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Listado de Ventas",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdfHtml5',
                title: "Listado de Ventas",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }  
            }
        ],
        //estableciendo lenguaje en español para las tablas
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    })

	$('#example1').DataTable({
        
        //estableciendo lenghuaje en español para las tablas
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
	$('.sidebar-menu').tree();



	//ventas 

    //cargar comprobantes serie y numero de comprobante
	$("#comprobantes").on("change", function(){
		option = $(this).val()

		if(option != ""){

			infocomprobante = option.split("*")

			$("#idcomprobante").val(infocomprobante[0])

            igv_select()


			
			$("#serie").val(infocomprobante[3])
			$("#numero").val(generarnumero(infocomprobante[1]))
		}else{
			$("#idcomprobante").val(null)
			$("#igv").val(null)
			$("#serie").val(null)
			$("#numero").val(null)
		}
        sumar()
	})


    $(document).on("click", ".btn-check", function(){
        cliente = $(this).val()
        infocliente = cliente.split("*")
        
        $("#idcliente").val(infocliente[0])
        $("#cliente").val(infocliente[1])
        $("#modal-default").modal("hide")

    })

    //autompletado para la busqueda de productos
    $("#producto").autocomplete({
        source: function(request, response){
            $.ajax({
                url: base_url+"movimientos/ventas/getproductos",
                type: "POST",
                dataType: "json",
                data: {valor: request.term},
                success: function(data){
                    response(data)
                }
            })    
        },
        minLength: 2,
        select: function(event, ui){
            data = ui.item.id +"*"+ ui.item.codigo +"*"+ ui.item.label +"*"+ ui.item.precio +"*"+ ui.item.stock
            $("#btn-agregar").val(data)
        }
    })


    $("#producto").autocomplete({
        source: function(request, response){
            $.ajax({
                url: base_url+"movimientos/compras/getproductos",
                type: "POST",
                dataType: "json",
                data: {valor: request.term},
                success: function(data){
                    response(data)
                }
            })    
        },
        minLength: 2,
        select: function(event, ui){
            data = ui.item.id +"*"+ ui.item.codigo +"*"+ ui.item.label +"*"+ ui.item.precio +"*"+ ui.item.stock
            $("#btn-agregar").val(data)
        }
    })

    //Agregar producto a la tabla de venta
    $("#btn-agregar").on("click", function(){

        valor_inicial = 0.00
        data = $(this).val()
        if(data != ''){
            infoproducto = data.split("*")
            html = "<tr>"
            html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>"
            html += "<td>"+infoproducto[2]+"</td>"
            html += "<td><input type='text' name='precios[]' value='"+infoproducto[3]+"' class='precios'></td>"
            html += "<td>"+infoproducto[4]+"</td>"
            html += "<td><input type='text' name='cantidades[]' value='0' class='cantidades'></td>"
            html += "<td><input type='hidden' name='importes[]' value='"+infoproducto[3]+"'><p>"+valor_inicial+"</p></td>"
            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>"
            html += "</tr>"
            $("#tbventas tbody").append(html);
            igv_select()
            sumar()
            $("#btn-agregar").val(null)
            $("#producto").val(null)
        }else{
            alert("seleccione un producto ...")
        }
    })

    //retirar producto de la venta
    $(document).on("click", ".btn-remove-producto", function(){
        $(this).closest("tr").remove()
        sumar()    
        validar_venta()
    })

    //calcular importe

    $(document).on("keyup", "#tbventas input.precios", function(){
        
        if($(this).val()<=0){
            alert("Ingrese cantidad valida")
        }else if($(this).val()>=0){         
            cantidad = $(this).closest("tr").find("td:eq(4)").children("input").val()
            precio = $(this).closest("tr").find("td:eq(2)").children("input").val()
            importe = cantidad * precio            
        }
        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2))
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2))
        igv_select()
        sumar()  
        //validamos los campos del cuadro ventas
        validar_venta()
    })


    $(document).on("keyup", "#tbventas input.cantidades", function(){
        
        if($(this).val()<0){
            alert("Ingrese cantidad valida")
            $(this).closest("tr").find("td:eq(2)").children("input").val()
        }else if($(this).val()>=0){         
            cantidad = $(this).val()
            precio = $(this).closest("tr").find("td:eq(2)").children("input").val()
            importe = cantidad * precio            
        }
        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2))
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2))
        sumar()  
        //validamos los campos del cuadro ventas
        validar_venta()
    })

    $(document).on("keyup", "#tbventas input.cantidades", function(){
        
        if($(this).val()<0){
            alert("Ingrese cantidad valida")
            $(this).closest("tr").find("td:eq(2)").children("input").val()
        }else if($(this).val()>=0){         
            cantidad = $(this).val()
            precio = $(this).closest("tr").find("td:eq(2)").children("input").val()
            importe = cantidad * precio            
        }
        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2))
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2))
        sumar()  
        //validamos los campos del cuadro ventas
        validar_venta()
    })


    $(document).on("keyup", "input[name=descuento]", function(){
        
        sumar()  
        //validamos los campos del cuadro ventas
        validar_venta()
    })

    //mostrar información de la venta

    $(document).on("click", ".btn-view-venta", function(){
        valor_id = $(this).val()
        $.ajax({
            url: base_url + "movimientos/ventas/view",
            type: "POST",
            dataType: "html",
            data: {id:valor_id},
            success: function(data){
                $("#modal-default .modal-body").html(data)
            }
        })
    })

    //Mostrar información de la compra
    $(document).on("click", ".btn-view-compra", function(){
        valor_id = $(this).val()
        $.ajax({
            url: base_url + "movimientos/compras/view",
            type: "POST",
            dataType: "html",
            data: {id:valor_id},
            success: function(data){
                $("#modal-default .modal-body").html(data)
            }
        })
    })

    //imprimir detalle venta
    $(document).on("click", ".btn-print", function(){
        $("#modal-default .modal-body").print();
    })

})


function igv_select(){
    $("#igv_select").on("change", function(){
                if($(this).val() == "1"){
                    $("#igv").val(infocomprobante[2])    
                    sumar()
                }else{
                    $("#igv").val(null)
                    sumar()
                }
            })
}
  
function validar_venta(){
    $("#tbventas tbody tr").each(function(){

        stock = parseInt($(this).find("td").eq(3).text())
        cantidad = parseInt($(this).find("td:eq(4)").children("input").val())

        if(stock==0){
            alert("Un producto no tiene stock, sera retirado de la lista")
            $(this).closest("tr").remove()
        }else if(stock<cantidad){
            $(this).find("td:eq(4)").children("input").addClass("btn-danger")
            alert("La cantidad no puede ser mayor que el stock. Ingrese nuevamente el valor")
            $(this).find("td:eq(5)").children("p").text("")
            $(this).find("td:eq(5)").children("input").val("")
            $(this).find("td:eq(4)").children("input").val(0)


        }else if(cantidad<stock){
            $(this).find("td:eq(4)").children("input").removeClass("btn-danger")
           
        }else if(stock == cantidad){
            $(this).find("td:eq(4)").children("input").removeClass("btn-danger")
        }

    })
}




function generarnumero(numero){
	if(numero >= 99999 && numero < 999999){
		return Number(numero)+1
	}
	if(numero >= 9999 && numero < 99999){
		return "0" + (Number(numero)+1)
	}
	if(numero >= 999 && numero < 9999){
		return "00" + (Number(numero)+1)
	}
	if(numero >= 99 && numero < 999){
		return "000" + (Number(numero)+1)
	}
	if(numero >= 9 && numero < 99){
		return "0000" + (Number(numero)+1)
	}
	if(numero < 9 ){
		return "00000" + (Number(numero)+1)
	}
}

//subtotal, igv, total 
function sumar(){
    subtotal = 0
    $("#tbventas tbody tr").each(function(){
    subtotal = subtotal + Number($(this).find("td:eq(5)").text())
    })
    $("input[name=subtotal]").val(subtotal.toFixed(2))
    porcentaje = $("#igv").val()

    igv = subtotal * (porcentaje/100)
    $("input[name=igv]").val(igv.toFixed(2)) 

    descuento = $("input[name=descuento]").val()
    
    total = subtotal + igv - descuento
    $("input[name=total]").val(total.toFixed(2))     
}

function datagrafico(base_url, year){
    namesMonth = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"];

    $.ajax({
        url: base_url + "dashboard/getData",
        type: "POST",
        data: { year: year},
        dataType: "json",
        success: function(data){
            var meses = new Array();
            var montos = new Array();
            $.each(data, function(key, value){
                meses.push(namesMonth[value.mes -1])
                valor = Number(value.monto)
                montos.push(valor)
            })
            graficar(meses, montos, year)
        }
    })
}

function graficar(meses, montos, year){

    Highcharts.chart('grafico', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monto acumulado de ventas por meses'
    },
    subtitle: {
        text: 'Año ' + year
    },
    xAxis: {
        categories: meses,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ' Monto Acumulado (soles)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} soles</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabel:{
                enable: true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }
            }
        }
    },
    series: [{
        name: 'Meses',
        data: montos
    }]
});

}

</script>
</body>
</html>
