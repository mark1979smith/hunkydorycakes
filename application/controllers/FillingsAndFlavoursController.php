<?php
require_once('AbstractController.php');
class FillingsAndFlavoursController extends AbstractController
{

	public function init()
    {
        /* Initialize action controller here */
    	parent::init();
    	$this->view->headTitle('Fillings and Flavours');
    }

    public function indexAction()
    {
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, butter cream, icing, frosting, fruit, sponge, delivery, stawberry, chocolate, vanilla, red velvet, cheese', 'keywords');
		        $this->view->headMeta('Whether is is chocolate buttercream or strawberry jam at Hunkydory Cakes we will get it right for you.', 'description');
    	
    }


}

