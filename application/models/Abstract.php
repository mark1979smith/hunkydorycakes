<?php
abstract class HC_Model_Abstract
{
	/**
     * Database connection
     *
     * @var Zend_Db_Adapter_Abstract
     */
	protected $_db = null;
	
	public function __construct()
	{
		$this->_db = $this->_getDbInstance();
	}
	
	private function _getDbInstance()
	{
		return Zend_Registry::get('db');
	}
	
	protected function _throw404()
	{
		$this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
	}
}