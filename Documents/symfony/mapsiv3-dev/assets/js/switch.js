/* Function recevant les demandes de navigation sur le div main */
$('.switch').on('click', function () {
    var entite = $(this).data('entite') ;
    var domaine;
    var trans = $(this).data('trans') ;
    var tdb = $(this).data('tdb') ;
    if( $(this).data('domid')) { 
        domid = $(this).data('domid') ;
        $( ".tablist" ).addClass('d-none');
        $( "."+domid ).removeClass('d-none');
    }else
    {
        var pathArray = window.location.pathname.split('/');
        domid = pathArray[2];
    }
    
    $.masterswitch(domid, entite, domaine, trans, tdb);
    getDomaineTitle(domid);


    $('.sparklines').sparkline('html', { enableTagOptions: true });


    
});

jQuery.tabswitch = function tabSwitch(domid, entite, domaine, trans, tdb) {
    $( ".tablist" ).addClass('d-none');
    $( "."+domid ).removeClass('d-none');
    $.masterswitch(domid, entite, domaine, trans, tdb);
   
    getDomaineTitle(domid);
    $('.sparklines').sparkline('html', { enableTagOptions: true });
}

jQuery.masterswitch = function masterSwitch(domid, entite, domaine, trans, tdb) {

    $("#overlay").fadeIn(300);
    
    var datatablename = '#dataTables-'+entite;
    var smname = entite;


    if( trans ) 
    {   url = '/app/'+domid+'/'+entite;
    } 
    else if  ( tdb )
    {   url = '/app/'+domid+'/tdb/'+entite;
    }
    else
    {   url = '/app/'+domid+'/'+entite;  }

    console.log("switcher :"+entite+"-> url : "+url);

    if( tdb ) { 
        showTDB(entite,domid, url);
        console.log('page tdb');
    } else
    { console.log('page tableau'); if ( $.fn.dataTable.isDataTable( datatablename ) ) { $(datatablename).DataTable().ajax.url( url ).load(); } else { getDT(entite, datatablename, smname, url); }}
        
    $( ".panshowman" ).removeClass( "active show" );
    $("#"+entite+"link" ).addClass( "active show" );
    $("#"+entite).tab('show');
    console.log('show');
    
    $("#overlay").fadeOut(300);  
    window.history.pushState('', '', url); 


    
}


function getDT(entite, datatablename, smname, url) {
    var url = url;
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url, 
        async:      true, 
        success: function(d) {
            console.log(d.columns+'get columns');
            console.log(d.data+'get data');
            console.log("End switcher");
                    
            var table = $(datatablename).DataTable({
                ajax: url,
                columns: d.columns,
                stateSave: true,
                pageLength: 50,
                responsive: true,
                autoWidth: false,
                colReorder: true,
                searching: true,
                // orderCellsTop: true,
                select: {
                    style:    'multi',
                    selector: 'td:first-child'
                },
                order: [[ 1, 'asc' ]],
                dom: 't',
                columnDefs: [ 
                    { orderable: false, targets: 'tableselect' },
                    { targets: 'no-sort', orderable: false },
                    { targets: 'no-show', visible: false, searchable: false	},
                ],
                language: {
                    "decimal":        "",
                    "emptyTable":     "Pas de données disponibles",
                    "loadingRecords": "Loading...",
                    "processing":     "Processing...",
                    "zeroRecords":    "Oups, il n'y a pas de données correspondant à cette recherche"
                    },
                initComplete: function() {
                $('.sparklines').sparkline('html', { enableTagOptions: true });   
                    
                    $('#searchdt-'+smname).val(table.search());
                    table.on( 'search.dt', function () {
                        var info = table.page.info();
                        var rowsshown = info.recordsDisplay;
                        $('.rowcountview-'+smname).html( rowsshown );
                    } );
                    table.on( 'select deselect', function () {
                        var rowsselect = table.rows( { selected: true } ).count();
                        $('.rowcountselect-'+smname).html( rowsselect );
                    } );
                    var info = table.page.info();
                    var rowstot = info.recordsTotal;
                    var rowsshown = info.recordsDisplay;
                    console.log(info+' '+rowstot+' '+rowsshown)
                    const newLocal = '.rowcounttot-'+smname;
                    const newLocal1 = '.rowcountview-'+smname;
                    $(newLocal).text(rowstot);
                    $(newLocal1).text(rowsshown);
                    $("#searchdt-"+smname).on('keyup change', function () {
                        table.search(this.value).draw();
                    });
                    $(".reset").click(function() {
                        $('#searchdt-'+smname).val("");
                        table.search("").draw();
                    });
                    new $.fn.dataTable.Buttons(table, {
                        buttons: [
                            {
                                extend: 'collection',
                                text: '<i class="bi bi-cloud-download"></i>',
                                tag: 'button',
                                className: 'btn btn-outline',
                                buttons: [
                                    {
                                        extend: 'excelHtml5',
                                        exportOptions: {
                                            columns: '.export'
                                        }
                                    },
                                    {
                                        extend: 'csvHtml5',
                                        exportOptions: {
                                            columns: '.export'
                                        }
                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        exportOptions: {
                                            columns: '.pdf'
                                        }
                                    }
                                ],
                            }
                        ]
                    }).container().appendTo($('#buttondt-'+smname));  
                }   
            }); 

            table.on("click", "th.select-checkbox", function() {
                
                if ($("th.select-checkbox").hasClass("selected")) {
                    table.rows().deselect();
                    $("th.select-checkbox").removeClass("selected");
                } else {
                    table.rows().select();
                    $("th.select-checkbox").addClass("selected");
                }
            }).on("select deselect", function() {
                ("Some selection or deselection going on")
                if (table.rows({
                        selected: true
                    }).count() !== table.rows().count()) {
                    $("th.select-checkbox").removeClass("selected");
                } else {
                    $("th.select-checkbox").addClass("selected");
                }
            });
        }
    });  
}

function showTDB(entite,domid, url)  {
$.ajax({  
        url:         url,  
        type:       'POST',   
        dataType:   'json', 
        async:      true,  
        success: function( data) {  
                $('.page-'+entite).html('');
                $('.page-'+entite).append(data.output);
        },  
        error : function(xhr, textStatus, errorThrown) {  
            console.log('Erreur'); 
            console.log(status);
            alert('Ajax request failed.'); 
            
        }   
    });
}

function getDomaineTitle(domid)  {
    if ( domid=='home') { domaine = "Tableaux de bord GRC"; } 
    else if (domid=='process') { domaine = "Management des processus"; }
    else if (domid=='si') { domaine = "Système d'information"; }
    else if (domid=='asset') { domaine = "Management des assets"; }
    else if (domid=='portfolio') { domaine = "Pilotage du portfolio projet"; }
    else if (domid=='rgpd') { domaine = "Réglement général sur la protection des données"; }
    else if (domid=='environnement') { domaine = "Management du système environnemental"; }
    else if (domid=='risque') { domaine = "Management des risques"; }
    else if (domid=='ctrlinterne') { domaine = "Contrôle interne"; }
    else if (domid=='qualite') { domaine = "Management de la qualité"; }
    else if (domid=='mapsi_customer') { domaine = "Management MAPSI"; }
    else { var domaine = "Tableaux de bord GRC"; }

    $( "#titledomaine" ).html( domaine );
    document.title = 'MAPSI - '+domaine;
}





