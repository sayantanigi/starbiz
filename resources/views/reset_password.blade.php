<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarBiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="<?=url('assets/home/style/style.css')?>">
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

        .OTPBlock {
            display: none;
        }
    </style>
</head>

<body>
    
    <div class="PasswordContainer">
        <img src="<?=url('assets/home/Logo/Logo.png')?>" alt="Logo">
        <h2>Enter Password</h2>
		
		
			@if ($errors->any())
			<div class="alert alert-danger" style="color: #993838;
			background-color: #ffdfdf;
			border-color: #ffcece;
			position: relative;
			padding: 0.75rem 1.25rem;
			margin-bottom: 1rem;
			border: 1px solid transparent;
			border-radius: 0.25rem;">

			@foreach ($errors->all() as $error)
			{{ $error }}
			@endforeach

			</div>
			@endif
			
			@if (session('error'))
			<div class="alert alert-danger" style="color: #993838;
			background-color: #ffdfdf;
			border-color: #ffcece;
			position: relative;
			padding: 0.75rem 1.25rem;
			margin-bottom: 1rem;
			border: 1px solid transparent;
			border-radius: 0.25rem;">

			
			{{ session('error') }}
			

			</div>
			@endif
			
			
			@if (session('error'))
			<div class="alert alert-danger" style="color: #993838;
			background-color: #ffdfdf;
			border-color: #ffcece;
			position: relative;
			padding: 0.75rem 1.25rem;
			margin-bottom: 1rem;
			border: 1px solid transparent;
			border-radius: 0.25rem;">

			
			{{ session('error') }}
			

			</div>
			@endif
			
			@if (session('status'))
			<div class="alert alert-danger" style="color: black;
			background-color: #9cddd4;
			border-color: #9cddd4;
			position: relative;
			padding: 0.75rem 1.25rem;
			margin-bottom: 1rem;
			border: 1px solid transparent;
			border-radius: 0.25rem;">


			{{ session('status') }}


			</div>
			@endif
			
			
			
	
		<form method="POST" action="<?=url('savePassword')?>">
            @csrf
        <div class="input-field" id="emailField">
            <label for="role">Enter New Password</label>
            <input type="password" name="newPassword" placeholder="Enter New Password">
            <span class="icon fa fa-lock"></span>
			<input type="hidden" class="OTPinput" value="<?=(!empty(@$_GET['otpuserId']) ? @$_GET['otpuserId'] : '')?>" name="otpuserId">
        </div>

        

        <!--<button class="OTPSendBtn" onclick="showOTPBlock()">Send</button>-->
        <button class="OTPSendBtn" type="submit">Submit</button>
        </form>
        <div class="Bottomlink">
            Back to <a href="<?=url('login')?>">Sign In</a>
        </div>
    </div>
	

    <script>
        function moveToNext(current, nextFieldID) {
            if (current.value.length === 1) {
                document.getElementById(nextFieldID)?.focus();
            }
        }

        function showOTPBlock() {
            const button = document.querySelector(".OTPSendBtn");

            if (button.textContent === "Send") {
                document.getElementById("emailField").style.display = "none";
                document.getElementById("otpBlock").style.display = "block";
                button.textContent = "Verify";
            } else {
                window.location.href = "Login.html";
            }
        }
    </script>
</body>

</html>