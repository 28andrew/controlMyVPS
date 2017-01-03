<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	$root = $_SERVER['DOCUMENT_ROOT'];
	$core = $root . "/core/";

	require_once($root . '/config.defaults.php');
	require_once($root . '/config.php');

	require_once($core . 'mysql.php');

	$login = false;

	$token = null;
	$email = null;
	$display_name = null;

	if ($needs_login){



		if(isset($_COOKIE['login_token'])){
			$connection = connection();

			$token = $_COOKIE['login_token'];

			$stmt = $connection->prepare('SELECT * FROM `logins` where token=?');
			try{
				$stmt->execute([$token]);
			}catch(PDOException $e){
				throw $e;
			}

			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if(isset($row)){
				$email = $row['email'];
				$expire = $row['expire'];
				if (time() >= $expire){
					//EXPIRED
					try{
						$connection->prepare('DELETE from `logins` where token=?')->execute([$token]);
					}catch(PDOException $e){
						throw $e;
					}
					$login = true;
				}else{
					//Not Expired, everything OK ----------------------------------------
					$stmt = $connection->prepare('SELECT * from `users` where email=?');
					try{
						$stmt->execute([$email]);
					}catch(PDOException $e){
						throw $e;
					}
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					$display_name = $row['display'];
					//-------------------------------------------------------------------
				}
			}else{
				//Invalid token
				header("HTTP/1.1 401 Unauthorized");
				$login = true;
			}


		}else{
			//Login page
			$login = true;
		}
		$email_first = explode("@", $email)[0];
	}
	if ($title === true){
		$title = $CONFIG['name'];
	}
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?=$title?></title>

<!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/AdminLTE/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="/AdminLTE/dist/css/skins/skin-blue.min.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php
	if ($login){
		require('login.php');
		exit();
	}
 ?>
