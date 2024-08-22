$(document).ready(function () {
	var division ="";
	get_beat();
	get_masters(division);
	// get_osm();
	// get_rs();
	// get_users();
	$("#show_beat").show();
	$("#show_master").hide();
	$("#show_osm").hide();
	$("#show_rs").hide();
});

//Beat
$("#beatuploadForm").submit(function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	$.ajax({
		url: BASE_URL + "MastersController/beat_excel_upload",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
			if (data.logstatus == "success") {
				$("#beatuploadForm")[0].reset();
				var err = data.error;
				if (err.length > 0) {
					var html = "<p>Errors:</p>";
					for (var i = 0; i < err.length; i++) {
						if (data.error[i].format == "phno") {
							html +=
								"<p>" +
								(i + 1) +
								" .Phone No must be 10 digits only in id = " +
								data.error[i].id +
								"</p>";
						} else if (data.error[i].format == "already_exists") {
							html +=
								"<p>" +
								(i + 1) +
								" . Data already exists, Please check in Beat Code =" +
								data.error[i].Beat_Code +
								"</p>";
						} else {
							html +=
								"<p>" +
								(i + 1) +
								" . Empty column noted, Please check in id = " +
								data.error[i].id +
								"</p>";
						}
					}
				} else {
					var html = "";
				}
				$("#errors_show").html(html);
				data_added_toast();
				get_beat();
			}
			if (data.logstatus == "errors") {
				excel_fields_required();
				$("#beatuploadForm")[0].reset();
			}
			if (data.logstatus == "error_") {
				file_error_toast();
				$("#beatuploadForm")[0].reset();
			}
			if (data.logstatus == "error_h") {
				file_error_toast1();
				$("#beatuploadForm")[0].reset();
			}
			if (data.logstatus == "error") {
				$("#beatuploadForm")[0].reset();
				var err = data.error;
				if (err.length > 0) {
					var html = "<p>Errors :</p>";
					for (var i = 0; i < err.length; i++) {
						if (data.error[i].format == "phno") {
							html +=
								"<p>" +
								(i + 1) +
								" .Phone No must be 10 digits only in id = " +
								data.error[i].id +
								"</p>";
						} else if (data.error[i].format == "already_exists") {
							html +=
								"<p>" +
								(i + 1) +
								" . Data already exists, Please check in Beat Code =" +
								data.error[i].Beat_Code +
								"</p>";
						} else {
							html +=
								"<p>" +
								(i + 1) +
								" . Empty column noted, Please check in id = " +
								data.error[i].id +
								"</p>";
						}
					}
				} else {
					var html = "";
				}
				$("#errors_show").html(html);
				data_error_toast();
				get_beat();
			}
		},
	});
});
$("#del_beat").submit(function (e) {
	e.preventDefault();
	var formData = new FormData($('#beatdelete')[0]);
	$.ajax({
		url: BASE_URL + "MastersController/delete_beat",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
			if(data =="success"){
				$('#confirm_del_beat').modal('hide');
				$('#delete_beat').addClass('d-none');
				$('#CheckAll').prop('checked',false);
				$('#ckbCheckAll').prop('checked',false);

				delsuccess_toast();
				get_beat();
			}else{
				request_failed();
				$('#confirm_del_beat').modal('hide');
				get_beat();
			}
		},
	});
});
function get_beat() {
	$.ajax({
		url: BASE_URL + "MastersController/get_beat_optimize",
		type: "post",
		dataType: "json",
		success: function (response) {
			var example = $("#beat_tb").DataTable({
				data: response,
				bDestroy: true,
				lengthChange: true,
				processing: true,
				fnRowCallback: function (
					nRow,
					aData,
					iDisplayIndex,
					iDisplayIndexFull
				) {
					$("td:eq(1)", nRow).html(iDisplayIndexFull + 1);
				},
				columns: [
					{ data: "action","render": function(data,type,  row) {
						return ' <input type="checkbox" value='+row.id+' class="checkBoxClass" />'
						} 
					},
					
					{ data: "id" },
					{ data: "business" },
					{ data: "beat_name" },
					{ data: "beat_code" },
					{ data: "sm_mobile" },
					{ data: "created_at" },
					
				],
				orderable: false,
				searchable: false,
				columnDefs: [
					{ orderable: false, targets: "_all" }, // Applies the option to all columns
				],
			});
		},
	});
}


var selectedCheckboxes = [];

