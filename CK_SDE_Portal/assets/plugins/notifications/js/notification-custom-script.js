
function login_success() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Logged In Successfully..!'
	});
}

function updated_toast() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Updated Successfully..!'
	});
}

function added_toast() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Added Successfully..!'
	});
}

function delsuccess_toast() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Deleted Successfully..!'
	});
}

function request_failed() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Request Failed..! Try Again..!'
	});
}

function fields_required() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: '* Fields are Required..!'
	});
}

 
 /* Default Notifications */
  function default_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function info_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-info-circle',
		msg: 'Logged in Successfully'
	});
}

function warning_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-error',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function error_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-x-circle',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}
 
function success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-check-circle',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}
/* Rounded corners Notifications */
function round_default_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_info_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: 'bx bx-info-circle',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_warning_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_error_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-x-circle',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function round_success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: 'bx bx-check-circle',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}
/* Notifications With Images*/
function img_default_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		img: 'assets/plugins/notifications/img/1.jpg', //path to image
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function img_info_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		icon: 'bx bx-info-circle',
		position: 'top right',
		img: 'assets/plugins/notifications/img/2.jpg', //path to image
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function img_warning_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		img: 'assets/plugins/notifications/img/3.jpg', //path to image
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function img_error_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		icon: 'bx bx-x-circle',
		position: 'top right',
		img: 'assets/plugins/notifications/img/4.jpg', //path to image
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function img_success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-check-circle',
		img: 'assets/plugins/notifications/img/5.jpg', //path to image
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}
/* Notifications With Images*/
function pos1_default_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'center top',
		size: 'mini',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function pos2_info_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		icon: 'bx bx-info-circle',
		continueDelayOnInactiveTab: false,
		position: 'top left',
		size: 'mini',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function pos3_warning_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		size: 'mini',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function pos4_error_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		icon: 'bx bx-x-circle',
		size: 'mini',
		continueDelayOnInactiveTab: false,
		position: 'bottom left',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function pos5_success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		icon: 'bx bx-check-circle',
		continueDelayOnInactiveTab: false,
		position: 'bottom right',
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}
/* Animated Notifications*/
function anim1_noti() {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'center top',
		showClass: 'fadeInDown',
		hideClass: 'fadeOutDown',
		width: 600,
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function anim2_noti() {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		icon: 'bx bx-info-circle',
		continueDelayOnInactiveTab: false,
		position: 'center top',
		showClass: 'bounceIn',
		hideClass: 'bounceOut',
		width: 600,
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function anim3_noti() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		icon: 'bx bx-error',
		position: 'center top',
		showClass: 'zoomIn',
		hideClass: 'zoomOut',
		width: 600,
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function anim4_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		icon: '',
		position: 'center top',
		showClass: 'lightSpeedIn',
		hideClass: 'lightSpeedOut',
		icon: 'bx bx-x-circle',
		width: 600,
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

function anim5_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'center top',
		showClass: 'rollIn',
		hideClass: 'rollOut',
		icon: 'bx bx-check-circle',
		width: 600,
		msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
	});
}

//excel upload notification
function excel_fields_required() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: '* Empty column noted, Please check !'
	});
}

function data_added_toast() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		rounded: true,
		size: 'mini',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Data Added Successfully..!'
	});
}

function file_error_toast() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Please Upload the file..!'
	});
}

function data_error_toast() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Please check excel and clear errors to add!'
	});
}

function file_error_toast1() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Uploaded Excel is mismatch..!'
	});
}

function invaild_user() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Invalid User!, Please reach out your higher official...'
	});
}


function beat_added_toast() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Beat Added Successfully..!'
	});
}


function beat_overwrite_toast() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Beat Over Written Successfully..!'
	});
}

function excel_fields_required() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: '* Empty column noted, Please check !'
	});
}

function valid_email() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Enter the valid mail id..!'
	});
}

function valid_phone_number() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Enter the valid phone number..!'
	});
}
function valid_aadhar_number() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Enter the valid aadhar number..!'
	});
}
function valid_pan_number() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Enter the valid pan card number..!'
	});
}

function exceed_beat_limit() {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'You have already added maximum beats'
	});
}

function verification_toast() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Verified Successfully..!'
	});
}

function rejected_toast() {
	Lobibox.notify('danger', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Rejected Successfully..!'
	});
}

//Moved to SAP
function moved_to_sap() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Moved to SAP Successfully..!'
	});
}

