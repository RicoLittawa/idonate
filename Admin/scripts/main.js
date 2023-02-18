$(document).ready(function(){
    $('#menuBtn').click(function(){
        $('#sidebar').toggleClass('sidebar small-sidebar')
        $('#menuBtn').toggleClass('resposBtn')
        $('.main-content').toggleClass('large-content')

    });
});

	  $(document).ready(function () {
			$('#table_data').DataTable({
			"pagingType":"full_numbers",
			"lengthMenu":[
			[10,25,50,-1],
			[10,25,50,"All"]],
			responsive:true,
			language:{
				search:"_INPUT_",
				searchPlaceholder: "Search Records",
			}

			});
		});