$(document).on("change", ".checkBoxClass", function () {
	// $('.checkBoxClass').click(function(){
//   $('#delete_beat').removeClass('d-none');
  const checkboxValues = [...document.querySelectorAll('.checkBoxClass:checked')].map(e => e.value);
  checkboxValues.forEach(function (value) {
    if (!selectedCheckboxes.includes(value)) {
      selectedCheckboxes.push(value);
    }
  });
  $('#beat_tb tbody :checkbox:not(:checked)').each(function() {
	var valueToRemove = $(this).val();
	selectedCheckboxes = selectedCheckboxes.filter(function(value) {
		return value !== valueToRemove;
	});
});


  $('#beat_delete').val(selectedCheckboxes);
  if(selectedCheckboxes.length){
	$('#delete_beat').removeClass('d-none');
  }else{
	$('#delete_beat').addClass('d-none');
  }
  $('#delete_beat').toggleClass('d-none', selectedCheckboxes.length === 0);
});
selectedCheckboxes = [];

$('#CheckAll').click(function (e) {
    var table = $('#beat_tb').DataTable();

    $('#beat_tb tbody :checkbox').prop('checked', $(this).is(':checked'));
	// $('#delete_beat').removeClass('d-none');

    const data = [...document.querySelectorAll('.checkBoxClass:checked')].map(e => e.value);
	data.forEach(function (value) {
		if (!selectedCheckboxes.includes(value)) {
		  selectedCheckboxes.push(value);
		}else{
			selectedCheckboxes = data;
			
		}
	  });
	//   selectedCheckboxes = data;
	  

    e.stopImmediatePropagation();
	selec(table);
    
    $('#beat_tb tbody :checkbox:not(:checked)').each(function() {
        var valueToRemove = $(this).val();
        selectedCheckboxes = selectedCheckboxes.filter(function(value) {
            return value !== valueToRemove;
        });
    });
	$('#beat_delete').val(selectedCheckboxes.join(','));
	if(selectedCheckboxes.length){
		$('#delete_beat').removeClass('d-none');
	  }else{
		$('#delete_beat').addClass('d-none');
		// table.rows().nodes().to$().find('.checkBoxClass').prop('checked', false);
	  }
	// $('#delete_beat').toggleClass('d-none', selectedCheckboxes.length === 0);

	});


var checkall_beat = document.getElementById('ckbCheckAll');

	$('#ckbCheckAll').click(function (e) {
if(checkall_beat.checked){
	$('#CheckAll').attr('disabled','');
}else{
	$('#CheckAll').removeAttr('disabled','');
	$('#CheckAll').prop('checked',false);
}
// $('#delete_beat').removeClass('d-none');


		var table = $('#beat_tb').DataTable();
		$('#delete_beat').removeClass('d-none');
		table.rows().nodes().to$().find('.checkBoxClass').prop('checked', $(this).is(':checked'));
		e.stopImmediatePropagation();

		updateBeatDeleteInput(table);
	});
	
	function updateBeatDeleteInput(table) {
		selectedCheckboxes = [];
    table.rows().nodes().to$().find('.checkBoxClass:checked').each(function () {
        selectedCheckboxes.push($(this).val());
    });
	$('#beat_tb tbody :checkbox:not(:checked)').each(function() {
        var valueToRemove = $(this).val();
        selectedCheckboxes = selectedCheckboxes.filter(function(value) {
            return value !== valueToRemove;
        });
    });
		$('#beat_delete').val(selectedCheckboxes);
		// $('#delete_beat').toggleClass('d-none', selectedCheckboxes.length === 0);
		if(selectedCheckboxes.length){
			$('#delete_beat').removeClass('d-none');
		  }else{
			$('#delete_beat').addClass('d-none');
		  }

	}
	
	function updateDataTableSelectAllCtrl(table){
		var $table             = table.table().node();
		var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		var $chkbox_checked    = $('tbody .checkBoxClass:checked', $table);
		var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);
		if($chkbox_checked.length === 0){
		   chkbox_select_all.checked = false;
		   if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = false;
		   }
		} else if ($chkbox_checked.length === $chkbox_all.length){
		   chkbox_select_all.checked = true;
		   if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = false;
		   }
		} else {
		   chkbox_select_all.checked = true;
		   if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = true;
		   }
		}
	  }
	 function selec(table){
		var rows_selected = [];
		$('#beat_tb tbody').on('click', 'input[type="checkbox"]', function(e){
		   var $row = $(this).closest('tr');
		   var data = table.row($row).data();
		   var rowId = data[0];
		   var index = $.inArray(rowId, rows_selected);
		   if(this.checked && index === -1){
			 rows_selected.push(rowId);
		   } else if (!this.checked && index !== -1){
			 rows_selected.splice(index, 1);
		   }
		   if(this.checked){
			 $row.addClass('selected');
		   } else {
			 $row.removeClass('selected');
		   }
		   updateDataTableSelectAllCtrl(table);
		   e.stopPropagation();
		});
		$('#beat_tb').on('click', 'tbody td, thead th:first-child', function(e){
		   $(this).parent().find('input[type="checkbox"]').trigger('click');
		});
		$('thead input[name="select_all"]', table.table().container()).on('click', function(e){
		   if(this.checked){
			 $('#beat_tb tbody input[type="checkbox"]:not(:checked)').trigger('click');
		   } else {
			 $('#beat_tb tbody input[type="checkbox"]:checked').trigger('click');
		   }
		   e.stopPropagation();
		});
		table.on('draw', function(){
		   updateDataTableSelectAllCtrl(table);
		});
	  }
	 
