// // Setup - add a text input to each footer cell
 
// var datatablename = '#dataTables-application';
// var smname = 'application';


// $(datatablename+' thead tr').clone(true).appendTo( datatablename+' thead' ); 

// $(datatablename+' thead tr:eq(1) th').each( function (i) {
//     var title = $(this).text();
//     if(title != ''){
//     $(this).html( '<input type="text" class="form-control form-control-sm" placeholder="" />' );

//     $( 'input', this ).on( 'keyup change', function () {
//         if ( table.column(i).search() !== this.value ) {
//             table
//                 .column(i)
//                 .search( this.value )
//                 .draw();
//         }
//     } );
//     }
// }
// );


// var table = $(datatablename).DataTable({
//     stateSave: true,
//     pageLength: 50,
//     responsive: true,
//     autoWidth: false,
//     colReorder: true,
//     searching: true,
//     orderCellsTop: true,
//     select: {
//         style:    'multi',
//         selector: 'td:first-child'
//     },
//     order: [[ 1, 'asc' ]],
//     dom: 't',
//     columnDefs: [ 
//     { targets: 'no-sort', orderable: false },
//     { targets: 'no-show',visible: false, searchable: false	},
//     { targets: 'action-btn',searchable: false },
//     { orderable: false, searchable: false, className: 'select-checkbox', targets:   0 }
//         ],
//     language: {
//          "decimal":        "",
//            "emptyTable":     "Pas de données disponibles",
//            "info":           "De _START_ à _END_ sur _TOTAL_ smname",
//            "infoEmpty":      "De 0 à 0 sur 0 projet",
//            "infoFiltered":   "(filtered from _MAX_ total entries)",
//            "infoPostFix":    "",
//            "thousands":      ",",
//            "lengthMenu":     "Afficher _MENU_ smname",
//            "loadingRecords": "Loading...",
//            "processing":     "Processing...",
//            "search":         "<span style='font-size: 18px;'><img src='/bootstrap-icons-1/search.svg' alt='' width='16' height='16' title='Bootstrap'></span>",
//            "zeroRecords":    "Oups, il n'y a pas de données correspondant à cette recherche",
//            "paginate": {
//                "first":      "Premier",
//                "last":       "Dernier",
//                "next":       "Suivant",
//                "previous":   "Précédent"
//            },
//            "aria": {
//                "sortAscending":  ": Tri montant",
//                "sortDescending": ": Tri descendant"
//            }
//         },
//     initComplete: function() {
//         var table = $(datatablename).DataTable();
//         table.columns().every( function () {
//             var column = this;
//             column
//                     .search( '' )
//                     .draw();
//         } );
//         $('#searchdt-'+smname).val(table.search());
//         table.on( 'search.dt', function () {
            
//             var info = table.page.info();
//             var rowsshown = info.recordsDisplay;
//             $('.rowcountview-'+smname).html( rowsshown );
//         } );
//         table.on( 'select deselect', function () {
//             var rowsselect = table.rows( { selected: true } ).count();
//             $('.rowcountselect-'+smname).html( rowsselect );
//         } );
//         var info = table.page.info();
//         var rowstot = info.recordsTotal;
//         var rowsshown = info.recordsDisplay;
//         const newLocal = '.rowcounttot-'+smname;
//         const newLocal1 = '.rowcountview-'+smname;
//         $(newLocal).text(rowstot);
//         $(newLocal1).text(rowsshown);
//         $("#searchdt-"+smname).on('keyup change', function () {
//             table.search(this.value).draw();
//         });
//         $(".reset").click(function() {
//             $('#searchdt-'+smname).val("");
//             table.search("").draw();
            
//         });
//         new $.fn.dataTable.Buttons(table, {
//             buttons: [
//                 {
//                     extend: 'collection',
//                     text: '<i class="bi bi-cloud-download"></i>',
//                     tag: 'button',
//                     className: 'btn btn-outline',
//                     buttons: [
//                         {
//                             extend: 'excelHtml5',
//                             exportOptions: {
//                                 columns: '.export'
//                             }
//                         },
//                         {
//                             extend: 'csvHtml5',
//                             exportOptions: {
//                                 columns: '.export'
//                             }
//                         },
//                         {
//                             extend: 'pdfHtml5',
//                             exportOptions: {
//                                 columns: '.pdf'
//                             }
//                         }
//                     ],
//                 }
//             ]
//         }).container().appendTo($('#buttondt-'+smname));                
//     }
        
// });


