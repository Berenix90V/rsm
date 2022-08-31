//recupera i parametri in get
/*
*  url browser --> http://www.zzz.it/?nomeParametro=something
*  var param = getUrlParameter('nomeParametro');
*  param --> something
*  Simile a $_GET['nomeParametro'] di php
*/
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};


$('body').addClass('sidebar-toggled');
$('.sidebar').addClass('toggled');

$('.is-active').parent().addClass('td-active');
$('.not-active').parent().addClass('td-not-active');

var aWidth = $('td').find('a');
//console.log(aWidth);



//gestione rapida notifiche
$.ajax({
    url:baseurl+'/Notifiche/notifica_richieste',
    method:'get',
    dataType:'json',
    success:function(result) {
        if (result['bool'] == 'true') {

            var notifiche = $('#notifiche').find('span');
            $(notifiche).text(result['num']);
        }
    }
});
//setta un intervallo tra una notifica e l'altra
setInterval(function() {
    $.ajax({
        url:baseurl+'/Notifiche/notifica_richieste',
        method:'get',
        dataType:'json',
        success:function(result) {
            if (result['bool'] == 'true') {
                // console.log(result['num']);
                var notifiche = $('#notifiche').find('span');
                $(notifiche).text(result['num']);
            }
        }
    });
}, 30000);

//gestione notifiche richieste reparti
//gestione rapida notifiche
$.ajax({
    url:baseurl+'/Notifiche/notifica_richieste_reparti',
    method:'get',
    dataType:'json',
    success:function(result) {
        
        if (result['bool'] == 'true') {

            var notifiche = $('#notifiche2').find('span');
            $(notifiche).text(result['num']);
        }
       
    }
});
//setta un intervallo tra una notifica e l'altra
setInterval(function() {
    $.ajax({
        url:baseurl+'/Notifiche/notifica_richieste_reparti',
        method:'get',
        dataType:'json',
        success:function(result) {

            if (result['bool'] == 'true') {
                // console.log(result['num']);
                var notifiche = $('#notifiche2').find('span');
                $(notifiche).text(result['num']);
            }
           
        }
    });
}, 30000);



//detect nome campo se duplicato
if (getUrlParameter('ref') == '') {
var usrname = $('input[name=usrname]').length;

if ( usrname  > 0) {
    function isUnivoco(el) {
        $.ajax({
            url:baseurl+'/thecontroller/isunique',
            data: {
                table: 'users',
                value: $('input[name=usrname]').val(),
                field: 'USR_usrname'
            },
            method:'post',
            dataType:'html',
            success: function(result) {
                $('.just-exists').remove();
                $(el).css('border-color','#d1d3e2');
                if (result == true) {
                    $(el).css({'border-color':'red', 'position':'relative'}).after('<p style="font-size:10px;text-transform:uppercase; color:red; position:absolute; bottom:-20px; left:0; right:0" class="just-exists">nome utente già esistente</p>');
                }
            }
        });
    }
}



    //on keyup, start the countdown
    var timer = 2000;
    $('input[name=usrname]').on('blur', function() {
        $(this).css('border-color','#d1d3e2');
        console.log(isUnivoco('input[name=usrname]'));

        // var timer = 2000;
        //setTimeout(isUnivoco, timer);
    });
}


//funzione per evidenziare gli errori nella compilazione del form
function validator(cat) {
    //validation in tempo reale dei dati
    $('form').find(':input').on('blur', function() {
        var value = $(this).attr('name');
        var field = $(this);
        $.ajax({
            url:baseurl+'/thecontroller/validator',
            data: {
                param: cat,
                value: value
            }, 
            method:'POST',
            dataType:'html',
            success: function(result) {

                if (result == "true") {
                    console.log($(field).val());
                    if ( $(field).val() == '' || $(field).val() == null) {
                        $(field).css('border-color','red');

                    } else {
                        $(field).css('border-color','#d1d3e2');

                    }
                } 
            }

        });
    });
}
//validazione on submit

function controlSubmit(cat) {
    $.ajax({
        url:baseurl+'/thecontroller/validatorSubmit',
        data: {
            param: cat
        }, 
        method:'POST',
        dataType:'json',
        success: function(result) {
           // $arr = [];
            for (var i = 0; i < result.length; i++) {
               /* var singleVal = '';
                singleVal = $(':input[name='+result[i]+']').val();
               // console.log(singleVal);
                if ( singleVal == '' || singleVal == null) {
                    $arr.push('1');
                   
                }*/
                $(':input[name='+result[i]+']').prop('required', true);
            }
            /* 
            if ($arr.length > 0) {
                $(':input[type=submit]').css('opacity','0.5');
                    $(':input[type=submit]').click(function(e) {
                        return false;
                    });
            } else {
                    $(':input[type=submit]').css('opacity','1');
                    $(':input[type=submit]').unbind('click');
            }
            setTimeout(function() { controlSubmit(cat); }, 1000);
            */
        }

    });
    
}

//console.log($('form').find(':input'));
var cat = getUrlParameter('regtab');
var ref = getUrlParameter('ref');
var validationErrors = [];
var laPath = document.location.href.match(/[^\/]+$/)[0];

if (ref != undefined) {
    var newPath = laPath.split('?');
    laPath=newPath[0];
}
console.log(laPath);
console.log(ref);
//controlSubmit(cat != '' ? cat : laPath);
if (cat !='' && cat != undefined) {
    if ($('.user-edit').length > 0) {
        controlSubmit('user-edit');
        validator('user-edit');
    } else {
        controlSubmit(cat);
        validator(cat);
    }
} else {
    controlSubmit(laPath);
    validator(laPath);
}


//rimuovo la funzione di salvataggio tramite invio
$(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});

