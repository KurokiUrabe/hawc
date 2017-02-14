// IIFE - Immediately Invoked Function Expression
(function(yourcode) {

	//The global jQuery object is passed as a parameter
	yourcode(window.jQuery, window, document);

}(function($, window, document){

	// The $ is now locally scoped
	$(function() {
		console.log("isLoad");
		// The DOM is ready!
		$( "#variable_conteiner" ).sortable();
		$( "#variable_conteiner" ).disableSelection();
		 $('#queryBuldier').droppable({
			drop: function(e, ui) {
				outputResult(ui.draggable);
			}
		});


		$(".variable.finder").on("keyup paste change focus blur keydown",function(event) {
			var data = {search:$(this).val()}
			getVariableSelect(data)
			.done(function(response){
				if (response.correct) {
					// console.log("miracle",response.variables);
					var elements = ''
					$.each(response.variables,function(key,variable) {
						elements += '<li class="ui-state-default drag" data-variable="'+variable.Name+'" data-`="[0,1]"><span>'+variable.Name+'</span></li>'
					})
					$("#variable_conteiner").html(elements);
				}else{
					// toastr.error("Fall");
				}
			});
		});


		/**
		 * Eventos de variables
		 */
		$("table .save").click(function() {

		})

		$('#popover').popover({
			html : true,
			title: function() {
				return $("#popover-head").html();
			},
			content: function() {
				return $("#popover-content").html();
			}
		});
		// $(document)
		// 	.off('click',$("#popoverSave"))
		// 	.on('click',$("#popoverSave"),function(event) {
		// 	if (
		// 		$(".popover-content form input.name").length >0 &&
		// 		$(".popover-content form input.description").length>0 &&
		// 		$(".popover-content form input.name").val().length > 0 &&
		// 		$(".popover-content form input.description").val().length > 0
		// 		) {
		// 		var newVariable = $(".popover-content form").serialize();
		// 		insertVariable(newVariable)
		// 			.done(function(response){
		// 				if (response.correct) {
		// 					$("#popover").popover('hide');
		// 				}else{
		// 				}
		// 			});
		// 	}else{
		// 		console.error("valores incorrectos");
		// 	}
		// });
	});

	function outputResult(elm) {
		$("#queryBuldier").append(elm.data('variable'));
		console.log(elm.data('range'));
		// if ($(elm).hasClass('oTextInput')) {
			// $result.append('<input type="text" />');
		// } else if ($(elm).hasClass('oRadioInput')) {
		// 	$result.append('<input type="radio" />');
		// }
	}

	function newVariable() {
		console.error("asdas");
		if(
			$(".popover-content form input.name").length >0 &&
			$(".popover-content form input.description").length>0 &&
			$(".popover-content form input.name").val().length > 0 &&
			$(".popover-content form input.description").val().length > 0
			) {
			var newVariable = $(".popover-content form").serialize();
			insertVariable(newVariable)
				.done(function(response){
					if (response.correct) {
						$("#popover").popover('hide');
					}else{
					}
				});
		}
	}
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

	function insertVariable(data) {
		return $.ajax({
			url: base_url +"Hawc/insertVariable",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}
}
));