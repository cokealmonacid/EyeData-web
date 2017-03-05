function changeStatus() {
	var button = document.getElementById('heatmap-section');
	style = window.getComputedStyle(button),
    display = style.getPropertyValue('display');
    if (display == 'none') {
    	button.style.display = 'initial';
    } else {
    	button.style.display = 'none';
    }
}