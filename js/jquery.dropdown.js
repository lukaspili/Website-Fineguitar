$(document).ready(function() {
		// Setup the nav drop-downs
		$('#nav').nmcDropDown({
			show: {height: 'show', opacity: 'show'}
		});
		
		// Setup the sidebar panel drop-downs
		$('#sidebarNav').nmcDropDown({
			trigger: 'click',
			submenu_selector: 'p',
			show: {height: 'show'},
			hide: {height: 'hide'}
		});
	});