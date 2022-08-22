<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
$currency=priceSymbol();
?>

<div id="dataStep-2" style="display: none">
  <div class="dashboard-box"> 
    <!-- Headline -->
    <div class="headline">
      <h4><?php echo __('postproposal_budget','Budget');?>  </h4>
    </div>
    <div class="content with-padding">
      <div class="submit-field myradio">
        <label class="form-label"><?php echo __('postproposal_how_pay','How would you like to sell service ?');?></label>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group"><!-- data-toggle="buttons" for active -->          
            <input type="radio" class="btn-check proposal_payment_type" id="defaultInlineHourly" name="proposalPaymentType" value="package" autocomplete="off" <?php if($proposalData && $proposalData['proposal_settings']->is_package==1){echo "checked";}?>>
            <label for="defaultInlineHourly" class="btn <?php if($proposalData && $proposalData['proposal_settings']->is_package==1){echo "active";}?>"><i class="icon-feather-package"></i><br><?php echo __('postproposal_package','Package');?> </label>            
          
            <input type="radio" class="btn-check proposal_payment_type" id="defaultInlineFixed" name="proposalPaymentType" value="fixed" autocomplete="off" <?php if($proposalData && $proposalData['proposal_settings']->is_package!=1){echo "checked";}?>>
            <label for="defaultInlineFixed" class="btn <?php if($proposalData && $proposalData['proposal_settings']->is_package!=1){echo "active";}?>"><i class="icon-feather-tag"></i><br><?php echo __('postproposal_fixed','Fixed');?> </label>
        </div>
        <div class="clearfix"></div>
        <span id="proposalPaymentTypeError" class="rerror"></span> 
    </div>

<?php
if($proposalData){
  $packages=array();
  foreach($proposalData['proposal_packages'] as $p=>$package){
    $packages[$package->package_type]=$package;
  }
}
?>
    <div class="row">
      <div class="basic_package col-md-4 col-12" <?php if($proposalData){}else{?>style="display: none" <?php }?>>
        <div class="section-package">
          <h4>Basic</h4>
          <div>
            <div class="form-group">
              <label class="form-label">Name: </label>
              <input name="package_name_basic" id="package_name_basic" class="form-control" type="text" value="<?php if($proposalData && $packages && array_key_exists('B',$packages)){echo $packages['B']->package_name;}?>">
              <span id="package_name_basicError" class="rerror"></span>
            </div>
            <div class="form-group">
              <label class="form-label">Description: </label>
              <textarea name="package_desc_basic" id="package_desc_basic" class="form-control" rows="5"><?php if($proposalData && $packages && array_key_exists('B',$packages)){echo ($packages['B']->description);}?></textarea>
              <span id="package_desc_basicError" class="rerror"></span>
            </div>
          
            <div class="form-group">
              <label class="form-label">Delivery Time:(days) </label>
              <input onkeypress="return isNumberKey(event)" name="package_time_basic" id="package_time_basic" class="form-control" value="<?php if($proposalData && $packages && array_key_exists('B',$packages)){echo $packages['B']->delivery_time;}else{echo '1';}?>">
              <span id="package_time_basicError" class="rerror"></span>
            </div>
            <div class="form-group mb-0">
              <label class="form-label">Price: </label>
              <div class="input-with-icon-left mb-0">
                <input type="number" onkeypress="return isNumberKey(event)" name="package_price_basic" id="package_price_basic" class="form-control" value="<?php if($proposalData && $packages && array_key_exists('B',$packages)){echo $packages['B']->price;}?>">
                <i><?php echo $currency;?></i>              
              </div>
              <span id="package_price_basicError" class="rerror"></span>
            </div>
          </div>
        </div>
      </div>

      <div class="standard_package col-md-4 col-12" <?php if($proposalData && $proposalData['proposal_settings']->is_package==1){}else{?>style="display: none" <?php }?>>
        <div class="section-package">
          <h4>Standard</h4>
          <div>
            <div class="form-group">
                <label class="form-label">Name: </label>
                <input name="package_name_standard" id="package_name_standard" class="form-control" type="text" value="<?php if($proposalData && $packages && array_key_exists('S',$packages)){echo $packages['S']->package_name;}?>">
                <span id="package_name_standardError" class="rerror"></span>
            </div>
            <div class="form-group">
                <label class="form-label">Description: </label>
                <textarea name="package_desc_standard" id="package_desc_standard" class="form-control" rows="5"><?php if($proposalData && $packages && array_key_exists('S',$packages)){echo ($packages['S']->description);}?></textarea>
                <span id="package_desc_standardError" class="rerror"></span>
            </div>
            
            <div class="form-group">
                <label class="form-label">Delivery Time:(days) </label>
                <input onkeypress="return isNumberKey(event)" name="package_time_standard" id="package_time_standard" class="form-control" value="<?php if($proposalData && $packages && array_key_exists('S',$packages)){echo $packages['S']->delivery_time;}else{echo '1';}?>">
                <span id="package_time_standardError" class="rerror"></span>
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Price: </label>
                <div class="input-with-icon-left">
                  <input type="number" onkeypress="return isNumberKey(event)" name="package_price_standard" id="package_price_standard" class="form-control" value="<?php if($proposalData && $packages && array_key_exists('S',$packages)){echo $packages['S']->price;}?>">
                  <i><?php echo $currency;?></i>              
                </div>
                <span id="package_price_standardError" class="rerror"></span>
            </div>
          </div>
        </div>
      </div>

      <div class="premium_package col-md-4 col-12" <?php if($proposalData && $proposalData['proposal_settings']->is_package==1){}else{?>style="display: none" <?php }?>>
        <div class="section-package mb-0">
          <h4>Premium</h4>
          <div>
              <div class="form-group">
                  <label class="form-label">Name: </label>
                  <input name="package_name_premium" id="package_name_premium" class="form-control" type="text" value="<?php if($proposalData && $packages && array_key_exists('P',$packages)){echo $packages['P']->package_name;}?>">
                  <span id="package_name_premiumError" class="rerror"></span>
              </div>
              <div class="form-group">
                  <label class="form-label">Description: </label>
                  <textarea name="package_desc_premium" id="package_desc_premium" class="form-control" rows="5"><?php if($proposalData && $packages && array_key_exists('P',$packages)){echo ($packages['P']->description);}?></textarea>
                  <span id="package_desc_premiumError" class="rerror"></span>
              </div>
              
              <div class="form-group">
                  <label class="form-label">Delivery Time:(days) </label>
                  <input onkeypress="return isNumberKey(event)" name="package_time_premium" id="package_time_premium" class="form-control" value="<?php if($proposalData && $packages && array_key_exists('P',$packages)){echo $packages['P']->delivery_time;}else{echo '1';}?>">
                  <span id="package_time_premiumError" class="rerror"></span>
              </div>
              <div class="form-group mb-0">
                  <label class="form-label">Price: </label>
                  <div class="input-with-icon-left">
                    <input type="number" onkeypress="return isNumberKey(event)" name="package_price_premium" id="package_price_premium" class="form-control" value="<?php if($proposalData && $packages && array_key_exists('P',$packages)){echo $packages['P']->price;}?>">
                    <i><?php echo $currency;?></i>              
                  </div>
                  <span id="package_price_premiumError" class="rerror"></span>
              </div>
          </div>
        </div>
      </div>
    </div>              
    </div>
        
  </div>
	<button class="btn btn-outline-secondary backbtnproposal" data-step="2"><?php echo __('postproposal_back','Back');?></button>
	<button class="btn btn-site nextbtnproposal" data-step="2"><?php echo __('postproposal_next','Next');?></button>
</div>
