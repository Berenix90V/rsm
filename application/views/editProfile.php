<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modifica profilo</h1>
    </div>
    <div style="padding-bottom:20px"></div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h3 mb-0 text-gray-800">Impostazioni generali</h1>
    </div>
    <div class="row">
        <div class="col-lg-6 form-group">
            <label for="username">Nome utente</label>
            <input type="text" class="form-control" name="username" placeholder="Modifica nome utente">
        </div>
        <div class="col-lg-6 form-group">
            <label for="email">Modifica email</label>
            <input type="email" class="form-control" name="email" placeholder="Modifica email">
        </div>
       
    </div>
    <div style="padding-bottom:20px"></div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h3 mb-0 text-gray-800">Impostazioni avanzate</h1>
    </div>

    <div class="row">   
        <div class="col-lg-6 form-group">
            <label for="password">Modifica password</label>
            <input type="text" class="form-control" name="password" placeholder="Modifica password">
        </div>
        <div class="col-lg-6 form-group">
            <label for="role">Modifica ruolo</label>
            <select name="role" class="form-control">
                <option selected value="" disabled>Seleziona un valore</option>
                <option value="admin">Amministratore</option>
                <option value="standard">Utente standard</option>
            </select>
        </div>
    </div>
    <div class="row" style="padding:20px 0">
       <div class="col-md-12">
        <button type="button" class="btn btn-primary">Salva informazioni</button>
        </div>
    </div>
    
    
</div>