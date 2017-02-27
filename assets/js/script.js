// IIFE - Immediately Invoked Function Expression
(function(yourcode) {

	//The global jQuery object is passed as a parameter
	yourcode(window.jQuery, window, document);

}(function($, window, document){

	// The $ is now locally scoped
	$(function() {


		// $( ".connectedSortable" ).draggable({ revert: "valid" });

		$( "#tools" ).droppable({
			classes: {
				"ui-droppable-active": "ui-state-active",
				"ui-droppable-hover": "ui-state-hover"
			},
			drop: function( event, ui ) {
				var newRow = newRow(ui.draggable.data('variable'));
				newQuery(newRow);
			}
		});

		$('select.right').change(function() {
			if ($(this).val()==-1) {
				$(this).closest(tr).find('input.left').attr('disabled','false');
			}else{
				$(this).closest(tr).find('input.left').attr('disabled','disabled');
			}
		});

		// The DOM is ready!
		$( "#variable_conteiner").sortable({
			connectWith: ".connectedSortable"
		}).disableSelection()
		.on("dblclick", ".connectedSortable", function() {
			// First figure out which list the clicked element is NOT in...
			var otherUL = $("#variable_conteiner, #queryBuldier").not($(this).closest("ul"));
			var li = $(this).closest("li");

			// Move the li to the other list. prependTo() can also be used instead of appendTo().
			li.detach().appendTo(otherUL);

		});
		// $('#queryBuldier').on('click','li',function() {
		// 	$('#queryBuldier li.editing').removeClass('editing');
		// 	$(this).addClass('editing');

		// 	// var tools  =$('#tools').html($(this).data('variable'));
		// 	var variables = $('#propertiesEditor tbody tr td.variable');
		// 		console.log($('.editing').data('variable'));
		// 	$.each(variables,function(k,variable) {
		// 		$(variable).text($('.editing').data('variable').Name);
		// 	});
		// 	// console.log($(this).data());
		// });


		$(".variable.finder").on("keyup paste change focus blur keydown",function(event) {
			var data = {search:$(this).val()}
			getVariableSelect(data)
			.done(function(response){
				if (response.correct) {
					var elements = '';
					var ul = document.getElementById('variable_conteiner');
					ul.innerHTML = '';
					$.each(response.variables,function(key,variable) {
						var li = document.createElement('li');
						var span = document.createElement('span');
						li.className = "ui-state-default connectedSortable";

						span.textContent = variable.Name;
						li.setAttribute('data-variable', JSON.stringify(variable));
						li.appendChild(span);
						ul.appendChild(li);
					})
				}else{
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
	function newRow(variableJson) {
		// var tr = document.createElement('tr');
		// var td = document.createElement('td');
		var defaultTR = document.getElementById('default');
		var tr = defaultTR.cloneNode(true)
		tr.removeAttribute('id')
		var left = tr.querySelector('input.left');
		var right = tr.querySelector('input.right');
		var variable = tr.querySelector('td.variable');
		var queryRow = 'query'+document.getElementById('propertiesEditor').rows.length-1;
		// tr.classList.add('')
		tr.setAttribute('data-query', rows);
		left.setAttribute ('min', variableJson.minRange);
		left.setAttribute ('max', variableJson.minRange);
		variable.innerHTML = variableJson.Name;
		left.setAttribute ('placeholder', "["+variableJson.minRange+","+variableJson.maxRange+"]");
		var tbody = document.getElementById('tbody');

		tr.style.display = '';
		console.log(tr);
		tbody.insertBefore(tr,tbody.childNodes[0]);
		return queryRow;
	}
	function outputResult(elm) {
		$("#queryBuldier").append('<div>'+elm.data('variable')+'</div>');
		console.log(elm.data('range'));
		// if ($(elm).hasClass('oTextInput')) {
			// $result.append('<input type="text" />');
		// } else if ($(elm).hasClass('oRadioInput')) {
		// 	$result.append('<input type="radio" />');
		// }
	}
	function newQuery(queryRow) {

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