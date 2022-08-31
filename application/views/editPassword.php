<!DOCTYPE html>
<html lang="en">

    <?php
defined('BASEPATH') OR exit('No direct script access allowed');

// parametri dipendenti dalla tabella di riferimento


//iprint_r($tablearray);
    ?>


    <body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Anagrafica di base 

                <a href="" class="btn btn-primary btn-icon-split addnew-btn button-margin">
                    <span class="icon text-white-50">
                        <i class="fas fa-angle-left"></i>
                    </span>
                    <span class="text">Tabella</span>
                </a>

            </h1>

            <div id="registry-container" class="card shadow mb-4 table-container registry">

                <!-- header -->
                <div id = "card-header-shadow" class="card shadow mb-4">
                    <!-- titolo tabella/ form -->
                    <div id = "card-header" class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary tabletitle">Modifica password Utente</h4>
                    </div> <!-- end # card-header py-3-->
                </div>	 <!-- end  # card-header-shadow -->

                <!-- body card -->
                <div id = "card-body" class="card-body">
                    <form method="post" action = "<?php echo site_url('usermanagement/savenewpassword');?>">
                        <div class="col-md-6 form-group">
                            <label for="oldPassword">Inserire vecchia password</label>
                            <input type="text" name="oldPassword" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="newPassword">Inserire nuova password</label>
                            <input type="text" name="newPassword" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="confirmPassword">Reinserire nuova password</label>
                            <input type="text"  name="confirmPassword" class="form-control">

                        </div>
                        <div style = 'clear:both'></div>

                        <!-- bottone clonazione -->
                        <!--span class="btn btn-success btn-circle btn-lg" onclick = "NewDoc(this)">
<i class="fas fa-plus"></i>
</span-->

                        <div class = "col-md-6 form-group"> <!-- form group-->
                            <button type="submit" class="btn btn-primary" name = "submit">Salva</button>
                        </div> <!-- end form-group -->
                    </form>
                    <!-- fine bottone salva-->

                </div>	<!-- end # card-body  card shadow mb-4 -->

            </div>	<!-- end # registry-container  card shadow mb-4 -->

        </div> 	<!-- end container-fluid -->

    </body>
</html>