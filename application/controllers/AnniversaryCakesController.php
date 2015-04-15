<?php
require_once('AbstractController.php');
class AnniversaryCakesController extends AbstractController
{

    public function init()
    {
        /* Initialize action controller here */
    	parent::init();
 		$this->view->headTitle('Anniversary Cake');
		
    }

    public function indexAction()
    {
        // action body
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
    }

    public function galleryAction()
    {
        // action body
				$this->view->headTitle('Gallery');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
    }


}



