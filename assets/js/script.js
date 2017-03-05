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

		$('#tables').change(function() {
			$(".from .queryPart").text($(this).val());
		});

		$('#runQuery').click(function() {
			printQuery();
		});

		$("#propertiesEditor").on('change','.left,.rigth',function(event) {
			var tr = $(this).closest('tr');
			var inputLeft = $(tr).find("input.left");
			var selectLeft = $(tr).find("select.left");
			var selectRigth = $(tr).find("select.rigth");
			var inputRigth = $(tr).find("input.rigth");
			var query = $(tr).data('query')
			var queryPart = $("#querySample .where .queryPart."+query);
			var valueLeft = $(queryPart).find('.value.left');
			var operatorLeft = $(queryPart).find('.operator.left');
			var operatorRigth = $(queryPart).find('.operator.rigth');
			var valueRigth = $(queryPart).find('.value.rigth');
			if ($(selectLeft).val()!=-1) {
				console.log('yea');
				$(valueLeft).show();
				$(operatorLeft).show();
				$(inputLeft).prop('disabled', false);
			}else{
				$(valueLeft).hide();
				$(operatorLeft).hide();
				$(inputLeft).prop('disabled', true);
			}
			valueLeft.text($(inputLeft).val());
			operatorLeft.text($(selectLeft).val());
			operatorRigth.text($(selectRigth).val());
			valueRigth.text($(inputRigth).val());


			if (document.getElementById("autoQuery").checked) {
				printQuery();
			}
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

		$(document).on('click','.delete',function() {
			var query = $(this).closest('tr').data('query');
			$(this).closest('tr').remove();
			var queryPart = $("#querySample .where .queryPart."+query);
			$(queryPart).remove();
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

	function printQuery() {
		var text = document.getElementById("querySample").innerText;
		text = text.replace(/\n/gm, " ");
		text = text.replace(/</gm, "\<");
		text = text.replace(/>/gm, "\>");
		var responseQuery = $("#responseQuery");
		runQuery({query:text})
			.done(function(response){
				console.log(typeof response);
				if (!$.trim(response)) {
					console.log("is empty");
				}else{
					var names = Object.keys(response[1]);
					var tr = '<tr>';
					$.each(names, function(i, name) {
						tr += '<th>'+name+'</th>';
					});
					tr += '</tr>';
					$("#responseQuery thead").append(tr);
					var body = '';
					$.each(response,function(i,res) {
						tr = '<tr>';

						$.each(names, function(i, name) {
							tr += '<td>'+res[name]+'</td>';
						});
						tr += "</tr>";
						body+= tr;
					});
					$("#responseQuery tbody").append(body);


				}
			});
	}

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
		var valueleft = document.createElement('span');
		var operatorLefth = document.createElement('span');
		var bool = document.createElement('span');
		var cierre = document.createElement('span');
		var name = document.createElement('span');
		var operatorRigth = document.createElement('span');
		var valuerigth = document.createElement('span');
		bool.innerHTML = 'and (';
		name.innerHTML = variable.VariableName;
		operatorLefth.innerHTML = '<';
		operatorLefth.className = "operator left";
		operatorLefth.style.display = "none";
		operatorRigth.innerHTML = '<';
		operatorRigth.className = "operator rigth";
		valueleft.className = "value left";
		valueleft.innerHTML = 0;
		valueleft.style.display = "none";
		valuerigth.className = "value rigth";
		valuerigth.innerHTML = 0;
		cierre.innerHTML = ')';
		div.appendChild(bool);
		div.appendChild(valueleft);
		div.appendChild(operatorLefth);
		div.appendChild(name);
		div.appendChild(operatorRigth);
		div.appendChild(valuerigth);
		div.appendChild(cierre);

// 		div.appendChild(bool);
// 		div.appendChild(name);
// 		div.appendChild(operator);
// 		div.appendChild(value);
// 		div.appendChild(cierre);
// >>>>>>> 82465a1e35715f50c4b6a9075df54b3ddd63dec0
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
	function runQuery(data) {
		return $.ajax({
			url: base_url +"Hawc/runQuery",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}
	function hola(data) {
		return $.ajax({
			url: base_url +"Hawc/hola",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}
}
));