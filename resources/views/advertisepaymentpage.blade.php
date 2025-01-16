<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarBiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!--<link rel="stylesheet" href="../assets/style/style.css">-->
	<link rel="stylesheet" href="<?=url('assets/home/style/style.css')?>">
	
	<style>
	    /********************** Payment Details Style **********************/

		.PaymentDetails {
		  margin-top: 70px;
		}

		.PaymentDetails .TopSection {
		  display: flex;
		  flex-direction: column;
		  align-items: center;
		  justify-content: center;
		  background: #c5a668;
		  gap: 5px;
		  padding-top: 15px;
		  padding-bottom: 15px;
		  border-top-left-radius: 15px;
		  border-top-right-radius: 15px;
		  z-index: 10;
		}

		.PaymentDetails .TopSection h1 {
		  font-size: 30px;
		  font-weight: 600;
		  color: #fbfbfb;
		  margin: 0;
		}

		.PaymentDetails .TopSection p {
		  font-size: 16px;
		  margin: 0;
		  color: #fff;
		  opacity: 0.8;
		}

		.PaymentDetails .BottomSection {
		  padding-top: 15px;
		  padding-bottom: 15px;
		  background: #ffffff;
		  box-shadow: 0 0 10px #ddd;
		  border-bottom-left-radius: 15px;
		  border-bottom-right-radius: 15px;
		}

		.PaymentDetails .BottomSection .Block {
		  margin-bottom: 15px;
		}

		.PaymentDetails .BottomSection .Block label {
		  display: block;
		  text-align: left;
		  font-size: 14px;
		  margin-bottom: 5px;
		  color: #000000;
		  font-weight: 600;
		}

		.PaymentDetails .BottomSection .Block input {
		  font-size: 16px;
		  border: 1px solid #ddd;
		  border-radius: 10px;
		  outline: none;
		  background-color: #f5f5f5;
		  width: 100%;
		  height: 40px;
		  padding-left: 15px;
		  padding-right: 15px;
		}

		.PaymentDetails .BottomSection .PayNowBtnBlock {
		  align-items: center;
		  justify-content: center;
		  display: flex;
		}

		.PaymentDetails .BottomSection .PayNowBtn {
		  height: 40px;
		  background: #c5a668;
		  display: flex;
		  border-radius: 10px;
		  z-index: 100;
		  flex-direction: row;
		  align-items: center;
		  justify-content: center;
		  gap: 15px;
		  border: none;
		  padding-left: 15px;
		  padding-right: 15px;
		  font-size: 15px;
		  font-weight: 600;
		  color: #fff;
		}

		.PaymentDetails .BottomSection .PayNowBtn:hover {
		  background: linear-gradient(90deg, #b58b42, #7a5a28);
		}

		@media only screen and (max-width: 480px) {
		  .PaymentDetails {
			margin-top: 0;
		  }

		  .PaymentDetails .TopSection {
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		  }

		  .PaymentDetails .BottomSection {
			border-bottom-left-radius: 0;
			border-bottom-right-radius: 0;
		  }
		}
		
		#paymentResponse > p{

	color:red !important;

}
	</style>
</head>
<body>
    <section>
        <div class="container PaymentDetails">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 TopSection">
                    <h1>Total : $<?= @$newprice?></h1>
                    <p>Enter Payment Details</p>
					<p id="paymentResponse" style="text-align: center;color: red;"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 BottomSection">
                    <form action="{{url('dashboard/submitAdvertisepayment')}}" method="POST" id="paymentFrm">
					@csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 Block">
                                <label for="" class="form-label">NAME OF CARD HOLDER</label>
                                <input type="text" class="form-control"  name="card_name" id="card_name" placeholder="Name of Card Holder" value="<?=@$userInfo->first_name .' '. @$userInfo->last_name?>" required>
								
								<input type="hidden" name="user_id" id="user_id" value="<?=@$userInfo->id?>">
								<input type="hidden" name="sub_id" id="sub_id" value="<?=@$planInfo->id?>">
								<input type="hidden" name="amount" id="amount" value="<?=@$newprice?>">
								<input type="hidden" name="sub_name" id="sub_name" value="<?=@$planInfo->name?>">
								<input type="hidden" name="email" id="email" value="<?=@$userInfo->email?>">
								<input type="hidden" name="adsId" id="adsId" value="<?=@$adsId?>">
								<input type="hidden" name="preferredListing" id="preferredListing" value="<?=@$preferredListing?>">
								<input type="hidden" name="duration" id="duration" value="<?=@$duration?>">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 Block">
                                <label for="" class="form-label">ADDRESS</label>
                                <input type="text" class="form-control" name="card_address" id="card_address" placeholder="ADDRESS" value="<?=@$userInfo->address?>" required>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 Block">
                                <label for="" class="form-label">COUNTRY</label>
                                <input type="text" class="form-control" placeholder="COUNTRY"  name="card_country" id="card_country" value="<?=@$userInfo->country?>" required>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 Block">
                                <label for="" class="form-label">STATE</label>
                                <input type="text" class="form-control" placeholder="STATE" name="card_state" id="card_state" value="<?=@$userInfo->state?>" required>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 Block">
                                <label for="" class="form-label">CITY</label>
                                <input type="text" class="form-control" placeholder="CITY" name="card_city" id="card_city" value="<?=@$userInfo->city?>" required>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 Block">
                                <label for="" class="form-label">ZIPCODE</label>
                                <input type="text" class="form-control" placeholder="ZIPCODE" name="card_zipcode" id="card_zipcode" value="<?=@$userInfo->zipcode?>" required>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 Block">
                                <label for="" class="form-label">CARD NUMBER</label>
                                <!--<input type="text" class="form-control">-->
								<div id="card_number" class="field form-control"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 Block">
                                <label for="" class="form-label">EXPIRY DATE</label>
                                <!--<input type="text" class="form-control">-->
								<div id="card_expiry" class="field form-control"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 Block">
                                <label for="" class="form-label">CVC</label>
                                <!--<input type="text" class="form-control">-->
								<div id="card_cvc" class="field form-control"></div>
                            </div> 
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 PayNowBtnBlock">
                            <button type="submit" class="btn btn-primary PayNowBtn">Pay Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
	
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

</body>
</html>