//OSM
$("#osmuploadForm").submit(function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	$.ajax({
		url: BASE_URL + "MastersController/osm_excel_upload",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
			if (data.logstatus == "success") {
				$("#osmuploadForm")[0].reset();
				var err = data.error;
				if (err.length > 0) {
					var html = "<p>Errors :</p>";
					for (var i = 0; i < err.length; i++) {
						if (data.error[i].format == "phno") {
							html +=
								"<p>" +
								(i + 1) +
								" .Phone No must be 10 digits only in id = " +
								data.error[i].id +
								"</p>";
						} else if (data.error[i].format == "already_exists") {
							html +=
								"<p>" +
								(i + 1) +
								" . Data already exists, Please check in SSFA Id = " +
								data.error[i].ssfa_id +
								" and JC Type = " +
								data.error[i].jc_type +
								" and Fin_Year = " +
								data.error[i].fin_year +
								"</p>";
						} else {
							html +=
								"<p>" +
								(i + 1) +
								" . Empty column noted, Please check in id = " +
								data.error[i].id +
								"</p>";
						}
					}
				} else {
					var html = "";
				}
				$("#errors_show").html(html);
				data_added_toast();
			}
			if (data.logstatus == "errors") {
				excel_fields_required();
				$("#osmuploadForm")[0].reset();
			}
			if (data.logstatus == "error_") {
				file_error_toast();
				$("#osmuploadForm")[0].reset();
			}
			if (data.logstatus == "error_h") {
				file_error_toast1();
				$("#osmuploadForm")[0].reset();
			}
			if (data.logstatus == "error") {
				$("#osmuploadForm")[0].reset();
				var err = data.error;
				if (err.length > 0) {
					var html = "<p>Errors :</p>";
					for (var i = 0; i < err.length; i++) {
						if (data.error[i].format == "phno") {
							html +=
								"<p>" +
								(i + 1) +
								" .Phone No must be 10 digits only in id = " +
								data.error[i].id +
								"</p>";
						} else if (data.error[i].format == "already_exists") {
							html +=
								"<p>" +
								(i + 1) +
								" . Data already exists, Please check in SSFA Id = " +
								data.error[i].ssfa_id +
								" and JC Type = " +
								data.error[i].jc_type +
								" and Fin_Year = " +
								data.error[i].fin_year +
								"</p>";
						} else {
							html +=
								"<p>" +
								(i + 1) +
								" . Empty column noted, Please check in id = " +
								data.error[i].id +
								"</p>";
						}
					}
				} else {
					var html = "";
				}
				$("#errors_show").html(html);
				data_error_toast();
			}
			get_osm();
		},
	});
});

$("#del_osm").submit(function (e) {
	e.preventDefault();
	var formData = new FormData($('#osmdelete')[0]);
	$.ajax({
		url: BASE_URL + "MastersController/delete_osm",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
			if(data =="success"){
				$('#delete_osm').addClass('d-none');
				$('#confirm_del_osm').modal('hide');
				delsuccess_toast();
				get_osm();
			}else{
				request_failed();
				$('#confirm_del_osm').modal('hide');
				get_osm();
			}
		},
	});
});

function get_osm() {
	$.ajax({
		url: BASE_URL + "MastersController/get_osm",
		type: "post",
		dataType: "json",
		success: function (response) {
			var example = $("#osm_tb").DataTable({
				data: response,
				bDestroy: true,
				lengthChange: true,
				processing: true,
				fnRowCallback: function (
					nRow,
					aData,
					iDisplayIndex,
					iDisplayIndexFull
				) {
					$("td:eq(1)", nRow).html(iDisplayIndexFull + 1);
				},
				columns: [
					{ data: "action","render": function(data,type,  row) {
						return ' <input type="checkbox" value='+row.id+' class="checkBoxOsm" />'
						} 
					},
					{ data: "id" },
					{ data: "osm_name" },
					{ data: "ssfa_id" },
					{ data: "sm_type" },
					{ data: "zsm" },
					{ data: "asm" },
					{ data: "sde" },
					{ data: "sde_id" },
					{ data: "jc_type" },
					{ data: "bc_target" },
					{ data: "tlsd_target" },
					{ data: "eco_target" },
					{ data: "bc_achivement" },
					{ data: "tlsd_achivement" },
					{ data: "eco_achivement" },
					{ data: "bc_percentage" },
					{ data: "tlsd_percentage" },
					{ data: "eco_percentage" },
					{ data: "created_date" },
				],
				orderable: false,
				searchable: false,
				columnDefs: [
					{ orderable: false, targets: "_all" }, // Applies the option to all columns
				],
			});
		},
	});
}

