setInterval(function() {
var data = document.getElementById('to_id').value;
$.ajax({
	url:"inc/getmes.php",
	type:"post",
	data:{data:data},
	success:function(messages) {
		$('#acc_mes').html(messages);
	}
});


},1000);
