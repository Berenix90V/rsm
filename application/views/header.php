<!DOCTYPE html>
<?php
if (!isset($_SESSION['username'])) {
    redirect(site_url('UserManagement'));
}

$role = $_SESSION['userrole'];
?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--title>SB Admin 2 - Blank</title-->
        <?php
if(isset($titolo)){
        ?>
        <title><?php echo $titolo; ?></title>

        <?php
}
        ?>

        <!-- Custom fonts for this template-->
        <link href="<?php echo base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,500, 500i, 600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?php echo base_url();?>assets/css/sb-admin-2.min.css" rel="stylesheet">


        <!-- Custom styles for this page  tables -->
        <link href="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- custom css -->
        <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
        <!--advanced css-->
        <link href="<?php echo base_url();?>assets/css/advanced-style/main-style.css" rel="stylesheet">


    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                    <div class="sidebar-brand-icon">
                        <!--i class="fas fa-laugh-wink"></i-->
                        <img src="<?php echo base_url();?>/assets/img/albero.png" style="width:32px; height:auto">
                    </div>
                    <div class="sidebar-brand-text mx-3">RSM<sup>MAG</sup></div>
                </a>

                <!-- inizio anagrafica -->

                <!-- permessi anagrafica: admin tutto wah solo prodotti, fornitori e prodotti-fornitori-->
                <?php
