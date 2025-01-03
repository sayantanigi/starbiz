<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>StarBiz</title>
	<link rel="shortcut icon" href="https://techb.igiapp.com/starbiz/setting/2019685580.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
	<link rel="stylesheet" href="<?=url('assets/home/style/style.css')?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<style>
	body,
	html {
		height: 100vh;
		margin: 0;
		display: flex;
		align-items: center;
		justify-content: center;
		background: url(https://img.freepik.com/free-photo/people-concert_1160-737.jpg?t=st=1730050734~exp=1730054334~hmac=4785251…&w=900) no-repeat center center / cover;
		font-family: Arial, sans-serif;
		width: 100vw;
	}
	</style>
</head>
<body>

  <div class="login-card">
    <!-- Logo and Sign In title -->
     <img src="<?=url('assets/home/Logo/Logo.png')?>" alt="Logo">
    <h2>Sign In</h2>
	
    @if ($errors->any())
		<div class="alert alert-danger" style="color: #993838;background-color: #ffdfdf;border-color: #ffcece;position: relative;padding: 0.75rem 1.25rem;margin-bottom: 1rem;border: 1px solid transparent;border-radius: 0.25rem;">
			@foreach ($errors->all() as $error)
				{{ $error }}
			@endforeach
		</div>
	@endif
	
	<form action="<?=url('submitLogin')?>" method="POST">
	    @csrf
		<!-- Email Input -->
		<div class="input-field">
			<label for="role">Email</label>
			<input type="email" placeholder="Enter email" name="email" id="email">
			<span class="icon fa fa-envelope"></span>
		</div>

		<!-- Password Input -->
		<div class="input-field">
			<label for="role">Password</label>
			<input type="password" placeholder="Enter password" name="password" id="password">
			<!--<span class="icon fa fa-lock"></span>-->
			<span class="icon fa fa-eye toggle-password"></span>
		</div>

		<!-- Forgot Password -->
		<a href="<?=url('forgetpassword')?>"><div class="forgot-password">Forgot Password?</div></a>
		<!-- Login Button -->
		<button class="login-button" type="submit">Log In</button>
    </form>
    <!-- Signup Link -->
    <div class="signup-link">
      Don’t have an account yet? <a href="<?=url('register')?>">Sign Up</a> 
    </div>
  </div>
	<script>
		$(document).on('click', '.toggle-password', function() {
		    $(this).toggleClass("fa-eye fa-eye-slash");
		    var input = $("#password");
		    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password');
		});
	</script>
</body>
</html>
