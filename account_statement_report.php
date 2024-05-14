<?php
$title = "Reporte de estado de cuenta | ";
include "head.php";
$active12 = "active";
include "sidebar.php";
?>


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-4 col-5">
                <h4 class="page-title"> Reporte de estado de cuenta</h4>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="card-block">

                        <form class="form-horizontal" role="form" id="data_income">
                            <div class="form-group row">
                                <input type="hidden" class="form-control" id="name_user" value="<?php echo $name; ?>">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="daterange" name="daterange" value="<?php echo "01/" . date("m/Y") . " - " . date("d/m/Y"); ?>" readonly onchange="load(1);">
                                </div>

                                <div class="col-md-3 form-group">
                                    <select class="form-control select2" name="account" data-placeholder="Selecciona Cuenta" id="account" onchange="load(1);">

                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <select class="form-control" id="type" name="type" onchange="load(1);">
                                        <option selected="" value="0">-- Tipo de transacción --</option>
                                        <option value="1">Débito</option>
                                        <option value="2">Crédito</option>
                                    </select>
                                </div>


                                <div class="col-md-1">
                                    <button type="button" class="btn btn-success" onclick='load(1);'>
                                        <i class="fa fa-search"></i> Buscar</button>
                                    <span id="loader"></span>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-light pull-right">
                                        <span class="glyphicon glyphicon-print"></span> Imprimir
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- end form print -->
                        <div class="table-responsive">
                            <!-- ajax -->
                            <div id="resultados"></div><!-- Carga los datos ajax -->
                            <div class='outer_div'></div><!-- Carga los datos ajax -->
                            <!-- /ajax -->

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>



<?php include "footer.php" ?>
<!-- Include Required Prerequisites -->

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
    $(document).ready(function() {
        // load(1);
    });

    function load(page) {
        var daterange = $("#daterange").val();
        var account_id = $("#account").val();
        var type = $("#type").val();
        $("#loader").fadeIn('slow');
        $.ajax({
            url: './ajax/account_statement_report.php?action=ajax&page=' + page + '&daterange=' + daterange + '&account_id=' + account_id + '&type=' + type,
            beforeSend: function(objeto) {
                $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
            },
            success: function(data) {
                $(".outer_div").html(data).fadeIn('slow');
                $('#loader').html('');
            }
        })
    }

    // function print
    $("#data_income").submit(function(e) {
        e.preventDefault();
        var daterange = $("#daterange").val();
        var type = $("#type").val();
        var account = $("#account").val();
        if (account < 1) {
            alert('Selecciona una cuenta para generar el reporte');
            return false;
        }

        VentanaCentrada('./pdf/documentos/account_statement_report_pdf.php?daterange=' + daterange + '&type=' + type + '&account=' + account, 'Gasto', '', '1024', '768', 'true');
    });
</script>


<script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY',
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "daysOfWeek": [
                    "Do",
                    "Lu",
                    "Ma",
                    "Mi",
                    "Ju",
                    "Vi",
                    "Sa"
                ],
                "monthNames": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
            }
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

        var id = $("#account_to").val();
        $(".select2").select2({
            ajax: {
                url: "ajax/accounts_select2.php",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    // console.log(params.term);


                    return {
                        q: params.term // search term
                    };
                },
                processResults: function(data) {


                    return {
                        results: data
                    };
                },
                cache: true



            },
            minimumInputLength: 2

        })

    });
</script>