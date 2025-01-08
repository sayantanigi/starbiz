<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<style>
body[data-topbar=dark] .app-search .form-control {
    background-color: #2d2d2d !important;
    color: #fff !important;
	border: none !important;
}
.listar-content{
    background: #f2f2f2; 
    padding: 20px;
    border: 1px solid #ccc;
}
.listar-content .form-control{
    border-radius: 0px;
    border: 1px solid #ccc;
    min-height: 44px;
}
.listar-content h2{
    font-size: 24px;
    font-weight: 700;
    text-align: center;
    padding-top: 10px;
}
.topsecure{
    width: 100%;
    text-align: center;
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
}

#loader{
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 999;
    background: #ffffffd4;
    text-align: center;
}
#loader span{
    width: 300px;
    height: 150px;
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    top: 0;
    bottom: 0;
}
#loader h6 {
    font-weight: 500;
    margin: 10px 0 0;
    font-size: 17px;
    color: #666;
}
#loader img{
    height: 100px;
}
#paymentResponse > p{
	color:red !important;
}




/* WRAPPERS */
#wrapper {
	width: 100% !important;
	overflow-x: hidden !important;
}

.wrapper {
    padding: 0 20px !important;
}

.wrapper-content {
    padding: 20px 10px 40px !important;
}

#page-wrapper {
	padding: 0 15px !important;
	min-height: 568px !important;
	position: relative !important;
}

@media (min-width: 768px) {
	#page-wrapper {
		position: inherit !important;
		margin: 0 0 0 240px !important;
		min-height: 2002px !important;
	}
}

/* Payments */
.payment-card {
	background: #ffffff !important;
	padding: 20px !important;
	margin-bottom: 25px !important;
	border: 1px solid #e7eaec !important;
}

.payment-icon-big {
	font-size: 60px !important;
	color: #d1dade !important;
}

.payments-method.panel-group .panel + .panel {
    margin-top: -1px !important;
}

.payments-method .panel-heading {
    padding: 15px !important;
}

.payments-method .panel {
    border-radius: 0 !important;
}

.payments-method .panel-heading h5 {
    margin-bottom: 5px !important;
}

.payments-method .panel-heading i {
    font-size: 26px !important;
}

.payment-icon-big {
	font-size: 60px !important;
	color: #d1dade !important;
}

.form-control,
.single-line {
	background-color: #FFFFFF !important;
	background-image: none !important;
	border: 1px solid #e5e6e7 !important;
	border-radius: 1px !important;
	color: inherit !important;
	display: block !important;
	padding: 6px 12px !important;
	transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s !important;
	width: 100% !important;
	font-size: 14px !important;
}

.text-navy {
    color: #1ab394 !important;
}

.text-success {
    color: #1c84c6 !important;
}

.text-warning {
    color: #f8ac59 !important;
}

.ibox {
    clear: both !important;
	margin-bottom: 25px !important;
	margin-top: 0 !important;
	padding: 0 !important;
}

.ibox.collapsed .ibox-content {
    display: none !important;
}

.ibox.collapsed .fa.fa-chevron-up:before {
    content: "\f078" !important;
}

.ibox.collapsed .fa.fa-chevron-down:before {
    content: "\f077" !important;
}

.ibox:after,
.ibox:before {
    display: table !important;
}

.ibox-title {
	-moz-border-bottom-colors: none !important;
	-moz-border-left-colors: none !important;
	-moz-border-right-colors: none !important;
	-moz-border-top-colors: none !important;
	background-color: #ffffff !important;
	border-color: #e7eaec !important;
	border-image: none !important;
	border-style: solid solid none !important;
	border-width: 3px 0 0 !important;
	color: inherit !important;
	margin-bottom: 0 !important;
	padding: 14px 15px 7px !important;
	min-height: 48px !important;
}

.ibox-content {
	background-color: #ffffff !important;
	color: inherit !important;
	padding: 15px 20px 20px 20px !important;
	border-color: #e7eaec !important;
	border-image: none !important;
	border-style: solid solid none !important;
	border-width: 1px 0 !important;
}

