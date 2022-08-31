
//SIDEBAR //
// selezione menù
$(document).ready(function() {
    var string = window.location.href;
    var substring = ['Registry', 'Pfregistry', 'Instock', 'Requests', 'Inrequests', 'Outrequests', 'Totrequests', 'Inventory', 'Archiveinv'];
    substring.forEach(function(element){
        if(string.indexOf(element) !== -1) {
            var strtolow = element.toLowerCase();          
            var navclass = "nav-item-" + strtolow;
            //console.log(strtolow);
            $("."+navclass).addClass('active');            
        }
    })
});


// GENERICI //

//SCRIPT X DISABILITARE PRIMA OPZIONE DI UNA SELECT 
$(document).ready(function(){
    $("select.disablefirst").find("option:first").attr('disabled', 'disabled');
});

// funzione per dare ordine di priorità alle icone e usarla in sort table non sicura che funzioni bene
/*$.fn.dataTable.ext.order['dom-class'] = function(settings, col)
{
    return this.api().column(col, {order:'index'}).nodes().map(function(td, i)
    {
        return $('span', td).hasClass('toconfirm') ? '1' : '2';
    });
}*/



// ANAGRAFICA DI BASE - UTENTI - PERMESSI//
// checkbox automatica x reparto o centrale principale
$('#cwahlist').change(function(){
    var wahid = $(this).val();
    $('#wah_'+wahid).prop('checked', true);
    $('input[type=checkbox].cen').each(function(){
        //$(this).prop("onclick", null);
        $(this).removeAttr("disabled");
    });
    $('#wah_'+wahid).prop('disabled', true);
});
$('#rwahlist').change(function(){
    var wahid = $(this).val();
    $('#wah_'+wahid).prop('checked', true);
    $('input[type=checkbox].rep').each(function(){
        //$(this).prop("onclick", null);
        $(this).removeAttr("disabled");
    });
    $('#wah_'+wahid).prop('disabled', true);
});

$(document).ready(function(){
    var active = $('th:contains("Attivo")').index();
    var table = $('.basic_registry').DataTable();
    table
        .order([ active, 'asc' ], [0, 'asc'])
        .draw();   
});



//GESTIONE PERMESSI
//mostra/nascondi
$(document).ready(function(){
    var value = $('#role').val();
    hideshow(value);
    $('#role').change(function(){
        
        $('#rwahlist').val('choose');
        $('#cwahlist').val('choose');
        $('input[type=checkbox]').prop('checked', false);
        var valore = $(this).val();
        hideshow(valore);
    });
});

//funzione permessi
function hideshow(valore){
    var hidediv = { "rep": "centrali", "wah": "reparti", "admin": ["reparti", "centrali"]};
    var showdiv = { "rep": "reparti", "wah": "centrali", "wahrep": ["reparti", "centrali"]};
    if(valore in hidediv && valore !== "admin"){    
        var tohide = hidediv[valore];
        $("div."+tohide).hide();
        var toshow = showdiv[valore];
        $("div."+toshow).show();
    } else if(valore == "wahrep"){
        var dshow = showdiv[valore];
        for (i = 0; i < dshow.length; i++) { 
            var toshow = dshow[i];
            $("div."+toshow).show();
        }
    } else if(valore == "admin"){
        var dhide = hidediv[valore];
        for (j = 0; j < dhide.length; j++) { 
            var tohide = dhide[j];
            $("div."+tohide).hide();
        }
    } 
}
// fine gestione permessi


// PRODOTTI FORNITORI //

// order table
$(document).ready(function(){
    var active = $('th:contains("Attivo")').index();
    var table = $('.pfregistry').DataTable();
    table
        .order([ active, 'asc' ])
        .draw();   
});


