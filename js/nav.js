console.log(navigator.onLine);
if(!navigator.onLine) {
	alert('Please Check Your Internet Connection');
	console.log('Please Check Your Internet Connection');
	window.open('nocon.php','_self');
}
