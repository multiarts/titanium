<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
<script>
    $('select').select2();

    $('#table').DataTable({
        info: false,
		responsive: true,
		language: {
			url: '{{ asset("js/dataTables.pt_br.json") }}'
		},
	});

	$('#delete .no').on('click', function(){
		$('.modal-content').addClass('flipOutX').removeClass('bounceIn');
			setTimeout(function() {
				$('#delete').modal('hide')
		}, 600)
	});

	function confirmDeleteA(item_id) {
		$('.modal-content').addClass('bounceIn').removeClass('flipOutX');
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
                $('#cite_id').append('<option value="'+subcatObj.id+'">'+	subcatObj.title+'</option>');
            });
        });
        info.fail(function(){
            alert('ok');
        });
    });

</script>