//picker prodotti o fornitori//
$("input.picker").on("keyup", function(){
    $('#tendina').remove();
    //console.log($(this).val());
    $(this).css("position","relative");
    var inputpicker = $(this);
    var valore= $(this).val();
    var name = $(this).attr('name');
    
    if (valore !== "" && $(this).is(":focus")==true){
        $.ajax({
            url: baseurl+'/Custompicker/picker',
            data: {
                name: name,
                valore: valore
            },
            method: "POST",
            dataType:"html",
            success:function(result){
                //console.log(result);
                inputpicker.after(result);
                $('.tendinarow').click(function(){
                    var tdinput = $(this).find("td.toinput");
                    var nome = tdinput.length;
                    for (var i = 0; i < nome; i++) {
                        var iname = $(tdinput[i]).attr('name');
                        var itext = $(tdinput[i]).text();
                        //console.log($(tdinput[i]).attr('name'));
                        $("input[name = '"+iname+"']").val(itext);
                    }                    
                    var nomearticolo = $(this).find("td.show").text();
                    inputpicker.val(nomearticolo);
                    $('#tendina').remove();
                });
            }        
        });
    } 

});

// close tendina//
$(document).mouseup(function tendinaclose(e){
    $menu = $('#tendina');
    if(!$menu.is(e.target)  && $menu.has(e.target).length === 0){
       $('#tendina').remove();
    }
});
// fine picker

// in prodotti - fornitori abilitare data di decadenza o no //
$('select[name = "prsactive"]').change(function(){
    var valactive = $(this).val();
    //console.log($(this).val());
    if(valactive == 0){
        $('input[name = "PRS_end"]').attr('disabled', false);
    } else{
        $('input[name = "PRS_end"]').attr('disabled', true);
    }
    
});




// INSTOCK AGGIORNA AJAX



//filtro
$('select[name = "isv_wahcen"]').change(function(){
    var warehouse = $(this).val();
    
    var path = baseurl+'/Instock/instock_view';
    //console.log(warehouse);
    $.ajax({
        url: path,
        data: {warehouse:warehouse},
        method: "POST",
        dataType:"html",
        success:function(result){
            //$('#archinv_wrapper').remove();
            $('table').remove();
            $('div.row').remove();
            $('div.dataTables_wrapper').remove();
            $('div.no-data').remove();
            $("div#table-responsive").append(result);
            ordertable();
        }       
    });
});



//HIDE COLUMNS INSTOCK - REQUESTS - INREQUESTS

