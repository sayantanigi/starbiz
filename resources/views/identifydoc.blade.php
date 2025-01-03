<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarBiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
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

        .DocumentContainer {
            display: none;
        }

        .DocumentContainer.active {
            display: block;
        }
    </style>
</head>

<body>

<?php
  if(!empty(session('status'))) {
	$msg = session('status');
	echo '<script>swal({
	title: "Success!",
	text: "<strong>'.$msg.'</strong>",
	type: "success",
	html:true,
	showConfirmButton: true
	});</script>';
 }
 
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
	    if(!empty(session('doc_status'))) {
			
	?>
	
	<div class="DocumentContainer DataComplete" id="submissionComplete" style="display:block;">
        <img src="<?=url('assets/home/images/CompleteIcon.png')?>" alt="Logo">
        <h2>Submission Complete</h2>
        <p>Waiting For Admin approval. You may preview the app as a guest until then.</p>
        <p>Thanks for submitting your document. We’ll verify it and activate your account as soon as possible. You will
            be notified via email.</p>
        <button type="button" class="SubmitBtn"><a href="<?=url('login')?>">Go to Login</a></button>
    </div>
    <?php
        return false;
		}
	?>
    <!-- Form Container -->
    <div class="DocumentContainer active" id="formContainer">
        <img src="<?=url('assets/home/Logo/Logo.png')?>" alt="Logo">
        <h2>Identification Document</h2>
		
		@if ($errors->any())
		<div class="alert alert-danger" style="color: #993838;
    background-color: #ffdfdf;
    border-color: #ffcece;
    position: relative;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;">
			   <ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
				</ul>
			
		</div>
	@endif
	
        <form action="<?=url('saveDocument')?>" method="Post" enctype="multipart/form-data">
		@csrf
            <div class="input-field">
                <label for="role">Document Type <span style="color:red;">*<span></label>
                <select id="role" name="documentType">
                    <option value="">Select document type</option>
                    <option value="Drivers' License">Drivers' License</option>
                    <option value="Passport">Passport</option>
                    <option value="Social Security">Social Security</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="input-field">
                <label for="role">Document Number <span style="color:red;">*<span></label>
                <input type="text" placeholder="Enter document number" name="documentNumber">
            </div>

            <div class="input-field">
                <label for="UploadFile">Upload Identification Document <span style="color:red;">*<span></label>
                <label for="UploadFile" class="CustomFileUpload">Choose File</label>
                <input type="file" class="UploadData" id="UploadFile" name="documentPhoto[]" accept="image/*"
                    onchange="updateFileName('UploadFile', 'photo-chosen1')">
                <span id="photo-chosen1" class="FileChosen">No file chosen</span>
            </div>

            <div class="input-field">
                <label for="role">Date of Birth <span style="color:red;">*<span></label>
                <input type="date" id="dob" name="dob">
            </div>

            <div class="input-field">
                <label for="role">Upload Profile Image <span style="color:red;">*<span></label>
                <label for="UploadPhoto" class="CustomFileUpload">Choose File</label>
                <input type="file" class="UploadData" id="UploadPhoto" name="profilePhoto" accept="image/*"
                    onchange="updateFileName('UploadPhoto', 'photo-chosen2')">
                <span id="photo-chosen2" class="FileChosen">No file chosen</span>
            </div>

            <button type="submit" class="SubmitBtn">Submit</button>

            <!--<a class="Link" href="SignUp.html">Back</a>-->
        </form>
    </div>

    <!-- Submission Complete Container -->
    <div class="DocumentContainer DataComplete" id="submissionComplete">
        <img src="../assets/images/CompleteIcon.png" alt="Logo">
        <h2>Submission Complete</h2>
        <p>Waiting For Admin approval. You may preview the app as a guest until then.</p>
        <p>Thanks for submitting your document. We’ll verify it and activate your account as soon as possible. You will
            be notified via email.</p>
        <button type="button" class="SubmitBtn"><a href="Login.html">Go to Login</a></button>
    </div>

    <script>
        function updateFileName(inputId, displayId) {
            const fileInput = document.getElementById(inputId);
            const fileChosen = document.getElementById(displayId);
            fileChosen.textContent = fileInput.files[0] ? fileInput.files[0].name : 'No file chosen';
        }

        function showSubmissionComplete(event) {
            event.preventDefault();
            document.getElementById("formContainer").classList.remove("active");
            document.getElementById("submissionComplete").classList.add("active");
        }
    </script>
</body>

</html>