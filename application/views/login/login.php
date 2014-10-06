<div class="shadowbox">
	<div class="pure-u-1-3 login_dialog">
		<div class="pure-u-1 login_dialog_title">
			<span>Login / Register</span>
		</div>
		<div class="login_dialog_inner">
			Welcome, to proceed to "The Game" you have to login<br /><br />
			<form class="pure-form login_form" method="post">
				<input type="text" name="username" placeholder="Username" />
				<input type="password" name="password" placeholder="password" />&nbsp; &nbsp;
				<input type="submit" value="Login" class="login_submit pure-button pure-button-primary"/>

				<div class="login_error">
					Username and password combination not found.
				</div>
			</form>
		</div>
	</div>
</div>

<script src="assets/js/jQuery-sha1.js"></script>
<script>
	$(".login_form").on("submit",function(){
		$(".login_error").hide();

		username = $("input[name='username']").val();
		password = $.sha1($("input[name='password'").val());

		
		$.post("login/login_validate",{
			username: username,
			password: password,
		},function(data){
			console.log(data);
			if(data == 1){
				window.location = window.location;
			} else {
				$(".login_error").fadeIn(750);
			}
		});

		return false;
	});
</script>