<?php
/* @var $this SiteController */
/* @var $data Screenshot */
?>
<li style="background: url('<?php echo $data->filename; ?>') no-repeat center center; width: 80px; height: 80px;"><a href="<?php echo $data->filename; ?>" title="<?php echo $data->shard->name; ?>" rel='shadowbox[screenshots]' style="display: block; height: 100%; width: 100%">&nbsp;</a></li>