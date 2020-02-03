<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
var SPINNER='<?php load_view('inc/spinner',array('size'=>30));?>';
var main=function(){

bootbox.alert({
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
 }, 2000);
 	
}
</script>
<section style="background-color: #2c3e50;min-height: 200px">
<form action="<?php D($formdata['url']);?>" method="post" style="display: none">
    <input name="amount" type="hidden" value="<?php D($formdata['amount_converted']);?>">
    <input name="currency_code" type="hidden" value="<?php D($formdata['currency_code']);?>">
    <input name="shipping" type="hidden" value="0.00">
    <input name="tax" type="hidden" value="0.00">
    <input name="return" type="hidden" value="<?php D($formdata['return_url']);?>">
    <input name="cancel_return" type="hidden" value="<?php D($formdata['cancel_url'])?>">
    <input name="notify_url" type="hidden" value="<?php D($formdata['notify_url']);?>">
    <input name="cmd" type="hidden" value="_xclick">
    <input name="business" type="hidden" value="<?php D(get_setting('paypal_email'))?>">
    <input name="item_name" type="hidden" value="<?php D($formdata['item_name']);?> - <?php D(get_setting('website_name'))?>">
    <input name="no_note" type="hidden" value="1">
    <input type="hidden" name="no_shipping" value="1">
    <input name="lc" type="hidden" value="EN">
    <input name="bn" type="hidden" value="PP-BuyNowBF">
    <input name="custom" type="hidden" value="<?php D($formdata['custom']);?>">
    <input type="submit" name="pay" value="Submit" id="pay">
    </form>	
</section>