var osm_selectedCheckboxes = [];
$(document).on("change", ".checkBoxOsm", function () {
  const checkboxValues = [...document.querySelectorAll('.checkBoxOsm:checked')].map(e => e.value);
  checkboxValues.forEach(function (value) {
    if (!osm_selectedCheckboxes.includes(value)) {
		osm_selectedCheckboxes.push(value);
    }
  });
  $('#osm_tb tbody :checkbox:not(:checked)').each(function() {
	var valueToRemove = $(this).val();
	osm_selectedCheckboxes = osm_selectedCheckboxes.filter(function(value) {
		return value !== valueToRemove;
	});
});
  $('#osm_delete').val(osm_selectedCheckboxes);
  if(osm_selectedCheckboxes.length){
	$('#delete_osm').removeClass('d-none');
  }else{
	$('#delete_osm').addClass('d-none');
  }
});
// selectedCheckboxes = [];

$('#CheckOsm').click(function (e) {
    var table = $('#osm_tb').DataTable();

    $('#osm_tb tbody :checkbox').prop('checked', $(this).is(':checked'));

    const data = [...document.querySelectorAll('.checkBoxOsm:checked')].map(e => e.value);
	data.forEach(function (value) {
		if (!osm_selectedCheckboxes.includes(value)) {
			osm_selectedCheckboxes.push(value);
		}else{
			osm_selectedCheckboxes = data;
			
		}
	  });
	// osm_selectedCheckboxes = data;
	

    e.stopImmediatePropagation();
	selec_osm(table);
    
    $('#osm_tb tbody :checkbox:not(:checked)').each(function() {
        var valueToRemove = $(this).val();
        osm_selectedCheckboxes = osm_selectedCheckboxes.filter(function(value) {
            return value !== valueToRemove;
        });
    });
	$('#osm_delete').val(osm_selectedCheckboxes.join(','));
	if(osm_selectedCheckboxes.length){
		$('#delete_osm').removeClass('d-none');
	  }else{
		$('#delete_osm').addClass('d-none');
	  }
});
var checkall_osm = document.getElementById('CheckAllOsm');

	$('#CheckAllOsm').click(function (e) {
if(checkall_osm.checked){
	$('#CheckOsm').attr('disabled','');
}else{
	$('#CheckOsm').removeAttr('disabled','');
	$('#CheckOsm').prop('checked',false);
}


		var table = $('#osm_tb').DataTable();
		table.rows().nodes().to$().find('.checkBoxOsm').prop('checked', $(this).is(':checked'));
		e.stopImmediatePropagation();

		updateBeatDeleteInputOsm(table);
	});
	
	function updateBeatDeleteInputOsm(table) {
		osm_selectedCheckboxes = [];
    table.rows().nodes().to$().find('.checkBoxOsm:checked').each(function () {
        osm_selectedCheckboxes.push($(this).val());
    });
	$('#osm_tb tbody :checkbox:not(:checked)').each(function() {
        var valueToRemove = $(this).val();
        osm_selectedCheckboxes = osm_selectedCheckboxes.filter(function(value) {
            return value !== valueToRemove;
        });
    });
		$('#osm_delete').val(osm_selectedCheckboxes);
		if(osm_selectedCheckboxes.length){
			$('#delete_osm').removeClass('d-none');
		  }else{
			$('#delete_osm').addClass('d-none');
		  }
	}

	function updateDataTableSelectAll(table){
		var $table             = table.table().node();
		var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		var $chkbox_checked    = $('tbody .checkBoxOsm:checked', $table);
		var chkbox_select_all  = $('thead input[name="select_osm"]', $table).get(0);
		if($chkbox_checked.length === 0){
		   chkbox_select_all.checked = false;
		   if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = false;
		   }
		} else if ($chkbox_checked.length === $chkbox_all.length){
		   chkbox_select_all.checked = true;
		   if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = false;
		   }
		} else {
		   chkbox_select_all.checked = true;
		   if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = true;
		   }
		}
	  }
	 function selec_osm(table){
		var rows_selected = [];
		$('#osm_tb tbody').on('click', 'input[type="checkbox"]', function(e){
		   var $row = $(this).closest('tr');
		   var data = table.row($row).data();
		   var rowId = data[0];
		   var index = $.inArray(rowId, rows_selected);
		   if(this.checked && index === -1){
			 rows_selected.push(rowId);
		   } else if (!this.checked && index !== -1){
			 rows_selected.splice(index, 1);
		   }
		   if(this.checked){
			 $row.addClass('selected');
		   } else {
			 $row.removeClass('selected');
		   }
		   updateDataTableSelectAll(table);
		   e.stopPropagation();
		});
		$('#osm_tb').on('click', 'tbody td, thead th:first-child', function(e){
		   $(this).parent().find('input[type="checkbox"]').trigger('click');
		});
		$('thead input[name="select_all"]', table.table().container()).on('click', function(e){
		   if(this.checked){
			 $('#osm_tb tbody input[type="checkbox"]:not(:checked)').trigger('click');
		   } else {
			 $('#osm_tb tbody input[type="checkbox"]:checked').trigger('click');
		   }
		   e.stopPropagation();
		});
		table.on('draw', function(){
		   updateDataTableSelectAll(table);
		});
	  }