if($role == 'admin' || $role == 'wah'){
                ?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->      
                <div class="sidebar-heading">
                    Anagrafica
                </div>

                <!-- Nav Item - Dashboard -->
                <li class="nav-item nav-item-registry"> <!-- aggiunta classe  nav-item-registry to add class active js -->
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRegistry" aria-expanded="true" aria-controls="collapseRegistry">
                        <i class="fas fa-fw fa-list-ul"></i>
                        <span>Anagrafica di base</span>
                    </a>
                    <div id="collapseRegistry" class="collapse" aria-labelledby="headingRegistry" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Tabelle</h6>
                            <a class="collapse-item" href="<?php echo site_url('Registry/basicregistry?regtab=products'); ?>">Prodotti</a>
                            <a class="collapse-item" href="<?php echo site_url('Registry/basicregistry?regtab=suppliers'); ?>">Fornitori</a>
                            <?php
                            if($role == 'admin'){
                            ?>
                            <a class="collapse-item" href="<?php echo site_url('Registry/basicregistry?regtab=warehouses'); ?>">Magazzini</a>
                            <a class="collapse-item" href="<?php echo site_url('Registry/basicregistry?regtab=users'); ?>">Utenti</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </li>

                <li class="nav-item nav-item-pfregistry "> 
                    <a class="nav-link" href="<?php echo site_url('Pfregistry/pfregistry_view'); ?>">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Prodotti-Fornitori</span></a>
                </li>


                <?php // fine anagrafica tot
}
                ?>

                <!-- inizio magazzino -->

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    MAGAZZINO
                </div>

                <!-- riservato magazzino -->

                <!-- permessi magazzino: admin e wah -->
                <?php
if($role == 'admin' || $role == 'wah' || $role == 'wahrep'){
                ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item nav-item-instock">
                    <a class="nav-link" href="<?php echo site_url('Instock/instock_view'); ?>">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Operazioni interne</span>
                    </a>
                </li>
                <?php 
}
                ?>


                <!-- riservato reparto -->
                <?php
if($role == 'admin' || $role == 'rep' || $role == 'wahrep'){
                ?>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item nav-item-requests">
                    <a class="nav-link" href="<?php echo site_url('Requests/requests_view'); ?>">
                        <i class="fas fa-fw fa-question"></i>
                        <span>Richiedi prodotto</span>
                    </a>
                </li>
                <?php 
}
                ?>


                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    RICHIESTE
                </div>

                <!-- riservato magazzino -->
                <?php
if($role == 'admin' || $role == 'wah' || $role == 'wahrep'){
                ?>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item nav-item-inrequests">
                    <a class="nav-link" href="<?php echo site_url('Inrequests/inrequests_view'); ?>">
                        <i class="fas fa-fw fa-sign-in-alt"></i>
                        <span>Al magazzino</span>
                    </a>
                </li>
                <?php 
}
                ?>


                <!-- riservato reparto -->
                <?php
if($role == 'admin' || $role == 'rep' || $role == 'wahrep'){
                ?>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item nav-item-outrequests">
                    <a class="nav-link" href="<?php echo site_url('Outrequests/outrequests_view'); ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Conferma ricezione</span>
                    </a>
                </li>
                <?php 
}
                ?>


                <!-- riservato reparto -->
                <?php
if($role == 'admin'){
                ?>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item nav-item-totrequests">
                    <a class="nav-link" href="<?php echo site_url('Totrequests/totrequests_view'); ?>">
                        <i class="fas fa-fw fa-arrows-alt-h"></i>
                        <span>Totali</span>
                    </a>
                </li>
                <?php 
}
                ?>


                <?php
if($role == 'admin' || $role == 'rep'|| $role == 'wahrep'){
                ?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    INVENTARIO
                </div>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item nav-item-inventory"> <!-- aggiunta classe  nav-item-registry to add class active js -->
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventory" aria-expanded="true" aria-controls="collapseInventory">
                        <i class="fas fa-fw fa-boxes"></i>
                        <span>Inventario</span>
                    </a>
                    <div id="collapseInventory" class="collapse" aria-labelledby="headingInventory" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Magazzini</h6>

                            <?php
                            /*if($role == 'admin' || $role == 'wah'){
                              ?>
                            <a class="collapse-item" href="<?php echo site_url('Inventory/inventory_c_choose_view'); ?>">Centrali</a>
                            
                            <?php
                            }*/
                            if($role == 'admin' || $role == 'rep'){
                            ?>
                            <a class="collapse-item" href="<?php echo site_url('Inventory/inventory_r_choose_view'); ?>">Reparti</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-item-archiveinv"> 
                    <a class="nav-link" href="<?php echo site_url('Archiveinv/archinv_tot_choose'); ?>" >
                        <i class="fas fa-fw fa-archive"></i>
                        <span>Archivio inventari</span>
                    </a>
                </li>

<?php
}
?>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <!--
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
<div class="input-group">
<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
<div class="input-group-append">
<button class="btn btn-primary" type="button">
<i class="fas fa-search fa-sm"></i>
</button>
</div>
</div>
</form>
-->


                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <?php
/*
             <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            */

            // NOTIFICHE X REQ IN USCITA, REPARTI
            
            if($role == 'admin' || $role == 'rep'|| $role == 'wahrep'){
                            ?>
                            <li class="nav-link">
                                <a class="nav-link " href="<?php echo site_url('Outrequests/outrequests_view');?>" id="notifiche2" role="button" aria-haspopup="true">
                                    <i class="far fa-bell"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter"></span>
                                </a>
                            </li>
            <?php
            }

            // NOTIFICHE X REQ IN ENTRATA, MAGAZZINI

            if($role == 'admin' || $role == 'wah'|| $role == 'wahrep'){
            ?>
                            <!-- Nav Item - Alerts -->
                            
                               <li class="nav-link">
                                <a id="notifiche" class="nav-link" href="<?php echo site_url('Inrequests/inrequests_view');?>"   role="button" aria-haspopup="true" >
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter"></span>
                                </a>
                            </li>
            <?php
            }
            ?>
                            
                              
                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php if (isset($_SESSION['username'])) { $username = $_SESSION['username']; }  else { $username = "Not Logged"; } ?>
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="text-transform:uppercase; font-weight:600"><?php echo $username;?></span>
                                    
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="<?php echo site_url('UserManagement/UserEdit');?>">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Modifica profilo
                                    </a>                        <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->