<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$currency=priceSymbol();
$currencyCode=CurrencyCode();
$enable_paypal=get_setting('enable_paypal');
$enable_stripe=get_setting('enable_stripe');
$payfor=1;
$p=0;
$sub_total=0;
?>
<section class="section">
<div class="container">
	<div class="dashboard-box mt-0 mb-4">
			<div class="headline">
			<h3><i class="icon-material-outline-credit-card text-site"></i> Pay With - Stripe</h3>
			</div>
			<div class="content with-padding">					
                <button  class="btn btn-site mr-2" onclick="pay_stripe('card')"><i class="icon-material-outline-credit-card"></i> Card Payment</button>
                <button  class="btn btn-site mr-2" onclick="pay_stripe('ali')"><img src="<?php echo IMAGE;?>alipay.png" alt="Alipay" /> Ali Pay</button>
                <button  class="btn btn-site mr-2" onclick="pay_stripe('wechat')"><i class="icon-brand-weixin"></i> Wechat Pay</button>				
			</div>
			</div>	
</div>
</section>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
var stripe_key = "<?php echo get_setting('stripe_key')?>";
var stripe = Stripe(stripe_key);
function pay_stripe(ptype){
	var amount = parseInt(<?php D($formdata['amount_converted']);?>);
	if(isNaN(amount)){
		amount = 0;
	}
	if(amount == 0){
		return false;
	}
	$.post("<?php echo get_link('RequestPaymentStripe');?>", 
       {pay_for: "<?php D($formdata['pay_for'])?>", method: ptype}, function(data) {
        if (data["status"] == "OK") {
			if(ptype=='ali'){
				pay_stripe_ali(data["amount"],data["custom"]);
			}else if(ptype=='wechat'){
				pay_stripe_wechat(data["amount"],data["custom"]);
			}else if(ptype=='card'){
				paycard(data["amount"],data["custom"]);
			}else{
				paycard(data["amount"],data["custom"]);
			}
        } else {
			bootbox.alert({
				title:'Add Fund By Stripe',
				message: data["error"],
				buttons: {
				'ok': {
					label: 'Ok',
					className: 'd-none'
					}
				},
				callback: function(result){
					window.location.href='<?php D(get_link('AddFundURL'));?>';
				}
			});
        }
    },'json');
}
function paycard(amount,custom){
	event.preventDefault();
	handler = stripe_checkout(amount,custom);
	handler.open({
		image: '<?php echo LOGO;?>',
		locale: 'auto',
		name: "<?php echo get_setting('website_name')?>",
		description: "<?php D($formdata['item_name']);?> - <?php D(get_setting('website_name'))?>",
		amount: amount*100,
		email: '<?php D($formdata['member_email']);?>',
		currency:'<?php D($formdata['currency_code']);?>',
		alipay: true,
		bitcoin: true,
    });
}
function stripe_checkout(amount,custom) {
  var handler = StripeCheckout.configure({
    key: stripe_key,
    token: function(token) {
      // Send the charge through
      $.post("<?php echo get_link('MakePaymentStripe');?>",{token: token.id, amount: amount,'custom':custom,pay_for: "<?php D($formdata['pay_for'])?>"}, function(data) {
        if (data["status"] == "OK") {
          window.location.href="<?php echo get_link('AddFundURL').'?refer=paymentsuccess&method=stripe_card';?>";
        } else {
         	bootbox.alert({
				title:'Add Fund By Stripe',
				message: data["error"],
				buttons: {
				'ok': {
					label: 'Ok',
					className: 'd-none'
					}
				},
				callback: function(result){
					window.location.href='<?php D(get_link('AddFundURL'));?>';
				}
			});
        }
      },'json');
    }
  });
  return handler;
}
var main=function(){

/*bootbox.alert({
	title:'Add Fund By Paypal',
	message: '<div class="text-center">'+SPINNER+' Processing. Please wait...</div>',
	buttons: {
	'ok': {
		label: 'Ok',
		className: 'd-none'
		}
	},
	 "backdrop"  : "static",
});
window.setTimeout(function(){
	 $('#pay').click();
 }, 2000);*/
 	
}
</script>
