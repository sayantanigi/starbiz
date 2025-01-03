
$(document).ready(function() {
    validation();
    //$('.note-editable').css({'font-size':'15px','font-family':'inherit'});
});

function validation() {
    $.validate({
        modules : 'security, file, html5',
        onModulesLoaded : function() {
            var optionalConfig = {
                fontSize: '10pt',
                padding: '3px',
                bad : 'Very bad',
                weak : 'Weak',
                good : 'Good',
                strong : 'Strong',
                width : '100%'
            };
            $('input[type="password"].validate_password').displayPasswordStrength(optionalConfig);
        }
    });
}

function alert_response(data,redirectURL) {

	//swal({title: data[0], type: data[1], confirmButtonColor: data[2]});
    setTimeout(function() {
	    swal({
	        title: data[0],
	        type: data[1],
	        confirmButtonColor: data[2]
	    }, function() {
	        window.location = redirectURL;
	    });
	 }, 300);    
}

function alert_func(data) {
	swal({title: data[0], type: data[1], confirmButtonColor: data[2]});
}

function strcmp(a, b) {
    if (a.toString() != b.toString()) return -1;
    if (a.toString() == b.toString()) return 1;
    return 0;
}

var owl = $('#dealslide');
owl.owlCarousel({
     loop:true,
     margin:10,
     nav:true,
     dots:false,
      navText:["<div class='nav-btn prev-slide'><i class='fa fa-chevron-left'></i></div>","<div class='nav-btn next-slide'><i class='fa fa-chevron-right'></i></div>"],
     responsive:{
         0:{
             items:1
         },
         600:{
             items:1
         },
         1000:{
             items:1
         }
     }
})

//Initializing summernote editor
$(".summernote").summernote({
  height: 120,
  minHeight: null,
  maxHeight: null,
  focus: false,
  codemirror: {
     theme: 'default'
  },
   toolbar: [
      //['style', ['style']],
      //['font', [/*'bold',*/ 'italic', 'underline', /*'clear'*/]],
      //['fontname', ['fontname']],
      //['color', ['color']],
      ['para', ['ul',/*'ol', 'paragraph'*/]],
      //['height', ['height']],
      //['table', ['table']],
      //['insert', ['link', 'picture', 'hr']],
      //['view', [/*'fullscreen',*/ 'codeview']],
      //['help', ['help']]
    ],
    callbacks: {
      onKeyup: function(e) {
        var editor_id = $(this).attr('id');
        var markupStr = $(this).summernote('code');

        //Force appending ul on editor
        $(this).html('<ul><li><br></li></ul>');
        //Checking current summernote id
        if(editor_id == "deal"){
           showDealDesc(); 
        }
        var compareEmptyContent =strcmp(markupStr,'<div><br></div>');

        if(compareEmptyContent == 1 || markupStr.startsWith("<div><font") || markupStr.endsWith("<br></font></div>")){
            $(this).summernote('code','<ul><li><br></li></ul>');
        }
      },
       onInit: function() {
          $(".note-editable").on('click', function (e) {
              var editorContent = $(this).html();
              var compareEmptyContent =strcmp(editorContent,'<p><br></p>');

              if(compareEmptyContent == 1){
                 $(this).html('<ul><li><br></li></ul>');
              }
          });
       },
       onPaste: function (e) {
        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
        
        e.preventDefault();
        document.execCommand('insertText', false, bufferText);
    }
     
    }
 });

//  $('.summernote').on('summernote.paste', function(e) {
//      e.preventDefault();
//      var currentContent = $(this).summernote('code');

//      $(this).summernote('code',currentContent);
//      var errorRspnsArr = ["Paste feature is disabled; Please write your content manually!",'error','#DD6B55'];
//      alert_func(errorRspnsArr);
//      return false;
// });

//Initializing multiple image uploader   
$('.input-images').imageUploader({
    //preloaded: dealImagepreloaded
});


