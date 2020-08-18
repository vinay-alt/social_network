<div class="right_wrap">
	<div class="right">
		<div class="post_info">
			<form method="post" enctype="multipart/form-data">
				<h2>Let's Discuss Something :)</h2>
				<input type="text" name="title" autocomplete="off"  placeholder="Give a title" />
				<textarea name="desc" id="post_desc" placeholder="Say Something......."></textarea>
				<button type="submit" name="post">POST</button>
				<span id="selected"></span>
				<div class="img_select my_post_img"  id="img_post">
					<span onclick="document.getElementById('img_post').style.display='none'" id="exit">&times;</span>
					<h1>Choose a picture to post</h1>
					<input type="file" onchange="document.getElementById('selected').innerHTML=this.value.split('\\')[2];document.getElementById('img_post').style.display='none'" id="post" name="post_img" />
					<div onclick="document.getElementById('post').click()" class="choose_button">Choose a file</div>
				</div>
			</form>
			<button onclick="document.getElementById('img_post').style.display='block'" class="picture_button" style="color: rgba(0,0,0,0.8);background-color: #ccc; margin-left:1%;padding: 0.7% 1% 0.9% 1%;opacity: 0.7;position: absolute;bottom: 0;right: 0;">&#x1f5bc;</button>
			<?php
			if (isset($_POST['post'])) {
				insertpost();
			}
			?>
		</div>
		
	</div>
	<div class="right">
		<center><h3>Discussion</h3></center>
	</div>
	<div id="print_post">		
	</div>
</div>