$(document).ready(function(){
    // instock invisible col
var prsid = $('th:contains("PRS_ID")').index();
var stoid = $('th:contains("STO_ID")').index();
var supid = $('th:contains("Fornitore")').index();
var table = $('.instock_batch').DataTable();
    table.columns([prsid, stoid, supid]).visible(false);
    table.columns.adjust().draw( false ); // adjust column sizing and redraw

    // requests invisible col
var stowahid = $('th:contains("STO_WAH_ID")').index();
var table = $('.requests_batch').DataTable();
    table.columns([stoid, stowahid]).visible(false);
    table.columns.adjust().draw( false ); // adjust column sizing and redraw

    //inrequests invisible column
var reqid = $('th:contains("REQ_ID")').index();
var prowahid = $('th:contains("ID mag prodotto")').index();
var reqwahid = $('th:contains("ID mag richiedente")').index();
var table = $('.inreq_wahtable').DataTable();
    table.columns([reqid, prowahid, reqwahid]).visible(false);
    table.columns.adjust().draw( false ); // adjust column sizing and redraw
    
   



// TABELLE IN BATCH A + PAGINE CON ID NASCOSTI
// INSTOCK TABELLA IN BATCH
$('form#batchcarico').submit( function(e) {
    var table = $('.batchtable').DataTable()
    e.preventDefault();    
    //var alldata = table.$('input, select').serialize();
    var alldata = table.$('input, select');

    // cicletto x pescare nome valore
    var alldatalength = alldata.length;
    var alldataarray = new Object();
    for(var i = 0; i < alldatalength; i++){
        var nome=$(alldata[i]).attr('name');
        var valore = $(alldata[i]).val();
        alldataarray[nome] = valore;
    }

    // seleziono input stoid
    var stoID = table.column(stoid).data();
    //seleziono input
    var stoidlength = stoID.length;
    for(var i = 0; i < stoidlength; i++){
        var nome=$(stoID[i]).attr('name');
        var valore = $(stoID[i]).val();
        alldataarray[nome] = valore;   
    }

    // seleziono input prsid
    var prsID = table.column(prsid).data();
    //seleziono input
    var prsidlength = prsID.length;
    for(var i = 0; i < prsidlength; i++){
        var nome=$(prsID[i]).attr('name');
        var valore = $(prsID[i]).val();
        alldataarray[nome] = valore;   
    }  
    console.log(alldataarray);

    var warehouseid = $('input[name="instockwah"').val();
    var path = $(this).attr('action');
    console.log(warehouseid);
    $.ajax({
        url: path,
        data: {'alldataarray':alldataarray, 'warehouseid':warehouseid},
        method: "POST",
        dataType:"html",
        success:function(result){
            console.log(result);
            location.href = baseurl+'/Instock/instock_successsubmit';
        }       
    });
} ); 

// REQUESTS TABELLA IN BATCH
$('form#batchrequests').submit( function(e) {
    var table = $('.batchtable').DataTable()
    e.preventDefault();    
    //var alldata = table.$('input, select').serialize();
    var alldata = table.$('input, select');

    // cicletto x pescare nome valore
    var alldatalength = alldata.length;
    var alldataarray = new Object();
    for(var i = 0; i < alldatalength; i++){
        var nome=$(alldata[i]).attr('name');
        var valore = $(alldata[i]).val();
        alldataarray[nome] = valore;
    }

    // seleziono input stoid
    var stoID = table.column(stoid).data();
    //seleziono input
    var stoidlength = stoID.length;
    for(var i = 0; i < stoidlength; i++){
        var nome=$(stoID[i]).attr('name');
        var valore = $(stoID[i]).val();
        alldataarray[nome] = valore;   
    }

    // seleziono input stowahid
    var stowahID = table.column(stowahid).data();
    //seleziono input
    var stowahidlength = stowahID.length;
    for(var i = 0; i < stowahidlength; i++){
        var nome=$(stowahID[i]).attr('name');
        var valore = $(stowahID[i]).val();
        alldataarray[nome] = valore;   
    }  
    console.log(alldataarray);

    var rwarehouseid = $('input[name="rwahid"]').val();
    var path = $(this).attr('action');
    $.ajax({
        url: path,
        data: {'alldataarray':alldataarray, 'rwarehouseid':rwarehouseid},
        method: "POST",
        dataType:"html",
        success:function(result){
            console.log(result);
            location.href = baseurl+'/Requests/requests_successsubmit';
        }       
    });
} ); 
// INREQUESTS

// INREQUESTS AGGIORNA AJAX
//filtro
$('select[name = "inreq_wahcen"]').change(function(){
    var warehouse1 = $(this).val();
    
    var path = baseurl+'/Inrequests/inrequests_view';
    //console.log(warehouse1);
    $.ajax({
        url: path,
        data: {warehouse1:warehouse1},
        method: "POST",
        dataType:"html",
        success:function(result){
            //$('#archinv_wrapper').remove();
            $('table').remove();
            $('div.row').remove();
            $('div.dataTables_wrapper').remove();
            $('div.no-data').remove();
            $("div#table-responsive").append(result);
            orderinreqtable();
        }       
    });
});
// FINE AGGIORNA AJAX

// OUTREQUESTS AGGIORNA AJAX
//filtro
$('select[name = "outreq_wahrep"]').change(function(){
    var warehouse2 = $(this).val();
    
    var path = baseurl+'/Outrequests/outrequests_view';
    console.log(warehouse2);
    $.ajax({
        url: path,
        data: {warehouse2:warehouse2},
        method: "POST",
        dataType:"html",
        success:function(result){
            //$('#archinv_wrapper').remove();
            $('table').remove();
            $('div.row').remove();
            $('div.dataTables_wrapper').remove();
            $('div.no-data').remove();
            $("div#table-responsive").append(result);
            orderoutreqtable();
        }       
    });
});
// FINE AGGIORNA AJAX

// INREQUESTS TABELLA IN BATCH
$('form#inreqwahtable').submit( function(e) {
    var table = $('.batchtable').DataTable()
    e.preventDefault();    
    //var alldata = table.$('input, select').serialize();
    var alldata = table.$('input, select');

    // cicletto x pescare nome valore
    var alldatalength = alldata.length;
    var alldataarray = new Object();
    for(var i = 0; i < alldatalength; i++){
        var nome=$(alldata[i]).attr('name');
        var valore = $(alldata[i]).val();
        alldataarray[nome] = valore;
    }

    // seleziono input reqid
    var reqID = table.column(reqid).data();
    //seleziono input
    var reqidlength = reqID.length;
    for(var i = 0; i < reqidlength; i++){
        var nome=$(reqID[i]).attr('name');
        var valore = $(reqID[i]).val();
        alldataarray[nome] = valore;   
    }

    // seleziono input prowahid
    var prowahID = table.column(prowahid).data();
    //seleziono input
    var prowahidlength = prowahID.length;
    for(var i = 0; i < prowahidlength; i++){
        var nome=$(prowahID[i]).attr('name');
        var valore = $(prowahID[i]).val();
        alldataarray[nome] = valore;   
    } 
    
    // seleziono input reqwahid
    var reqwahID = table.column(reqwahid).data();
    //seleziono input
    var reqwahidlength = reqwahID.length;
    for(var i = 0; i < reqwahidlength; i++){
        var nome=$(reqwahID[i]).attr('name');
        var valore = $(reqwahID[i]).val();
        alldataarray[nome] = valore;   
    }  
    //console.log(alldataarray);

    var path = $(this).attr('action');
    $.ajax({
        url: path,
        data: {'alldataarray':alldataarray},
        method: "POST",
        dataType:"html",
        success:function(result){
            console.log(result);
            location.href = baseurl+'/Inrequests/inrequests_successsubmit';
        }       
    });
} ); 


});

