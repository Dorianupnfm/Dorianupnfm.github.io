<?php
include "../config/config.php";

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {

    $daterange = mysqli_real_escape_string($con, (strip_tags($_REQUEST['daterange'], ENT_QUOTES)));


    $sTable = "expenses";
    $sWhere = "";

    list($f_inicio, $f_final) = explode(" - ", $daterange);
    list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial 
    $fecha_inicial = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
    list($dia_fin, $mes_fin, $anio_fin) = explode("/", $f_final); //Extrae la fecha final
    $fecha_final = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

    $sWhere = "where created_at between '$fecha_inicial' and '$fecha_final' ";




    $sWhere .= " order by created_at desc";
    include 'pagination.php';
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 10;
    $adjacents  = 4;
    $offset = ($page - 1) * $per_page;
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload = './expences_report.php';
    $sql = "SELECT * FROM  $sTable $sWhere ";
    $query = mysqli_query($con, $sql);
    if ($numrows > 0) {

?>
        <table class="table table-striped custom-table">
            <thead>
                <tr class="">
                    <th class="column-title">Fecha </th>
                    <th class="column-title">Cuenta </th>
                    <th class="column-title">Categoría </th>
                    <th class="column-title">Descripción </th>
                    <th class="column-title">Cantidad </th>


                </tr>
            </thead>
            <tbody>
                <?php
                $sumador_total = 0;
                while ($r = mysqli_fetch_array($query)) {
                    $id = $r['id'];
                    $created_at = date('d/m/Y', strtotime($r['created_at']));
                    $description = $r['description'];
                    $amount = $r['amount'];
                    $account_id = $r['account_id'];
                    $user_id = $r['user_id'];
                    $category_id = $r['category_id'];

                    $sql = mysqli_query($con, "select * from accounts where id=$account_id");
                    if ($r = mysqli_fetch_array($sql)) {
                        $name_account = $r['name'];
                    }

                    $sql = mysqli_query($con, "select * from category_expence where id=$category_id");
                    if ($c = mysqli_fetch_array($sql)) {
                        $name_category = $c['name'];
                    }

                    $coin_name = "coin";
                    $querycoin = mysqli_query($con, "select * from configuration where name=\"$coin_name\" ");
                    if ($r = mysqli_fetch_array($querycoin)) {
                        $coin = $r['val'];
                    }
                ?>
                    <!-- <input type="hidden" value="<?php echo $created_at; ?>" id="created_at<?php echo $id; ?>"> -->
                    <input type="hidden" value="<?php echo $description; ?>" id="description<?php echo $id; ?>">
                    <input type="hidden" value="<?php echo $category_id; ?>" id="category_id<?php echo $id; ?>">
                    <input type="hidden" value="<?php echo number_format($amount, 2, '.', ''); ?>" id="amount<?php echo $id; ?>">

                    <tr class="even pointer">
                        <td><?php echo $created_at; ?></td>
                        <td><?php echo $name_account; ?></td>
                        <td><?php echo $name_category; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $coin; ?> <?php echo number_format($amount, 2); ?></td>

                    </tr>



                <?php
                    $sumador_total += $amount;
                } //end while
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan=""> <b>
                            <h5>Total Ingresos
                        </b> </h5>
                    </td>
                    <td>
                        <h5> <b><?php echo number_format($sumador_total, 2); ?></b></h5>
                    </td>
                </tr>

                <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
                </span></td>
                </tr>
        </table>
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Aviso!</strong> No hay datos para mostrar
        </div>
<?php
    }
}
?>