.ibox-footer {
	color: inherit !important;
	border-top: 1px solid #e7eaec !important;
	font-size: 90% !important;
	background: #ffffff !important;
	padding: 10px 15px !important;
}

.text-danger {
    color: #ed5565 !important;
}

.exvent-hero-section{
    top :-21px !important;
}

.text-navy_1 > ul{
    list-style: unset !important;
}

</style>
<div id="loader" style="display: none;">  
    <span>
        <img src="<?=url('uploads/loder.gif')?>">
        <h6>Please do not refresh</h6>
    </span>
</div>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">



  	
                        <div class="">
							<div class="py-5">	
								<div class="container">
									<div class="wrapper wrapper-content animated fadeInRight">
										<div class="row">
											<div class="col-lg-12">
												<div class="ibox">
													<div class="ibox-title"> 
													<div class="text-center">
														<h3 class="font-weight-bold text-success  mt-4 mb-2">
															Total : $ <?= @$newprice?>
														</h3>
													</div>
													<h3 style="text-align:center;">Enter Payment Details </h3>
													<p id="paymentResponse" style="text-align: center;color: red;"></p>
													</div>
													<div class="ibox-content">
														<div class="panel-group payments-method" id="accordion">
															<div class="panel panel-default">
																<div class="panel-heading">
																	<div class="pull-right">
																		<i class="fa fa-cc-amex text-success"></i>
																		<i class="fa fa-cc-mastercard text-warning"></i>
																		<i class="fa fa-cc-discover text-danger"></i>
																	</div>
																	<h5 class="panel-title">
																		<!--<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Credit Card</a>-->
																	</h5>
																</div>
																<div id="collapseTwo_1" class="panel-collapse_1 collapse_1 in_1">
																	<div class="panel-body">

																		<div class="row">
																			<div class="col-md-5">
																				
																			</div>
																			<div class="col-md-12">

																				<form action="{{url('webview/submit_advertisement_payment')}}" method="POST" id="paymentFrm">
																				    @csrf
																					<div class="row">
																						<div class="col-xs-12">
																							<div class="form-group">
																								<label class="fw-semibold">NAME OF CARD HOLDER</label>
																								<input type="text" class="form-control" name="card_name" id="card_name" placeholder="Name of Card Holder" value="<?=@$userInfo->first_name .' '. @$userInfo->last_name?>" required>
																								
																								<input type="hidden" name="user_id" id="user_id" value="<?=@$userInfo->id?>">
																								<input type="hidden" name="sub_id" id="sub_id" value="<?=@$planInfo->id?>">
																								<input type="hidden" name="amount" id="amount" value="<?=@$newprice?>">
																								<input type="hidden" name="sub_name" id="sub_name" value="<?=@$planInfo->name?>">
																								<input type="hidden" name="email" id="email" value="<?=@$userInfo->email?>">
																								<input type="hidden" name="adsId" id="adsId" value="<?=@$adsId?>">
																								<input type="hidden" name="preferredListing" id="preferredListing" value="<?=@$preferredListing?>">
																								<input type="hidden" name="duration" id="duration" value="<?=@$duration?>">
																								
																								<input type="hidden" name="network_user_id" id="network_user_id" value="<?=@$networkUserId?>">
																							</div>
																						</div>
																					</div><br>
																					
																					<div class="row">
																						<div class="col-xs-12">
																							<div class="form-group">
																								<label class="fw-semibold">ADDRESS</label>
																								<input type="text" class="form-control" name="card_address" id="card_address" placeholder="Full Address" value="<?=@$userInfo->address?>" required>
																							</div>
																						</div>
																					</div><br>
																					
																					<div class="row">
																						<div class="col-xs-4 col-md-4">
																							<div class="form-group">
																								<label class="fw-semibold">COUNTRY</label>
																								<input type="text" class="form-control" placeholder="Country" name="card_country" id="card_country" value="<?=@$userInfo->country?>" required>
																							</div>
																						</div>
																						<div class="col-xs-4 col-md-4 pull-right">
																							<div class="form-group">
																								<label class="fw-semibold">STATE</label>
																								<input type="text" class="form-control" placeholder="State" name="card_state" id="card_state" value="<?=@$userInfo->state?>" required>
																							</div>
																						</div>
																						
																						<div class="col-xs-4 col-md-4 pull-right">
																							<div class="form-group">
																								<label class="fw-semibold">CITY</label>
																								<input type="text" class="form-control" placeholder="City" name="card_city" id="card_city" value="<?=@$userInfo->city?>" required>
																							</div>
																						</div>
																					</div><br>
																					
																					<div class="row">
																						<div class="col-xs-12">
																							<div class="form-group">
																								<label class="fw-semibold">ZIPCODE</label>
																								<input type="text" class="form-control" placeholder="Zipcode" name="card_zipcode" id="card_zipcode" value="<?=@$userInfo->zipcode?>" required>
																							</div>
																						</div>
																					</div><br>
																					
																					
																					<div class="row">
																						<div class="col-xs-12">
																							<div class="form-group">
																							<label>CARD NUMBER</label>
																							<div id="card_number" class="field form-control"></div>
																							</div>
																						</div>
																					</div><br>
																					
																					<div class="row">
																					
																						<div class="col-xs-4 col-md-4">
																							<div class="left">
																								<div class="form-group">
																									<label>EXPIRY DATE</label>
																									<div id="card_expiry" class="field form-control"></div>
																								</div>
																							</div>
																						</div>

																						<div class="col-xs-4 col-md-4 pull-right">
																							<div class="right">
																								<div class="form-group">
																									<label>CVC CODE</label>
																									<div id="card_cvc" class="field form-control"></div>
																								</div>
																							</div>
																						</div>
																						
																						</div><br>
																					
																					
																					
																					<div class="col-md-12">
																						<div class="form-group text-center">
																							<button type="submit" class="btn btn-warning" id="payBtn">Pay Now</button>
																						</div>
																					</div>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                


