<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
{{-- <script src="https://cdn.datatables.net/plug-ins/1.10.21/filtering/row-based/range_dates.js"></script> --}}

<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/jquery.print/kinzi.print.min.js') }}"></script>
<script>
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

$('.custom-file-input').on('change',function(){
	var fileName = $(this).val().split('\\').pop();
	$(this).next('.custom-file-label').addClass("selected").html(fileName);
})

let table = $('#table').DataTable({
    dom: 'Bflrtip',
    info: true,
    responsive: true,
    ordering: true,
    // fixedHeader: true,
    lengthChange: false,
    searching: true,
    buttons: [
        // {extend:'copyHtml5', className: 'btn-info btn-sm'},
        { extend: 'excelHtml5', className: 'btn-info btn-sm' },
        { extend: 'pdfHtml5', className: 'btn-info btn-sm' },
        { extend: 'print', className: 'btn-info btn-sm' },
    ],
    lengthMenu: [
        [20, 50, 100, -1],
        [20, 50, 100, "Todos"]
    ],
    initComplete: function () {
        $("#table").show();
        $('.dataTables_paginate, .dataTables_info, .dataTables_filter, .dataTables_length').addClass('d-print-none');
        $('select[name="table_length"]').addClass('col-md-6').select2();
    },
    
    /* language: {
        url: '{{ asset("js/dataTables.pt_br.json") }}'
    },  */
    
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
    },
});

$('.dataTablea thead th').each(function () {
    let title = $(this).text();
    $(this).html('<input type="text" class="form-control form-control-sm col-lg-12 col-xs-2" placeholder="' + title + '" />')
});

table.columns().every(function () {
    let that = this;
    $("input", this.header()).on('keyup change', function () {
        if (that.search() !== this.value) {
            that.search(this.value).draw();
        }
    })
});

table.buttons().container().addClass('float-left elevation-3-info mb-2').appendTo('#table_wrapper .col-md-6:eq(0) float-right');

$('#delete .no').on('click', function () {
    $('.deleteContent').addClass('flipOutX').removeClass('bounceIn');
    setTimeout(function () {
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

// Client -> SubClient
$('select[name=client_id]').change(function () {
    let idClient = $(this).val();
    $.get('/getSubClient/' + idClient, function (subclient) {
        $('select[name=sub_client_id]').empty();
                $('#sub_client_id').append('<option value="0" selected disabled>Selecione o SubCliente</option>');
        $.each(subclient, function (key, value) {
        $('select[name=sub_client_id]').append('<option value=' + value.id + '>' + value.name + '</option>').prop('disabled', false);
        });
    });
});

// State -> Cite
$('select[name=state_id]').change(function () {
    let idState = $(this).val();
    $.get('/get-cidades/' + idState, function (cidades) {
        $('select[name=cite_id]').empty();
        $('#cite_id').append('<option value="0" selected="selected">Selecione a Cidade</option>');
        $.each(cidades, function (key, value) {
        $('select[name=cite_id]').append('<option value=' + value.id + '>' + value.title + '</option>').prop('disabled', false);
        });
    });
});

$('.form-control').addClass('text-base font-mono shadows appearance-none bordera rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2');

$('#filter').click(function () {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
        $('#formSearch').submit();
    /*if (from_date != '' && to_date != '') {
    }
     else {
        alert('Both Date is required');
    } */
});

$('select[name=type]').change(function(){
    // $('option[data-cot=cot]:selected').addClass('text-success');
    if($('option[data-cot=cot]').is(':selected')){
        // $('#cot').removeClass('invisible zoomOutDown').addClass('fadeIn');
        $('#cot').prop('disabled', false);
    } else {
        $('#cot').prop('disabled', true);
        // $('#cot').addClass(' zoomOutDown').removeClass('fadeIn');
    }
});

// Extend dataTables search
/* $.fn.dataTable.ext.search.push(
  function(settings, data, dataIndex) {
    var min = $('#from_datea').val();
    var max = $('#to_datea').val();
    var createdAt = data[4] || 0; // Our date column in the table

    if (
      (min == "" || max == "") ||
      (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
    ) {
      return true;
    }
    return false;
  }
);

    // --------------------------
 $('.date-range-filter').focusout(function (e) {
        table.draw();

    }); */


// Busca CEP
$("#cep").focusout(function(){
    //Início do Comando AJAX
    $.ajax({
        //O campo URL diz o caminho de onde virá os dados
        //É importante concatenar o valor digitado no CEP
        url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
        //Aqui você deve preencher o tipo de dados que será lido,
        //no caso, estamos lendo JSON.
        dataType: 'json',
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function(resposta){
            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.
            $("#address").val(resposta.logradouro);
            // $("#complemento").val(resposta.complemento);
            // $("#bairro").val(resposta.bairro);
            $("#cite_id").val(resposta.localidade);
            $("#state_id").val(resposta.uf);
            //Vamos incluir para que o Número seja focado automaticamente
            //melhorando a experiência do usuário
            $("#name").focus();
        }
    });
});
</script>