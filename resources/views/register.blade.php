<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarBiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
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
<?php
if (!empty(session('status'))) {
    $msg = session('status');
    echo '<script>swal({title: "Success!", text: "<strong>' . $msg . '</strong>", type: "success", html:true, showConfirmButton: true});</script>';
}

if (!empty(session('error'))) {
    $msg = session('error');
    echo '<script>swal({title: "Fail!", text: "<strong>' . $msg . '</strong>", type: "error", html:true, button: "ok"});</script>';
}
?>
<div class="form-container">
    <div class="logo">
        <img src="Logo.png" alt="Starbiz Logo">
    </div>
    <h1>Create Your Account</h1>
    @if ($errors->any())
    <div class="alert alert-danger"
        style="color: #993838;background-color: #ffdfdf;border-color: #ffcece;position: relative;padding: 0.75rem 1.25rem;margin-bottom: 1rem;border: 1px solid transparent;border-radius: 0.25rem;">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
    @endif
    <!-- Form fields -->
    <form action="<?=url('saveRegister')?>" method="POST">
        @csrf
        <div class="input-field">
            <label for="name">First Name</label>
            <input type="text" name="fname" id="fname" placeholder="Enter First Name" required>
        </div>

        <div class="input-field">
            <label for="name">Last Name</label>
            <input type="text" name="lname" id="lname" placeholder="Last Name" required>
        </div>
        <div class="input-field">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter email" required>
            <span class="icon fa fa-envelope"></span>
        </div>
        <div class="input-field">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required>
            <span class="icon fa fa-eye toggle-password"></span>
        </div>
        <div class="input-field">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password"
                placeholder="Enter confirm password" required>
            <span class="icon fa fa-eye toggle-password1"></span>
        </div>
        <div class="input-field">
            <label for="role">Join as a</label>
            <select name="user_type" id="user_type" required="">
                <option value="3">Service Provider</option>
            </select>
        </div>
        <div class="input-field">
            <label for="email">Referral Code</label>
            <input type="text" name="referral_code" id="referral_code" placeholder="Enter Referral Code">
        </div>
        <button type="submit" class="signup-button"> Sign Up</button>
    </form>
    <div class="signin-link">
        Already have an account? <a href="<?=url('login')?>">Sign In</a>
    </div>
</div>
<script>
$(document).on('click', '.toggle-password', function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});

$(document).on('click', '.toggle-password1', function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#confirm_password");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});
</script>
</body>
</html>