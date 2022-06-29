<?php
$default_size="34";
if(!empty($size)){
	$default_size=$size;
}
$scale=round($default_size/70,2);
$precent=0;
$percent_graph=204-(2.04*$precent);
?>
<div><div class="progress-circle-custom" style="-webkit-transform: translateY(-24px) scale(<?php echo $scale;?>);transform: translateY(-24px) scale(<?php echo $scale;?>);"><div class="circle-counter-border"></div><svg class="process-bar" width="70" height="70"><path d="m35,2.5c17.955803,0 32.5,14.544199 32.5,32.5c0,17.955803 -14.544197,32.5 -32.5,32.5c-17.955803,0 -32.5,-14.544197 -32.5,-32.5c0,-17.955801 14.544197,-32.5 32.5,-32.5z" style="stroke-dasharray: 204;stroke-dashoffset: <?php echo $percent_graph;?>;"></path></svg><svg class="tickcomplete" width="70" height="70"><path d="m22.5,37.5l8.5,7.1l15.3,-23.2" style="stroke-dasharray: 40; stroke-dashoffset: 40;"></path></svg></div></div>