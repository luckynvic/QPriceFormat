<?php
/**
* QPriceFormat
* Wrapper for Price Format jQuery Plugin
* Created By Eduardo Cuducos
*
* @author Lucky Vic <luckynvi@gmail.com>
* 
*/
class QPriceFormat extends CInputWidget
{

	public $prefix ='';
    public $suffix = '';
	public $centsSeparator;
	public $thousandsSeparator;
	public $limit = false;
	public $centsLimit = 2;
	public $clearPrefix = false;
    public $clearSufix = false;
	public $allowNegative =false;
	public $insertPlusSign =false;
	public $clearOnEmpty =false;

	public $unMaskHidden=true;

	public $selector;

	private $_options = array();

	public function init()
	{
		$baseUrl=Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');
		Yii::app()->clientScript->registerScriptFile($baseUrl.'/jquery.price_format'.(YII_DEBUG?'':'.min').'.js');


		if(!isset($this->thousandsSeparator))
			$this->thousandsSeparator=Yii::app()->locale->getNumberSymbol('group');

		if(!isset($this->centsSeparator))
			$this->centsSeparator=Yii::app()->locale->getNumberSymbol('decimal');

		$this->_options['prefix']=$this->prefix;
		$this->_options['suffix']=$this->suffix;
		$this->_options['centsSeparator']=$this->centsSeparator;
		$this->_options['thousandsSeparator']=$this->thousandsSeparator;
		$this->_options['limit']=$this->limit;
		$this->_options['centsLimit']=$this->centsLimit;
		$this->_options['clearPrefix']=$this->clearPrefix;
		$this->_options['clearSufix']=$this->clearSufix;
		$this->_options['allowNegative']=$this->allowNegative;
		$this->_options['insertPlusSign']=$this->insertPlusSign;
		$this->_options['clearOnEmpty']=$this->clearOnEmpty;

		$jsoptions=CJavaScript::encode($this->_options);

		if(isset($this->selector))
		Yii::app()->clientScript->registerScript('q_price_format_',
"jQuery('#{$this->selector}').priceFormat({$jsoptions});"
		);
	}

	public function run()
	{
 		if($this->hasModel()) {
			//need to resolve name and id first;
			CHtml::resolveNameId($this->model,$this->attribute,$this->htmlOptions);
			list($name,$id)=$this->resolveNameId();
			$value=CHtml::resolveValue($this->model,$this->attribute);
		}
		else {
			$id=$this->name;
			$name=$this->name;
			$value=$this->value;
		}
			
		if($this->unMaskHidden)
		{
			$unmaskId=$this->id.'_'.$id;
			$options=$this->htmlOptions;
			echo CHtml::textField($name,$value,$options);
			// put in bottom of textField and change id
			echo CHtml::hiddenField($name,$value,array('id'=>$unmaskId));

		} else {
			$unmaskId=$id;
			echo CHtml::textField($name,$value,$this->htmlOptions);
		}

		$jsoptions=CJavaScript::encode($this->_options);

		Yii::app()->clientScript->registerScript('q_number_format_'.$this->id,
"jQuery('#{$id}').priceFormat({$jsoptions});"
		);
		if($this->unMaskHidden)
		{
			Yii::app()->clientScript->registerScript("q_number_format_change_".$this->id,
"
//sycronize input
jQuery('#{$id}').keypress(function(){
	var val = $('#{$id}').unmask();
	jQuery('#{$unmaskId}').val(val);
});
"
				);
		}
	}
}