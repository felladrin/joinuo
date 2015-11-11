<?php
/* @var $this SiteController */
/* @var $data Screenshot */
?>
<li><?php echo CHtml::link(CHtml::image($data->filename, '', array('style' => 'width: 100%')), array('DeleteScreenshot' , 'id' => $data->id), array('title' => "Click To Delete")) ?></li>