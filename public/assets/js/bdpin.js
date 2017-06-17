$(document).ready(function() {
	
    $('#AllpinTables').DataTable({
        "responsive": true,
        "processing": true,
        "order": [[ 0, "desc" ]]
    });
    
    $('#AllExchangeRateTable').DataTable({
        "responsive": true,
        "processing": true,
        "order": [[ 0, "desc" ]]
    }); 

    $('#AllUserBalance').DataTable({
        "responsive": true,
        "processing": true,
        "order": [[ 0, "desc" ]]
    });

    $( "#topMenu" ).click(function() {
	  $( this ).parent().find(".dropdown-user").show();
	});

	$(document).mouseup(function(e) 
	{
	   var container = $(".dropdown-user");

	   // if the target of the click isn't the container nor a descendant of the container
	   if (!container.is(e.target) && container.has(e.target).length === 0) 
	   {
	       container.hide();
	   }
	});
});