
setInterval(function() {
$.ajax({
	url:"inc/getmem.php",
	type:"post",
	success:function(members) {
		//console.log(members);
		$('#mem').html(members);
	}
});
},500);


setInterval(function() {
$.ajax({
	url:"inc/getmescount.php",
	type:"post",
	success:function(count) {
		$('#mes_count1').html(count);
		$('#mes_count2').html(count);
	}
});

},500);

setInterval(function() {
$.ajax({
	url:"inc/user_post.php",
	type:"post",
	success:function(user_posts) {
		$('#user_post').html(user_posts);
	}
});

},500);



setInterval(function() {
$.ajax({
	url:"inc/getreq.php",
	type:"post",
	success:function(requests) {
		$('#r_d').html(requests);
	}
});
},500);


// setInterval(function() {
// $.ajax({
// 	url:"inc/getfriend.php",
// 	type:"post",
// 	success:function(friends) {
// 		$('#friend').html(friends);
// 	}
// });
// },1000);

setInterval(function() {
$.ajax({
	url:"inc/getlike.php",
	type:"post",
	success:function(likes) {
		$('#print_post').html(likes);
	}
});
},500);


function edit_post(event) {
	console.log(event.value);
	$.ajax({
		url:"inc/editpost.php",
		type:"post",
		data:{data:event.value},
		success:function(edittext) {
			$('#edit_post_form').html(edittext);
		}
	});
	document.getElementById('editdiv').style.display="block";

}

function saveinfo(event) {
	console.log(event.value);
	var desc = document.getElementById('editdesc').value;
	var title = document.getElementById('title').value;
	console.log(desc);
	console.log(title);
	$.ajax({
		url:"inc/saveinfo.php",
		type:"post",
		data:{id:event.value, title:title, desc:desc},
		success:function() {
			alert('Edited Successfully')
		}
	});
}



function like(number) {
	$.ajax({
		url:"inc/like.php",
		type:"post",
		data:{data:number},
		
	});
}

function seen() {
	window.open('messages.php','_self');

	$.ajax({
		url:"inc/seen.php",
		type:"POST"
	});
}

function del_like(number) {
	$.ajax({
		url:"inc/del_like.php",
		type:"post",
		data:{data:number},
		
	});
}


function add(number) {
	//var add = document.getElementById('add');
	console.log(number);
	$.ajax({
		url:"inc/add_friend.php",
		type:"POST",
		data:{data:number},
		success:function() {
			console.log('Request sent')
		}
	});
}

function check(number) {
	$.ajax({
		url:"inc/accept.php",
		type:"POST",
		data:{data:number},
		success:function() {
			console.log('Request Accepted');
		}
	});
}

function uncheck(number) {
	$.ajax({
		url:"inc/reject.php",
		type:"POST",
		data:{data:number},
		success:function() {
			alert('Request Rejected');
		}
	});
}

function cancel(number) {
	$.ajax({
		url:"inc/cancel.php",
		type:"POST",
		data:{data:number},
		success:function() {
			console.log('Request Canceled');
		}
	});
}



