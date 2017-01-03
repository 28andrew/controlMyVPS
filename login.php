<body class="hold-transition login-page">
	<style>
		#error{
			padding: 3%;
		}
	</style>
	<script>
		document.title = "Login - <?=$CONFIG['name']?>";
	</script>
	<?php
		$submitted = isset($_POST['submit']);
		$error = "";
		if($submitted){
			if(!isset($_POST['email'])){
				$error = "Please specify your email";
			}else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$error = "An invalid email has been specified";
			}else if (!isset($_POST['password'])){
				$error = "Please specify your password";
			}
		}

		if ($error == "" && $submitted){
			//var_dump($error == ""/* && submitted*/);
			$email = $_POST['email'];
			$password = $_POST['password'];
			//Try to get row from database
			$connection = connection();
			try{
				$stmt = $connection->prepare('SELECT password FROM users WHERE email = ?');
				$stmt->execute([$email]);
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if (isset($row['password'])){
					if (password_verify($password, $row['password'])){
						$_SESSION['logintoken'] = bin2hex(random_bytes(35));
						$expire = time() + (86400 * 30);
						$stmt = $connection->prepare('INSERT INTO `logins`(`token`, `email`, `expire`, `address`) VALUES (:token,:email,:expire,:address) ON DUPLICATE KEY UPDATE token=:token, email=:email, expire=:expire, address=:address');
						try{
							//array('token' => $_SESSION['logintoken'], 'email' => $email, 'expire', time() + (86400 * 30) /* 30 DAYS */)
							$stmt->bindValue('token', $_SESSION['logintoken']);
							$stmt->bindValue('email', $email);
							$stmt->bindValue('expire', $expire /* 30 DAYS */);
							$stmt->bindValue('address', $_SERVER['REMOTE_ADDR']);
							$stmt->execute();
							setcookie("login_token", $_SESSION['logintoken'], $expire, "/");
							//Refresh
							header("Refresh:0");
						}catch(PDOException $e){
							$error = "Unknown database error while setting login token";
							throw $e;
						}
					}else{
						$error = "Email or password is incorrect.";
					}
				}else{
					$error = "Email or password is incorrect.";
				}

			}catch(PDOException $e){
				$error = "Unknown database error";
				throw $e;
			}
		}
	?>
	<div class="login-box">
		<div class="login-logo">
			<a href="/"><?=$CONFIG['html_name']?></a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Sign in to start your session</p>
			<form method="post">
				<div class="form-group has-feedback">
					<input type="email" name="email" class="form-control" placeholder="Email" id="email">
					<span class="glyphicon glyphicon-envelope form-control-feedback" id="email-span"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="password" class="form-control" placeholder="Password" id="password">
					<span class="glyphicon glyphicon-lock form-control-feedback" id="password-span"></span>
				</div>
				<?php
					if ($error != ""){
						?>
						<div class="alert alert-danger" role="alert" id="error">
  						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  						<span class="sr-only">Error:</span>
  						<?=$error?>
						</div>
						<?php
					}
				 ?>
				<div class="row">
					<!--div class="col-xs-8">
						<div class="checkbox icheck">
							<label>
								<input type="checkbox"> Remember Me
							</label>
						</div>
					</div-->
					<!-- /.col -->
					<div class="col-xs-offset-8 col-xs-4">
						<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
			<!--div class="social-auth-links text-center">
				<p>- OR -</p>
				<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
				Facebook</a>
				<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
				Google+</a>
			</div-->
			<!-- /.social-auth-links -->
			<a href="#">I forgot my password</a><br>
			<!--a href="register.html" class="text-center">Register a new membership</a-->
		</div>
		<!-- /.login-box-body -->
	</div>
	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' // optional
		});
	  });
	</script>
	<script>
		$.fn.hasAttr = function(name) {
	   return this.attr(name) !== undefined;
		};
		//Script to disable glyph icons on email/password input boxes if a chrome/browser extension is setting a stlye (e.g LastPass)
		var interval = null;
		$(document).ready(function(){
			console.log('Starting Glyph Icon interference check');
			interval = setInterval(check,100);
		});
		var i = 0;
		function check(){
			if($("#email").hasAttr('style')){
				console.log('Removing Glyph Icons on Input Boxes because style changing (e.g LastPass) has been detected on the input boxes.');
				clearInterval(interval);
				$("#email-span").removeClass("glyphicon glyphicon-envelope");
				$("#password-span").removeClass("glyphicon glyphicon-lock");
			}else{
				i++;
				if (i > 6){
					clearInterval(interval);
					//console.log('Cancelled Input Box Style Checking');
				}
			}
		}
	</script>
</body>
