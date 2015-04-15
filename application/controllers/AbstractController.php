<?php

abstract class AbstractController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    	// Set Holiday Message
        if (Zend_Registry::isRegistered('holiday_notice') && Zend_Registry::get('holiday_notice') === true)
        	$this->view->noticeBoard = '<p>Hunkydory Cakes will be closed from Friday 21st December 2012 until Monday 28th January 2013. Please email any enquiries to <a href="'. $this->view->url(array(), 'contact') .'">anna@hunkydorycakes.co.uk</a><br />Alternatively, leave a message on 0114 266 4573. All enquiries will be dealt with on my return, many thanks!</p>';
        else
        	$this->view->noticeBoard = NULL;
    }
}

