<?php
/* @var $this SiteController */
/* @var $data Comment */
?>
<li class= "clearfix">
    <div class="user">
        <img alt="" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $data->user->email ) ) )?>?d=identicon&s=60" height="60" width="60" class="avatar" />
    </div>
    <div class="message">
        <div class="info">
            <h3><a><?php echo CHtml::encode($data->user->username); ?></a></h3>
            <span class="date">- <?php echo date( 'H:i F d, Y', strtotime($data->datetime) ); ?></span> </div>
        <p><?php echo CHtml::encode($data->message); ?></p>
    </div>
    <div class="clear"></div>
</li>