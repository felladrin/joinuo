<?php
/* @var $this SiteController */
/* @var $data Comment */
?>
<li>
    <a href="<?php echo $this->createUrl("shard/view", array('id' => $data->shard->id)) ?>" title=""><img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($data->user->email))) ?>?d=identicon&s=60" alt="" /></a>
    <h4><a href="<?php echo $this->createUrl("shard/view", array('id' => $data->shard->id)) ?>" title=""><?php echo CHtml::encode($data->user->username); ?> on <?php echo CHtml::encode($data->shard->name); ?></a></h4>
    <span class="info"><?php echo date('H:i F d, Y', strtotime($data->datetime)); ?></span>
</li>