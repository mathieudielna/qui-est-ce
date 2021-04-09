    //    // Setup - add a text input to each footer cell
    //    function getDT() {
    //     $.ajax({
    //         type: 'GET',
    //         dataType: 'json',
    //         url: '/app/activite', 
    //         async:      true, 
    //         success: function(d) {
    //             console.log(d.columns+'get columns');
    //             console.log(d.data+'get data');
    //             var datatablename = '#dataTables-activite';
    //             var smname = 'activite';
    //             console.log("End switcher");
    //             {# $('#processdtdiv').append("<table id='"+datatablename+"' class='table table-bordered select table-hover testfr'></table>"); #}
         
                        
    //             var table = $(datatablename).DataTable({
    //                 {# processing: true,
    //                 serverSide: true, #}
    //                 ajax: "/app/activite",
    //                 columns: d.columns,
    //                 stateSave: true,
    //                 pageLength: 50,
    //                 responsive: true,
    //                 autoWidth: false,
    //                 colReorder: true,
    //                 searching: true,
    //                 // orderCellsTop: true,
    //                 select: {
    //                     style:    'multi',
    //                     selector: 'td:first-child'
    //                 },
    //                 order: [[ 1, 'asc' ]],
    //                 dom: 't',
    //                 columnDefs: [ 
    //                     { targets: 'no-sort', orderable: false },
    //                     { targets: 'no-show',visible: false, searchable: false	},
    //                 ],
    //                 language: {
    //                     "decimal":        "",
    //                     "emptyTable":     "Pas de données disponibles",
    //                     "loadingRecords": "Loading...",
    //                     "processing":     "Processing...",
    //                     "zeroRecords":    "Oups, il n'y a pas de données correspondant à cette recherche"
    //                     },
    //                 initComplete: function() {
    //                     {# var table = $(datatablename).DataTable(); #}
    //                     $('#searchdt-'+smname).val(table.search());
    //                     table.on( 'search.dt', function () {
    //                         var info = table.page.info();
    //                         var rowsshown = info.recordsDisplay;
    //                         $('.rowcountview-'+smname).html( rowsshown );
    //                     } );
    //                     table.on( 'select deselect', function () {
    //                         var rowsselect = table.rows( { selected: true } ).count();
    //                         $('.rowcountselect-'+smname).html( rowsselect );
    //                     } );
    //                     var info = table.page.info();
    //                     var rowstot = info.recordsTotal;
    //                     var rowsshown = info.recordsDisplay;
    //                     console.log(info+' '+rowstot+' '+rowsshown)
    //                     const newLocal = '.rowcounttot-'+smname;
    //                     const newLocal1 = '.rowcountview-'+smname;
    //                     $(newLocal).text(rowstot);
    //                     $(newLocal1).text(rowsshown);
    //                     $("#searchdt-"+smname).on('keyup change', function () {
    //                         table.search(this.value).draw();
    //                     });
    //                     $(".reset").click(function() {
    //                         $('#searchdt-'+smname).val("");
    //                         table.search("").draw();
    //                     });
    //                     new $.fn.dataTable.Buttons(table, {
    //                         buttons: [
    //                             {
    //                                 extend: 'collection',
    //                                 text: '<i class="bi bi-cloud-download"></i>',
    //                                 tag: 'button',
    //                                 className: 'btn btn-outline',
    //                                 buttons: [
    //                                     {
    //                                         extend: 'excelHtml5',
    //                                         exportOptions: {
    //                                             columns: '.export'
    //                                         }
    //                                     },
    //                                     {
    //                                         extend: 'csvHtml5',
    //                                         exportOptions: {
    //                                             columns: '.export'
    //                                         }
    //                                     },
    //                                     {
    //                                         extend: 'pdfHtml5',
    //                                         exportOptions: {
    //                                             columns: '.pdf'
    //                                         }
    //                                     }
    //                                 ],
    //                             }
    //                         ]
    //                     }).container().appendTo($('#buttondt-'+smname));  
    //                 }   
    //             }); 
    //             $("#overlay").fadeOut(300);
    
    //             table.on("click", "th.select-checkbox", function() {
    //                 if ($("th.select-checkbox").hasClass("selected")) {
    //                     table.rows().deselect();
    //                     $("th.select-checkbox").removeClass("selected");
    //                 } else {
    //                     table.rows().select();
    //                     $("th.select-checkbox").addClass("selected");
    //                 }
    //             }).on("select deselect", function() {
    //                 ("Some selection or deselection going on")
    //                 if (table.rows({
    //                         selected: true
    //                     }).count() !== table.rows().count()) {
    //                     $("th.select-checkbox").removeClass("selected");
    //                 } else {
    //                     $("th.select-checkbox").addClass("selected");
    //                 }
    //             });
    //         }
    //     });   
    // }