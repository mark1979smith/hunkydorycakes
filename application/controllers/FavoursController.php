<?php
require_once('AbstractController.php');
class FavoursController extends AbstractController
{

    public function init()
    {
        /* Initialize action controller here */
    	parent::init();
    	$this->view->headTitle('Wedding Favours');
	}
    
    public function indexAction()
    {
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Wedding Cake, fruit cake, bride, groom, sugar flowers, wedding consultation, favours, shortbread, guests, gifts, wedding dress, hearts, rose, dove, peace, delivery, white, ivory', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make beautiful hand made edible wedding favours, we deliver to Sheffield, Chesterfield, Derbyshire and South Yorkshire', 'description');
    	
    }

    public function galleryAction()
    {
        // action body
				$this->view->headTitle('Gallery');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Wedding Cake, fruit cake, bride, groom, sugar flowers, wedding consultation, favours, shortbread, guests, gifts, wedding dress, hearts, rose, dove, peace, delivery, white, ivory', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make beautiful hand made edible wedding favours, we deliver to Sheffield, Chesterfield, Derbyshire and South Yorkshire', 'description');
    }


}



