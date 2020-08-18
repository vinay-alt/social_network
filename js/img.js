
// const bg = document.getElementById('bg');
// bg.addEventListener('click', ()=>{
// 	alert();
// });

function change(event) {
	const Btn = document.getElementById('Btn');
	const img = document.getElementById('img_se');
	const file = document.getElementById('realfile');
	const text = document.getElementById('filetext');
	const close = document.getElementById('close');
	img.style.display = "block";
	


	Btn.addEventListener('click', ()=>{
		file.click();
	});
	file.addEventListener('change', ()=>{
		if(file.value) {
		var name = file.value.split('\\')[2];
		Btn.innerHTML = "Selected File : " + name;
		} else {
		Btn.innerHTML = "Choose a File"
		}
	});
	close.addEventListener('click', ()=>{
		img.style.display = "none";
	})
}


function change_co(event) {
	const img1 = document.getElementById('img_ce');
	const Btn1 = document.getElementById('Btn1');
	const file1 = document.getElementById('realfile1');
	const close1 = document.getElementById('close1');

	img1.style.display="block";
	Btn1.addEventListener('click', ()=>{
		file1.click();
	});
	 file1.addEventListener('change', ()=>{
	 	if(file1.value) {
	 	var name = file1.value.split('\\')[2];
	 	Btn1.innerHTML = "Selected File : " + name;
		} else {
	 	Btn1.innerHTML = "Choose a File"
	 	}
	 });
	 close1.addEventListener('click', ()=>{
	 	img1.style.display = "none";
	 })

}


function reqload() {
	const request = document.getElementById('Request');
	const load = document.getElementById('loader');
	request.style.borderBottom = 'thick solid #FFF';
	load.style.display='none';
	
}
	$('#photos').slideUp();
$('#showphoto').click(function() {
	
	if (document.getElementById('showphoto').innerHTML=='show▾') {	
		document.getElementById('showphoto').innerHTML='hide▴';
		document.getElementById('heading').style.backgroundColor="#ccc";
		document.getElementById('mes').style.backgroundColor="#fff";
		$('#photos').slideToggle();
	 } else if (document.getElementById('showphoto').innerHTML=='hide▴') {	
		document.getElementById('showphoto').innerHTML='show▾';
		document.getElementById('heading').style.backgroundColor="";
		document.getElementById('mes').style.backgroundColor="#ccc";
		$('#photos').slideToggle();
	 }
});

// const request = document.getElementById('Request');
// 	 const load = document.getElementById('loader');
// 	 request.style.borderBottom = 'thick solid #FFF';
// 	 load.style.display='none';