//RS
$("#rsuploadForm").submit(function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	$.ajax({
		url: BASE_URL + "MastersController/rs_excel_upload",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
			if (data.logstatus == "success") {
				$("#rsuploadForm")[0].reset();
				var err = data.error;
				if (err.length > 0) {
					var html = "<p>Errors :</p>";
					for (var i = 0; i < err.length; i++) {
						if (data.error[i].format == "phno") {
							html +=
								"<p>" +
								(i + 1) +
								" .Phone No must be 10 digits only in id = " +
								data.error[i].id +
								"</p>";
						} else if (data.error[i].format == "already_exists") {
							html +=
								"<p>" +
								(i + 1) +
								" . Data already exists, Please check in RS Code = " +
								data.error[i].RS_Code +
								" and SM Mobile = " +
								data.error[i].sm_mobile +
								"</p>";
						} else {
							html +=
								"<p>" +
								(i + 1) +
								" . Empty column noted, Please check in id = " +
								data.error[i].id +
								"</p>";
						}
					}
				} else {
					var html = "";
				}
				$("#errors_show").html(html);
				data_added_toast();
			}
			if (data.logstatus == "errors") {
				excel_fields_required();
				$("#rsuploadForm")[0].reset();
			}
			if (data.logstatus == "error_") {
				file_error_toast();
				$("#rsuploadForm")[0].reset();
			}
			if (data.logstatus == "error_h") {
				file_error_toast1();
				$("#rsuploadForm")[0].reset();
			}
			if (data.logstatus == "error") {
				$("#rsuploadForm")[0].reset();
				var err = data.error;
				if (err.length > 0) {
					var html = "<p>Errors :</p>";
					for (var i = 0; i < err.length; i++) {
						if (data.error[i].format == "phno") {
							html +=
								"<p>" +
								(i + 1) +
								" .Phone No must be 10 digits only in id = " +
								data.error[i].id +
								"</p>";
						} else if (data.error[i].format == "already_exists") {
							html +=
								"<p>" +
								(i + 1) +
								" . Data already exists, Please check in RS Code = " +
								data.error[i].RS_Code +
								" and SM Mobile = " +
								data.error[i].sm_mobile +
								"</p>";
						} else {
							html +=
								"<p>" +
								(i + 1) +
								" . Empty column noted, Please check in id = " +
								data.error[i].id +
								"</p>";
						}
					}
				} else {
					var html = "";
				}
				$("#errors_show").html(html);
				data_error_toast();
			}
			get_rs();
		},
	});
});

$("#del_rs").submit(function (e) {
	e.preventDefault();
	var formData = new FormData($('#rsdelete')[0]);
	$.ajax({
		url: BASE_URL + "MastersController/delete_rs",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
			if(data =="success"){
				$('#delete_rs').addClass('d-none');
				$('#confirm_del_rs').modal('hide');
				delsuccess_toast();
				get_rs();
			}else{
				request_failed();
				$('#confirm_del_rs').modal('hide');
				get_rs();
			}
		
		},
	});
});

function get_rs() {
	$.ajax({
		url: BASE_URL + "MastersController/get_rs",
		type: "post",
		dataType: "json",
		success: function (response) {
			var example = $("#rs_tb").DataTable({
				data: response,
				bDestroy: true,
				lengthChange: true,
				processing: true,
				fnRowCallback: function (
					nRow,
					aData,
					iDisplayIndex,
					iDisplayIndexFull
				) {
					$("td:eq(1)", nRow).html(iDisplayIndexFull + 1);
				},
				columns: [
					{ data: "action","render": function(data,type,  row) {
						return ' <input type="checkbox" value='+row.id+' class="checkBoxRs" />'
						} 
					},
					{ data: "id" },
					{ data: "business" },
					{ data: "rs_name" },
					{ data: "rs_code" },
					{ data: "state_name" },
					{ data: "district_name" },
					{ data: "city_name" },
					{ data: "town_name" },
					{ data: "town_code" },
					{ data: "sm_mobile" },
					{ data: "tso_name" },
					{ data: "tso_mobile" },
					{ data: "created_at" },
				],
				orderable: false,
				searchable: false,
				columnDefs: [
					{ orderable: false, targets: "_all" }, // Applies the option to all columns
				],
			});
		},
	});
}

