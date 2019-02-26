$(document).ready(function () {
    $.fn.dataTable.ext.errMode = 'throw';
    var idfk = $('.datatable').attr('dataref');
    var url = '/jadmin/sub-centros-costos/protodata/' + idfk;
    $('.datatable').DataTable({
            'autoWidth': false,
            'ajax': url,
            'columns': [
                {'data': 'subcentro_costo'},
                {'data': 'horas'},
                {
                    'data': 'id_subcentro_costo',
                    'render': function (data, type, full, meta) {
                        let links = [
                            `<a href='/jadmin/sub-centros-costos/gestion/${idfk}/${data}/' class='btn' title="Editar"><span class='fas fa-edit'></span></a>`,
                            `<a href='/jadmin/sub-centros-costos/eliminar/${idfk}/${data}/' class='btn' title="Eliminar"><span class='fas fa-trash'></span></a>`
                        ];
                        return links.join('');
                    }
                }],
            'responsive': true,
            'language': {

                'sProcessing': 'Procesando...',
                'sLengthMenu': 'Mostrar _MENU_ registros',
                'sZeroRecords': 'No se encontraron resultados',
                'sEmptyTable': 'Ningún dato disponible en esta tabla',
                'sInfo': 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
                'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
                'sInfoPostFix': '',
                'sSearch': 'Buscar: ',
                'sUrl': '',
                'sInfoThousands': ',',
                'sLoadingRecords': 'Cargando...',
                'oPaginate': {
                    'sFirst': 'Primero',
                    'sLast': 'Último',
                    'sNext': 'Siguiente',
                    'sPrevious': 'Anterior'
                },
                'oAria': {
                    'sSortAscending': ': Activar para ordenar la columna de manera ascendente',
                    'sSortDescending': ': Activar para ordenar la columna de manera descendente'
                }
            }

        }
    );
});
