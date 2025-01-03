@include('admin.header');
@include('admin.sidebar'); 
<style>
small > p{
  color:red;
}
small{
  color:red;
}
p strong{
	font-weight: 600 !important;
	color: black !important;
}
.sa-confirm-button-container button{
	background-color: #146c43 !important;
	border-color: #146c43 !important;
}

 </style>
 <div class="main-content">
   <div class="page-content">
      <div class="container-fluid">  
       <section class="bg-light-gray">
        <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0"><?= $title ?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?=url('dashboard')?>">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                    </div>

                </div>
            </div>
           </div>

            <div class="row">

                <div class="col-lg-6 mb-3">
                  <div class="card shadow rounded">
                     <div class="card-body">    
                        
						
							<?php if($button=='Update'){?>
							    <form  action="<?= url('admin/emailtemplate/update_action')?>" method="post" enctype="multipart/form-data" >
							<?php }else {?>
							    <form  action="<?= url('admin/emailtemplate/create_action')?>" method="post" enctype="multipart/form-data" >
							<?php }?>
							 @csrf
                            <div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Subject</label>
                                <input type="text" class="form-control" name="subject" value="<?= @$subject?>" required autocomplete="off">
                            </div>
							<small id="question_error"></small>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Body</label>
                                <textarea type="text" class="form-control editor summermote" name="body" required  autocomplete="off"><?= @$body?></textarea>
                            </div>
							<small id="answer_error"></small>
							
							 <div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Choose File</label>
                                <input type="file" class="form-control"  name="attachment" >
                            </div>
							
							<?php if(!empty($attachment)){?>
							<p><i class="fas fa-paperclip"></i><a href="<?=url('email/'.$attachment.'')?>"><?= @$attachment?></a></p>
							<?php }?>
							<input type="hidden" name="old_attachment" value="<?= @$attachment?>">
							</div>
							<input type="hidden" name="id" value="<?= @$id?>">
							
                            <div class="form-group mt-3 mb-2">
                                <button class="btn btn-success text-uppercase px-5 shadow">Submit</button>
                                <a class="btn btn-danger waves-effect waves-light m-l-30" href="javascript:history.go(-1)">Back</a>
                            </div>
                        </form>
                     </div>
                  </div>      
                </div>
            </div>
        </div>
     </section>
   </div>
 </div>


 <script>
$(document).ready(function(){
	$("#submitform").on('submit', function(e){
		e.preventDefault();

		$.ajax({
		type: 'POST',
		url: '<?php echo url('admin/faq/addfaq'); ?>',
		data: new FormData(this),
		dataType:"json",
		contentType: false,
		cache: false,
		processData:false,
		error:function(){
		  $('#uploadsuccessfully').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
		},
		success: function(data){
			if(data.status == 1){
				swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				
			}
			
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.message+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
			
			if(data.vali_error == 1){
				if(data.question_error != ''){
					$('#question_error').html(data.question_error);
				}else{
					$('#question_error').html('');
				}
				
				if(data.answer_error != ''){
					$('#answer_error').html(data.answer_error);
				}else{
					$('#answer_error').html('');
				}
				
				if(data.status_error != ''){
					$('#status_error').html(data.status_error);
				}else{
					$('#status_error').html('');
				}
				
			}
		}
		});
	});

});
$(document).ready(function() {
	$('.editor').summernote({
		placeholder: '',
		height: 200
	});
});
</script>
@include('admin.footer');