var rs_selectedCheckboxes = [];
$(document).on("change", ".checkBoxRs", function () {
  const checkboxValues = [...document.querySelectorAll('.checkBoxRs:checked')].map(e => e.value);
  checkboxValues.forEach(function (value) {
    if (!rs_selectedCheckboxes.includes(value)) {
		rs_selectedCheckboxes.push(value);
    }
  });

  $('#rs_tb tbody :checkbox:not(:checked)').each(function() {
	var valueToRemove = $(this).val();
	rs_selectedCheckboxes = rs_selectedCheckboxes.filter(function(value) {
		return value !== valueToRemove;
	});
});

  $('#rs_delete').val(rs_selectedCheckboxes);
  if(rs_selectedCheckboxes.length){
	$('#delete_rs').removeClass('d-none');
  }else{
	$('#delete_rs').addClass('d-none');
  }
});
// selectedCheckboxes = [];

$('#CheckRs').click(function (e) {
    var table = $('#rs_tb').DataTable();

    $('#rs_tb tbody :checkbox').prop('checked', $(this).is(':checked'));

    const data = [...document.querySelectorAll('.checkBoxRs:checked')].map(e => e.value);
	data.forEach(function (value) {
		if (!rs_selectedCheckboxes.includes(value)) {
			rs_selectedCheckboxes.push(value);
		}else{
			rs_selectedCheckboxes = data;
			
		}
	  });
	// rs_selectedCheckboxes = data;
	

    e.stopImmediatePropagation();
	selec_rs(table);
    
    $('#rs_tb tbody :checkbox:not(:checked)').each(function() {
        var valueToRemove = $(this).val();
        rs_selectedCheckboxes = rs_selectedCheckboxes.filter(function(value) {
            return value !== valueToRemove;
        });
    });
	$('#rs_delete').val(rs_selectedCheckboxes.join(','));
	if(rs_selectedCheckboxes.length){
		$('#delete_rs').removeClass('d-none');
	  }else{
		$('#delete_rs').addClass('d-none');
	  }
});
var checkall = document.getElementById('CheckAllRs');

	$('#CheckAllRs').click(function (e) {
if(checkall.checked){
	$('#CheckRs').attr('disabled','');
}else{
	$('#CheckRs').removeAttr('disabled','');
	$('#CheckRs').prop('checked',false);
}


		var table = $('#rs_tb').DataTable();
		table.rows().nodes().to$().find('.checkBoxRs').prop('checked', $(this).is(':checked'));
		e.stopImmediatePropagation();

		updateBeatDeleteInputRs(table);
	});
	
	function updateBeatDeleteInputRs(table) {
		rs_selectedCheckboxes = [];
    table.rows().nodes().to$().find('.checkBoxRs:checked').each(function () {
        rs_selectedCheckboxes.push($(this).val());
    });
	$('#rs_tb tbody :checkbox:not(:checked)').each(function() {
        var valueToRemove = $(this).val();
        rs_selectedCheckboxes = rs_selectedCheckboxes.filter(function(value) {
            return value !== valueToRemove;
        });
    });
		$('#rs_delete').val(rs_selectedCheckboxes);
		if(rs_selectedCheckboxes.length){
			$('#delete_rs').removeClass('d-none');
		  }else{
			$('#delete_rs').addClass('d-none');
		  }
	}

	function updateDataTable(table){
		var $table             = table.table().node();
		var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		var $chkbox_checked    = $('tbody .checkBoxRs:checked', $table);
		var chkbox_select_all  = $('thead input[name="select_rs"]', $table).get(0);
		if($chkbox_checked.length === 0){
		   chkbox_select_all.checked = false;
		   if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = false;
		   }
		} else if ($chkbox_checked.length === $chkbox_all.length){
		   chkbox_select_all.checked = true;
		   if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = false;
		   }
		} else {
		   chkbox_select_all.checked = true;
		   if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = true;
		   }
		}
	  }
	 function selec_rs(table){
		var rows_selected = [];
		$('#rs_tb tbody').on('click', 'input[type="checkbox"]', function(e){
		   var $row = $(this).closest('tr');
		   var data = table.row($row).data();
		   var rowId = data[0];
		   var index = $.inArray(rowId, rows_selected);
		   if(this.checked && index === -1){
			 rows_selected.push(rowId);
		   } else if (!this.checked && index !== -1){
			 rows_selected.splice(index, 1);
		   }
		   if(this.checked){
			 $row.addClass('selected');
		   } else {
			 $row.removeClass('selected');
		   }
		   updateDataTable(table);
		   e.stopPropagation();
		});
		$('#rs_tb').on('click', 'tbody td, thead th:first-child', function(e){
		   $(this).parent().find('input[type="checkbox"]').trigger('click');
		});
		$('thead input[name="select_all"]', table.table().container()).on('click', function(e){
		   if(this.checked){
			 $('#rs_tb tbody input[type="checkbox"]:not(:checked)').trigger('click');
		   } else {
			 $('#rs_tb tbody input[type="checkbox"]:checked').trigger('click');
		   }
		   e.stopPropagation();
		});
		table.on('draw', function(){
		   updateDataTable(table);
		});
	  }

