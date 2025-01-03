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
    <?php
		if(!empty(session('error'))) {
			$msg = session('error');
			echo '<script>swal({
			title: "Fail!",
			text: "<strong>'.$msg.'</strong>",
			type: "error",
			html:true,
			button: "ok",
			});</script>';
	   }
	?>
	
    <?php
	    if(!empty(session('forget_status'))) {
			
	?>
	<div class="PasswordContainer">
	     <img src="<?=url('assets/home/Logo/Logo.png')?>" alt="Logo">
		 <form method="POST" action="<?=url('submitOTP')?>">
		 @csrf
	    <div class="OTPBlock" id="otpBlock" style="display:block">
            <div class="input-field">
                <label for="role">Enter OTP sent to your email</label>
                <div class="OTPContainer">
                    <!--<input type="text" class="OTPinput" maxlength="1" pattern="[0-9]*" inputmode="numeric"
                        oninput="moveToNext(this, 'otp2')" id="otp1">
                    <input type="text" class="OTPinput" maxlength="1" pattern="[0-9]*" inputmode="numeric"
                        oninput="moveToNext(this, 'otp3')" id="otp2">
                    <input type="text" class="OTPinput" maxlength="1" pattern="[0-9]*" inputmode="numeric"
                        oninput="moveToNext(this, 'otp4')" id="otp3">
                    <input type="text" class="OTPinput" maxlength="1" pattern="[0-9]*" inputmode="numeric"
                        oninput="moveToNext(this, 'otp5')" id="otp4">-->
						<input type="text" class="OTPinput" name="otp" maxlength="4" pattern="[0-9]*" inputmode="numeric">
						<input type="hidden" class="OTPinput" value="<?=(!empty(@$_GET['otpuserId']) ? @$_GET['otpuserId'] : '')?>" name="otpuserId">
                </div>
            </div>

            <button class="OTPSendBtn" type="submit">Submit</button>
        </div>
		
		</form>
    </div>
    <?php
        return false;
		}
	?>
   
    <div class="PasswordContainer">
        <img src="<?=url('assets/home/Logo/Logo.png')?>" alt="Logo">
        <h2>Forgot Password</h2>
		
		
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
	
		<form method="POST" action="<?=url('SentOTP')?>">
            @csrf
        <div class="input-field" id="emailField">
            <label for="role">Email</label>
            <input type="email" name="email" placeholder="Enter recovery email">
            <span class="icon fa fa-envelope"></span>
        </div>

        

        <!--<button class="OTPSendBtn" onclick="showOTPBlock()">Send</button>-->
        <button class="OTPSendBtn" type="submit">Send</button>
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