<?php 
class HC_Form_OrderForm extends HC_Form_Abstract 
{
	// init	
	public function init()
	{
		//Configure
		$this->setAction('https://www.paypal.com/cgi-bin/webscr')
		->setMethod('POST')
		->setDecorators(array(
            	array('ViewScript', array('viewScript' => 'forms/OrderForm.phtml', 'placement' => false))
            ));
       
		//Add all your elements here.
		//I write a method for creating each element.
		//Seperates each element's setup code into it's own scope.
		$this->addElements(
			array(
				$this->_getPaypalCakeMinPrice(),
				$this->_getPaypalCakeTitle()
			)
		);
		
	
	}
	
	public function setProductData($data)
	{
		if (isset($data['min_price']))
			$this->getElement('amount')->setValue($data['min_price']);
		if (isset($data['title']))
			$this->getElement('item_name')->setValue($data['title']);
		
		$paypalId = -1;
		if (isset($data['inscription']) && $data['inscription'] === true)
		{
			$paypalId++;
			$this->addElement($this->_getCakeInscription());
		}
		$paypalId++;
		$this->addElement($this->_getDateRequired());
		if (isset($data['favour_choice']) && !empty($data['favour_choice']))
		{
			$paypalId++;
			$this->addElement($this->_getFavourChoice()->setMultiOptions($data['favour_choice']));
		}
		if (isset($data['sizes']) && !empty($data['sizes']))
		{
			$paypalId++;
			$this->addElement($this->_getCakeSize()->setMultiOptions($data['sizes']));
		}
		if (isset($data['flavours']) && !empty($data['flavours']))
		{
			$paypalId++;
			$this->addElement($this->_getCakeFlavour()->setMultiOptions($data['flavours']));
		}	
		if (isset($data['fillings']) && !empty($data['fillings']))
		{
			$paypalId++;
			$this->addElement($this->_getCakeFilling()->setMultiOptions($data['fillings']));
		}
		if (isset($data['qty']) && !empty($data['qty']))
		{
			$paypalId++;
			$this->addElement($this->_getQty()->setMultiOptions($data['qty']));
		}
		$this->addElement($this->_getDeliveryOption());
		$this->addElement($this->_getDeliveryPostcode());
	}
}