//Masters
$("#masterForm").submit(function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	$.ajax({
		url: BASE_URL + "MastersController/m_excel_upload",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
			if (data.logstatus == "success") {
				$("#masterForm")[0].reset();
				var err = data.error;
				if (err.length > 0) {
					var html = "<p>Errors :</p>";
					for (var i = 0; i < err.length; i++) {
						if (data.error[i].format == "phno") {
							html +=
								"<p>" +
								(i + 1) +
								" .Phone No must be 10 digits only in id = " +
								data.error[i].id +
								"</p>";
						} else if (data.error[i].format == "already_exists") {
							html +=
								"<p>" +
								(i + 1) +
								" . Data already exists, Please check in zsm number = " +
								data.error[i].zsm_number +
								" and asm number = " +
								data.error[i].asm_number +
								" and sm number = " +
								data.error[i].sm_number +
								" and tso number = " +
								data.error[i].tso_number +
								"</p>";
						} else {
							html +=
								"<p>" +
								(i + 1) +
								" . Empty column noted, Please check in id = " +
								data.error[i].id +
								"</p>";
						}
					}
				} else {
					var html = "";
				}
				$("#errors_show").html(html);
				data_added_toast();
			}
			if (data.logstatus == "errors") {
				excel_fields_required();
				$("#masterForm")[0].reset();
			}
			if (data.logstatus == "error_") {
				file_error_toast();
				$("#masterForm")[0].reset();
			}
			if (data.logstatus == "error_h") {
				file_error_toast1();
				$("#masterForm")[0].reset();
			}
			if (data.logstatus == "error") {
				data_error_toast();
				var err = data.error;
				$("#masterForm")[0].reset();
				if (err.length > 0) {
					var html = "<p>Errors :</p>";
					for (var i = 0; i < err.length; i++) {
						if (data.error[i].format == "phno") {
							html +=
								"<p>" +
								(i + 1) +
								" .Phone No must be 10 digits only in id = " +
								data.error[i].id +
								"</p>";
						} else if (data.error[i].format == "already_exists") {
							html +=
								"<p>" +
								(i + 1) +
								" . Data already exists, Please check in zsm number = " +
								data.error[i].zsm_number +
								" and asm number = " +
								data.error[i].asm_number +
								" and sm number = " +
								data.error[i].sm_number +
								" and tso number = " +
								data.error[i].tso_number +
								"</p>";
						} else {
							html +=
								"<p>" +
								(i + 1) +
								" . Empty column noted, Please check in id = " +
								data.error[i].id +
								"</p>";
						}
					}
				} else {
					var html = "";
				}
				$("#errors_show").html(html);
			}
			get_masters();
		},
	});
});
$('#business').on('change',function(){
	$('#delete_masters').removeClass('d-none');
	$('#sel').attr('disabled','');
	var business = $('#business').val();
	get_masters(business);
})

$('#del_masters').submit(function(e){
	e.preventDefault();
	var business = '';

	var formData = new FormData($('#mastersdelete')[0]);
	$.ajax({
		url: BASE_URL + "MastersController/delete_mastersdata",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
			if(data =="success"){
				$('#sel').removeAttr('disabled','');
				$('#delete_masters').addClass('d-none');
				$('#mastersdelete').trigger('reset');
				$('#confirm_del_masters').modal('hide');
				delsuccess_toast();
				get_masters(business);
			}else{
				request_failed();
				$('#confirm_del_masters').modal('hide');
				get_masters(business);
			}
		},
	});
});
$('#del_users').submit(function(e){
	e.preventDefault();
	var formData = new FormData(this);
	$.ajax({
		url: BASE_URL + "MastersController/delete_usersdata",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
			if(data =="success"){
				$('#confirm_del_user').modal('hide');
				delsuccess_toast();
				get_users(business);
			}else{
				request_failed();
				$('#confirm_del_user').modal('hide');
				get_users(business);
			}
		},
	});
});
function get_masters(division) {
	$.ajax({
		url: BASE_URL + "MastersController/get_masters",
		type: "post",
		data:{
			division:division
		},
		dataType: "json",
		success: function (response) {
			var example = $("#master_tb").DataTable({
				data: response,
				bDestroy: true,
				lengthChange: true,
				processing: true,
				fnRowCallback: function (
					nRow,
					aData,
					iDisplayIndex,
					iDisplayIndexFull
				) {
					$("td:eq(0)", nRow).html(iDisplayIndexFull + 1);
				},
				columns: [
					{ data: "id" },
					{ data: "division" },
					{ data: "region" },
					{ data: "zsm" },
					{ data: "zsm_number" },
					{ data: "asm" },
					{ data: "asm_number" },
					{ data: "tso" },
					{ data: "tso_number" },
					{ data: "sm" },
					{ data: "sm_number" },
					{ data: "createddate" },
					{ data: "action","render": function(data,type,  row) {
						return ' <button type="button" onclick=showpopup('+row.id+') data-toggle="modal"data-target = "#confirm_del" class="deleteMaster btn btn-sm btn-danger" > <i class="bx bx-trash "></i> </button>'
						}  },
				],
				orderable: false,
				searchable: false,
				columnDefs: [
					{ orderable: false, targets: "_all" }, // Applies the option to all columns
				],
			});
		},
	});
}
function deleteMaster(){
	var id= $('#del_id').val();
	$.ajax({
		url: BASE_URL + "MastersController/delete_single_mastersdata",
		method: "POST",
		data: {
			id:id
		},
		
		dataType: "json",
		success: function (data) {
			if(data =="success"){
				$('#confirm_del').modal('hide');
				delsuccess_toast();
				get_masters();
			}else{
				request_failed();
				$('#confirm_del').modal('hide');
				get_masters();
			}
		},
	});
}
function showpopup(id){
	$('#confirm_del').show();
	$('#del_id').val(id);
}

