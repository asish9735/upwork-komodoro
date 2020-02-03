<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);

$email=$memberInfo->member_email;
$d=explode('@',$email,2);
if(count($d)==2){
$first=$d[0];
$email_l=strlen($first);
$firs_part=substr($first,0,1);
if($email_l>3){
	$star=$email_l-3;
	for($s=0;$s<$star;$s++){
		$firs_part.='*';
	}
	$firs_part.=substr($first,-2);
}else{
	$firs_part.="**";
}
$display_email=$firs_part."@".$d[1];
}else{
	$display_email=$email;
}
?>

<div class="row">
    <div class="col-sm">
        <div class="submit-field">
            <h5>User ID</h5>
            <p><?php D($memberInfo->member_username)?></p>
        </div>
        <div class="submit-field">
            <h5>Name</h5>
            <p><?php ucwords(D($memberInfo->member_name));?></p>
        </div>
	</div>
    <div class="col-sm">
        <!-- Account Type -->
        <div class="submit-field">
            <h5>Email</h5>
            <p><?php D($display_email)?></p>
        </div>
    </div>
    
</div>