    // $('.dataTables-action').DataTable({
    //     stateSave: true,
    //     pageLength: 50,
    //     responsive: true,
    //     autoWidth: false,
    //     dom: 'tp',
    //     columnDefs: [ 
    //     { targets: 'no-sort', orderable: false },
    //     { targets: 'no-show',visible: false, searchable: false },
    //         ],
    //     language: {
    //         "decimal":        "",
    //         "emptyTable":     "Pas de données disponibles",
    //         "info":           "De _START_ à _END_ sur _TOTAL_ actions",
    //         "infoEmpty":      "De 0 à 0 sur 0 action",
    //         "infoFiltered":   "(filtered from _MAX_ total entries)",
    //         "infoPostFix":    "",
    //         "thousands":      ",",
    //         "lengthMenu":     "Afficher _MENU_ actions",
    //         "loadingRecords": "Loading...",
    //         "processing":     "Processing...",
    //         "search":         "<span style='font-size: 18px;'><img src='/bootstrap-icons-1/search.svg' alt='' width='16' height='16' title='Bootstrap'></span>",
    //         "zeroRecords":    "Pas de résultat pour cette recherche",
    //         "paginate": {
    //             "first":      "Premier",
    //             "last":       "Dernier",
    //             "next":       "Suivant",
    //             "previous":   "Précédent"
    //         },
    //         "aria": {
    //             "sortAscending":  ": Tri montant",
    //             "sortDescending": ": Tri descendant"
    //         },
    //     },
    //     select: {
    //         style: 'multi'
    //     },
    //     initComplete: function() {
    //         var table = $('.dataTables-action').DataTable();
    //         table.on( 'search.dt', function () {
    //             var info = table.page.info();
    //             var rowsshown = info.recordsDisplay;
    //             $('.rowcountview-action').html( rowsshown );
    //         } );
    //         table.on( 'select', function () {
    //             var rowsselect = table.rows( { selected: true } ).count();
    //             $('.rowcountselect-action').html( rowsselect );
    //         } );
    //         table.off( 'select', function () {
    //             var rowsselect = table.rows( { selected: true } ).count();
    //             $('.rowcountselect-action').html( rowsselect );
    //         } );
    //         var info = table.page.info();
    //         var rowstot = info.recordsTotal;
    //         var rowsshown = info.recordsDisplay;
    //         const newLocal = '.rowcounttot-action';
    //         const newLocal1 = '.rowcountview-action';
    //         $(newLocal).text(rowstot);
    //         $(newLocal1).text(rowsshown);
    //         $("#searchdt-action").keyup(function() {
    //             table.search($(this).val()).draw();
    //         }); 
    //         new $.fn.dataTable.Buttons(table, {
    //             buttons: [
    //                 {
    //                     extend: 'collection',
    //                     text: 'Télécharger',
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
    //     }).container().appendTo($('#buttondt-action'));
            
        
    //     }
    // });
