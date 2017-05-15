// IIFE - Immediately Invoked Function Expression
(function(yourcode) {

	//The global jQuery object is passed as a parameter
	yourcode(window.jQuery, window, document);

}(function($, window, document){

	// The $ is now locally scoped
	//
	$.fn.toggleDisabled = function(){
				return this.each(function(){
						this.disabled = !this.disabled;
				});
		};
	$(function() {

		$(".datetimepicker").datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'/*,
			onSelect: function(dateText, inst) {
				var date = $(this).val();
				console.log(date);
				$(this).change();
			}*/
		});

		$(document).on({
			ajaxStart: function() { $("body").addClass("loading");    },
			ajaxStop: function() { $("body").removeClass("loading"); }
		});

		// The DOM is ready!
		$( "#variable_conteiner").sortable({
			connectWith: ".connectedSortable"
		}).disableSelection();
	
		/**
		 * Eventos de variables
		 */
		$("table .save").click(function() {
			var data = $(this).closest('tr').find('input').serialize()+"&Type="+$(this).closest('tr').find('.Type').val();
			save(data)
				.done(function(response){
					if (true) {
						console.log(response);
					}
				});

		})

		$('#VariableTable')
		.off('focus',".MinRange,.MaxRange")
		.on('focus',".MinRange,.MaxRange", function(){
			console.log(this);
			if (Number($(this).closest('tr').find('.Type').val()) == 1) {
				console.log("picker");
				$(this).datetimepicker({
					format: 'YYYY-MM-DD HH:mm:ss'
				});
			}else{
				$(this).datetimepicker("destroy");
			}
		});

		$('#popover').popover({
			html : true,
			title: function() {
				return $("#popover-head").html();
			},
			content: function() {
				return $("#popover-content").html();
			}
		});

	});


	function insertVariable(data) {
		return $.ajax({
			url: urlBase +"~manuel/Hawc/insertVariable",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}

	function newVariable() {
		console.error("asdas");
		if(
			$(".popover-content form input.VariableName").length >0 &&
			$(".popover-content form input.description").length>0 &&
			$(".popover-content form input.VariableName").val().length > 0 &&
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
	
	function save(data) {
		return $.ajax({
			url: urlBase +"Hawc/save",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}
}
));