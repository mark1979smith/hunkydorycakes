<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'HC_',
            'basePath'  => dirname(__FILE__),
        ));
        return $autoloader;
    }

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        
        $view->headTitle('Hunkydory Cakes');
		$view->headTitle()->setSeparator(' :: ');
    }
    
    protected function _initSession()
    {
    	Zend_Session::start();
    }
	
	protected function _initLocale()
	{
		// Save locale
		$locale = new Zend_Locale('en_GB');
		Zend_Registry::set('Zend_Locale', $locale);
		
       	#$db = Zend_Registry::get('db');
    	#$db->query('SET time_zone = ?', 'Europe/London');
    	date_default_timezone_set('Europe/London');
	}
	
	protected function _initHolidayNotices()
	{
		if (date('Y-m-d') >= '2012-12-16' && date('Y-m-d') <= '2013-01-28')
		{
			Zend_Registry::set('holiday_notice', true);
		}
	}
	
	protected function _initRouter()
    {
		$front  = Zend_Controller_Front::getInstance();
		$router = $front->getRouter();
		
		#################
		# GENERIC PAGES #
		#################
		$route = new Zend_Controller_Router_Route_Static('press',array('controller' => 'static', 'action' => 'press'));
      	$router->addRoute('press', $route);
		$route = new Zend_Controller_Router_Route_Static('about-us',array('controller' => 'static', 'action' => 'about-us'));
      	$router->addRoute('about-us', $route);
		$route = new Zend_Controller_Router_Route_Static('links',array('controller' => 'static', 'action' => 'links'));
      	$router->addRoute('links', $route);
		
		# Wedding Cakes
		$route = new Zend_Controller_Router_Route_Static('wedding-cakes',array('controller' => 'wedding-cakes', 'action' => 'index'));
      	$router->addRoute('wedding-cakes', $route);
		$route = new Zend_Controller_Router_Route_Static('wedding-cakes/gallery',array('controller' => 'wedding-cakes', 'action' => 'gallery'));
      	$router->addRoute('wedding-cakes-gallery', $route);

      	# Anniversary Cakes
      	$route = new Zend_Controller_Router_Route_Static('anniversary-cakes',array('controller' => 'anniversary-cakes', 'action' => 'index'));
      	$router->addRoute('anniversary-cakes', $route);
      	$route = new Zend_Controller_Router_Route_Static('anniversary-cakes/gallery',array('controller' => 'anniversary-cakes', 'action' => 'gallery'));
      	$router->addRoute('anniversary-cakes-gallery', $route);
      	
      	# Childrens Cakes
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes',array('controller' => 'childrens-cakes', 'action' => 'index'));
      	$router->addRoute('childrens-cakes', $route);
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/gallery',array('controller' => 'childrens-cakes', 'action' => 'gallery'));
      	$router->addRoute('childrens-cakes-gallery', $route);
      	
      	# Christening Cakes
      	$route = new Zend_Controller_Router_Route_Static('christening-cakes',array('controller' => 'christening-cakes', 'action' => 'index'));
      	$router->addRoute('christening-cakes', $route);
      	$route = new Zend_Controller_Router_Route_Static('christening-cakes/gallery',array('controller' => 'christening-cakes', 'action' => 'gallery'));
      	$router->addRoute('christening-cakes-gallery', $route);
     
      	# Basic Cakes
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes',array('controller' => 'basic-cakes', 'action' => 'index'));
      	$router->addRoute('basic-cakes', $route);
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/gallery',array('controller' => 'basic-cakes', 'action' => 'gallery'));
      	$router->addRoute('basic-cakes-gallery', $route);
     
      	# Cupcakes
      	$route = new Zend_Controller_Router_Route_Static('cupcakes',array('controller' => 'cupcakes', 'action' => 'index'));
      	$router->addRoute('cupcakes', $route);
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/gallery',array('controller' => 'cupcakes', 'action' => 'gallery'));
      	$router->addRoute('cupcakes-gallery', $route);
      	
      	# Party Cakes
      	$route = new Zend_Controller_Router_Route_Static('party-cakes',array('controller' => 'party-cakes', 'action' => 'index'));
      	$router->addRoute('party-cakes', $route);
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/gallery',array('controller' => 'party-cakes', 'action' => 'gallery'));
      	$router->addRoute('party-cakes-gallery', $route);

      	# Favours
      	$route = new Zend_Controller_Router_Route_Static('favours',array('controller' => 'favours', 'action' => 'index'));
      	$router->addRoute('favours', $route);
      	$route = new Zend_Controller_Router_Route_Static('favours/gallery',array('controller' => 'favours', 'action' => 'gallery'));
      	$router->addRoute('favours-gallery', $route);
      	
      	# Corporate Cakes
      	$route = new Zend_Controller_Router_Route_Static('corporate-cakes',array('controller' => 'corporate-cakes', 'action' => 'index'));
      	$router->addRoute('corporate-cakes', $route);
      	$route = new Zend_Controller_Router_Route_Static('corporate-cakes/gallery',array('controller' => 'corporate-cakes', 'action' => 'gallery'));
      	$router->addRoute('corporate-cakes-gallery', $route);
      	
      	# Fillings and Flavours
      	$route = new Zend_Controller_Router_Route_Static('fillings-and-flavours',array('controller' => 'fillings-and-flavours', 'action' => 'index'));
      	$router->addRoute('fillings-and-flavours', $route);

      	# Tea Party
      	$route = new Zend_Controller_Router_Route_Static('tea-party',array('controller' => 'tea-party', 'action' => 'index'));
      	$router->addRoute('tea-party', $route);
      	
      	# Workshop
      	$route = new Zend_Controller_Router_Route_Static('cake-workshop',array('controller' => 'workshop', 'action' => 'index'));
      	$router->addRoute('workshop', $route);
      	
      	# Testimonials
      	$route = new Zend_Controller_Router_Route_Static('testimonials',array('controller' => 'testimonials', 'action' => 'index'));
      	$router->addRoute('testimonials', $route);
      	
      	# Making an Order
      	$route = new Zend_Controller_Router_Route_Static('making-an-order',array('controller' => 'making-an-order', 'action' => 'index'));
      	$router->addRoute('making-an-order', $route);
      	
      	# Making an Order
      	$route = new Zend_Controller_Router_Route_Static('contact',array('controller' => 'contact', 'action' => 'index'));
      	$router->addRoute('contact', $route);
      	
      	#####################
      	# Anniversary Cakes #
      	#####################
      	
      	#Lilies and Daisies
#      	$route = new Zend_Controller_Router_Route_Static('anniversary/lilies-and-daisies',array('controller' => 'product', 'action' => 'index', 'product' => 'lilies-and-daisies'));
#      	$router->addRoute('lilies-and-daisies-cake', $route);
# DELETED 26TH FEB 2012
      	
      	#Lily spray
      	$route = new Zend_Controller_Router_Route_Static('anniversary/lily-spray',array('controller' => 'product', 'action' => 'index', 'product' => 'lily-spray'));
      	$router->addRoute('lily-spray-cake', $route);

      	#Ring-a-roses
#      	$route = new Zend_Controller_Router_Route_Static('anniversary/ring-a-roses',array('controller' => 'product', 'action' => 'index', 'product' => 'ring-a-roses'));
#      	$router->addRoute('ring-a-roses-cake', $route);
# DELETED 26TH FEB 2012
      	
		#Anniversary Heart
      	$route = new Zend_Controller_Router_Route_Static('anniversary/heart',array('controller' => 'product', 'action' => 'index', 'product' => 'heart'));
      	$router->addRoute('heart-cake', $route);

      	#Anniversary Rose
      	$route = new Zend_Controller_Router_Route_Static('anniversary/rose',array('controller' => 'product', 'action' => 'index', 'product' => 'rose'));
      	$router->addRoute('rose-cake', $route);
      	
      	###############
      	# Basic Cakes #
      	###############
      	
      	#Cappuccino cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/cappuccino',array('controller' => 'product', 'action' => 'index', 'product' => 'cappuccino'));
      	$router->addRoute('cappuccino-cake', $route);

      	#Chocolate cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/chocolate',array('controller' => 'product', 'action' => 'index', 'product' => 'chocolate'));
      	$router->addRoute('chocolate-cake', $route);
      	
      	#Blueberry cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/blueberry',array('controller' => 'product', 'action' => 'index', 'product' => 'blueberry'));
      	$router->addRoute('blueberry-cake', $route);
      	
      	#Biscuits
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/biscuits',array('controller' => 'product', 'action' => 'index', 'product' => 'biscuits'));
      	$router->addRoute('biscuits', $route);
      	
      	#Deluxe Fruit Cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/deluxe-fruit',array('controller' => 'product', 'action' => 'index', 'product' => 'deluxe-fruit'));
      	$router->addRoute('deluxe-fruit-cake', $route);
      	
      	#Lemon Tart
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/lemon-tart',array('controller' => 'product', 'action' => 'index', 'product' => 'lemon-tart'));
      	$router->addRoute('lemon-tart-cake', $route);
      	
      	#Banana Mascapone Cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/banana-mascapone',array('controller' => 'product', 'action' => 'index', 'product' => 'banana-mascapone'));
      	$router->addRoute('banana-mascapone-cake', $route);
      	
      	#Red Velvet Cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/red-velvet',array('controller' => 'product', 'action' => 'index', 'product' => 'red-velvet'));
      	$router->addRoute('red-velvet-cake', $route);
      	
      	#Lemon Zest Cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/lemon-zest',array('controller' => 'product', 'action' => 'index', 'product' => 'lemon-zest'));
      	$router->addRoute('lemon-zest-cake', $route);
      	
      	#Victoria Sponge Cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/victoria-sponge',array('controller' => 'product', 'action' => 'index', 'product' => 'victoria-sponge'));
      	$router->addRoute('victoria-sponge-cake', $route);
      	
      	#Buttery Apple Crumble Cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/apple-crumble',array('controller' => 'product', 'action' => 'index', 'product' => 'apple-crumble'));
      	$router->addRoute('apple-crumble-cake', $route);
      	
      	#Get Well Soon Cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/get-well-soon',array('controller' => 'product', 'action' => 'index', 'product' => 'get-well-soon'));
      	$router->addRoute('get-well-soon-cake', $route);
      	
      	#Carrot Cake
      	$route = new Zend_Controller_Router_Route_Static('basic-cakes/carrot',array('controller' => 'product', 'action' => 'index', 'product' => 'carrot'));
      	$router->addRoute('carrot-cake', $route);
      	
      	#####################
      	## Childrens Cakes ##
      	#####################
      	
      	#Football Themed 1 Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/football-themed-no1',array('controller' => 'product', 'action' => 'index', 'product' => 'football-themed-1'));
      	$router->addRoute('football-themed-1-cake', $route);
      	
      	#Football Themed 2 Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/football-themed-no2',array('controller' => 'product', 'action' => 'index', 'product' => 'football-themed-2'));
      	$router->addRoute('football-themed-2-cake', $route);
      	
      	#Bathing Hippo Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/bathing-hippo',array('controller' => 'product', 'action' => 'index', 'product' => 'bathing-hippo'));
      	$router->addRoute('bathing-hippo-cake', $route);
      	
      	#Kermit Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/kermit',array('controller' => 'product', 'action' => 'index', 'product' => 'kermit'));
      	$router->addRoute('kermit-cake', $route);
      	
      	#The Three Bears Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/the-three-bears',array('controller' => 'product', 'action' => 'index', 'product' => 'the-three-bears'));
      	$router->addRoute('the-three-bears-cake', $route);
      	
      	#Farmyard Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/farmyard',array('controller' => 'product', 'action' => 'index', 'product' => 'farmyard'));
      	$router->addRoute('farmyard-cake', $route);
      	
      	#Postman Pat Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/postman-pat',array('controller' => 'product', 'action' => 'index', 'product' => 'postman-pat'));
      	$router->addRoute('postman-pat-cake', $route);
      	
      	#Minnie Mouse Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/minnie-mouse',array('controller' => 'product', 'action' => 'index', 'product' => 'minnie-mouse'));
      	$router->addRoute('minnie-mouse-cake', $route);
      	
      	#Cowboy Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/cowboy',array('controller' => 'product', 'action' => 'index', 'product' => 'cowboy'));
      	$router->addRoute('cowboy-cake', $route);
      	
      	#Cowboy Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/in-the-night-garden',array('controller' => 'product', 'action' => 'index', 'product' => 'in-the-night-garden'));
      	$router->addRoute('in-the-night-garden-cake', $route);
      	
      	#Graffitti Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/graffiti',array('controller' => 'product', 'action' => 'index', 'product' => 'graffitti'));
      	$router->addRoute('graffitti-cake', $route);
      	
      	#Numbers Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/numbers',array('controller' => 'product', 'action' => 'index', 'product' => 'numbers'));
      	$router->addRoute('childrens-numbers', $route);
      	
      	#Xbox Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/xbox',array('controller' => 'product', 'action' => 'index', 'product' => 'xbox'));
      	$router->addRoute('xbox-cake', $route);

      	#Rugby Cake
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/rugby',array('controller' => 'product', 'action' => 'index', 'product' => 'rugby'));
      	$router->addRoute('rugby-cake', $route);
      	
      	#Winnie the Pooh
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/winnie-the-pooh',array('controller' => 'product', 'action' => 'index', 'product' => 'winnie'));
      	$router->addRoute('childrens-winnie-cake', $route);
      	
      	#Spiderman
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/spiderman',array('controller' => 'product', 'action' => 'index', 'product' => 'spiderman'));
      	$router->addRoute('childrens-spiderman-cake', $route);
      	
      	#Postman Pat
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/fireman-sam',array('controller' => 'product', 'action' => 'index', 'product' => 'fireman-sam'));
      	$router->addRoute('childrens-fireman-sam-cake', $route);
      	
      	#Hook
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/hook',array('controller' => 'product', 'action' => 'index', 'product' => 'hook'));
      	$router->addRoute('childrens-hook-cake', $route);
      	
      	#Vintage Rose
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/vintage-rose',array('controller' => 'product', 'action' => 'index', 'product' => 'vintage-rose'));
      	$router->addRoute('childrens-vintage-rose', $route);
      	
      	#Toy Story
      	$route = new Zend_Controller_Router_Route_Static('childrens-cakes/toy-story',array('controller' => 'product', 'action' => 'index', 'product' => 'toy-story'));
      	$router->addRoute('childrens-toy-story', $route);
      	
      	
      	#######################
      	## Christening Cakes ##
      	#######################
      	
      	#Pretty in Pink Cake
      	$route = new Zend_Controller_Router_Route_Static('christening-cakes/pretty-in-pink',array('controller' => 'product', 'action' => 'index', 'product' => 'pretty-in-pink'));
      	$router->addRoute('pretty-in-pink-cake', $route);
      	
      	#Baby Blue Cake
      	$route = new Zend_Controller_Router_Route_Static('christening-cakes/baby-blue',array('controller' => 'product', 'action' => 'index', 'product' => 'baby-blue'));
      	$router->addRoute('baby-blue-cake', $route);
      	
      	#Blossom & daisies Cake
      	$route = new Zend_Controller_Router_Route_Static('christening-cakes/blossom-and-daisies',array('controller' => 'product', 'action' => 'index', 'product' => 'blossom-and-daisies'));
      	$router->addRoute('blossom-and-daisies-cake', $route);
      	
      	#Bird
      	$route = new Zend_Controller_Router_Route_Static('christening-cakes/bird',array('controller' => 'product', 'action' => 'index', 'product' => 'bird'));
      	$router->addRoute('christening-bird', $route);

      	#Jungle
      	$route = new Zend_Controller_Router_Route_Static('christening-cakes/jungle',array('controller' => 'product', 'action' => 'index', 'product' => 'jungle'));
      	$router->addRoute('christening-jungle', $route);

      	#Vintage Rose
      	$route = new Zend_Controller_Router_Route_Static('christening-cakes/vintage-rose',array('controller' => 'product', 'action' => 'index', 'product' => 'christening-vintage-rose'));
      	$router->addRoute('christening-vintage-rose', $route);
      	 
      	#####################
      	## Corporate Cakes ##
      	#####################
      	
      	#Corporate Cake
      	$route = new Zend_Controller_Router_Route_Static('corporate-cakes/corporate',array('controller' => 'product', 'action' => 'index', 'product' => 'corporate'));
      	$router->addRoute('corporate-cake', $route);
      	
      	#################
      	## Party Cakes ##
      	#################
      	
      	#In Bloom Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/in-bloom',array('controller' => 'product', 'action' => 'index', 'product' => 'in-bloom'));
      	$router->addRoute('in-bloom-cake', $route);
      	
      	#Tea Pot Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/tea-pot',array('controller' => 'product', 'action' => 'index', 'product' => 'tea-pot'));
      	$router->addRoute('tea-pot-cake', $route);
      	
      	#Piano polk-adot Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/piano-polk-adot',array('controller' => 'product', 'action' => 'index', 'product' => 'piano-polk-adot'));
      	$router->addRoute('piano-polk-adot-cake', $route);
      	
      	#Circles and rose Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/circles-and-rose',array('controller' => 'product', 'action' => 'index', 'product' => 'circles-and-rose'));
      	$router->addRoute('circles-and-rose-cake', $route);
      	
      	#Dolphin Splash Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/dolphin-splash',array('controller' => 'product', 'action' => 'index', 'product' => 'dolphin-splash'));
      	$router->addRoute('dolphin-splash-cake', $route);
      	
      	#Photo Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/photo',array('controller' => 'product', 'action' => 'index', 'product' => 'photo'));
      	$router->addRoute('photo-cake', $route);
      	
      	#Christmas Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/christmas',array('controller' => 'product', 'action' => 'index', 'product' => 'christmas'));
      	$router->addRoute('christmas-cake', $route);
     
      	#Zebra Stripes Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/zebra-stripes',array('controller' => 'product', 'action' => 'index', 'product' => 'zebra-stripes'));
      	$router->addRoute('zebra-stripes-cake', $route);
      	
      	#Daisy Zest Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/daisy-zest',array('controller' => 'product', 'action' => 'index', 'product' => 'daisy-zest'));
      	$router->addRoute('daisy-zest-cake', $route);
      	
      	#Mad Hatter Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/mad-hatters',array('controller' => 'product', 'action' => 'index', 'product' => 'mad-hatters'));
      	$router->addRoute('mad-hatters-cake', $route);
      	
      	#Colin's Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/colins-cake',array('controller' => 'product', 'action' => 'index', 'product' => 'colins-cake'));
      	$router->addRoute('colins-cake', $route);
      	
		#English Garden
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/english-garden',array('controller' => 'product', 'action' => 'index', 'product' => 'english-garden'));
      	$router->addRoute('english-garden', $route);
      	
		#Bespoke 1
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/bespoke-version-1',array('controller' => 'product', 'action' => 'index', 'product' => 'bespoke-version-1'));
      	$router->addRoute('bespoke-version-1', $route);
      	
		#Bespoke 1
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/bespoke-version-2',array('controller' => 'product', 'action' => 'index', 'product' => 'bespoke-version-2'));
      	$router->addRoute('bespoke-version-2', $route);
      	
      	#Cruise Themed Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/cruise-themed',array('controller' => 'product', 'action' => 'index', 'product' => 'cruise-themed'));
      	$router->addRoute('cruise-themed-cake', $route);
      	
      	#Golfing Themed Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/golf-themed',array('controller' => 'product', 'action' => 'index', 'product' => 'golf-themed'));
      	$router->addRoute('golf-themed-cake', $route);
      	
      	#Suitcase Cake
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/suitcase',array('controller' => 'product', 'action' => 'index', 'product' => 'suitcase'));
      	$router->addRoute('suitcase-cake', $route);
      	
      	#Yacht
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/yacht',array('controller' => 'product', 'action' => 'index', 'product' => 'yacht'));
      	$router->addRoute('party-yacht', $route);
      	
      	#Nightmare Before Christmas
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/nightmare-before-christmas',array('controller' => 'product', 'action' => 'index', 'product' => 'nightmare-before-christmas'));
      	$router->addRoute('party-nightmare-bc', $route);
      	
      	#Nightmare Before Christmas
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/peacock',array('controller' => 'product', 'action' => 'index', 'product' => 'peacock'));
      	$router->addRoute('party-peacock', $route);
      	
      	#Lace
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/lace',array('controller' => 'product', 'action' => 'index', 'product' => 'lace'));
      	$router->addRoute('party-lace', $route);
      	
      	#Champagne
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/champagne',array('controller' => 'product', 'action' => 'index', 'product' => 'champagne'));
      	$router->addRoute('party-champagne', $route);

      	#Camera
      	$route = new Zend_Controller_Router_Route_Static('party-cakes/camera',array('controller' => 'product', 'action' => 'index', 'product' => 'camera'));
      	$router->addRoute('party-camera', $route);
      	
      	#############
      	## Favours ##
      	#############
      	
      	#Bridesmaid Dress 1 Favour
      	$route = new Zend_Controller_Router_Route_Static('favours/wedding-dress-no1',array('controller' => 'product', 'action' => 'index', 'product' => 'wedding-dress-no1'));
      	$router->addRoute('wedding-dress-no1-favour', $route);
      	
      	#Bridesmaid Dress 2 Favour
      	$route = new Zend_Controller_Router_Route_Static('favours/wedding-dress-no2',array('controller' => 'product', 'action' => 'index', 'product' => 'wedding-dress-no2'));
      	$router->addRoute('wedding-dress-no2-favour', $route);
      	
      	#White Doves Favour
      	$route = new Zend_Controller_Router_Route_Static('favours/white-doves',array('controller' => 'product', 'action' => 'index', 'product' => 'white-doves'));
      	$router->addRoute('white-doves-favour', $route);
      	
      	#Red Rose Favour
      	$route = new Zend_Controller_Router_Route_Static('favours/red-rose',array('controller' => 'product', 'action' => 'index', 'product' => 'red-rose'));
      	$router->addRoute('red-rose-favour', $route);
      	
      	#Gingham Heart Favour
      	$route = new Zend_Controller_Router_Route_Static('favours/gingham-heart',array('controller' => 'product', 'action' => 'index', 'product' => 'gingham-heart'));
      	$router->addRoute('gingham-heart-favour', $route);
      	
      	#Dots of Love Favour
      	$route = new Zend_Controller_Router_Route_Static('favours/dots-of-love',array('controller' => 'product', 'action' => 'index', 'product' => 'dots-of-love'));
      	$router->addRoute('dots-of-love-favour', $route);
      	
      	#Peace and Love Favour
      	$route = new Zend_Controller_Router_Route_Static('favours/peace-and-love',array('controller' => 'product', 'action' => 'index', 'product' => 'peace-and-love'));
      	$router->addRoute('peace-and-love-favour', $route);
      	
      	###################
      	## Wedding Cakes ##
      	###################
      	
      	#Classic Collection Number 1 Wedding Cake
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/classic-collection-no1',array('controller' => 'product', 'action' => 'index', 'product' => 'classic-collection-no1'));
      	$router->addRoute('wedding-classic-collection-no1-cake', $route);

      	#Classic Collection Number 2 Wedding Cake
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/classic-collection-no2',array('controller' => 'product', 'action' => 'index', 'product' => 'classic-collection-no2'));
      	$router->addRoute('wedding-classic-collection-no2-cake', $route);

      	#Contemporary Collection Number 1 Wedding Cake
      	#$route = new Zend_Controller_Router_Route_Static('wedding-cakes/contemporary-collection-no1',array('controller' => 'product', 'action' => 'index', 'product' => 'contemporary-collection-no1'));
      	#$router->addRoute('contemporary-collection-no1-cake', $route);
      	# DELETED 9/12/12
      	
      	#Contemporary Collection Number 2 Wedding Cake
      	#$route = new Zend_Controller_Router_Route_Static('wedding-cakes/contemporary-collection-no2',array('controller' => 'product', 'action' => 'index', 'product' => 'contemporary-collection-no2'));
      	#$router->addRoute('contemporary-collection-no2-cake', $route);
      	# DELETED 9/12/12

      	#Flower Collection Number 1 Wedding Cake
      	#$route = new Zend_Controller_Router_Route_Static('wedding-cakes/flower-collection-no1',array('controller' => 'product', 'action' => 'index', 'product' => 'flower-collection-no1'));
      	#$router->addRoute('flower-collection-no1-cake', $route);
      	# DELETED 9/12/12
      	
      	#Flower Collection Number 2 Wedding Cake
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/flower-collection-no2',array('controller' => 'product', 'action' => 'index', 'product' => 'flower-collection-no2'));
      	$router->addRoute('wedding-flower-collection-no2-cake', $route);
      	
      	#Flower Collection Number 3 Wedding Cake
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/flower-collection-no3',array('controller' => 'product', 'action' => 'index', 'product' => 'flower-collection-no3'));
      	$router->addRoute('wedding-flower-collection-no3-cake', $route);
      	
      	#Chocolate Cigarello
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/chocolate-cigarello',array('controller' => 'product', 'action' => 'index', 'product' => 'chocolate-cigarello'));
      	$router->addRoute('wedding-chocolate-cigarello', $route);
      	
      	#Vintage Lace
      	#$route = new Zend_Controller_Router_Route_Static('wedding-cakes/vintage-lace',array('controller' => 'product', 'action' => 'index', 'product' => 'vintage-lace'));
      	#$router->addRoute('vintage-lace', $route);
      	# DELETED 9/12/12
      	
      	#Dots, Stripes and Hearts
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/dots-stripes-and-hearts',array('controller' => 'product', 'action' => 'index', 'product' => 'dots-stripes-and-hearts'));
      	$router->addRoute('wedding-dots-stripes-and-hearts', $route);
      	
      	#Under the Sea
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/under-the-sea',array('controller' => 'product', 'action' => 'index', 'product' => 'under-the-sea'));
      	$router->addRoute('wedding-under-the-sea', $route);
      	
      	#Cupcake Tower
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/cupcake-tower',array('controller' => 'product', 'action' => 'index', 'product' => 'cupcake-tower'));
      	$router->addRoute('wedding-cupcake-tower', $route);
      	
      	#Mandy
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/mandy',array('controller' => 'product', 'action' => 'index', 'product' => 'mandy'));
      	$router->addRoute('wedding-mandy', $route);
      	
      	#Franchesca
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/francesca',array('controller' => 'product', 'action' => 'index', 'product' => 'franchesca'));
      	$router->addRoute('wedding-franchesca', $route);
      	
      	#Helen
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/helen',array('controller' => 'product', 'action' => 'index', 'product' => 'helen'));
      	$router->addRoute('wedding-helen', $route);
      	
      	#Victoria
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/victoria',array('controller' => 'product', 'action' => 'index', 'product' => 'victoria'));
      	$router->addRoute('wedding-victoria', $route);
      	
      	#Amy
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/amy',array('controller' => 'product', 'action' => 'index', 'product' => 'amy'));
      	$router->addRoute('wedding-amy', $route);
      	
      	#Anna
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/anna',array('controller' => 'product', 'action' => 'index', 'product' => 'anna'));
      	$router->addRoute('wedding-anna', $route);

      	#Basia
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/basia',array('controller' => 'product', 'action' => 'index', 'product' => 'basia'));
      	$router->addRoute('wedding-basia', $route);

      	#Claire
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/claire',array('controller' => 'product', 'action' => 'index', 'product' => 'claire'));
      	$router->addRoute('wedding-claire', $route);

      	#Cupcake & Cake
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/cupcake-and-cake',array('controller' => 'product', 'action' => 'index', 'product' => 'cupcake-and-cake'));
      	$router->addRoute('wedding-cupcake-and-cake', $route);

      	#Jemma
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/jemma',array('controller' => 'product', 'action' => 'index', 'product' => 'jemma'));
      	$router->addRoute('wedding-jemma', $route);

      	#Charlotte
      	$route = new Zend_Controller_Router_Route_Static('wedding-cakes/charlotte',array('controller' => 'product', 'action' => 'index', 'product' => 'charlotte'));
      	$router->addRoute('wedding-charlotte', $route);
      	
      	##############
      	## Cupcakes ##
      	##############
      	
      	#Bespoke Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/bespoke',array('controller' => 'product', 'action' => 'index', 'product' => 'bespoke-cupcake'));
      	$router->addRoute('bespoke-cupcake', $route);
      	
      	#Blueberry Burst Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/blueberry-burst',array('controller' => 'product', 'action' => 'index', 'product' => 'blueberry-burst'));
      	$router->addRoute('blueberry-burst-cupcake', $route);
      	
      	#Bonbons Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/bonbons',array('controller' => 'product', 'action' => 'index', 'product' => 'bonbons'));
      	$router->addRoute('bonbons-cupcake', $route);
      	
      	#Cherry on Top Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/cherry-on-top',array('controller' => 'product', 'action' => 'index', 'product' => 'cherry-on-top'));
      	$router->addRoute('cherry-on-top-cupcake', $route);
      	
      	#Black Forest Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/black-forest',array('controller' => 'product', 'action' => 'index', 'product' => 'black-forest'));
      	$router->addRoute('black-forest-cupcake', $route);
      	
      	#Chocolate Cookie Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/chocolate-cookie',array('controller' => 'product', 'action' => 'index', 'product' => 'chocolate-cookie'));
      	$router->addRoute('chocolate-cookie-cupcake', $route);
      	
      	#Chocolate Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/chocolate',array('controller' => 'product', 'action' => 'index', 'product' => 'chocolate-cupcake'));
      	$router->addRoute('chocolate-cupcake', $route);
      	
      	#Dairy Fudge Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/dairy-fudge',array('controller' => 'product', 'action' => 'index', 'product' => 'dairy-fudge'));
      	$router->addRoute('dairy-fudge-cupcake', $route);
      	
      	#Dotty Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/dotty',array('controller' => 'product', 'action' => 'index', 'product' => 'dotty'));
      	$router->addRoute('dotty-cupcake', $route);
      	
      	#Double Decker Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/double-decker',array('controller' => 'product', 'action' => 'index', 'product' => 'double-decker'));
      	$router->addRoute('double-decker-cupcake', $route);
      	
      	#Football Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/football',array('controller' => 'product', 'action' => 'index', 'product' => 'football'));
      	$router->addRoute('football-cupcake', $route);
      	
      	#I Heart U Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/i-heart-u',array('controller' => 'product', 'action' => 'index', 'product' => 'i-heart-u'));
      	$router->addRoute('i-heart-u-cupcake', $route);
      	
      	#Mint Choc Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/mint-choc',array('controller' => 'product', 'action' => 'index', 'product' => 'mint-choc'));
      	$router->addRoute('mint-choc-cupcake', $route);
      	
      	#Oreo Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/oreo',array('controller' => 'product', 'action' => 'index', 'product' => 'oreo'));
      	$router->addRoute('oreo-cupcake', $route);
      	
      	#Pretty in Pink Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/pretty-in-pink',array('controller' => 'product', 'action' => 'index', 'product' => 'pretty-in-pink-cupcake'));
      	$router->addRoute('pretty-in-pink-cupcake', $route);
      	
      	#Red Velvet Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/red-velvet',array('controller' => 'product', 'action' => 'index', 'product' => 'red-velvet-cupcake'));
      	$router->addRoute('red-velvet-cupcake', $route);
      	
      	#Strawberry - Fragola Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/fragola',array('controller' => 'product', 'action' => 'index', 'product' => 'fragola'));
      	$router->addRoute('fragola-cupcake', $route);
      	
      	#Top Trumps Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/top-trumps',array('controller' => 'product', 'action' => 'index', 'product' => 'top-trumps'));
      	$router->addRoute('top-trumps-cupcake', $route);
      	
      	#Vanilla Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/vanilla',array('controller' => 'product', 'action' => 'index', 'product' => 'vanilla'));
      	$router->addRoute('vanilla-cupcake', $route);
      	
      	#Wedding Cupcake
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/wedding',array('controller' => 'product', 'action' => 'index', 'product' => 'wedding-cupcake'));
      	$router->addRoute('wedding-cupcake', $route);
      	
      	#Deluxe Chocolate Cupcake Box 
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/deluxe-choc-box',array('controller' => 'product', 'action' => 'index', 'product' => 'deluxe-choc-box'));
      	$router->addRoute('deluxe-choc-box', $route);
      	
      	#Deluxe Gluten Free Box 
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/gluten-free-box',array('controller' => 'product', 'action' => 'index', 'product' => 'gluten-free-box'));
      	$router->addRoute('gluten-free-box', $route);
      	
      	#Baby Shower Cupcakes
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/baby-shower',array('controller' => 'product', 'action' => 'index', 'product' => 'baby-shower-cupcake'));
      	$router->addRoute('baby-shower-cupcake', $route);
      	
      	#Cat themed mini Cupcakes
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/cat-themed',array('controller' => 'product', 'action' => 'index', 'product' => 'cat-themed-minicupcakes'));
      	$router->addRoute('cat-themed-minicupcakes', $route);
      	
      	#Mixed Box Cupcakes
      	$route = new Zend_Controller_Router_Route_Static('cupcakes/mixed-box',array('controller' => 'product', 'action' => 'index', 'product' => 'mixed-box-cupcakes'));
      	$router->addRoute('mixed-box-cupcakes', $route);
      	
      	
      	
    }
    
    protected function _startMVC()
    {
    	Zend_Layout::startMvc();
    }
}

