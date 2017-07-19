(function () {
	var browser_warning = document.getElementById('browser_warning');
	
	document.getElementById('whichbrowser').addEventListener("load", function () {
		var b = new WhichBrowser();
		
		if (
			b.isBrowser('Internet Explorer','<', '11')
		 || b.isBrowser('Chrome', 			'<', '42')
		 || b.isBrowser('Firefox', 			'<', '38')
		 || b.isBrowser('Opera', 			'<', '29')
		 || b.isBrowser('Safari', 			'<', '8' )
		 || window.location.hash === '#debug'
		) {
			browser_warning.style.display = 'block';
		}
	});
	
	buttons = document.getElementsByClassName('goto_site');
	for ( var i = 0, c = buttons.length; i < c; i++ ) {
		buttons[i].addEventListener("click", function () {
			browser_warning.style.display = 'none';
		});
	}
})();
