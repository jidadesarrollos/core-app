$(document).ready(function () {
        'use strict';

        $.fn.dataTable.ext.errMode = 'throw';

        let filtroFechaInicio = $('#fecha-inicio').get(0);
        let filtroFechaFin = $('#fecha-fin').get(0);
        let $datatable = $('.datatable');

        let btnBusqueda = $('#btn-busqueda').get(0);

        btnBusqueda.addEventListener('click', () => table.draw());

        $.fn.dataTable.ext.search.push(
            function (settings, data) {

                if (!filtroFechaInicio.value && !filtroFechaFin.value) {
                    return true;
                }

                if (!data[2] && !!filtroFechaInicio.value || !data[3] && !!filtroFechaFin.value) {
                    return false;
                }

                let fechainicio = moment(data[2]);
                let fechaFin = moment(data[3]);
                let min = moment(filtroFechaInicio.value);
                let max = moment(filtroFechaFin.value);

                let inicioValido = !filtroFechaInicio.value || fechainicio.isSameOrAfter(min, 'day');
                let finValido = !filtroFechaFin.value || fechaFin.isSameOrBefore(max, 'day');

                return inicioValido && finValido;
            }
        );

        let table = $datatable.DataTable({
            'autoWidth': false,
            'ajax': '/jadmin/actividades/protodata',

            'columns': [
                {'data': 'descripcion'},
                {'data': 'horas'},
                {'data': 'fecha_inicio'},
                {'data': 'fecha_entrega'},
                {'data': 'centro_costo'},
                {'data': 'subcentro_costo'},
                {'data': 'usuario'},
                {
                    'data': 'id_actividad',
                    'render': function (data) {
                        let links = [
                            `<a href='/jadmin/actividades/gestion/${data}/' class='btn' title="Editar"><span class='fas fa-edit'></span></a>`,
                            `<a href='/jadmin/actividades/eliminar/${data}/' class='btn' title="Eliminar"><span class='fas fa-trash'></span></a>`
                        ];
                        return links.join('');
                    }
                }
            ],
            'aaSorting': [],
            'responsive': true,
            'language': JD_DATATABLE_LANGUAGE,
            'footerCallback': function () {
                let api = this.api();

                let total = api.column(1)
                    .data()
                    .reduce((total, b) => total + parseFloat(b), 0);

                let filtroTotal = api.column(1, {'filter': 'applied'})
                    .data()
                    .reduce((total, b) => total + parseFloat(b), 0);

                $(api.column(7).footer()).html(`Filtro: ${filtroTotal.toFixed(2)} <br/> (${total.toFixed(2)} Totales)`);
            },
            'initComplete': function () {

                let api = this.api();
                let responsable = api.column(6);
                let $responsable = $('#responsable');

                let select = $responsable.on('change', function () {
                    let val = $.fn.dataTable.util.escapeRegex(this.value);
                    responsable
                        .search(val ? `^${val}$` : '', true, false)
                        .draw();
                });

                responsable.data().unique().sort().each((d) => select.append(`<option value="${d}">${d}</option>`));

            }
        });

    }
);