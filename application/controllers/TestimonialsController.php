<?php
require_once('AbstractController.php');
class TestimonialsController extends AbstractController
{

    public function init()
    {
        /* Initialize action controller here */
    	parent::init();
    	$this->view->headTitle('Testimonials');
    }

    public function indexAction()
    {
        // action body
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Derbyshire, Hunkydory Cakes, best, top, delicious, incredible, perfection, value, quality, ingredients, free range', 'keywords');
		        $this->view->headMeta('People love the results form Hunkydory Cakes, Sheffield.', 'description');
    }


}

