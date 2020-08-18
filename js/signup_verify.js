
var number = 0;
function v_email() {
	var email = document.getElementById('email').value;
	if (email.indexOf('@')<1) {
		number = -1;
		document.getElementById('noatsign').style.display = 'block';

	} else if (email.indexOf('@')>1) {
		number = 0;
		console.log(document.getElementById('noatsign').style.display);
		document.getElementById('noatsign').style.display = 'none';
	}

}

function v_pass() {
	var pass = document.getElementById('pass').value;
	if (pass.length<8) {
		number = -1;
		document.getElementById('lessthan').style.display = 'block';
	} else if (pass.length>=8) {
		number = 0;
		console.log(document.getElementById('lessthan').style.display);
		document.getElementById('lessthan').style.display = 'none';
	}
}

function v_coun() {
	var country = document.getElementById('country').value;
	if (country=='') {
		number = -1;
		document.getElementById('nocoun').style.display = 'block';
	} else if (country!='') {
		number = 0;
		console.log(document.getElementById('nocoun').style.display);
		document.getElementById('nocoun').style.display = 'none';
	}
}

function v_gen() {
	var gender = document.getElementById('gender').value;
	if (gender=='') {
		number = -1;
		document.getElementById('nogen').style.display = 'block';
	} else if (gender!='') {
		number = 0;
		console.log(document.getElementById('nogen').style.display);
		document.getElementById('nogen').style.display = 'none';
	}
}

function v_birth() {
	var birth = document.getElementById('birth').value;
	console.log(birth);
	var array = birth.split("-");
	var curDate = new Date();
	var curYear = curDate.getFullYear();
	var curMonth = curDate.getMonth();
	var curDay = curDate.getDate();
	
	if (array[0]>curYear) {
		number = -1;
		document.getElementById('dmsg').style.display = 'block';
	} else if (array[0]<curYear) {
		number = 0;
		console.log(document.getElementById('dmsg').style.display);
		document.getElementById('dmsg').style.display = 'none';
	} else {

		if (array[1]>curMonth+1) {
			number = -1;
			document.getElementById('dmsg').style.display = 'block';
		} else if(array[1]<curMonth+1) {
			number = 0;
			document.getElementById('dmsg').style.display = 'none';
		} else {
			if (array[2]>curDay) {
				number = -1;
				document.getElementById('dmsg').style.display = 'block';
			} else if (array[2]<Number(curDay)) {
				number = 0;
				document.getElementById('dmsg').style.display = 'none';
			}
		}

	}
}

function Home() {
const Home = document.getElementById('Home');
const Member = document.getElementById('Member');
const Message = document.getElementById('Message');
Home.style.borderBottom = "thick solid #FFF";
Member.style.borderBottom = "";
Message.style.borderBottom = "";
}

function Member() {
const Message = document.getElementById('Message');
const Member = document.getElementById('Member');
const Home = document.getElementById('Home');
const load = document.getElementById('loader');
Member.style.borderBottom = "thick solid #FFF";
Home.style.borderBottom = "";
Message.style.borderBottom = "";
load.style.display="none";
}



function load_mem() {
	window.open('member.php','_self');
}

function load_home() {
	window.open('home.php','_self');
}

function myFunction() { 
const Home = document.getElementById('Home');
const Member = document.getElementById('Member');
const load = document.getElementById('loader');
Home.style.borderBottom = "thick solid #FFF";
Member.style.borderBottom = "";
load.style.display="none";
}

 