<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('<?=STRIPE_PUBLISHABLE_KEY;?>');

    var elements = stripe.elements();

    var style = {
        base: {
            fontWeight: 400,
            fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
            fontSize: '16px',
            lineHeight: '1.4',
            color: '#555',
            backgroundColor: '#fff',
            '::placeholder': {
                color: '#888',
            },
        },
        invalid: {
            color: '#eb1c26',
        }
    };

    var cardElement = elements.create('cardNumber', {
        style: style,
        placeholder: 'xxxx xxxx xxxx xxxx'
    });
    cardElement.mount('#card_number');

    var exp = elements.create('cardExpiry', {
        'style': style
    });
    exp.mount('#card_expiry');

    var cvc = elements.create('cardCvc', {
        'style': style
    });
    cvc.mount('#card_cvc');


    var resultContainer = document.getElementById('paymentResponse');
    cardElement.addEventListener('change', function(event) {
        if (event.error) {
			console.log(event.error)
            resultContainer.innerHTML = '<p>' + event.error.message + '</p>';
        } else {
            resultContainer.innerHTML = '';
        }
    });


    var form = document.getElementById('paymentFrm');


    form.addEventListener('submit', function(e) {
        e.preventDefault();
        createToken();        
    });


    function createToken() {
        stripe.createToken(cardElement).then(function(result) {
            if (result.error) {

                resultContainer.innerHTML = '<p>' + result.error.message + '</p>';
            } else {

                stripeTokenHandler(result.token);
            }
        });
    }

    function stripeTokenHandler(token) {
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
        $("#loader").css('display', 'block');
    }
	
	
	$(document).on('change','#payment_in',function(e){
	var payment_in = $(this).val();
	console.log(payment_in)
	if(payment_in == 'Part Payment'){
		$("#card_amount").prop('disabled', false);
	}else{
		var amount = '';
		$("#card_amount_1").val(amount);
		$("#card_amount").val(amount);
		$("#card_amount").prop('disabled', true);
	}
});

$(document).on('keyup','#card_amount',function(e){
        var card_amount = $(this).val();
        if(card_amount){
          $("#card_amount_1").val(card_amount);
        }else{
          $("#card_amount_1").val('');
        }
    });
</script>
