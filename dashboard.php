<?php 
    $title ="Panel de control - "; 
    include "head.php";
	$active1="active";
    include "sidebar.php";
	include("funciones.php");
?>
<?php 
    $expenses = mysqli_query($con, "select sum(amount) as amount from expenses");
    $income = mysqli_query($con, "select sum(amount) as amount from income");
?>

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                  <!-- Content -->
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-success"><i class="fa fa-money" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                              <?php foreach ($income as $key2) { ?>
                                 <div class="count"> <b> <?php echo number_format($key2['amount'],2); ?> </b></div>
                                 <?php } ?>
                                <span>Ingresos totales</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                              <?php foreach ($expenses as $key) { ?>
                               <div class="count"><b><?php echo number_format($key['amount'],2); ?> </b></div>
                                <span>Gastos totales  </span>
                                 <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-warning"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">

                                <div class="count"> <b><?php echo sum_incomes_month(date('m'));?></b></div> 
                                <span>Ingresos  este mes</span>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-danger"><i class="fa fa-tasks" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <div class="count"><b> <?php echo sum_expenses_month(date('m'));?> </b></div>
                                <span>Gastos este mes</span>
                                
                            </div>
                        </div>
                    </div>
                  </div>
                    <div class="chat-window">
                            <div class="fixed-header">
                                <div class="navbar">
                                    <div class="pull-left mr-auto">
                                        <div class="add-task-btn-wrapper">
                                             <H3>Ingresos vrs Gastos <small>Reporte mensual</small></H3>
                                        </div>
                                    </div>
                                    <a class="task-chat profile-rightbar pull-right" href="#chat_sidebar"><i class="fa fa fa-comment"></i></a>
                                   
                                </div>
                            </div>
                           
                        </div>
                    <div class="row">

                      <div class="col-md-12">
                          <div class="card-box">
                              <div id="">
                                <canvas id="bar-example" style="width: 521px; height: 260px;" width="521" height="260"></canvas>
                              </div>
                          </div>
                      </div>  
                    </div>
                   

                    <!-- End content -->                    
                </div>
            </div>           
        <!-- </div> -->
</div>
        <div class="sidebar-overlay" data-reff=""></div>    
        <?php include "footer.php" ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>


<script>

 if($("#bar-example").length) {
            var f=document.getElementById("bar-example");
            new Chart(f,
            {
                type:"bar",
                data: {
                    labels:["Enero","Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre","Octubre", "Noviembre","Diciembre"],
                    datasets:[ {
                        label: "Ingresos", backgroundColor: "#1C7EBB", data: [<?php echo sum_incomes_month(1); ?>, <?php echo sum_incomes_month(2); ?>, <?php echo sum_incomes_month(3); ?>, <?php echo sum_incomes_month(4); ?>, <?php echo sum_incomes_month(5); ?>, <?php echo sum_incomes_month(6); ?>, <?php echo sum_incomes_month(7); ?>,<?php echo sum_incomes_month(8); ?>,<?php echo sum_incomes_month(9); ?>,<?php echo sum_incomes_month(10); ?>,<?php echo sum_incomes_month(11); ?>,<?php echo sum_incomes_month(12); ?>]
                    }
                    ,
                    {
                        label: "Gastos", backgroundColor: "#f62d51", data: [<?php echo sum_expenses_month(1);?>, <?php echo sum_expenses_month(2);?>, <?php echo sum_expenses_month(3);?>, <?php echo sum_expenses_month(4);?>, <?php echo sum_expenses_month(5);?>, <?php echo sum_expenses_month(6);?>, <?php echo sum_expenses_month(7);?>,<?php echo sum_expenses_month(8);?>,<?php echo sum_expenses_month(9);?>,<?php echo sum_expenses_month(10);?>,<?php echo sum_expenses_month(11);?>,<?php echo sum_expenses_month(12);?>]
                    }
                    ]
                }
                ,
                options: {
                    scales: {
                        yAxes:[ {
                            ticks: {
                                beginAtZero: !0
                            }
                        }
                        ]
                    }
                }
            }
            )
        }
</script>
