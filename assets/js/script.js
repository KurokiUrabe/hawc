// IIFE - Immediately Invoked Function Expression
(function(yourcode) {

	//The global jQuery object is passed as a parameter
	yourcode(window.jQuery, window, document);

}(function($, window, document){

	// The $ is now locally scoped
	$(function() {
		var responseQuery = {};

		 $("#tags").autocomplete({
		source: function (request, response) {
			$.ajax({
				type: 'post',
				data:{searchStr: request.term},
				url: base_url +"Hawc/getVariableName", // resolved
				dataType: 'json',
				success: function(jsonData) {
					var data = [];
					$.each(jsonData,function(key,item) {
						data.push(item.VariableName);
					});
					response(data);
				}
			});
		},
		delay: 0,
		minLength: 1,
		focus: function() {
			// prevent value inserted on focus
			return false;
		},
		select: function( event, ui ) {
			var terms = split( this.value );
			// remove the current input
			terms.pop();
			// add the selected item
			terms.push( ui.item.value );
			// add placeholder to get the comma-and-space at the end
			terms.push( "" );
			this.value = terms.join( ", " );
			return false;
		}
	});

		 $("#tags").change(function() {
		 	if ($(this).length <=1) {
				$(".selector .queryPart").text('*');
		 	}else{
				$(".selector .queryPart").text($(this).val().slice(0,-2));
		 	}

		 })

		// $(".selector .queryPart").on('click,focus',function() {
		// 	$("#tags").show();
		// 	$(this).hide();
		// 	$("#tags").focus()
		// });
		// $("#tags").focus(function() {
		// 	$(this).show();
		// })
		// $("#tags").on( "focusout", function() {
		// 		$(this).hide();
		// 	$("#.selector .queryPart").show()
		// })
		var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		// $( "#tags" )
		// 	// don't navigate away from the field on tab when selecting an item
		// 	.on( "keydown", function( event ) {
		// 		if ( event.keyCode === $.ui.keyCode.TAB &&
		// 				$( this ).autocomplete( "instance" ).menu.active ) {
		// 			event.preventDefault();
		// 		}
		// 	})
		// 	.autocomplete({
		// 		minLength: 0,
		// 		source: function( request, response ) {
		// 			// delegate back to autocomplete, but extract the last term
		// 			response( $.ui.autocomplete.filter(
		// 				availableTags, extractLast( request.term ) ) );
		// 		},
		// 		focus: function() {
		// 			// prevent value inserted on focus
		// 			return false;
		// 		},
		// 		select: function( event, ui ) {
		// 			var terms = split( this.value );
		// 			// remove the current input
		// 			terms.pop();
		// 			// add the selected item
		// 			terms.push( ui.item.value );
		// 			// add placeholder to get the comma-and-space at the end
		// 			terms.push( "" );
		// 			this.value = terms.join( ", " );
		// 			return false;
		// 		}
		// 	});

		$(".datetimepicker").datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});
		// $( ".connectedSortable" ).draggable({ revert: "valid" });
		findVariable({search:''});
		$( "#tools" ).droppable({
			classes: {
				"ui-droppable-active": "ui-hawc-state-active",
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
		/*	if (!$('#responseQuery').is(':empty')) {
					responseQuery = $('#responseQuery').dataTable();
			}*/

		});

		$("#propertiesEditor").on('change','select.right',function() {
			var input  = $(this).closest('tr').find('input.left');
			var select = $(this).closest('tr').find('select.left');
			switch($(this).val()){
				case -1:
					$(input).attr('disabled','false');
				break;
				case "=":
				case "!=":
					$( select ).val(-1).change()
					$(input).attr('disabled','false');
					$(select).attr('disabled','false');
				break;
				default:
					console.log($(this).val());
					$(input).removeAttr('disabled');
					$(select).removeAttr('disabled');
				break;
			}
		});



		$("#propertiesEditor").on('input change','.left,.right',function(event) {
			var tr = $(this).closest('tr');
			var inputLeft = $(tr).find("input.left");
			var selectLeft = $(tr).find("select.left");
			var selectRight = $(tr).find("select.right");
			var inputRight = $(tr).find("input.right");
			var query = $(tr).data('query');
			var queryPart = $("#querySample .where .queryPart."+query);
			var valueLeft = $(queryPart).find('.value.left');
			var and = $(queryPart).find('.and');
			var operatorLeft = $(queryPart).find('.operator.left');
			var nameLeft = $(queryPart).find('.name.left');
			var operatorRight = $(queryPart).find('.operator.right');
			var valueRight = $(queryPart).find('.value.right');

			if ($(selectLeft).val()!=-1) {
				$(valueLeft).show();
				$(operatorLeft).show();
				$(nameLeft).show();
				$(and).show();
				$(inputLeft).prop('disabled', false);
			}else{
				$(valueLeft).hide();
				$(operatorLeft).hide();
				$(nameLeft).hide();
				$(and).hide();
				$(inputLeft).prop('disabled', true);
			}

			if ($(tr).data('type')==1) {
				valueLeft.text("'" + $(inputLeft).val() + "'");
				valueRight.text("'" + $(inputRight).val() + "'");
			}else{
				valueLeft.text($(inputLeft).val());
				valueRight.text($(inputRight).val());
			}
			operatorLeft.text($(selectLeft).val());
			operatorRight.text($(selectRight).val());

			if (document.getElementById("autoQuery").checked) {
				printQuery();
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
			findVariable(data);
		});

		$(document)
		.off('click','.delete')
		.on('click','.delete',function() {
			var query = $(this).closest('tr').data('query');
			$(this).closest('tr').remove();
			var queryPart = $("#querySample .where .queryPart."+query);
			$(queryPart).remove();
			printQuery();
		});



		/**
		 * Eventos de variables
		 */
		$("table .save").click(function() {
			var data = $(this).closest('tr').find('input').serialize();
			save(data)
				.done(function(response){
					if (true) {
						console.log(response);
					}
				});

		})
		console.log("@#!@#!@#");

		// $("#variablesTable")
		// .off('change','.Type')
		// .on('change','.Type',function() {
		// 	console.log("mother of good");

		// });

		$('#variablesTable')
		.off('focus',".MinRange,.MaxRange")
		.on('focus',".MinRange,.MaxRange", function(){
			console.log(this);
			if (Number($(this).closest('tr').find('.Type').val()) == 1) {
				console.log("picker");
				$(this).datetimepicker({
					format: 'YYYY-MM-DD HH:mm:ss'
				});

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

	function findVariable(data) {
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
	}

	function printQuery() {
		var text = document.getElementById("querySample").innerText;
		text = text.replace(/\n/gm, " ");
		text = text.replace(/</gm, "\<");
		text = text.replace(/>/gm, "\>");
		var responseQuery = $("#responseQuery");
		var thead = '';
		var tbody = '';
		var tr = '';
		var helio = $("#helio");
		var table = ''
		var head = '';
		var body = '';
		runQuery({query:text})
			.done(function(response){
				$(helio).empty()
				table = $('<table>');
				$(table).addClass("table").attr("id","responseQuery");
				head = $("<thead>");
				body = $("<tbody>")
				$(table).append(head);
				$(table).append(body);
				$(helio).append(table);
				if (Object.keys(response).length === 0) {
					console.log("is empty");
				}else{
					var names = Object.keys(response[0]);
					tr = '<tr>';
					$.each(names, function(i, name) {
						tr += '<th>'+name+'</th>';
					});
					tr += '</tr>';
					thead = tr;
					$.each(response,function(i,res) {
						tr = '<tr>';

						$.each(names, function(i, name) {
							tr += '<td>'+res[name]+'</td>';
						});
						tr += "</tr>";
						tbody+= tr;
					});

					$(body).append(tbody)
					$(head).append(thead)
					// $("#responseQuery thead").append(tr);


				$('#responseQuery').dataTable({
					"paging": false,
					dom: 'Bfrtip',
					buttons: [
						'csvFlash'
					]
				});
				}
			});
	}

	function newRow(variableJson) {
		// var tr = document.createElement('tr');
		// var td = document.createElement('td');
		var defaultTR = document.getElementById('default');
		var tr = defaultTR.cloneNode(true);
		tr.removeAttribute('id')
		var left = tr.querySelector('input.left');
		var right = tr.querySelector('input.right');
		var variable = tr.querySelector('td.variable');
		var queryRow = document.getElementById('propertiesEditor').rows.length-1;
		queryRow = "query"+queryRow;
		// tr.classList.add('')
		tr.setAttribute('data-query', queryRow);
		tr.setAttribute('data-type', variableJson.Type);
		left.setAttribute  ('min', variableJson.MinRange);
		left.setAttribute  ('max', variableJson.MaxRange);
		left.setAttribute  ('step', variableJson.Step);
		right.setAttribute ('step', variableJson.Step);
		right.setAttribute ('min', variableJson.MinRange);
		right.setAttribute ('max', variableJson.MaxRange);
		variable.innerHTML = variableJson.VariableName;
		var tbody = document.getElementById('tbody');

		tr.style.display = '';
		// tbody.insertBefore(tr,tbody.childNodes[0]);
		tbody.appendChild(tr);
		if (variableJson.Type==1) {
			right.setAttribute ('type','text');
			left.setAttribute ('type','text');
			$(left).datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss'
			});
			$(right).datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss'
			});
		}else{
			right.setAttribute ('placeholder', "["+variableJson.MinRange+","+variableJson.MaxRange+"]");
			left.setAttribute ('placeholder', "["+variableJson.MinRange+","+variableJson.MaxRange+"]");
		}
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
		var left = document.createElement('div');
		var right = document.createElement('div');
		var valueleft = document.createElement('span');
		var operatorLefth = document.createElement('span');
		var and = document.createElement('span');
		var bool = document.createElement('span');
		var cierre = document.createElement('span');
		var name = document.createElement('span');
		var operatorRight = document.createElement('span');
		var valueright = document.createElement('span');
		bool.innerHTML = 'and (';
		name.innerHTML = variable.VariableName;
		operatorLefth.innerHTML = '<';
		operatorLefth.className = "operator left";
		operatorLefth.style.display = "none";
		operatorRight.innerHTML = '<';
		operatorRight.className = "operator right";
		valueleft.className = "value left";
		valueleft.innerHTML = 0;
		valueleft.style.display = "none";
		valueright.className = "value right";
		valueright.innerHTML = 0;
		cierre.innerHTML = ')';
		var name2 = name.cloneNode(true);
		name2.style.display = 'none';
		name2.className = "name left";
		left.className = 'left';


		//and
		and.className = 'and';
		and.innerHTML = 'and ';
		and.style.display = "none";
		div.appendChild(bool);
		left.className = "queryPart";
		left.appendChild(valueleft);
		left.appendChild(operatorLefth);
		left.appendChild(name2);
		div.appendChild(left);

		right.className = "queryPart";
		right.appendChild(and);
		right.appendChild(name);
		right.appendChild(operatorRight);
		right.appendChild(valueright);
		div.appendChild(right);
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
		console.log(base_url +"Hawc/getVariableSelect");
		return $.ajax({
			url: base_url +"Hawc/getVariableSelect",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}

	// function getVariableSelect (data) {
	// 	console.log(base_url +"Hawc/getVariableSelect");
	// 	return $.ajax({
	// 		url: base_url +"Hawc/getVariableSelect",
	// 		cache: false,
	// 		type: "post",
	// 		data: data,
	// 		dataType: 'json'
	// 	});
	// }


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
	function save(data) {
		return $.ajax({
			url: baseurl +"index.php/Hawc/save",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}
	function updateDatatable() {

	}
}
));