function first(event) {
	document.getElementById('one').style.opacity=1;
	document.getElementById('two').style.opacity=0;
	document.getElementById('four').style.opacity=0;
	document.getElementById('three').style.opacity=0;
	event.style.background="#4b5f83";
	document.getElementById('second').style.background="#fff";
	document.getElementById('third').style.background="#fff";
	document.getElementById('fourth').style.background="#fff";

	event.style.color="#fff";
	document.getElementById('second').style.color="";
	document.getElementById('third').style.color="";
	document.getElementById('fourth').style.color="";
}

function two(event) {
	document.getElementById('one').style.opacity=0;
	document.getElementById('two').style.opacity=1;
	document.getElementById('four').style.opacity=0;
	document.getElementById('three').style.opacity=0;
	event.style.background="#4b5f83";
	document.getElementById('first').style.background="#fff";
	document.getElementById('third').style.background="#fff";
	document.getElementById('fourth').style.background="#fff";

	event.style.color="#fff";
	document.getElementById('first').style.color="";
	document.getElementById('third').style.color="";
	document.getElementById('fourth').style.color="";

}

function three(event) {
	document.getElementById('one').style.opacity=0;
	document.getElementById('two').style.opacity=0;
	document.getElementById('four').style.opacity=0;
	document.getElementById('three').style.opacity=1;
	event.style.background="#4b5f83";
	document.getElementById('second').style.background="#fff";
	document.getElementById('first').style.background="#fff";
	document.getElementById('fourth').style.background="#fff";

	event.style.color="#fff";
	document.getElementById('second').style.color="";
	document.getElementById('first').style.color="";
	document.getElementById('fourth').style.color="";

}
function four(event) {
	document.getElementById('one').style.opacity=0;
	document.getElementById('two').style.opacity=0;
	document.getElementById('four').style.opacity=1;
	document.getElementById('three').style.opacity=0;
	event.style.background="#4b5f83";
	document.getElementById('second').style.background="#fff";
	document.getElementById('third').style.background="#fff";
	document.getElementById('first').style.background="#fff";

	event.style.color="#fff";
	document.getElementById('second').style.color="";
	document.getElementById('third').style.color="";
	document.getElementById('first').style.color="";
}