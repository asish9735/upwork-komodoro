<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title><?php echo !empty($title) ? $title : get_setting('site_title'); ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="<?php echo IMAGE;?>favicon.png" type="image/x-icon">
<?php $this->layout->load_meta(); ?>
<!--<style type="">
	@import url("https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&subset=latin-ext");
</style>-->

<?php
$this->minify->add_css('bootstrap.css');
$this->minify->add_css('icons.css');
$this->minify->add_css('theme.css');
$load_css=$this->layout->load_css(); 
if(!empty($load_css)){
	foreach($load_css as $files){
		$this->minify->add_css($files);
	}
}
$this->minify->add_css('style.css');
$this->minify->add_css('responsive.css');
$this->minify->add_css('colors/green.css');
echo $this->minify->deploy_css(FALSE, 'header.min.css');
?>

<script type="text/javascript">
    var VPATH = '<?php echo base_url();?>';
</script>
</head>
<body>

<!-- Wrapper -->
<!--<div id="wrapper" class="wrapper-with-transparent-header"> for transparent header -->
<div id="wrapper" class="">