function showpopup_users(id){
	$('#confirm_del_user').show();
	$('#user_id').val(id);
}
function get_users() {
	$.ajax({
		url: BASE_URL + "MastersController/get_users",
		type: "post",
		dataType: "json",
		success: function (response) {
			var example = $("#user_tb").DataTable({
				data: response,
				bDestroy: true,
				lengthChange: true,
				processing: true,
				fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
					$("td:eq(0)", nRow).html(iDisplayIndexFull + 1);
				},
				columns: [
					{ data: "id" },
					{data: 'username'},
					{data: 'mobile'},
					{ data: "role_type" },
					{ data: "createddate" },
					{
						data: function (data) {
							return (
								'<button type="button" class="btn btn-primary btn-sm edit_user" data-id="' +
								data.id +
								'" data-mobile="' +
								data.mobile +
								'"><i class="bx bxs-edit"></i></button> <button type="button" onclick=showpopup_users('+data.id+') data-toggle="modal"data-target = "#confirm_del_user" class="deleteMaster btn btn-sm btn-danger" > <i class="bx bx-trash "></i> </button>'
							);
						},
					},
				],
				orderable: false,
				searchable: true,
				columnDefs: [
					{ orderable: false, targets: "_all" }, // Applies the option to all columns
				],
			});
		},
	});
}

$(document).on("click", ".edit_user", function () {
	id = $(this).data("id");
	console.log(id);
	$.ajax({
		url: BASE_URL + "MastersController/get_user_id",
		type:'POST',
		data:{
			id:id
		},
		dataType:'json',
		success: function (data){
			// console.log(data[0].username);
			// console.log(data);
			$('#update_form #id').val(data[0].id);
			$('#update_form #username').val(data[0].username);
			$('#update_form #mobile').val(data[0].mobile);
			$('#update_form #or_mobile').val(data[0].mobile);
			$('#un_err').addClass('d-none')
			$('#mob_err').addClass('d-none')
		}
	})
	$('#update').modal('show');

	
});

$(document).on("click", "#update_user", function () {
		
	var id =$('#id').val();
	var cur_mobile = $('#or_mobile').val();
	// var username = $(this).data("username");
	var username =$("#username").val();
	// alert(username);
	var mobile = $("#mobile").val();
	if ( mobile.length == 10 && username!='') {
		$.ajax({
			url: BASE_URL + "MastersController/update_user",
			type: "post",
			data: {
				id: id,
				mobile: mobile,
				cur_mobile: cur_mobile,
				username: username,
			},
			dataType: "json",
			success: function (response) {
				if (response.logstatus == "success") {
					updated_toast();
					get_users();
					$('#update').modal('hide');
					$('#un_err').addClass('d-none')
					$('#mob_err').addClass('d-none')
				}
				if (response.logstatus == "error") {
					request_failed();
				}
			},
		});
	}
	else {
		if( mobile.length != 10 && username == '' ){
			// user_name();
			$('#mob_err').removeClass('d-none');
			$('#un_err').removeClass('d-none')
		}else if(username !=''){
			// mobile_number();
			$('#un_err').addClass('d-none')
			$('#mob_err').removeClass('d-none')
		}else{
			$('#mob_err').addClass('d-none')
			$('#un_err').removeClass('d-none')

		}
	}
});


function mobile_number() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-x-circle',
		msg: 'Invalid mobile number'
	});
}

function user_name() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-x-circle',
		msg: 'Invalid user name'
	});
}
 
