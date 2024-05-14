<?php
    $style="display: none;";

?> 

    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="#" class="logo text-white">
					Base HCM
                </a>
            </div>
            <div class="page-title-box pull-left">
                
            </div>
            <a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <ul class="nav user-menu pull-right">                
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="images/profiles/<?php echo $profile_pic;?>" width="40" alt="Admin">
                            <span class="status online"></span></span>
                        <span><?php echo $name;?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.php">Mi cuenta</a>
                        <a class="dropdown-item" href="https://api.whatsapp.com/send?phone=50494957641" target="_blank">Soporte</a>                        
                        <a class="dropdown-item" href="action/logout.php">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>            
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="<?php if(isset($active1)){echo $active1;}?>">
                            <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>

                        <li class="<?php if(isset($active4)){echo $active4;}?>">
                            <a href="accounts.php"><i class="fa fa-th"></i> Cuentas</a>
                        </li>
                         <li class="submenu">
                            <a href="#"><i class="fa fa-ticket" aria-hidden="true"></i> <span> Transacciones</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="<?php if(isset($active2)|| isset($active3) || isset($active9)){ echo '';} else echo $style ?>">
                                <li class="<?php if(isset($active2)){echo $active2;}?>"><a href="expences.php">Gastos</a></li>
                               <li class="<?php if(isset($active3)){echo $active3;}?>"><a href="income.php">Ingresos</a></li>
                                <li class="<?php if(isset($active9)){echo $active9;}?>"><a href="transfer.php">Transferencias</a></li>                       
                            </ul>
                        </li>
                         <li class="submenu">
                            <a href="#"><i class="fa fa-tags" aria-hidden="true"></i> <span> Categorías</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="<?php if(isset($active5)|| isset($active6)){ echo '';} else echo $style ?>">
                                <li class="<?php if(isset($active5)){echo $active5;}?>"><a href="category_expence.php" >Gastos</a></li>
                                <li class="<?php if(isset($active6)){echo $active6;}?>"><a href="category_income.php">Ingresos</a></li>                                
                            </ul>
                        </li>
                        <!-- <li class="<?php if(isset($active5)){echo $active5;}?>">
                            <a href="category_expence.php"><i class="fa fa-dashboard"></i> Categoría de gastos</a>
                        </li>
                        <li class="<?php if(isset($active6)){echo $active6;}?>">
                            <a href="category_income.php"><i class="fa fa-dashboard"></i> Categoría de ingresos</a>
                        </li> -->
                        <li class="<?php if(isset($active7)){echo $active7;}?>">
                            <a href="users.php"><i class="fa fa-users"></i> Usuarios</a>
                        </li>
                       <!--  <li class="<?php if(isset($active8)){echo $active8;}?>">
                            <a href="settings.php"><i class="fa fa-dashboard"></i> Configuración</a>
                        </li> -->  


                                           
                       
                       
                        <li class="submenu">
                            <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span> Configuración</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="<?php if(isset($active8)){ echo '';} else echo $style ?>">
                                <li class="<?php if(isset($active8)){echo $active8;}?>"><a href="settings.php">General</a></li>                                
                            </ul>
                        </li>  

                  
                         <li class="submenu">
                            <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i> <span> Reportes</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="<?php if(isset($active10)|| isset($active11) || isset($active12) | isset($active13)| isset($active14) | isset($active15)){ echo '';} else echo $style ?>">
                                <li class="<?php if(isset($active11)){echo $active11;}?>"><a href="expences_report.php">Gastos</a></li>
                                <li class="<?php if(isset($active14)){echo $active14;}?>"><a href="expences_byday_report.php">Gastos por día</a></li>
                                <li class="<?php if(isset($active10)){echo $active10;}?>"><a href="income_report.php">Ingresos</a></li>
                                <li class="<?php if(isset($active13)){echo $active13;}?>"><a href="income_byday_report.php">Ingresos por día</a></li>

                                <li class="<?php if(isset($active15)){echo $active15;}?>"><a href="transfer_report.php">Transferencias</a></li>
                                
                                <li class="<?php if(isset($active12)){echo $active12;}?>"><a href="account_statement_report.php">Estado de cuentas</a></li>


                            
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
   