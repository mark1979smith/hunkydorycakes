<?php
class HC_Model_Product extends HC_Model_Abstract
{
	private $_cakeId = null;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Set the cake id
	 * @param integer $cakeId
	 */
	public function setCakeId($cakeId)
	{
		$this->_cakeId = $cakeId;
		
		return $this;
	}
	
	/**
	 * Get the cake id
	 * 
	 * @return integer
	 */
	public function getCakeId()
	{
		return $this->_cakeId;
	}
	
	/**
	 * Get the cake info
	 * 
	 * @return array
	 */
	public function getCakeInfo()
	{
		$data = $this->_db->fetchRow('SELECT * FROM `cake` WHERE `cake_id` = ?', $this->getCakeId());
		$data['min_price'] = $this->getMinPrice();

		return $data;
	}
	
	/**
	 * Get the minimum sponge price of a cake
	 * 
	 * @return float
	 */
	public function getMinPrice()
	{
		return (float) $this->_db->fetchOne('SELECT MIN(`sponge_price`) FROM `cake_prices` WHERE `cake_id` = ?', $this->getCakeId());
	}
	
	/**
	 * Get All (excluding Cupcake) prices
	 * 
	 * @return array
	 */
	public function getAllPrices()
	{
		return $this->_db->fetchAll('SELECT `cake_prices`.`sponge_price` as `sponge`, `cake_prices`.`fruit_price` as `fruit` FROM `cake_prices` WHERE `cake_id` = ?', $this->getCakeId());
	}
	
	/**
	 * Get cupcake prices
	 * 
	 * @return array
	 */
	public function getCupCakePrices($type = '')
	{
		switch($type) 
		{
			case 'deluxe':
			case 'gluten-free':
				return array(12 => '26.00');
				break;
				
			case 'baby-shower':
				return array(12 => '24.00');
				break;
				
			default:
				return array(12 => '22.00', 24 => '43.00', 36 => '62.00');
		}
	}
	/**
	 * Get the cake sizes
	 * 
	 * @return array
	 */
	public function getSizes()
	{
		if (is_null($this->getCakeId()))
			throw new Exception('Cake Id not set');
			
		return $this->_db->fetchPairs('SELECT `cake_sizes`.`size`, `cake_sizes`.`size` FROM `cake_prices` JOIN `cake_sizes` USING (`size_id`) WHERE `cake_id` = ?', $this->getCakeId());
	}
	
	/**
	 * Get the cake flavours
	 * 
	 * @return array
	 */
	public function getAllFlavours()
	{
		return array(
			'Classic Vanilla' => 'Classic Vanilla',
			'Indulgent Chocolate' => 'Indulgent Chocolate',
			'Espresso Coffee' => 'Espresso Coffee',
			'Lemon Zest' => 'Lemon Zest',
			'Orange Zest' => 'Orange Zest',
			'Banana' => 'Banana',
			'Red Velvet' => 'Red Velvet'
		);
	}
	
	/**
	 * Return favours flavours
	 * 
	 * @return array
	 */
	public function getFavourFlavours()
	{
		return array(
			'Chocolate Shortbread' => 'Chocolate Shortbread',
			'Vanilla Shortbread' => 'Vanilla Shortbread'
		);
	}

	/**
	 * Get list of multiples of 12
	 * 
	 * @return array
	 */
	public function getDozenQty($restrictOneOption = false)
	{
		if ($restrictOneOption === false)
			return array(
				'12' => 'One Dozen',
				'24' => 'Two Dozen',
				'36' => 'Three Dozen'
			);
		else
			return array(
				'12' => 'One Dozen'
			);
	}
	/**
	 * Get the cake fillings
	 * 
	 * @return array
	 */
	public function getAllFillings()
	{
		$hasFruit = (boolean) $this->_db->fetchOne('SELECT COUNT(*) FROM `cake_prices` WHERE `sponge_price` > 0 AND `fruit_price` > 0 AND `cake_id` = ?', array($this->getCakeId()));
		if ($hasFruit)
			return array(
				'Sponge' => 'Sponge',
				'Fruit' => 'Fruit'
			);
		else
			return null;
	}
	
	/**
	 * Get the buttercream fillings
	 * 
	 * @return array
	 */
	public function getAllButterCreamFilling()
	{
		return array(
			'Vanilla' => 'Vanilla',
			'Chocolate' => 'Chocolate',
			'Espresso Coffee' => 'Espresso Coffee',
			'Mocha' => 'Mocha',
			'Orange' => 'Orange',
			'Chocolate and Orange Zest' => 'Chocolate and Orange Zest',
			'Lemon' => 'Lemon',
			'Coconut' => 'Coconut'
		);
	}
	
	public function workingDays($days)
	{
		for ($i = 1; $i <= $days; $i++)
		{
			//echo date('N jS F Y', strtotime('+'. $i . ' days')), '<br />';
			$dayNumber = date('N', strtotime('+'. $i . ' days'));
			if ($dayNumber == 6 || $dayNumber == 7)
			{
				$days++;
			}
				
		}
		return $i;
	}
}