// FINE TABELLE IN BATCH




////RICHIESTE///

/*$(document).ready(function() {
    $('.outrequests-table').DataTable({
        "searching": true,
        "paging":   false,
        "ordering": true,
        "info":     true,
        columnDefs: [
            {targets: 7, "orderDataType": "dom-class", type: 'string'},
        ]
    });
} );*/



// ordine tabella icone conferma e in coda x tutte le richieste

function orderinreqtable(){
    var table = $('.inrequests-table').DataTable();
    var pro = $('th:contains("Conferma magazzino")').index();
    var req = $('th:contains("Conferma richiedente")').index();
        table
            .order([pro, 'desc'], [req, 'asc'])
            .draw();
}

function orderoutreqtable(){
    var table = $('.outrequests-table').DataTable();
    //var pro = $('th:contains("Conferma magazzino")').index();
    var req = $('th:contains("Conferma magazzino richiedente")').index();
        table
            .order([req, 'asc'])
            .draw();
}


$(document).ready(function(){

orderinreqtable()
orderoutreqtable();

var table = $('.totrequests-table').DataTable();
var reqid = $('th:contains("Contenuto per confezione")').index();
var prowahid = $('th:contains("Fornitore")').index();
var pro = $('th:contains("Conferma magazzino prodotto")').index();
var req = $('th:contains("Conferma magazzino richiedente")').index();
    table
        .order([req, 'asc'], [pro, 'desc'] )
        .draw();
    table.columns([reqid, prowahid]).visible(false);
    table.columns.adjust().draw( false ); // adjust column sizing and redraw

});



