<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>

<select name="city_id" id="city_id" class="selectpicker browser-default" title="City" data-live-search="true">
<?php
if($all_city){
	foreach($all_city as $city){
		?>
		<option value="<?php D($city->city_id);?>"><?php D(ucfirst($city->city_name));?></option>
		<?php
	}
}
?>
</select>
			            		