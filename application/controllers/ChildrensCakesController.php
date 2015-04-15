<?php
require_once('AbstractController.php');
class ChildrensCakesController extends AbstractController
{

    public function init()
    {
        /* Initialize action controller here */
    	parent::init();
        $this->view->headTitle('Children\'s Cake');
	}

    public function indexAction()
    {
    	        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams,1st, 5th, 9th, 11th, celebration, party,children, birthday, football, Sheffield United, teddy, character', 'keywords');
		        $this->view->headMeta('At Sheffield based Hunkydory Cakes we love making Children\'s birthday cakes.', 'description');
    	
    }

    public function galleryAction()
    {
        // action body
        		$this->view->headTitle('Gallery');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams,1st, 5th, 9th, 11th, celebration, party,children, birthday, football, Sheffield United, teddy, character', 'keywords');
		        $this->view->headMeta('At Sheffield based Hunkydory Cakes we love making Children\'s birthday cakes.', 'description');
    }


}



