<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/jquery.print/kinzi.print.min.js') }}"></script>
<script>
    // $(document).ready(function(){
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif

        $('select').select2();

        let table = $('#table').DataTable({
            dom: 'Blrtsip',
            // fixedHeader: true,
            lengthChange: true,
            // searching: true,
            buttons: [
                // {extend:'copyHtml5', className: 'btn-info btn-sm'},
                {extend: 'excelHtml5', className: 'btn-info btn-sm'},
                {extend: 'pdfHtml5', className: 'btn-info btn-sm'},
                {extend: 'print', className: 'btn-info btn-sm'},
            ],
            lengthMenu: [
                [20, 50, 100, -1],
                [20, 50, 100, "Todos"]
            ],
            initComplete: function() {
                $("#table").show();
                $('.dataTables_paginate, .dataTables_info, .dataTables_filter, .dataTables_length').addClass('d-print-none');
                $('select[name="table_length"]').addClass('col-md-6').select2();
            },
            info: true,
            responsive: true,
            /* language: {
                url: '{{ asset("js/dataTables.pt_br.json") }}'
            },  */
            ordering: false,
            language: {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                oPaginate: {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                oAria: {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                select: {
                    "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                    }
                },
                buttons: {
                    "copy": "<i class='fad fa-copy'></i> Copiar",
                    "copyTitle": "Cópia bem sucedida",
                    "copySuccess": {
                        "1": "Uma linha copiada com sucesso",
                        "_": "%d linhas copiadas com sucesso"
                    },
                    'print': '<i class="fad fa-print"></i> Imprimir',
                    'excel': '<i class="fad fa-file-excel"></i> Excel',
                    'pdf': '<i class="fad fa-file-pdf"></i> PDF',
                }
            }
        });

        $('.dataTablea thead th').each(function(){
            let title = $(this).text();
            $(this).html('<input type="text" class="form-control form-control-sm col-lg-12 col-xs-2" placeholder="'+title+'" />')
        });

        table.columns().every(function(){
            let that = this;
            $("input", this.header()).on('keyup change', function(){
                if(that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            })
        });

        table.buttons().container().addClass('float-right elevation-3-info mb-2')
        .appendTo('#table_wrapper .col-md-6:eq(0) float-right' );

        $('#delete .no').on('click', function(){
            $('.deleteContent').addClass('flipOutX').removeClass('bounceIn');
                setTimeout(function() {
                    $('#delete').modal('hide');                    
            }, 600)
        });

        function confirmDelete(item_id) {
            $('#delete .deleteContent').addClass('bounceIn').removeClass('flipOutX');
            $('#deleteForm').attr('action', item_id);
        }
        
        $(document).on('click', '#getChamado', function (e) {
            e.preventDefault();
            let url = $(this).data('url');
            $('.message-modal').html('');
            $('#modal-loader').show();
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function (data) {
                // console.log(data);
                $('.message-modal').html('');
                $('.message-modal').html(data); // load response
                $('#modal-loader').hide();      // hide ajax loader
            })
            .fail(function () {
                $('#dynamic-content').html('<i class="fas fa-sign"></i> Something went wrong, Please try again...');
                $('#modal-loader').hide();
            });
        });

        $('#state_id').on('change',function(e){
                                
            $('#cite_id').find('option').remove().end();
            var cat_id = $('#state_id option:selected').attr('value');
        
            var info=$.get('/get-cidades/' + cat_id);
            info.done(function(data){
                $.each(data,function(index,subcatObj){
                    $('#cite_id').append('<option value="'+subcatObj.id+'">'+	subcatObj.title+'</option>').addClass('is-valid');
                });
            });
            info.fail(function(){
                alert('ok');
            });
        });

        $('.form-control').addClass('text-base font-mono shadow appearance-none bordera rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline');

        $('#filter').click(function () {
			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();
			if (from_date != '' && to_date != '') {
				// $('#tablea').DataTable().destroy();
				// fill_datatable(from_date, to_date);
				$('#formSearch').submit();
			}
			else {
				alert('Both Date is required');
			}
    	});
        
    // });
</script>