// IIFE - Immediately Invoked Function Expression
(function(yourcode) {

	//The global jQuery object is passed as a parameter
	yourcode(window.jQuery, window, document);

}(function($, window, document){

	// The $ is now locally scoped
	$(function() {
		console.log("isLoad");
		// The DOM is ready!
		$("#variable").on("keyup paste change focus blur keydown",function(event) {
			var data = {variableID:$(this).val()}
			$("#variable_conteiner").empty();

			getVariableSelect(data)
			.done(function(response){
				if (response.correct) {
					$("#variable_conteiner").append(response.variable);
				}else{
					// toastr.error("Fall");
				}
			});
		});

	});

		console.log("other");
		var base_url = window.location.origin+"/hawc/index.php/";
		// The rest of your code goes here!
		function getVariableSelect (data) {
			return $.ajax({
				url: base_url +"Hawc/getVariableSelect",
				cache: false,
				type: "post",
				data: data,
				dataType: 'json'
			});
		}
	}
));