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
				var variable = ui.draggable.data('variable');
				var row = newRow(variable);
				newQuery(row,variable);
			}
		});

		$("#propertiesEditor").on('change','.left,.rigth',function(event) {
			console.log(event.target);
			console.log(this);
			var tr = $(this).closest('tr');
			var inputLeft = $(tr).find("input.left");
			var selectLeft = $(tr).find("select.left");
			var selectRigth = $(tr).find("select.rigth");
			var inputRigth = $(tr).find("input.rigth");
			console.log($(tr).data('query'));
			var query = $(tr).data('query')
			var queryPart = $("#querySample .where .queryPart."+query);
			var valueLeft = $(queryPart).find('.value.left');
			var operatorLeft = $(queryPart).find('.operator.left');
			var operatorRigth = $(queryPart).find('.operator.rigth');
			var valueRigth = $(queryPart).find('.value.rigth');

			valueLeft.text($(inputLeft).val());
			operatorLeft.text($(selectLeft).val());
			operatorRigth.text($(selectRigth).val());
			valueRigth.text($(inputRigth).val());
		});

		$('select.rigth').change(function() {
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
		// 		$(variable).text($('.editing').data('variable').VariableName);
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

						span.textContent = variable.VariableName;
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
		// 		$(".popover-content form input.VariableName").length >0 &&
		// 		$(".popover-content form input.description").length>0 &&
		// 		$(".popover-content form input.VariableName").val().length > 0 &&
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
		var rigth = tr.querySelector('input.rigth');
		var variable = tr.querySelector('td.variable');
		var queryRow = document.getElementById('propertiesEditor').rows.length-1;
		queryRow = "query"+queryRow;
		// tr.classList.add('')
		tr.setAttribute('data-query', queryRow);
		left.setAttribute ('min', variableJson.minRange);
		left.setAttribute ('max', variableJson.minRange);
		variable.innerHTML = variableJson.VariableName;
		left.setAttribute ('placeholder', "["+variableJson.minRange+","+variableJson.maxRange+"]");
		var tbody = document.getElementById('tbody');

		tr.style.display = '';
		// tbody.insertBefore(tr,tbody.childNodes[0]);
		tbody.appendChild(tr);
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

	function newQuery(queryRow,variable) {
		var div = document.createElement('div');
		var name = document.createElement('span');
		var operator = document.createElement('span');
		var value = document.createElement('span');
		name.innerHTML = variable.VariableName;
		operator.innerHTML = '<';
		operator.className = "operator rigth";
		value.className = "value rigth";
		value.innerHTML = 0;
		div.appendChild(name);
		div.appendChild(operator);
		div.appendChild(value);
		div.className = "queryPart "+queryRow;
		var where = document.querySelector("#querySample .where");
		where.appendChild(div);
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
	var base_url = window.location.href+"index.php/";
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