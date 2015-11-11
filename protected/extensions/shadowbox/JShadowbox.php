<?php

/**
 * JShadowbox class file.
 *
 * @author jerry2801 <jerry2801@gmail.com>
 *
 * A typical usage of JShadowbox is as follows:
 * <pre>
 * $this->widget('application.extensions.shadowbox.JShadowbox', array(
 *     'options' => array(
 *         'language'=>'en',
 *         'players'=>array('img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'),
 *     ),
 * ));
 * </pre>
 */


class JShadowbox extends CWidget
{
	public $baseUrl;
    public $options = array();
    public $htmlOptions = array();
    public $adapter='jquery';

    public function init()
    {
        $options = CJavaScript::encode($this->options);

        $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'source';
        $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);

        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCssFile($this->baseUrl.'/shadowbox.css');
        $cs->registerScriptFile($this->baseUrl.'/shadowbox.js');
        $cs->registerScriptFile($this->baseUrl.'/adapters/shadowbox-'.$this->adapter.'.js');
        $cs->registerScript($this->getId(),'Shadowbox.init('.$options.');', CClientScript::POS_HEAD);
    }

    public function run()
    {
    }
}