/// VALIDI X + TABELLE
// Table navigation - valida per instock, requests e inventory
$('.tablearrow').arrowTable({
    enabledKeys: ['left', 'right', 'up', 'down'],
    listenTarget: 'input',
    focusTarget: 'input',
    namespace: 'arrowtable',
    continuousDelay: 50,

    // Function to call before navigating
  beforeMove: function(input, targetFinder, direction){
    // do something
  },      

  // Function to call after navigating
  afterMove: function(input, targetFinder, direction){
    // do something
  },  
});


/// INVENTARIO // 

// script calcolo inventario 
$("tr input.endinv, input.begininv ").on("keyup", function(){
    
    // begin consumo pezzi 
    var endinv = $(this).closest('tr').find("input.endinv").val();
    var endinv = Number(endinv);
    var richieste = $(this).closest('tr').find("input.totrequests").val();  
    var richieste = Number(richieste);
    //var richieste = $(richieste[0]).text();
    var begininv = $(this).closest('tr').find("input.begininv").val();
    var begininv = Number(begininv);
    
    var consumi = (richieste + begininv) - endinv;
    $(this).closest('tr').find("input.consumption").val(consumi);
    // end consumo pezzi

    // begin cost
    var colsinglecost = $('th:contains("Costo pz (euro)")').index();
    var realcolcost = colsinglecost + 1;
    var costopz = $(this).closest('tr').find("td:nth-child(" + realcolcost + ")").text();
    var costopz = Number(costopz);
    var costotot = costopz * consumi;
    costotot = costotot.toFixed(2);
    $(this).closest('tr').find("input.totalcost").val(costotot); 
    //end cost 
    
    //begin cost tot
    var totsum = 0;
    $('input.totalcost').each(function(){
        totsum += Number($(this).val());  // Or this.innerHTML, this.innerText      
    });
    totsum = totsum.toFixed(2);
    $("input#totale").val(totsum);
    //end cost tot

     //begin cat cost tot
    $('input.cats').each(function(){
        var name = $(this).attr('name');
        var catsum = 0;
        $('input.totalcost.'+name).each(function(){
            catsum += Number($(this).val());  // Or this.innerHTML, this.innerText      
        });
        catsum = catsum.toFixed(2);
        $(this).val(catsum);
    });
     //end cat cost tot



});



// ARCHIVIO INVENTARI
$(document).ready(function() {
      
    //filtro
    $('select[name = "chooseyear"]').change(function(){
        var year = $(this).val();
        var warehouse = $('#warehouse').val();
        
        var path = baseurl+'/Archiveinv/archinv_tot_wah_view';
        //console.log(warehouse);
        $.ajax({
            url: path,
            data: {year:year , warehouse:warehouse},
            method: "POST",
            dataType:"html",
            //dataType:"json",
            success:function(result){
                
                //$('#archinv_wrapper').remove();
                $('table').remove();
                $('div.row').remove();
                /*var secondrow = document.getElementById("archinv_wrapper").firstElementChild.nextSibling; //dentro row
                var colinsiderow = secondrow.firstElementChild; //dentro col*/
                $("div#table-responsive").append(result);
                /*
                $("archinv_wrapper").append(result);*/
                // riordino tabella
                ordertable();
            }       
        });
    });    
} );   


// attribuire classe details-control in archivio
/*function ordertable(){
    $('#archinv').DataTable({
        columns: [{
            className: "details-control", "targets": [ 0 ] 
        }],
        
        
    });
}*/     // da vedere se posso toglierlo

// ordine tabelle generico per prima colonna e sorting
$(document).ready(function() {
    //ordine
    ordertable();
    
});
function ordertable(){
    $('.orderable').DataTable({
        columnDefs: [{
            orderable: true,
        }],
        "order": [[ 0, "asc" ]]
        
    });
}






/*
$(document).ready(function() {
    var table = $('#example').DataTable({
        columnDefs: [{
            orderable: false,
            targets: [1,2,3]
        }]
    });
 
    $('button').click( function() {
        var data = table.$('input, select').serialize();
        alert(
            "The following data would have been submitted to the server: \n\n"+
            data.substr( 0, 120 )+'...'
        );
        return false;
    } );
} );
*/ 














