<div class="content">
<?php
if (!isset($_GET['login'])) {
?>	
	<div class="signup_div">
		<form  method="post" accept-charset="utf-8">
			<h2>Signup</h2>
			<div class="group">

				<label>Name</label><br />
				<input  type="text" name="u_name" placeholder="Enter your name">
			</div>
			<div class="group">

				<label>Email</label><br />
				<input id="email" onchange="v_email()" type="text" name="u_email" placeholder="Enter your email">
				<p id="noatsign">Email must contain @-sign</p>
			</div>
			<div class="group">

				<label>Password</label><br />
				<input id="pass" onchange="v_pass()" type="password" name="u_pass" placeholder="Enter your password">
				<p id="lessthan">Password must be atleast 8 characters long</p>
			</div>
			<div class="group">

				<label>Country</label><br />
				<select id="country" onchange="v_coun()" name="u_country">
					<option value="">Select</option>
					<option value="India">India</option>
					<option value="USA">USA</option>
					<option value="UK">UK</option>
					<option value="Japan">Japan</option>
					<option value="Russia">Russia</option>
				</select>
				<p id="nocoun">No country selected</p>
			</div>
			<div class="group">

				<label>Gender</label><br />
				<select id="gender" onchange="v_gen()" name="u_gender">
					<option value="">Select</option>
					<option value="Male">Male</option>
					<option value="Male">Female</option>
					<option value="Male">Other</option>
				</select>
				<p id="nogen">No Gender selected</p>
			</div>
			<div class="group">

				<label>Birthday</label><br />
				<input id="birth" onchange="v_birth()" type="date" name="u_birth" >
				<p id="dmsg">Invalid Birth date</p>
				<p id="dmsg">Invalid Birth date</p>
				<p id="dmsg">Invalid Birth date</p>
			</div>
			<button name="signup" type="submit">Signup</button>
			
		</form>
	</div>
<?php
} else {
?>
	<div class="login_div">
		<form method="post" accept-charset="utf-8">
			<h2>Login</h2>
			<div class="group">

				<label>Email</label><br />
				<input type="text" name="email" placeholder="Enter your name">
			</div>
			<div class="group">

				<label>Password</label><br />
				<input type="text" name="pass" placeholder="Enter your password">
			</div>
			
			<button type="submit" name="login">Login</button>
			<button type="button" class="gp">Login with google</button>
		</form>
	</div>
<?php
}
?>
</div>
<?php
if (isset($_POST['signup'])) {
	signup();
}

if (isset($_POST['login'])) {
	login();
}
?>