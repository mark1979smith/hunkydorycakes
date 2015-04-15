<?php
require_once('AbstractController.php');
class MakingAnOrderController extends AbstractController
{

    public function init()
    {
        /* Initialize action controller here */
    	parent::init();
    	$this->view->headTitle('Making an Order');
    }

    public function indexAction()
    {
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Anna Williams, Hunkydory Cakes, blair athol road, s11 7gd, 0114 266 4573, delivery, cupcakes', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes deliver within Sheffield, Chesterfield, Rotherham and South Yorkshire.', 'description');
    	
    }

}

