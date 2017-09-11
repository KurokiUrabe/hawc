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





		document.getElementById('fileID').addEventListener('change', onChange);


		var responseQuery = {};

		$("#save_context").click(function(event){
			var data = { wheres: $("#wheres").html().replace("\\r?\\n", ""), select: $("#select").html().replace("\\r?\\n", ""), date: new Date() },
			fileName = "QMDBi_WorkArea_"+getDate()+".json";

			saveData(data, fileName);
		});
		// lectura de un archivo al dar change
		// document.getElementById('fileID').addEventListener('change', handleFileSelect, false);


		$(".datetimepicker").datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});

		$("#tags").autocomplete({
			source: function (request, response) {
				$.ajax({
					type: 'post',
					data:{searchStr: request.term},
					url: urlBase +"Hawc/getVariableName", // resolved
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

		 $("#tags").on('autocompletechange',function() {
			if ($("#tags").val().length <=1) {
				console.log(":si");
				$("#selector .queryPart").text('*');
			}else{
				console.log(":squery");
				$("#selector .queryPart").text($("#tags").val().slice(0,-2));
			}
		 });

		$('#cleanquery').click(function() {
			$("#selector .queryPart").text("*");
			$("#from .queryPart").text($('#tables').val());
			$("#where .queryPart").remove();
			$("#where").append('<div class="queryPart">1=1</div>');
			var deff = $("#default").detach();
			$('#tbody').empty();
			$('#tbody').append(deff);
		});

		$(document).on({
			ajaxStart: function() { $("body").addClass("loading");    },
			ajaxStop: function() { $("body").removeClass("loading"); }
		});

		$("#saveQuery").click(function(){
			var querySample = document.getElementById("querySample").innerText;
			console.log(querySample);
			download(querySample, 'QMDBi_SQLQuery_' + getDate() + '.sql','text/plain');
		})

		$('#getcsv').click(function() {
			// $('#getcsv').prop("disabled", true);
			var selector = document.getElementById("selector").innerText;
			var from     = document.getElementById("from").innerText;
			var where    = document.getElementById("where").innerText;
			var extras   = document.getElementById("extras").innerText;

			selector = cleanText( selector );
			from     = cleanText( from );
			where    = cleanText( where );
			getCSV({
				selector:selector,
				from:from,
				where:where,
				extras:extras
			}).done(function(response) {
				document.location.href = urlBase +"Hawc/download/"+response;
				// $("#getcsv").prop("disabled", false);

			}).always(function() {
				console.log('eliminando');
				// deletAfterDownload(response);
				console.log('elimino');

			})
		});

		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$(document).on('click', '.boolean', function() {
			var boolean = $(this).text();

			if (boolean == "AND") {
				$(this).text("OR");
				$('.'+$(this).closest('tr').data('query')).find('.bool').text('or (');
			}else{
				$(this).text("AND");
				$('.'+$(this).closest('tr').data('query')).find('.bool').text('and (');
			}
		});



		findVariable({search:''});

		$( "#select" ).droppable({
			classes: {
				"ui-droppable-active": "ui-hawc-state-select-active",
				"ui-droppable-hover": "ui-state-hover"
			},
			drop: function( event, ui ) {
				var variable = ui.draggable.data('variable');
				var select = $("#selector .queryPart");
				if ($(select).text().length==1) {
					$(select).empty();
					$(select).text(variable.VariableName);
				}else{
					var newSelect = $(select).text() + ', ' + variable.VariableName;
					console.log(newSelect);
					$(select).text(newSelect);
				}

				// var row = newRow(variable);
				// newQuery(row,variable);
			}
		});

		$( "#wheres" ).droppable({
			classes: {
				"ui-droppable-active": "ui-hawc-state-where-active",
				"ui-droppable-hover": "ui-state-hover"
			},
			drop: function( event, ui ) {
				var variable = ui.draggable.data('variable');
				var row = newRow(variable);
				newQuery(row,variable);
			}
		});

		$('#tables').change(function() {
			$("#from .queryPart").text($(this).val());
		});

		$('#runQuery').click(function() {
			$('#runQuery').prop("disabled", true);
			printQuery();
		/*	if (!$('#responseQuery').is(':empty')) {
					responseQuery = $('#responseQuery').dataTable();
			}*/
			$("#runQuery").prop("disabled", false);
		});

		$(document).on('change','#propertiesEditor select.right',function() {
			$(this).find("[value='"+$(this).val()+"']").attr('selected','selected')
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

		$(document).on('input, change','#propertiesEditor .left,#propertiesEditor .right',function(event) {
			$(this).find("[value='"+$(this).val()+"']").attr('selected','selected')
			var tr = $(this).closest('tr');
			var inputLeft = $(tr).find("input.left");
			var selectLeft = $(tr).find("select.left");
			var selectRight = $(tr).find("select.right");
			var inputRight = $(tr).find("input.right");
			var query = $(tr).data('query');
			console.log("#querySample #where .queryPart."+query);
			var queryPart = $("#querySample #where .queryPart."+query);
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

			console.log('event',event.target,'value',event.target.value);
			event.target.setAttribute('value',event.target.value);
		})
		.on('dp.change','.left,.right',function(event) {
			console.log('dateevent',event.target,'value',event.target.value);
			event.target.setAttribute('value',event.target.value);
			var tr = $(this).closest('tr');
			var inputLeft = $(tr).find("input.left");
			var selectLeft = $(tr).find("select.left");
			var selectRight = $(tr).find("select.right");
			var inputRight = $(tr).find("input.right");
			var query = $(tr).data('query');
			var queryPart = $("#querySample #where .queryPart."+query);
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

			// if (document.getElementById("autoQuery").checked) {
			// 	printQuery();
			// }
		});


		// The DOM is ready!
		$( "#variable_conteiner").sortable({
			connectWith: ".connectedSortable"
		}).disableSelection()



		$(".variable.finder").on("keyup focus",function(event) {
			var data = {search:$(this).val()}
			findVariable(data);
		});

		$(document)
		.off('click','.delete')
		.on('click','.delete',function() {
			var query = $(this).closest('tr').data('query');
			var queryPart = $("#querySample #where .queryPart."+query);
			$(queryPart).remove();
			$(this).closest('tr').remove();
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

	function getDate() {
		var date = new Date(),
			year = date.getFullYear(),
			month = (date.getMonth() + 1).toString(),
			formatedMonth = (month.length === 1) ? ("0" + month) : month,
			day = date.getDate().toString(),
			formatedDay = (day.length === 1) ? ("0" + day) : day,
			hour = date.getHours().toString(),
			formatedHour = (hour.length === 1) ? ("0" + hour) : hour,
			minute = date.getMinutes().toString(),
			formatedMinute = (minute.length === 1) ? ("0" + minute) : minute,
			second = date.getSeconds().toString(),
			formatedSecond = (second.length === 1) ? ("0" + second) : second;
		return year + formatedMonth  + formatedDay + "_" + formatedHour + formatedMinute + formatedSecond;
	};

	function onChange(event) {
		var reader = new FileReader();
		reader.onload = onReaderLoad;
		reader.readAsText(event.target.files[0]);
	}

	function onReaderLoad(event){
		var obj = JSON.parse(event.target.result);
		$("#wheres").html(obj.wheres);
		$("#select").html(obj.select);
		$('.datetimepicker').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});
	}

	function alert_data(name, family){
		alert('Name : ' + name + ', Family : ' + family);
	}

	function download(data, filename, type) {
		var file = new Blob([data], {type: type});
		if (window.navigator.msSaveOrOpenBlob) // IE10+
			window.navigator.msSaveOrOpenBlob(file, filename);
		else { // Others
			var a = document.createElement("a"),
			url = URL.createObjectURL(file);
			a.href = url;
			a.download = filename;
			document.body.appendChild(a);
			a.click();
			setTimeout(function() {
				document.body.removeChild(a);
				window.URL.revokeObjectURL(url);
			}, 0);
		}
	}
	function findVariable(data) {
		if (!$.isEmptyObject(data)) {
			data.table = document.querySelector("#from .queryPart").innerText;
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
	}

	function printQuery() {
		// $("#runQuery").toggleDisabled();

		var selector = document.querySelector("#selector .queryPart").innerText;
		var from     = document.querySelector("#from .queryPart").innerText;
		var where    = document.getElementById("where").innerText;
		var extras    = document.getElementById("extras").innerText;

		selector = cleanText( selector );
		from     = cleanText( from );
		where    = cleanText( where );
		extras    = cleanText( extras );
		selector = "select"+ selector.length<2?"*":selector;
		// getCSV({
		// 	selector:selector,
		// 	from:from,
		// 	where:where,
		// 	extras:extras
		// }

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
		// runQuery({query:text})
		runQuery(
			{
				selector:selector,
				from:from,
				where:where,
				extras:extras
			}
			)
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
					// "paging":false,
					ajax: {
						url: urlBase +"hawc/runQueryDatatable",
						type: "POST",
						data: {
							selector:selector,
							from:from,
							where:where,
							extras:extras
						}
					},
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"order": [], //Initial no order.

					//Set column definition initialisation properties.
							// "columnDefs": [
							 //  {
							 //      "targets": [ 0 ], //first column / numbering column
							 //      "orderable": false, //set not orderable
							 //  },
							// ],
							responsive: true,
					start : 0,
					length : 10,
					PaginationType: 'full_numbers'
				});
				}
			}).always(function() {

				console.log("this is amuse");
				var button = document.getElementById("runQuery");
				// $("#runQuery").prop("disabled", false);
				// if (button.hasAttribute('disable')) {
				// 	$("#runQuery").toggleDisabled();
				// }
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
		if (variableJson.MinRange) {
			left.setAttribute  ('min', variableJson.MinRange);
			left.setAttribute  ('max', variableJson.MaxRange);
		}
		if (variableJson.Step) {
			left.setAttribute  ('step', variableJson.Step);
			right.setAttribute ('step', variableJson.Step);
		}
		if (variableJson.MinRange) {
			right.setAttribute ('min', variableJson.MinRange);
			right.setAttribute ('max', variableJson.MaxRange);
		}
		variable.innerHTML = variableJson.VariableName;
		var tbody = document.getElementById('tbody');

		tr.style.display = '';
		// tbody.insertBefore(tr,tbody.childNodes[0]);
		tbody.appendChild(tr);
		if (variableJson.Type==1) {
			right.setAttribute ('type','text');
			left.setAttribute ('type','text');
			left.classList.add('datetimepicker');
			right.classList.add('datetimepicker');
			$(left).datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss'
			});
			$(right).datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss'
			});
		}else{
			var min = "(∞";
			var max = "∞)";
			if ( variableJson.MinRange != null ) {
				min = "["+variableJson.MinRange;
			}
			if ( variableJson.MaxRange != null ) {
				max = variableJson.MaxRange+"]";
			}

			left.setAttribute ('placeholder', min + "," + max);
			right.setAttribute ('placeholder', min + "," + max);
		}
		return queryRow;
	}

	function outputResult(elm) {
		$("#queryBuldier").append('<div>'+elm.data('variable')+'</div>');
		console.log(elm.data('range'));
	}

	var saveData = (function () {
		var a = document.createElement("a");
		document.body.appendChild(a);
		a.style = "display: none";
		return function (data, fileName) {
			var json = JSON.stringify(data),
				blob = new Blob([json], {type: "octet/stream"}),
				url = window.URL.createObjectURL(blob);
			a.href = url;
			a.download = fileName;
			a.click();
			window.URL.revokeObjectURL(url);
		};
	}());

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
		bool.className = 'bool';
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

		div.className = "queryPart "+queryRow;
		var where = document.querySelector("#querySample #where");
		where.appendChild(div);
	}

	function deletAfterDownload(response) {
		deleteFile({fileName:response}).done(function(response) {
					console.log('nada apacere');
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
	// var urlBase = window.location.href+"index.php/";
	// The rest of your code goes here!
	function getVariableSelect (data) {
		console.log(urlBase +"Hawc/getVariableSelect");
		return $.ajax({
			url: urlBase +"Hawc/getVariableSelect",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}

	function cleanText(text) {
		text = text.replace(/\n/gm, " ");
		text = text.replace(/</gm, "\<");
		text = text.replace(/>/gm, "\>");
		return text;
	}

	function insertVariable(data) {
		return $.ajax({
			url: urlBase +"Hawc/insertVariable",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}

	function runQuery(data) {
		return $.ajax({
			url: urlBase +"Hawc/runQuery",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}

	// 	function runQuery(data) {
	// 	return $.ajax({
	// 		url: urlBase +"Hawc/runQueryDatatable",
	// 		cache: false,
	// 		type: "post",
	// 		data: data,
	// 		dataType: 'json'
	// 	});
	// }

	/*function handleFileSelect(evt) {
		var file = evt.target.files[0]; // FileList object
		console.log(file);
		 var MIMEType = file.type;
		if (MIMEType.match('.json')) {
			// decode base64 string, remove space for IE compatibility
			var reader = new FileReader();

			reader.onload = function(readerEvt) {

				// This is done just for the proof of concept
				var binaryString = readerEvt.target.result;
				var base64 = btoa(binaryString);
				var blobfile = atob(base64);


				window.blobFromBlobFile = b64toBlob(base64, MIMEType, 512);
				window.blobURL = URL.createObjectURL(window.blobFromBlobFile);


				if (MIMEType != "image/jpeg") {
					var a = "<br /><a href=\"" + window.blobURL + "\">Blob File Link</a>";
				} else {
					var a = "<img src=" + window.blobURL + "\>";
				}

				document.getElementById('byte_content').innerHTML = a;

			};

			reader.readAsBinaryString(file);
		} else {
		}
		// Loop through the FileList and render image files as thumbnails.
		// for (var i = 0, f; f = files[i]; i++) {

		// 	// Only process image files.
		// 	if (!f.type.match('image.*')) {
		// 		continue;
		// 	}

		// 	var reader = new FileReader();

		// 	// Closure to capture the file information.
		// 	reader.onload = (function(theFile) {
		// 		return function(e) {
		// 			// Render thumbnail.
		// 			var span = document.createElement('span');
		// 			span.innerHTML = ['<img class="thumb" src="', e.target.result,
		// 												'" title="', escape(theFile.name), '"/>'].join('');
		// 			document.getElementById('list').insertBefore(span, null);
		// 		};
		// 	})(f);

		// 	// Read in the image file as a data URL.
		// 	reader.readAsDataURL(f);
		// }
	}*/

	function save(data) {
		return $.ajax({
			url: urlBase +"index.php/Hawc/save",
			cache: false,
			type: "post",
			data: data,
			dataType: 'json'
		});
	}

	function getCSV(data) {
		return $.ajax({
			url: urlBase +"Hawc/getCSV",
			type: "post",
			data: data,
		});
	}
	function deleteFile(data) {
		return $.ajax({
			url: urlBase +"Hawc/del_file",
			cache: false,
			type: "post",
			data: data,
		});
	}

}
));