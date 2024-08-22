$(document).ready(function () {
	get_rs_type_list();
	get_company_list();
	// get_additional_details();
	// get_region_list();
});

function get_rs_type_list() {
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSController/get_rs_type_list',
		data: {},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="" disabled selected>Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].rs_type + '">' + data[index].rs_type + '</option>';
				}
				$('#distri_type').html(html);
			}
		}
	});
}

function get_company_list() {
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSController/get_company_list',
		data: {},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="" disabled>Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].cname + '">' + data[index].cname + '</option>';
				}
				$('#handled_company').html(html);
			}
		}
	});
}
$(document).ready(function() {
    // Function to handle file input change and validation
    $('#noc_pending_claims').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#noc_pending_claims').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });
	$('#gst_reg_file').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#gst_reg_file').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });

	$('#fssai_copy').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#fssai_copy').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });

	$('#invoice_copy').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#invoice_copy').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });

	$('#delivery_van_rc').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#delivery_van_rc').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });
	$('#delivery_van_pic').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#delivery_van_pic').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });

	$('#owner_picture').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#owner_picture').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });
	$('#office_main_gate').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#office_main_gate').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });
	$('#godown_pic2').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#godown_pic2').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });
	$('#godown_pic').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#godown_pic').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });
	$('#pan_copy').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#pan_copy').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });
	$('#aadhar_copy2').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#aadhar_copy2').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });
	$('#aadhar_copy').on('change', function() {
        var file = this.files[0]; // Get the selected file
        var fileSize = file.size; // Get the file size in bytes
        var maxSize = 2 * 1024 * 1024; // 10 MB (in bytes)

        if (fileSize > maxSize) {
            $(this).addClass('is-invalid');
            $('.invalid-feedback').text('File size exceeds the maximum allowed size of 10 MB.');
            // Clear the file input
            $('#aadhar_copy').val('');
        } else {
            // File is valid, you can proceed with further actions
            $(this).removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }
    });
	$('#email_id').on('input', function() {
        // Get the value of the input field
        var email = $(this).val().trim();

        // Define regular expression for email validation
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Check if the input matches the regular expression
        if (!emailPattern.test(email)) {
            // Invalid email format
            $(this).addClass('is-invalid');
            $(this).siblings('.invalid-feedback').text('Please enter a valid email address.');
        } else {
            // Valid email format
            $(this).removeClass('is-invalid');
            $(this).siblings('.invalid-feedback').text('');
        }
    });
	$('#mobile_no').on('input', function() {
        // Remove any non-numeric characters
        var mobileNumber = $(this).val().replace(/\D/g, '');
        
        // Limit to 10 digits
        mobileNumber = mobileNumber.substring(0, 10);
        
        // Update the input field value
        $(this).val(mobileNumber);

        // Check if the input is 10 digits
        if (mobileNumber.length !== 10) {
            // Invalid mobile number format
            $(this).addClass('is-invalid');
            $(this).siblings('.invalid-feedback').text('Please enter a valid 10-digit mobile number.');
        } else {
            // Valid mobile number format
            $(this).removeClass('is-invalid');
            $(this).siblings('.invalid-feedback').text('');
        }
    });
});
$('#reason_appoint').on('change', function () {
	var areason = $('#reason_appoint').val();
	if (areason != 'Expansion') {
		$('.tab-content').addClass('show_birep');
		// $('.tab-content').removeClass('show_ex');
		$('#sap_sscode').prop('required',true);
		$('#noc_pending_claims').prop('required',true);
		$('#bifu_replace').show();
		// $('#region_name').val("").trigger('change');
		// $('#select_rs_name').val("").trigger('change');
		// $('#state_name').val("").trigger('change');
		// $('#c_division').val("").trigger('change');
		// $('#c_city').val("").trigger('change');
		// $('#c_town').val("").trigger('change');
	} else {
		$('#sap_sscode').prop('required',false);
		$('#noc_pending_claims').prop('required',false);
		$('#bifu_replace').hide();
		$('.tab-content').removeClass('show_birep');
		// $('.tab-content').removeClass('show_ex');

		// $('#region_name').val("").trigger('change');
		// $('#select_rs_name').val("").trigger('change');
		// $('#state_name').val("").trigger('change');
		// $('#c_division').val("").trigger('change');
		// $('#c_city').val("").trigger('change');
		// $('#c_town').val("").trigger('change');
		// $('#ex_rssm_number').val("");
		// $('#c_ex_rssm_name').val("");

	}
});


$('#SubmitBtn').click(function () {
	let form = $('#rs_appointment_form');
		if (form.length) {
			let stepFields = form.find('#step-6').find('input');
			let isValid = true;

			stepFields.each(function () {
				if (!$(this)[0].checkValidity()) {
					isValid = false;
					return false; // Exit each loop early
				}
			});

			if (!isValid) {
				form.addClass('was-validated');
				return false; // Prevent navigation
			}
			form.removeClass('was-validated');
		}
		$('#smartwizard').smartWizard("unsetState", [6], 'error');
	$("#SubmitBtn").attr("disabled",true);
	// e.preventDefault();
	var formData = new FormData($('#rs_appointment_form')[0]);
	$.ajax({
		url: BASE_URL + 'RSController/add_rs_details',
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",

		success: function (data) {

			if (data.response == 'success') {

				$('#rs_appointment_form')[0].reset();
				$('.single-select').select2({
					theme: 'bootstrap4',
					width: $('#rssmForm').data('width') ? $('#rssmForm').data('width') : $('#rssmForm').hasClass('w-100') ? '100%' : 'style',
					placeholder: $('#rssmForm').data('placeholder'),
					allowClear: Boolean($('#rssmForm').data('allow-clear')),
				});

				$("#SubmitBtn").attr("disabled",false);
				$('#reset-btn').click();
				added_toast();
			}
			else {
				$('#SubmitBtn').attr("disabled", false);
			}
		}
	});
});
