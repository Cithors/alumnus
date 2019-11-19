$(document).ready(function() {
	// Language dropdown
	$('#logo').ready(function(e) { $('.nav-wrapper').hide().removeClass('hide'); });	// Hide and display
	$('#logo').hover(function(e) { $('.nav-wrapper').show('fast'); }); 					// Show on hover
	$('html').click(function(e) { $('.nav-wrapper').hide('slow'); }); 					// Hide on click out
	// Scroll
	$('#header, content, #footer').dblclick(function(e) {
		$('#logo, #header').toggleClass("sticky");
	});
});

getCookie = function(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
};

lightMode = function() {
	$('#logo').css('filter', 'none');
	$('.slider, .bg-bottom, #footer').removeClass('dark');
};


darkMode = function() {
	let filter = 'filter: invert(100%) sepia(95%) saturate(0%) hue-rotate(96deg) brightness(102%) contrast(104%);';
	$('#logo').attr('style', filter);
	$('.slider, .bg-bottom, #footer').toggleClass('dark');
};

/* Cookies Management */
createCookie = function(name, value, days) {
	var expires = '';
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 *1000));
		expires = "; expires=" + date.toGMTString();
	}
	document.cookie = name + "=" + '' + parseInt(-1) + "; path=/;";
	document.cookie = name + "=" + value + expires + "; path=/";
	// document.cookie = name+'='+value+';'+'path=/';
	document.location.reload(true);
};

createCookie2 = function(name, value, sec) {
	var expires = '';
	if (sec) {
		var date = new Date();
		date.setTime(date.getTime() + (sec *1000));
		expires = "; expires=" + date.toGMTString();
	}
	document.cookie = name + "=" + '' + parseInt(-1) + "; path=/;";
	document.cookie = name + "=" + value + expires + "; path=/";
	// document.cookie = name+'='+value+';'+'path=/';
	document.location.reload(true);
};

readCookie = function(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1,c.length);
		}
		if (c.indexOf(nameEQ) == 0) {
			return c.substring(nameEQ.length,c.length);
		}
	}
	return null;
};

eraseCookie = function(name) {
	createCookie(name, '', -1);
};
