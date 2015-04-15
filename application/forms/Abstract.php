<?php
abstract class HC_Form_Abstract extends Zend_Form 
{
	protected function _getCakeInscription()
	{
		$element = new Zend_Form_Element_Textarea('os0');
		$element
			->setLabel('Cake Inscription')
			->addFilter('StringTrim')
			->addFilter('HtmlEntities')
			->setAttribs(array('class' => 'text', 'cols' => 35, 'rows' => 2, 'id' => 'cake_inscription'))
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
		return $element;
	}
	
	protected function _getDateRequired()
	{
		$element = new Zend_Form_Element_Text('os1');
		$element
			->setLabel('Date Required')
			->addFilter('StringTrim')
			->addFilter('HtmlEntities')
			->setAttribs(array('class' => 'text', 'id' => 'datepicker'))
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
		return $element;
	}
	
	protected function _getCakeSize()
	{
		$element = new Zend_Form_Element_Select('os3');
		$element
			->setLabel('Cake Size')
			->addFilter('StringTrim')
			->addFilter('HtmlEntities')
			->setAttribs(array('class' => 'text', 'id' => 'cake_size'))
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
		return $element;
	}
	
	protected function _getFavourChoice()
	{
		$element = new Zend_Form_Element_Select('os2');
		$element
			->setLabel('Favour choice')
			->addFilter('StringTrim')
			->addFilter('HtmlEntities')
			->setAttribs(array('class' => 'text', 'id' => 'favour_choice'))
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
		return $element;
	}
	
	protected function _getCakeFlavour()
	{
		$element = new Zend_Form_Element_Select('os4');
		$element
			->setLabel('Cake Flavour')
			->addFilter('StringTrim')
			->addFilter('HtmlEntities')
			->setAttribs(array('class' => 'text', 'id' => 'cake_flavour'))
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
		return $element;
	}

	protected function _getCakeFilling()
	{
		$element = new Zend_Form_Element_Select('os5');
		$element
			->setLabel('Cake type')
			->addFilter('StringTrim')
			->addFilter('HtmlEntities')
			->setAttribs(array('class' => 'text', 'id' => 'cake_filling'))
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
		return $element;
	}
	
	protected function _getQty()
	{
		$element = new Zend_Form_Element_Select('os6');
		$element
			->setLabel('Quantity Required')
			->addFilter('StringTrim')
			->setAttribs(array('class' => 'text', 'id' => 'qty'))

			
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
		return $element;
	}
	
	protected function _getPaypalCakeTitle()
	{
		$element = new Zend_Form_Element_Hidden('item_name');
		$element
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
				
		return $element;
	}
	
	protected function _getPaypalCakeMinPrice()
	{
		$element = new Zend_Form_Element_Hidden('amount');
		$element
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
				
		return $element;
	}
	
	protected function _getDeliveryOption()
	{
		$element = new Zend_Form_Element_Checkbox('shipping');
		$element
			->setOptions(array('checkedValue' => 10, 'uncheckedValue' => 0))
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
				
		return $element;
	}
	
	protected function _getDeliveryPostcode()
	{
		$element = new Zend_Form_Element_Text('os7');
		$element
			->setLabel('Delivery Postcode')
			->addFilter('StringTrim')
			->setAttribs(array('class' => 'postcode', 'id' => 'delivery_postcode', 'maxlength' => 8))
			->setDecorators(
				array(
					array('ViewHelper'),
					array('Errors', array('escape' => false)),
				));
		return $element;
	}
}