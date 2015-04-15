<?php
require_once('AbstractController.php');
class ProductController extends AbstractController
{

	private $_product = null;
	
	const CAKE_INSCRIPTION_KEY = 'inscription';
	const CAKE_FLAVOURS_KEY = 'flavours';
	const CAKE_FILLINGS_KEY = 'fillings';
	const CAKE_SIZE_KEY = 'sizes';
	const CAKE_QTY_KEY = 'qty';
	const CAKE_FAVOUR_CHOICE_KEY = 'favour_choice';
	
    public function init()
    {
        /* Initialize action controller here */
    	parent::init();
    	$this->_product = new HC_Model_Product();
    	
    	$packer = new HC_Model_Javascriptpacker("$(function() { 
    		$('#deliveryPostcode').hide(); 
    		$('#shipping').bind('click', function() { $('#deliveryPostcode').toggle();});
    		$('form input').attr('autocomplete', 'off');
    		$('form[action^=\"https://www.paypal.com/\"]').bind('submit', function(e) {
    			if ($('#datepicker').val().length == 0)
    			{
    				$.prompt('Please supply a date');
    				e.preventDefault();
				}
				else if ($('#shipping:checked').length > 0)
				{
					if ($.trim($('#delivery_postcode').val()).length < 5)
					{
						$.prompt('Please supply the full postcode');
						e.preventDefault(); 
					}
					else if ($.trim($('#delivery_postcode').val()).match(/^S[0-9]{1,2}/i) == null)
					{
						$.prompt('The delivery postcode is not in our delivery range');
						$('#delivery_postcode').val('');
						$('#shipping').removeAttr('checked');
						$('#deliveryPostcode').hide();
						e.preventDefault();
					}
				}
				
    		});
    	});");
		$packed = $packer->pack();
		$this->view->inlineScript()->setScript($packed);
    }

    public function indexAction()
    {
        $params = $this->_request->getParams();
        switch ($params['product']) :
	    	case 'lilies-and-daisies' :
	    		/**
	    		 * DELETED 26TH FEB 2012
	    		 */
	    		return;
	    		$cakeId = 1;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'anniversary';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'anniversary-cakes';
		        $this->view->image = 'lilies-and-daisies.png';
		        $this->view->header = 'golden wedding anniversary, calla lilies &amp; golden daisies.';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) sponge cake<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on the iced scroll sat on the top of the cake as shown in the picture. Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        // Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY	=> $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
		        $prices = $this->_product->getAllPrices();
		        $packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
		        
				$this->view->headTitle('Anniversary Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			
	    	case 'lily-spray':
	    		$cakeId = 2;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'anniversary';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'anniversary-cakes';
		        $this->view->image = 'lily-spray.png';
		        $this->view->header = 'white rubrum lily spray';
		        $this->view->info = '<p>Image shown: shown: 11&quot; fruit cake. Decorated with handmade white Rubrum Lilies finished with your choice of coloured ribbon.</p><p>Prices:  Fruit from: &pound;120.00. Sponge from: &pound;80.00.</p><p>Available in a range of sizes on circular cakes and square cakes.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on the the top of the cake or around the cake board.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        /**
		        // Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				*/
				
				$this->view->headTitle('Anniversary Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			
			case 'ring-a-roses':
	    		$cakeId = 3;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'anniversary';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'anniversary-cakes';
		        $this->view->image = 'ring-a-roses.png';
		        $this->view->header = 'golden wedding anniversary, ring-a-roses.';
		        $this->view->info = '<p>Image shown: shown: 10&quot; (25.5cm) fruit cake.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on the iced scroll sat on the top of the cake as shown in the picture. Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
		        // Order Form
		       $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Anniversary Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			
			case 'cappuccino':
	    		$cakeId = 4;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'cappuccino.png';
		        $this->view->header = 'Cappuccino cake';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) Cappuccino sponge cake smothered in lashings of cappuccino butter cream. <br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular &amp; square cakes.<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
		        
		        // Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, coffee, cappuccino,  red velvet', 'keywords');
		        $this->view->headMeta('You really should try Hunkydory Cakes Capuccion cake it is delicious.', 'description');
			break;
			
			case 'chocolate':
	    		$cakeId = 5;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'chocolate.png';
		        $this->view->header = 'Chocolate cake';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) Chocolate sponge cake, covered in lashings of chocolate butter cream.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular &amp; square cakes.<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake,  red velvet', 'keywords');
		        $this->view->headMeta('You really should try Hunkydory Cakes Chocolate cake it is a great tasty treat.', 'description');
			break;
			
			case 'blueberry':
	    		$cakeId = 6;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'blueberry.png';
		        $this->view->header = 'blueberry mascarpone cake';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) blueberry sponge with mascarpone topping sprinkled with fresh blueberries.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular &amp; square cakes.<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
		        
		        // Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, blueberry, mascapone,  red velvet', 'keywords');
		        $this->view->headMeta('The perfect cake for a Summer barbeque is Hunkydory Cakes \'Blueberry cake\', it can be delivered to you if you live in Sheffield.', 'description');
			break;
			
			case 'biscuits':
	    		$cakeId = 7;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'biscuits.png';
		        $this->view->header = 'biscuits &amp; cookies<br />freshly baked to order';
		        $this->view->info = '<p>Image shown: Ginger Biscuits.<br />Also available are Chocolate Chip Cookies, Anzac Biscuits, White chocolate &amp; macadamia shortbread*, Chocolate and orange pinwheels, Pecan &amp; cranberry biscuits*, Lemon Biscuits, Oaty cherry cookies and Choc-chip peanut butter biscuits. <br />Price &pound;8.00 per dozen. *plus &pound;1.00 per dozen. Available in dozen batches.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->orderFormText = '<p>Please give Hunkydory Cakes a call on 0114 266 4573 or email enquiries@hunkydorycakes to place biscuit orders.</p>';
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake,  red velvet', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes bake the best biscuits in Sheffield.', 'description');
				break;
			
			case 'deluxe-fruit':
	    		$cakeId = 8;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'deluxe-fruit.png';
		        $this->view->header = 'deluxe fruit cake';
		        $this->view->info = '<p>Image shown: 8&quot; (20 cm) Deluxe fruit cake. We bake our fruit cakes as far in advance as possible and feed them regularly with brandy. <br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake,  red velvet', 'keywords');
		        $this->view->headMeta('Sheffield\'s Hunkydory Cakes produce traditional, affordable cakes including the \'Deluxe Fruit cake\'.', 'description');
			break;
			
			case 'lemon-tart':
	    		$cakeId = 9;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'lemon-tart.png';
		        $this->view->header = 'lemon tart';
		        $this->view->info = '<p>Image shown: 11&quot; (26 cm) A French classic, zesty lemon tart with sweet shortcrust pastry.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, red velvet', 'keywords');
		        $this->view->headMeta('Sheffield\'s Hunkydory Cakes produce traditional, affordable cakes including the classic French Lemon Tart.', 'description');
				break;
			
			case 'banana-mascapone':
	    		$cakeId = 10;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'banana-mascapone.png';
		        $this->view->header = 'banana mascarpone cake';
		        $this->view->info = '<p>Image shown: 8&quot; (20 cm) Banana, ginger and cinnamon sponge cake. <br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular &amp; square cakes.<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, red velvet', 'keywords');
		        $this->view->headMeta('A Hunkydory Cakes concoction, the Banana Mascarpone Cake is divine.', 'description');
				break;
			
			case 'red-velvet':
	    		$cakeId = 11;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'red-velvet.png';
		        $this->view->header = 'red velvet layer cake';
		        $this->view->info = '<p>Image shown: 8&quot; (20 cm) American Red Velvet Layer cake, subtle flavours of vanilla &amp; chocolate smothered in lashings of cream cheese icing<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular &amp; square cakes.<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, red velvet', 'keywords');
		        $this->view->headMeta('Sheffield\'s Hunkydory Cakes taste sensation is the \'Red Velvet\' layer Cake.', 'description');
				break;
			
			case 'lemon-zest':
	    		$cakeId = 12;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'lemon-zest.png';
		        $this->view->header = 'lemon zest cake';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) Lemon zest sponge cake smothered in lashings of lemon juice butter cream.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular &amp; square cakes.<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, red velvet', 'keywords');
		        $this->view->headMeta('Sheffield\'s Hunkydory Cakes produce the perfect cake for a Summer\'s afternoon - The \'Lemon Zest\' cake.', 'description');
				break;
			
			case 'football-themed-1':
	    		$cakeId = 13;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'football-themed-1.png';
		        $this->view->header = 'football themed cake';
		        $this->view->info = '<p>Image shown: 10&quot; (25 cm) sponge cake. Decorated with football badge and studded hearts.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.</p><p>You may wish to personalise the cake &amp; incorporate a message, this will be added to the red banner that is wrapped round the side of the cake. <br />Any football teams badge can be created, it may be your favourite team or a local team you play for. <br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Children\'s Cake');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams,1st, 5th, 9th, 11th, celebration, party,children, birthday, football, Sheffield United, teddy, character', 'keywords');
		        $this->view->headMeta('At Sheffield based Hunkydory Cakes we love making football birthday cakes, it may be your favourite team or your local children\'s team.', 'description');
				break;
			
			case 'victoria-sponge':
	    		$cakeId = 14;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'victoria-sponge.png';
		        $this->view->header = 'victoria sponge cake';
		        $this->view->info = '<p>Image shown: 8&quot; (20 cm) A classic Victoria sponge cake smothered in lashings of butter cream and strawberry jam. <br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular &amp; square cakes.<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, strawberries,  red velvet', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes Victoria sponge is a traditional favourite amongst many people throughout Sheffield.', 'description');
				break;
			
			case 'bathing-hippo':
	    		$cakeId = 15;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'bathing-hippo.png';
		        $this->view->header = 'bathing hippo cake topper';
		        $this->view->info = '<p>Image shown: Hand made marzipan hippo circular cake topper. <br />Price including sponge cake: &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.</p><p>You may wish to personalise the cake &amp; incorporate a message, the message will go on the cake board. <br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Children\'s Cake');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams,1st, 5th, 9th, 11th, celebration, party,children, birthday, football, Sheffield United, teddy, character', 'keywords');
		        $this->view->headMeta('At Sheffield based Hunkydory Cakes we love making Children\'s birthday cakes, the Hippo cake is very popular with children.', 'description');
				break;
			
			case 'kermit':
	    		$cakeId = 16;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'kermit.png';
		        $this->view->header = 'kermit the frog';
		        $this->view->info = '<p>Image shown: head 4&quot; (10 cm) &amp; body 6&quot; (15 cm) sphere sponge cakes. <br />Price: &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.</p><p>You may wish to personalise the cake &amp; incorporate a message, this will be added to the cake board that Kermit sits on.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Children\'s Cake');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams,1st, 5th, 9th, 11th, celebration, party,children, birthday, football, Sheffield United, teddy, character, Kermit', 'keywords');
		        $this->view->headMeta('At Sheffield based Hunkydory Cakes we love making Children\'s birthday cakes, the Kermit cake is very popular with children and adults alike.', 'description');
				break;
			
			case 'the-three-bears':
	    		$cakeId = 17;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'the-three-bears.png';
		        $this->view->header = 'the three bears';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) sponge cake, decorated with a hand made, edible Mummy, Daddy and baby bear sat amongst clusters of flowers.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on top of the cake &amp; on the cake board as shown in the picture. Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Children\'s Cake');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams,1st, 5th, 9th, 11th, celebration, party,children, birthday, football, Sheffield United, teddy, character', 'keywords');
		        $this->view->headMeta('At Sheffield based Hunkydory Cakes we love making Children\'s birthday cakes and the \'Three Bears Picnic\' cake is a big hit.', 'description');
				break;
			
			case 'farmyard':
	    		$cakeId = 18;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'farmyard.png';
		        $this->view->header = 'farmyard cake topper';
		        $this->view->info = '<p>Image shown: Hand made marzipan circular farmyard topper. <br />Prices from &pound;'. number_format($data['min_price'], 2) .' including sponge cake<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on top of the cake or on the cake board.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Children\'s Cake');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams,1st, 5th, 9th, 11th, celebration, party,children, birthday, football, Sheffield United, teddy, character', 'keywords');
		        $this->view->headMeta('At Sheffield based Hunkydory Cakes we make a great \'Farmyard\' themed cake suitable for little boys and girls.', 'description');
				break;
			
			case 'football-themed-2':
	    		$cakeId = 19;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'football-themed-2.png';
		        $this->view->header = 'football themed cake, no. 2';
		        $this->view->info = '<p>Image shown: 8&quot; (20 cm) sponge cake. Decorated with football badge and edible footballs. <br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.</p><p>You may wish to personalise the cake &amp; incorporate a message, this will be added to the red banner that is wrapped round the side of the cake. <br />Any football teams badge can be created, it may be your favourite team or a local team you play for. <br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Children\'s Cake');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams,1st, 5th, 9th, 11th, celebration, party,children, birthday, football, Sheffield United, teddy, character', 'keywords');
		        $this->view->headMeta('At Sheffield based Hunkydory Cakes we love making football birthday cakes, we get a high demand for Sheffield United cakes.', 'description');
				break;
			
			case 'postman-pat':
	    		$cakeId = 20;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'postman-pat.png';
		        $this->view->header = 'postman pat';
		        $this->view->info = '<p>Image shown: 8&quot; (20 cm) sponge cake. Decorated with an edible, hand made marzipan Postman Pat scene.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.</p><p>You may wish to personalise the cake &amp; incorporate a message, this will be added to the top of the cake. <br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Children\'s Cake');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams,1st, 5th, 9th, 11th, celebration, party,children, birthday, football, Sheffield United, teddy, character', 'keywords');
		        $this->view->headMeta('At Sheffield based Hunkydory Cakes we love making Children\'s birthday cakes the \'Postman Pat\' cake is a classic.', 'description');
				break;
			
			case 'pretty-in-pink':
	    		$cakeId = 21;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'christening';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'christening-cakes';
		        $this->view->image = 'pretty-in-pink.png';
		        $this->view->header = 'pretty in pink!';
		        $this->view->info = '<p>Image shown: 14&quot; (36 cm) bottom layer fruit cake, 9&quot; (23 cm) top layer chocolate sponge. The cake is decorated with hand made edible rose buds and lettered iced cake building blocks that spell out the childs name. The childrens booties on top of the cake are a great keepsake. <br />Available in a range of sizes on circular cakes. <br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on the iced cake board. Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Christening Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, children, christening, boy, girl, baby, naming ceremony, sponge cake, fruit cake, pink', 'keywords');
		        $this->view->headMeta('Make a Christening even more special with a beautiful Christening Cake by Sheffield based Hunkydory Cakes.', 'description');
				break;
			
			case 'baby-blue':
	    		$cakeId = 22;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'christening';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'christening-cakes';
		        $this->view->image = 'baby-blue.png';
		        $this->view->header = 'baby blue';
		        $this->view->info = '<p>Image shown: 11&quot; (28 cm) sponge cake, decorated with hand made edible Teddy Bears &amp; letter building blocks that spell out childs name. Childrens booties made from clay dough can be kept as a keepsake. <br />Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on the iced cake board.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Christening Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, children, christening, boy, girl, baby, naming ceremony, sponge cake, fruit cake, pink', 'keywords');
		        $this->view->headMeta('Make a Christening even more special with a beautiful Christening Cake by Sheffield based Hunkydory Cakes.', 'description');
				break;
			
			case 'blossom-and-daisies':
	    		$cakeId = 23;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'christening';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'christening-cakes';
		        $this->view->image = 'blossom-and-daisies.png';
		        $this->view->header = 'blossom &amp; daisies';
		        $this->view->info = '<p>Image shown: Ivory two tiers: 6&quot; (15 cm) and 9&quot; (23 cm).<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on the iced cake board.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Christening Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, children, christening, boy, girl, baby, naming ceremony, sponge cake, fruit cake, daisy', 'keywords');
		        $this->view->headMeta('Make a Christening even more special with a beautiful Christening Cake by Sheffield based Hunkydory Cakes.', 'description');
				break;
			
			
			case 'corporate':
	    		$cakeId = 24;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'corporate';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'corporate-cakes';
		        $this->view->image = 'corporate.gif';
		        $this->view->header = 'corporate';
		        $this->view->info = '<p>Image example: 8&quot; (20cm) circular cake design.<br />Available from 8&quot; (20cm) - 14&quot; (35cm) on both circular and square cakes.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Send us your logo/images and we will transfer them onto icing &amp; place it on the top of your cake.</p><p>Decorated with a matching ribbon and iced cake board.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Corporate Cakes');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, corporate, photographic, photo, photograph, edible, company, delivery', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes deliver Corporate cakes to Sheffield, Chesterfield and South Yorkshire.', 'description');
				break;
			
			case 'in-bloom':
	    		$cakeId = 25;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'in-bloom.png';
		        $this->view->header = 'in bloom';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) square with sugar flowers and iced dots.<br />Prices from: &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on top of the cake as shown in the picture.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, congratulations, celebration, cake, chocolate, Spring, Summer, floral, bloom', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make the perfect girls birthday cake for spring or summer, the \'In Bloom\' cake.', 'description');
				break;
			
			case 'tea-pot':
	    		$cakeId = 26;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'tea-pot.png';
		        $this->view->header = 'time for tea';
		        $this->view->info = '<p>Image shown: 2 tier sponge cake, top tier is a tea pot. Decorations include hand made sugar tea bags. This and variations of it are very popular cakes, there are a lot of tea lovers out there! It is the perfect centerpiece to any tea party!</p><p>At Hunkydory Cakes we try our best to make the cake of your dreams, so tell us exactly what you are after and we will try our best to make it! Most of our cake orders come from people who are after something tailored to their ideas. <br />Please feel free to get in contact for a free no obligation quote &amp; consultation. <br />Our prices will include delivery and set-up within Sheffield, South Yorkshire &amp; the Derbyshire area. If you are wanting a delivery for further afield, please just let us know and we will do our best to cater for you.</p><p>To look at our latest creations or to get more ideas, please take a look at our photographs on the <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes facebook page</a>.</p>';
				$this->view->days_required = $data['days_required'];
		        /**
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				*/
				
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, congratulations, celebration, cake, chocolate, tea pot, tea party, English', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make a beautiful Tea Pot shaped cake.', 'description');
				break;
			
			case 'piano-polk-adot':
	    		$cakeId = 27;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'piano-polk-adot.png';
		        $this->view->header = 'piano polkadot';
		        $this->view->info = '<p>Image shown: 11&quot; (28cm) piano themed birthday cake.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes. <br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on the top of the cake as shown in the picture. <br />Please also specify if you require an edible number on top.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, piano, pianist, music, double clef, music notes, lemon, congratulations, celebration, cake, chocolate', 'keywords');
		        $this->view->headMeta('The ultimate cake for any music lover is Sheffield based Hunkydory Cakes, Piano Polk-adot Cake!', 'description');
				break;
			
			case 'circles-and-rose':
	    		$cakeId = 28;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'circles-and-rose.png';
		        $this->view->header = 'circles and sugar rose';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) circular design with white sugar rose &amp; bud. <br />Prices from: &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on the top of the cake as shown in the picture.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, congratulations, celebration, cake, chocolate, rose', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make the perfect birthday cake for boys and girls.', 'description');
				break;
			
			case 'dolphin-splash':
	    		$cakeId = 29;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'dolphin-splash.png';
		        $this->view->header = 'dolphin splash';
		        $this->view->info = '<p>Image shown: 11&quot; (28cm) square with sugar dolphins and wave design.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular and square cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, the message will go on top of the cake as shown in the picture.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, congratulations, celebration, cake, chocolate, dolphin, splash', 'keywords');
		        $this->view->headMeta('If you like Dolphins then you will love the \'Dolphin Splash\' birthday cake by Sheffield based Hunkydory Cakes.', 'description');
				break;
			
			case 'photo':
	    		$cakeId = 30;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'photo.gif';
		        $this->view->header = 'photo cake';
		        $this->view->info = '<p>Image example: 8&quot; (20cm) circular cake design.<br />Available from 8&quot; (20cm) - 14&quot; (35cm) on both circular and square cakes.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'.<br />Send us your images/photographs &amp; we will print them on to an icing sheet &amp; place it on top of your cake. Design service available.</p><p>Decorated with a matching ribbon and iced cake board.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, congratulations, celebration, cake, chocolate, photo, photograph, printing, edible, photography', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make great photo cakes.', 'description');
				break;
			
			case 'christmas':
	    		$cakeId = 31;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'christmas.png';
		        $this->view->header = 'christmas cake';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) circular.<br />Deluxe fruit cake covered in fondant icing and decorated with hand piped details and embossed icicles. Finished with edible silver balls.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'</p><p>You may wish to personalise the cake and incorporate a message. the message will go onto an iced cake board.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		       	$form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, congratulations, celebration, cake, chocolate, Christmas, Noel, Seasons greetings, snow, fruit cake', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make the ultimate in deluxe fruit Christmas cakes.', 'description');
				break;
			
			case 'zebra-stripes':
	    		$cakeId = 32;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'zebra-stripes.png';
		        $this->view->header = 'zebra stripes &amp; marzipan rose';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) lemon sponge cake<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, this will be hand painted on to the iced paper scroll.<br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, congratulations, celebration, cake, chocolate', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make the perfect girls birthday cake, the ever popular zebra print cake.', 'description');
				break;
			
			case 'daisy-zest':
	    		$cakeId = 33;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'daisy-zest.png';
		        $this->view->header = 'daisy zest';
		        $this->view->info = '<p><!-- --></p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, lemon, congratulations, celebration, cake, chocolate, Summer, daisy', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make the perfect girls birthday cake for spring or summer, the \'Daisy Zest\' cake.', 'description');
				break;
			
			case 'mad-hatters':
	    		$cakeId = 34;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'mad-hatters.png';
		        $this->view->header = 'the topsy turvy mad hatters tea party';
		        $this->view->info = '<p>Image shown: 4 tiered topsy turvy themed cake with edible tea pot, edible sugar playing cards and Mad Hatter themed decorations.<br />10&quot; (25cm), 8&quot; (20cm), 6&quot; (15cm) &amp; 4&quot; (10cm) cakes.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise the cake and incorporate a message, this will be hand painted on to the iced tags.<br />Hunkydory Cakes will assemble cake at destination.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, congratulations, celebration, cake, chocolate, Mad Hatters Tea Party, Alice in Wonderland, Johnny Depp, Cards', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make the ultimate cake for any Mad Hatter themed events or party.', 'description');
				break;
			
			case 'wedding-dress-no1':
	    		$cakeId = 35;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'favours';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'favours';
		        $this->view->image = 'wedding-dress-no1.png';
		        $this->view->header = 'brides dress No.1';
		        $this->view->info = '<p>Image shown: 3.5&quot; x 2.5&quot; (9 x 6 cm), vanilla shortbread.<br />White dress shaped biscuit, coated in royal icing and hand piped detail.<br />These biscuits are bespoke &amp; can be designed to match the brides dress.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of flavours<br />Various colour themes available.</p><p>Favours will be individually packaged in a cellophane bag with matching ribbon tie. Individual name tags also available upon request.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getFavourFlavours(),
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->headTitle('Wedding Favours');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Wedding Cake, fruit cake, bride, groom, sugar flowers, wedding consultation, favours, shortbread, guests, gifts, wedding dress, hearts, rose, dove, peace, delivery, white, ivory', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make beautiful hand made edible wedding favours, we deliver to Sheffield, Chesterfield, Derbyshire and South Yorkshire', 'description');
				$this->view->inlineScript()->appendScript($packed);
			break;
			
			case 'wedding-dress-no2':
	    		$cakeId = 36;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'favours';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'favours';
		        $this->view->image = 'wedding-dress-no2.png';
		        $this->view->header = 'brides dress No.2';
		        $this->view->info = '<p>Image shown: 3.5&quot; x 2.5&quot; (9 x 6 cm), vanilla shortbread.<br />White dress shaped biscuit, coated in royal icing and hand piped detail.<br />These biscuits are bespoke &amp; can be designed to match the brides dress.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of flavours. <br />Various colour themes available.</p><p>Favours will be individually packaged in a cellophane bag with  matching ribbon tie. Individual name tags also available upon request.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getFavourFlavours(),
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Wedding Favours');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Wedding Cake, fruit cake, bride, groom, sugar flowers, wedding consultation, favours, shortbread, guests, gifts, wedding dress, hearts, rose, dove, peace, delivery', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make beautiful hand made edible wedding favours, we deliver to Sheffield, Chesterfield, Derbyshire and South Yorkshire', 'description');
				break;
			
			case 'white-doves':
	    		$cakeId = 37;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'favours';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'favours';
		        $this->view->image = 'white-doves.png';
		        $this->view->header = 'white doves';
		        $this->view->info = '<p>Image shown: 4&quot; x 2&quot; (11 x 6 cm). <br />White dove shaped biscuit with hand piped royal icing.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of flavours.<br />Various colour themes available.</p><p>Favours will be individually packaged in a cellophane bag with  matching ribbon tie. Individual name tags also available upon request.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getFavourFlavours(),
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Wedding Favours');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Wedding Cake, fruit cake, bride, groom, sugar flowers, wedding consultation, favours, shortbread, guests, gifts, wedding dress, hearts, rose, dove, peace, delivery', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make beautiful hand made edible wedding favours, we deliver to Sheffield, Chesterfield, Derbyshire and South Yorkshire', 'description');
				break;
			
			case 'red-rose':
	    		$cakeId = 38;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'favours';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'favours';
		        $this->view->image = 'red-rose.png';
		        $this->view->header = 'red rose';
		        $this->view->info = '<p>Image shown: 3.5&quot; x 2.5&quot; (9 x 6 cm), Heart shaped biscuits coated in royal icing &amp; hand piped detail decorated with dots &amp; a single rose.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of flavours. <br />Various colour themes available.</p><p>Favours will be individually packaged in a cellophane bag with matching ribbon tie. Individual name tags also available upon request.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getFavourFlavours(),
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        	self::CAKE_FAVOUR_CHOICE_KEY => array('1' => 'Number 1', '2' => 'Number 2')
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$this->view->headTitle('Wedding Favours');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Wedding Cake, fruit cake, bride, groom, sugar flowers, wedding consultation, favours, shortbread, guests, gifts, wedding dress, hearts, rose, dove, peace, delivery', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make beautiful hand made edible wedding favours, we deliver to Sheffield, Chesterfield, Derbyshire and South Yorkshire', 'description');
				break;
			
			case 'gingham-heart':
	    		$cakeId = 39;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'favours';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'favours';
		        $this->view->image = 'gingham-heart.png';
		        $this->view->header = 'gingham heart';
		        $this->view->info = '<p>Image shown: 3&quot; x 3&quot; (7.5 x 7.5 cm), chocolate shortbread.<br />Heart shaped biscuit with gingham icing.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of flavours.<br />Various colour themes available.</p><p>Favours will be individually packaged in a cellophane bag with matching ribbon tie. Individual name tags also available upon request.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getFavourFlavours(),
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Wedding Favours');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Wedding Cake, fruit cake, bride, groom, sugar flowers, wedding consultation, favours, shortbread, guests, gifts, wedding dress, hearts, rose, dove, peace, delivery', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make beautiful hand made edible wedding favours, we deliver to Sheffield, Chesterfield, Derbyshire and South Yorkshire', 'description');
				break;
			
			case 'dots-of-love':
	    		$cakeId = 40;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'favours';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'favours';
		        $this->view->image = 'dots-of-love.png';
		        $this->view->header = 'dots of love';
		        $this->view->info = '<p>Image shown: 3.5&quot; x 2.5&quot; (9 x 6 cm), chocolate shortbread.<br />Heart shaped biscuits coated in royal icing, hand piped detail decorated in dots &amp; hand piped &quot;Love&quot;.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of flavours. <br />Various colour themes available.</p><p>Favours will be individually packaged in a cellophane bag with  matching ribbon tie. Individual name tags also available upon request.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
				$form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getFavourFlavours(),
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        	self::CAKE_FAVOUR_CHOICE_KEY => array('favour_choice' => array('1' => 'Number 1', '2' => 'Number 2'))
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Wedding Favours');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Wedding Cake, fruit cake, bride, groom, sugar flowers, wedding consultation, favours, shortbread, guests, gifts, wedding dress, hearts, rose, dove, peace, delivery', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make beautiful hand made edible wedding favours, we deliver to Sheffield, Chesterfield, Derbyshire and South Yorkshire', 'description');
				break;
			
			case 'peace-and-love':
	    		$cakeId = 41;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'favours';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'favours';
		        $this->view->image = 'peace-and-love.png';
		        $this->view->header = 'peace &amp; love';
		        $this->view->info = '<p>Image shown: 3&quot; x 3&quot; (7.5 x 7.5cm).<br />Chocolate shortbread heart shaped polkadot &amp; peace decorated biscuits.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of flavours.<br />Various colour themes available.</p><p>Favours will be individually packaged in a cellophane bag with  matching ribbon tie. Individual name tags also available upon request.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getFavourFlavours(),
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        	self::CAKE_FAVOUR_CHOICE_KEY => array('favour_choice' => array('1' => 'Number 1', '2' => 'Number 2'))
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Wedding Favours');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Wedding Cake, fruit cake, bride, groom, sugar flowers, wedding consultation, favours, shortbread, guests, gifts, wedding dress, hearts, rose, dove, peace, delivery', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make beautiful hand made edible wedding favours, we deliver to Sheffield, Chesterfield, Derbyshire and South Yorkshire', 'description');
				break;
			
			case 'classic-collection-no1':
	    		$cakeId = 42;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'classic-collection-no1.png';
		        $this->view->header = 'classic collection: No. 1';
		        $this->view->info = '<p>Image shown: 12&quot; (30cm), 10&quot; (25cm), 8&quot; (20cm)<br />Ivory cakes with sugar rose topper &amp; diamante detail with pearl decoration.<br />Base layer fruit cake, middle &amp; top layer sponge cake - flavours your choice.<br />Prices from &pound;430.00<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.<br />Price includes cake assembly and delivery.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('Sheffield based HUNKYDORY Cakes cake designer Anna Williams has a passion for fashionable, luxurious and couture wedding cakes.', 'description');
				
			break;
			
			case 'classic-collection-no2':
	    		$cakeId = 43;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'classic-collection-no2.png';
		        $this->view->header = 'classic collection: No. 2';
		        $this->view->info = '<p>Image shown: 14&quot; (35cm), 12&quot; (30cm), 10&quot; (25cm), 8&quot; (20cm)<br />Ivory cakes with hand piped detail with pink bow decoration.<br />Base layer fruit cake, middle two layers &amp; top layer sponge cake - flavours your choice.<br />Prices from &pound;460.00<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.<br />Price includes cake assembly and delivery.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('Sheffield based HUNKYDORY Cakes cake designer Anna Williams has a passion for fashionable, luxurious and couture wedding cakes.', 'description');
				
			break;
			
			case 'contemporary-collection-no1':
	    		$cakeId = 44;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'contemporary-collection-no1.png';
		        $this->view->header = 'contemporary collection: No. 1';
		        $this->view->info = '<p>Image shown: 11&quot; (27cm), 8&quot; (20cm), 6&quot; (15cm)<br />Ivory cakes with brown dots &amp; pink bow decoration.<br />Base layer fruit cake, middle layer &amp; top layer sponge cake - flavours your choice.<br />Prices from &pound;400.00<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.<br />Price includes cake assembly and delivery.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('Sheffield based HUNKYDORY Cakes cake designer Anna Williams has a passion for fashionable, luxurious and couture wedding cakes.', 'description');
				
			break;
			
			case 'contemporary-collection-no2':
	    		$cakeId = 45;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'contemporary-collection-no2.png';
		        $this->view->header = 'contemporary collection: No. 2';
		        $this->view->info = '<p>Image shown: 12&quot; (30cm), 10&quot; (25cm), 8&quot; (20cm), 6&quot; (15cm)<br />Ivory cakes with hand made sugar blossom &amp; flower decoration.<br />Base layer fruit cake, two middle layers &amp; top layer sponge cake - flavours your choice.<br />Prices from &pound;450.00<br />Available in a range of sizes on circular cakes. <br />Various colour themes available.<br />Price includes cake assembly and delivery.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('Sheffield based HUNKYDORY Cakes cake designer Anna Williams has a passion for fashionable, luxurious and couture wedding cakes.', 'description');
				
			break;
			
			case 'flower-collection-no1':
	    		$cakeId = 46;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'flower-collection-no1.png';
		        $this->view->header = 'flower collection: No. 1';
		        $this->view->info = '<p>Image shown: 12&quot; (30cm), 10&quot; (25cm), 8&quot; (20cm)<br />Ivory cakes with fresh flowers and blossom detail.<br />Base layer fruit cake, middle &amp; top layer sponge cake - flavours your choice.<br />Prices from &pound;450.00, plus fresh/silk flowers.<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.<br />Price includes cake assembly and delivery.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('Sheffield based HUNKYDORY Cakes cake designer Anna Williams has a passion for fashionable, luxurious and couture wedding cakes.', 'description');
				
			break;
			
			case 'flower-collection-no2':
	    		$cakeId = 47;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'flower-collection-no2.png';
		        $this->view->header = 'flower collection: No. 2';
		        $this->view->info = '<p>Image shown: 11&quot; (30cm), 9&quot; (25cm), 6&quot; (20cm) <br />White cakes with fresh flowers topper and small rose bud detail.<br />Base layer fruit cake, middle &amp; top layer sponge cake - flavours your choice.<br />Prices from &pound;400.00, plus fresh/silk flower topper.<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.<br />Price includes cake assembly and delivery.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('Sheffield based HUNKYDORY Cakes cake designer Anna Williams has a passion for fashionable, luxurious and couture wedding cakes.', 'description');
				
			break;
			
			case 'flower-collection-no3':
	    		$cakeId = 48;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'flower-collection-no3.png';
		        $this->view->header = 'flower collection: No. 3';
		        $this->view->info = '<p>Image shown: 10&quot; (25cm), 8&quot; (20cm), 6&quot; (15cm) <br />Ivory cakes with fresh flowers topper and hand piped detail.<br />Base layer fruit cake, middle &amp; top layer sponge cake - flavours your choice.<br />Prices from &pound;400.00, plus fresh/silk flower topper.<br />Available in a range of sizes on circular cakes.<br />Various colour themes available.<br />Price includes cake assembly and delivery.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('Sheffield based HUNKYDORY Cakes cake designer Anna Williams has a passion for fashionable, luxurious and couture wedding cakes.', 'description');
				
			break;
			
			case 'bespoke-cupcake':
	    		$cakeId = 49;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'bespoke-cupcake.png';
		        $this->view->header = '';
		        $this->view->info = '<p>We will do our best to create any cupcake you would like, so if you would like something a little different just give us a call on 0114 266 4573 or email us at enquiries@hunkydory.co.uk.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable', 'keywords');
		        $this->view->headMeta('Sheffield\'s Hunkydory Cakes will create bespoke cupcakes just how you want them.', 'description');
				
			break;
			
			case 'blueberry-burst':
	    		$cakeId = 50;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'blueberry-burst.png';
		        $this->view->header = 'blueberry burst';
		        $this->view->info = '<p>Image shown: Vanilla sponge cupcake topped with lashings of vanilla cream cheese icing &amp; blueberries. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, blueberry, frosting', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes love cupcakes - try our \'Blueberry Burst\' cupcake, we can deliver by hand to your door.', 'description');
				break;
			
			case 'bonbons':
	    		$cakeId = 51;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'bonbons.png';
		        $this->view->header = 'bonbons';
		        $this->view->info = '<p>Image shown: Vanilla sponge cupcake topped with vanilla frosting with coloured balls &amp; fudge decoration. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make delicious, unique, fashionable cupcakes.', 'description');
				break;
			
			case 'cherry-on-top':
	    		$cakeId = 52;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'cherry-on-top.png';
		        $this->view->header = 'the cherry on top';
		        $this->view->info = '<p>Image shown: Vanilla sponge cupcake topped with vanilla flavoured butter icing and a glacier cherry. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, icing, cherry', 'keywords');
		        $this->view->headMeta('Sheffield\'s Hunkydory Cakes make perfect cupcakes.', 'description');
				break;
			
			case 'black-forest':
	    		$cakeId = 53;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'black-forest.png';
		        $this->view->header = 'black forest';
		        $this->view->info = '<p>Image shown: Chocolate sponge topped with chocolate butter frosting &amp; a cherry on the top. Presented in a ribboned card cupcake box. </p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, cherry', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make delicious, unique, fashionable cupcakes and deliver within Sheffield and the surrounding area.', 'description');
				break;
			
			case 'chocolate-cookie':
	    		$cakeId = 54;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'chocolate-cookie.png';
		        $this->view->header = 'chocolate cookie';
		        $this->view->info = '<p>Image shown: Chocolate sponge cupcake topped with a chocolate frosting &amp; sprinklings of cookie. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday', 'keywords');
		        $this->view->headMeta('If you love cupcakes and cookies... then you must try the Chocolate Cookie Cupcake by Sheffield based Hunkydory Cakes.', 'description');
				break;
			
			case 'chocolate-cupcake':
	    		$cakeId = 55;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'chocolate-cupcake.png';
		        $this->view->header = 'chocolate';
		        $this->view->info = '<p>Image shown: Chocolate sponge cupcake topped with chocolate frosting and chocolate bits. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, chocolate, frosting', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes love cupcakes - try our \'Chocolate\' cupcake, we can deliver by hand to your door.', 'description');
				break;
			
			case 'dairy-fudge':
	    		$cakeId = 56;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'dairy-fudge.png';
		        $this->view->header = 'dairy fudge';
		        $this->view->info = '<p>Image shown: Vanilla sponge cupcake topped with lashings of dairy vanilla butter icing &amp; fudge.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, fudge', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes is the place to buy your cupcakes in Sheffield.', 'description');
				break;
			
			case 'dotty':
	    		$cakeId = 57;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'dotty.png';
		        $this->view->header = 'dotty';
		        $this->view->info = '<p>Image shown: Chocolate sponge cupcake topped with red frosting &amp; sugar black dots. If you would llike a different colour to red, please give us a call on 0114 266 4573 or dop us an email at <a href="mailto:enquiries@hunkydorycakes.co.uk">enquiries@hunkydorycakes.co.uk</a>. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, funky', 'keywords');
		        $this->view->headMeta('Funky cupcakes designed by Sheffield based Hunkydory Cakes.', 'description');
				break;
			
			case 'double-decker':
	    		$cakeId = 58;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'double-decker.png';
		        $this->view->header = 'double decker';
		        $this->view->info = '<p>Image shown: Chocolate sponge cupcake topped with an extra dollop of vanilla &amp; chocolate flavoured butter icing. This cupcake is perfect for people that love icing! Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, icing', 'keywords');
		        $this->view->headMeta('If you love cupcakes then you will love Sheffield based Hunkydory Cakes.', 'description');
				break;
			
			case 'football':
	    		$cakeId = 59;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'football.png';
		        $this->view->header = 'football';
		        $this->view->info = '<p>Image shown: Mixed box of footbal themed cupcakes. Options available are handmade football team flags and sugar football cupcake toppers. Presented in a ribboned card cupcake box. Please give Anna a call to discuss your \'Football\' cupcake options on 0114 2664573 or email her at <a href="mailto:enquires@hunkydorycakes.co.uk">enquires@hunkydorycakes.co.uk</a></p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, Sheffield United, football, teams', 'keywords');
		        $this->view->headMeta('Bespoke football themed cupcakes by Sheffield based Hunkydory Cakes.', 'description');
				break;
			
			case 'i-heart-u':
	    		$cakeId = 60;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'i-heart-u.png';
		        $this->view->header = 'i heart u';
		        $this->view->info = '<p>Image shown: Vanilla sponge cupcake topped with vanilla flavoured butter icing and sugar \'I heart u\'. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, valentines day, love, kitch, vintage', 'keywords');
		        $this->view->headMeta('The best way to I love you is with this kitsch cupcake by Hunkydory Cakes.', 'description');
				break;
			
			case 'mint-choc':
	    		$cakeId = 61;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'mint-choc.png';
		        $this->view->header = 'mint choc';
		        $this->view->info = '<p>Image shown: Chocolate sponge cupcake topped with vanilla mint flavoured butter icing and an after dinner mint. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, after eight, mint choc chip', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make tasty \'Mint Choc-Chip\' cupcakes and deliver within Sheffield and the surrounding area.', 'description');
				break;
			
			case 'oreo':
	    		$cakeId = 62;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'oreo.png';
		        $this->view->header = 'oreo';
		        $this->view->info = '<p>Image shown: Chocolate sponge cupcake topped with an Oreo frosting &amp; Oreo biscuit. Ideal for any Oreo lover! Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, icing', 'keywords');
		        $this->view->headMeta('If you love cupcakes then you will love Sheffield based Hunkydory Cakes.', 'description');
				break;
			
			case 'pretty-in-pink-cupcake':
	    		$cakeId = 63;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'pretty-in-pink-cupcake.png';
		        $this->view->header = 'pretty in pink';
		        $this->view->info = '<p>Image shown: Pink vanilla sponge cupcake topped with pink vanilla flavoured butter icing and sprinkles. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, girlie, pink', 'keywords');
		        $this->view->headMeta('Every little girl will love the Pretty in Pink cupcake by Sheffield based Hunkydory Cakes.', 'description');
				break;
			
			case 'red-velvet-cupcake':
	    		$cakeId = 64;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'red-velvet-cupcake.png';
		        $this->view->header = 'red velvet';
		        $this->view->info = '<p>Image shown: Red vanilla sponge with a hint of chocolate, topped with cream cheese frosting.  Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes love cupcakes - try our \'Red Velvet\' cupcake, we can deliver by hand to your door.', 'description');
				break;
			
			case 'fragola':
	    		$cakeId = 65;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'fragola.png';
		        $this->view->header = 'fragola';
		        $this->view->info = '<p>Image shown: Vanilla sponge cupcake topped with a cream cheese frosting &amp; pink sugar with fresh strawberry decoration. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, stawberry', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make delicious, unique, fashionable cupcakes.', 'description');
				break;
			
			case 'top-trumps':
	    		$cakeId = 66;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'top-trumps.png';
		        $this->view->header = 'top trumps';
		        $this->view->info = '<p>Image shown: Vanilla sponge cupcake topped with vanilla flavoured butter icing and a sugar suit. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, cards, casino, gambling', 'keywords');
		        $this->view->headMeta('The Top Trumps cupcakes by Sheffield based Hunkydory Cakes, are essential for any casino themed party.', 'description');
				break;
			
			case 'vanilla':
	    		$cakeId = 67;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'vanilla.png';
		        $this->view->header = 'vanilla';
		        $this->view->info = '<p>Image shown: Vanilla sponge cupcake topped with vanilla flavoured butter icing. Presented in a ribboned card cupcake box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, vanilla, classic', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes classic Vanilla cupcake tastes divine!', 'description');
				break;
			
			case 'wedding-cupcake':
	    		$cakeId = 68;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'wedding-cupcake.png';
		        $this->view->header = 'wedding cupcakes';
		        $this->view->info = '<p>Image shown: Vanilla sponge cupcake topped with a mascarpone frosting &amp; handmade sugar roses. These cupcakes are truly exquisite!</p><p>Hunkydory Cakes offer many different cupcake creations tailored to suit your wedding, so please get in contact to find out what we can offer you. We provide a delivery and set up service covering Sheffield, South Yorkshire and the Derbyshire area. We can cover other areas if you are getting married further afield.</p><p>Please give Anna at Hunkydory Cakes a call on 0114 266 4573 or email enquiries@hunkydorycakes.co.uk to arrange wedding cupcake orders.</p>';
		 		$this->view->days_required = $data['days_required'];
		 		/**
				$this->view->orderFormText = '<p>Please give Hunkydory Cakes a call on 0114 266 4573 or email <a href="mailto:enquiries@hunkydorycakes.co.uk">enquiries@hunkydorycakes.co.uk</a> to arrange wedding cupcake orders.</p>';
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				*/
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, classic, classy, white, wedding, ivory, vintage', 'keywords');
		        $this->view->headMeta('Hunkydory Cakes make spectacular, couture wedding cupcakes!', 'description');
				break;
			
			case 'colins-cake':
	    		$cakeId = 69;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'colins-cake.png';
		        $this->view->header = 'colin\'s cake';
		        $this->view->info = '<p>Image shown: 12&quot; (28cm) fruit cake, 8&quot; (20cm) sponge cake &amp; 6&quot; (15cm) sponge cake. 3 tiered bespoke 60th Birthday cake. Handmade sugar decorations &amp; model of Colin. Please send through a photograph of the person you would like a model of.<br />Prices from &pound;'. number_format($data['min_price'], 2) .'<br />Available in a range of sizes on circular cakes.<br />Themes &amp; characters tailored to suit your chosen theme.</p><p>You may wish to personalise the cake and incorporate a message.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, congratulations, celebration, cake, chocolate, bespoke, custom made, designed', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes will make any cake you like, we love creating couture, bespoke cakes.', 'description');
				break;
				
				case 'english-garden':
	    		$cakeId = 70;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'english-garden.png';
		        $this->view->header = 'english garden';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) lemon sponge cake with handmade sugar roses, rose buds &amp; leaves. Available in a range of sizes on circular cakes. Various colour themes available. <br /><br />You may wish to personalise the cake and incorporate a message, this will be hand written on to the iced paper scroll.<br /><br />Presented in a white ribboned box.</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, Party, birthday, couture, 21st, 60th, 40th, congratulations, celebration, cake, chocolate, bespoke, custom made, designed', 'keywords');
		        $this->view->headMeta('', 'description');
				break;
				
				case 'chocolate-cigarello':
	    		$cakeId = 71;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'chocolate-cigarello.png';
		        $this->view->header = 'chocolate cigarello';
		        $this->view->info = '<p>Image shown: 3 tiers  6&quot; (15cm) 9&quot; (22cm) 12&quot; (30cm)<br />Belgian chocolate cigarellos covering a choice of sponge cake/cakes.<br />Flavours include: Lemon and poppy seed, chocolate, coffee, mocha, vanilla, caramel and red velvet.<br />Topped with fresh strawberries and raspberries decorated with splashes of white chocolate. To add to the decadence real edible gold leaf is used to decorate some of the strawberries.<br />This cake is available in one, two and three tiers.<br />Price: 3 tiers  6&quot; (15cm) 9&quot; (22cm) 12&quot; (30cm) &pound;300<br />Price: 11&quot; (28cm) &pound;85.</p><p>Available in a range of sizes on square &amp; circular cakes.<br />Various colour themes available.</p><p>Price includes cake assembly and delivery within Sheffield.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('', 'description');
				
			break;
			
			case 'deluxe-choc-box':
	    		$cakeId = 72;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'deluxe-choc-box.png';
		        $this->view->header = 'deluxe chocolate box';
		        $this->view->info = '<p>Image shown: 12 double chocolate sponge cupcakes topped with chocolate butter cream and chunks of white chocolate, fresh strawberries, chocolate orange segment with fresh orange zest, Oreo\'s and top quality cocoa. This cupcake box is the perfect gift for any chocoholic!</p>';
				$this->view->days_required = $data['days_required'];
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(true),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices('deluxe');
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, vanilla, classic', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes classic Vanilla cupcake tastes divine!', 'description');				
		        break;
		        
		        
			
			case 'gluten-free-box':
	    		$cakeId = 73;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'gluten-free-box.png';
		        $this->view->header = 'gluten free box';
		        $this->view->info = '<p>Image shown: 12 gluten free sponge cupcakes topped with vanilla butter cream and decorated with fresh strawberries, white chocolate shavings, sprinkles and sugar hearts.</p>';
				$this->view->days_required = $data['days_required'];
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(true),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices('gluten-free');
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, vanilla, classic', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes classic Vanilla cupcake tastes divine!', 'description');				
		        break;
		        
		    case 'vintage-lace':
	    		$cakeId = 75;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'vintage-lace.png';
		        $this->view->header = 'vintage lace';
		        $this->view->info = '<p>Image shown: 6&quot;, 8&quot; and 10&quot; pink and ivory lace detail tiered cake with 1&quot; ivory seperators.<br />Available for fruit and sponge cakes.</p><p>Available in a range of sizes on circular cakes.<br />Various colour themes available.</p><p>You may wish to personalise your cake to stay in keeping with the theme of your wedding. There are also a huge variety of wedding cake toppers available.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('', 'description');
				
			break;
		        
		    case 'dots-stripes-and-hearts':
	    		$cakeId = 76;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'dots-stripes-and-hearts.png';
		        $this->view->header = 'dots, stripes &amp; hearts';
		        $this->view->info = '<p>Image shown: 6&quot;, 8&quot; and 12&quot; Ivory cakes with green and yellow dots, stripes and hearts.<br />Available for fruit and sponge cakes.</p><p>Available in a range of sizes on circular and square cakes.<br />Various colour themes available.</p><p>You may wish to personalise your cake to stay in keeping with the theme of your wedding. There are also a huge variety of wedding cake toppers available.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('', 'description');
				
			break;
		        
		    case 'under-the-sea':
	    		$cakeId = 77;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'under-the-sea.png';
		        $this->view->header = 'under the sea';
		        $this->view->info = '<p>Image shown: 4 tier wedding cake &quot;Under the Sea&quot; theme.<br />Bottom layer fruit cake and 3 sponge cakes.</p><p>Available in a range of sizes on circular and square cakes.</p><p>All aspects of the cake are handmade and edible, including edible sand, coral and tropical fish!</p><p>If this cake has inspired you to have an unconventional wedding cake, please give us a call on 0114 2664573 or email enquiries@hunkydorycakes.co.uk to discuss your ideas.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('', 'description');
				
			break;
		        
		    case 'cupcake-tower':
	    		$cakeId = 78;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'cupcake-tower.png';
		        $this->view->header = 'cupcake tower';
		        $this->view->info = '<p>Image shown: Cupcake towers are very popular for weddings, each guest can enjoy their very own cupcake. A Hunkydory Cakes Cupcake Tower adds an elegant and stylish edge to your wedding.</p><p>Hunkydory Cakes offer many different cupcake creations tailored to suit your wedding, so please get in contact to find out what we can offer you. We provide a delivery and set up service covering Sheffield, South Yorkshire and the Derbyshire area. We can cover other areas if you are getting married further afield.</p><p>Please give Anna at Hunkydory Cakes a call on 0114 266 4573 or email enquiries@hunkydorycakes.co.uk to arrange wedding cupcake orders.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('', 'description');
				
			break;
		        
		    case 'minnie-mouse':
	    		$cakeId = 79;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'children';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'minnie-mouse.png';
		        $this->view->header = 'minnie mouse';
		        $this->view->info = '<p>Image shown: Chocolate sponge cake face and vanilla sponge cake ears. <br />More flavour combinations available on request.</p><p>Child\'s name/personal message can be added.<br />Price: &pound;75.00*</p><p>Presented in a white ribboned box. <br />Mickey Mouse version also available.</p><p>All our cakes are freshly baked and made specific to your needs.<br />At Hunkydory Cakes we pride ourselves on making bespoke cakes tailored to your ideas.</p><p>To place an order please call us on 0114 2664573 or email enquiries@hunkydorycakes.co.uk</p><p>*price excludes fruit cake</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Childrens Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('', 'description');
				
			break;
		        
		    case 'bespoke-version-1':
	    		$cakeId = 80;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'bespoke-version-1.png';
		        $this->view->header = 'bespoke cakes';
		        $this->view->info = '<p>Image shown: 12&quot; (28cm) Chocolate cake, 8&quot; (20cm) Vanilla sponge cake &amp; 6&quot; (15cm) Chocolate sponge cake. <br />3 tiered bespoke 18th Birthday cake with handmade sugar decorations.</p><p>At Hunkydory Cakes we try our best to make the cake of your dreams, so tell us exactly what you are after and we will try our best to make it! Most of our cake orders come from people who are after something tailored to their ideas. <br />Please feel free to get in contact for a free no obligation quote &amp; consultation. <br />Our prices will include delivery and set-up within Sheffield, South Yorkshire &amp; the Derbyshire area. If you are wanting a delivery for further afield, please just let us know and we will do our best to cater for you.</p><p>To look at our latest creations or to get more ideas, please take a look at our photographs on the <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes facebook page</a>.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('', 'description');
				
			break;
		        
		    case 'bespoke-version-2':
	    		$cakeId = 81;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'bespoke-version-2.png';
		        $this->view->header = 'bespoke cakes';
		        $this->view->info = '<p>Image shown: 3 tiered bespoke Retirement cake with handmade sugar decorations.</p><p>At Hunkydory Cakes we try our best to make the cake of your dreams, so tell us exactly what you are after and we will try our best to make it! Most of our cake orders come from people who are after something tailored to their ideas. <br />Please feel free to get in contact for a free no obligation quote &amp; consultation. <br />Our prices will include delivery and set-up within Sheffield, South Yorkshire &amp; the Derbyshire area. If you are wanting a delivery for further afield, please just let us know and we will do our best to cater for you.</p><p>To look at our latest creations or to get more ideas, please take a look at our photographs on the <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes facebook page</a>.</p>';
				$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('', 'description');
				
			break;
		        
		    case 'cowboy':
	    		$cakeId = 82;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'children';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'cowboy-cake.png';
		        $this->view->header = 'cowboy cake';
		        $this->view->info = '<p>Image shown: 2 tiered cake bottom tier 11&quot; (20 cm) Vanilla sponge cake, top tier 8&quot; chocolate sponge cake. Decorated with edible, hand made sugar neckscarf, hat, sheriff badge and belt.</p><p>Available in a range of sizes on circular cakes.</p><p>At Hunkydory Cakes we try our best to make the cake of your dreams, so tell us exactly what you are after and we will try our best to make it! Most of our cake orders come from people who are after something tailored to their ideas. <br />Please feel free to get in contact for a free no obligation quote &amp; consultation. <br />Our prices will include delivery and set-up within Sheffield, South Yorkshire &amp; the Derbyshire area. If you are wanting a delivery for further afield, please just let us know and we will do our best to cater for you.</p><p>To look at our latest creations or to get more ideas, please take a look at our photographs on the <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes facebook page</a>.</p>';
		  		$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Childrens Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('', 'description');
		    				
			break;
		        
		    case 'in-the-night-garden':
	    		$cakeId = 83;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'children';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'in-the-night-garden.png';
		        $this->view->header = 'in the night garden';
		        $this->view->info = '<p>Image shown: 11&quot; (20 cm) Vanilla sponge cake. <br />Decorated with edible, hand made sugar &quot;In the Night Garden&quot; characters.</p><p>Child\'s name/personal message can be added.</p><p>Price: &pound;75.00*</p><p>Available in a range of sizes on circular cakes.</p><p>Presented in a white ribboned box.</p><p>*price excludes fruit cake</p>';
		         // Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_INSCRIPTION_KEY => true,
		        	self::CAKE_FLAVOURS_KEY => $this->_product->getAllFlavours(),
		        	self::CAKE_FILLINGS_KEY => $this->_product->getAllFillings(),
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
		        
		        
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				
		  		$this->view->days_required = $data['days_required'];
				$this->view->headTitle('Childrens Cakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, derbyshire, Hunkydory Cakes, Anna Williams, Wedding, Birthday, Anniversary, Party, Cupcake, Couture, Special occasion, fruit cake, sponge, chocolate, white, ivory', 'keywords');
		        $this->view->headMeta('', 'description');
		    				
			break;
			
			case 'baby-shower-cupcake':
	    		$cakeId = 84;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'baby-shower.png';
		        $this->view->header = 'baby shower cupcakes';
		        $this->view->info = '<p>Image shown: Mixed box of 12 cupcakes with baby feet and nappy pin decoration. <br />Available in baby blue or light pink. This is the perfect gift for a baby shower party.</p><p>Or, for a new mum to share with all her visitors. <br />Presented in a ribboned card cupcake box.</p><p>Baby Shower cupcakes are available for collection or can be hand delivered within Sheffield, Chesterfield &amp; Derbyshire. Please call Hunkydory Cakes on 0114 2664573 or email enquiries@hunkydorycakes.co.uk to place your order.</p><p>Hunkydory Cakes bakes all cupcake orders on the same day as delivery, we offer a bespoke service, so if there is anything you would like tailored please just let us know. If you would like specific cupcake flavours we will do our very best to deliver!</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(true),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices('baby-shower');
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, vanilla, classic', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes classic Vanilla cupcake tastes divine!', 'description');
				break;
			
			case 'cat-themed-minicupcakes':
	    		$cakeId = 85;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'cat-themed.png';
		        $this->view->header = 'cat themed minicupcakes';
		        $this->view->info = '<p>Image shown: Cat themed mini cupcakes.<br />This is the perfect gift for any cat lover. <br />Presented in a ribboned card cupcake box.</p><p>Cat themed mini cupcake are available for collection or can be hand delivered within Sheffield, Chesterfield &amp; Derbyshire. Please call Hunkydory Cakes on 0114 2664573 or email enquiries@hunkydorycakes.co.uk to place your order.</p><p>Hunkydory Cakes bakes all cupcake orders on the same day as delivery, we offer a bespoke service, so if there is anything you would like tailored, please just let us know. If you would like specific cupcake flavours we will do our very best to deliver!</p>';
				$this->view->days_required = $data['days_required'];
		        /**
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(true),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices('baby-shower');
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				*/
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, vanilla, classic', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes classic Vanilla cupcake tastes divine!', 'description');
				break;
			
			case 'mixed-box-cupcakes':
	    		$cakeId = 86;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'cupcakes';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'cupcakes';
		        $this->view->image = 'mixed-box-cupcakes.png';
		        $this->view->header = 'mixed box';
		        $this->view->info = '<p>Image shown: The mixed cupcakes box is a selection of our current most popular cupcakes. This cupcake box is the perfect gift for any cupcake lover! <br />All our cupcakes are baked on the same morning of collection/delivery, our cakes are always fresh and delicious!</p>';
				$this->view->days_required = $data['days_required'];
		        
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_QTY_KEY => $this->_product->getDozenQty(),
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $form->getElement('os6')->setLabel('Number of cupcakes');
		        $this->view->orderForm = $form;
		        
				$prices = $this->_product->getCupCakePrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
				
				$this->view->headTitle('Cupcakes');
				$this->view->headTitle($data['title']);
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, celebration, party, cupcakes, bespoke, couture, red velvet, chocolate, butter cream, delivery, fancie, fashionable, frosting, birthday, vanilla, classic', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes classic Vanilla cupcake tastes divine!', 'description');
				break;
				
			case 'apple-crumble':
				$cakeId = 88;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'apple-crumble.png';
		        $this->view->header = 'Buttery Apple Crumble Cake';
		        $this->view->info = '<p>Image shown: 9&quot; (23cm) Buttery apple crumble cake with chunks<br />Price: &pound;28.00<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
		        
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, coffee, cappuccino,  red velvet', 'keywords');
		        $this->view->headMeta('You really should try Hunkydory Cakes Capuccion cake it is delicious.', 'description');
				break;
				
			case 'get-well-soon':
				$cakeId = 89;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'get-well-soon.png';
		        $this->view->header = 'Get Well Soon Cake!';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) round chocolate cake with sugar inscription.<br />Please feel free to add your own message.<br /><br />The perfect way to show someone you are thinking of them when they are unwell. It is sure to put a smile on their face!<br />Price: &pound;27.00<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
		        
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, coffee, cappuccino,  red velvet', 'keywords');
		        $this->view->headMeta('You really should try Hunkydory Cakes Capuccion cake it is delicious.', 'description');
				break;
				
			case 'carrot':
				$cakeId = 90;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'basic-cakes';
		        $this->view->image = 'carrot.png';
		        $this->view->header = 'Crunchy Caramel Carrot Cake';
		        $this->view->info = '<p>Image shown: 8&quot; (20cm) square moist carrot cake. Packed with juicy raisins, cinnamon, ginger and a cream cheese topping. Finished with a generous helping of homemade crunchy caramel and pumpkin seed shards.<br />Price: &pound;28.00<br />Cake is presented in a white box with ribbon.</p>';
				$this->view->days_required = $data['days_required'];
				// Order Form
		        $form = new HC_Form_OrderForm();
		        $formOptions = array(
		        	self::CAKE_SIZE_KEY => $this->_product->getSizes()
		        );
		        $form->setProductData(array_merge($data, $formOptions));
		        $this->view->orderForm = $form;
				$prices = $this->_product->getAllPrices();
				$packer = new HC_Model_Javascriptpacker("$(function() { $('#datepicker').datepicker({ minDate: +". $this->_product->workingDays($data['days_required']) ." , showOn: 'button' , buttonImage: '/images/calendar.gif' , buttonImageOnly: true , dateFormat: 'dd MM yy' })}); var prices = ". json_encode($prices));
				$packed = $packer->pack();
				$this->view->inlineScript()->appendScript($packed);
		        
				$this->view->headTitle('Basics');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, coffee, cappuccino,  red velvet', 'keywords');
		        $this->view->headMeta('You really should try Hunkydory Cakes Capuccion cake it is delicious.', 'description');
				break;
				
			case 'graffitti':
				$cakeId = 91;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'basics';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'graffitti.png';
		        $this->view->header = 'graffiti cake';
		        $this->view->info = '<p>Image shown: 3 x tier vanilla sponge, lemon and chocolate sponge cake.<br /><br />Decorated with edible, hand made sugar spray cans, graffiti tags, graffiti spray painted walls and a retro ghetto blaster. Let us know the graffiti and tags you would like adding and we can make it out of your own messages.<br />Topped off, with a 4&quot; cake cap with the birthday boys age on it. <br />This cake would add the WOW factor to any child\'s birthday party!<br /><br />At Hunkydory Cakes we try our best to make the cake of your dreams, we love a challenge so tell us exactly what you are after and we will try our best to make it! Most of our cake orders come from people who are after something tailored to their ideas.<br /><br />We have lots of yummy sponge cake flavours to choose from: vanilla, lemon, chocolate, coffee, caramel, mocha and red velvet all sandwiched together with tasty butter cream fillings!<br /><br />We hand deliver to Sheffield and the surrounding areas. If you live further afield we can provide a delivery quote or alternatively, you can collect it yourself.<br /><br />To place an order or find out more please contact us at <a href="'. $this->view->url(array(), 'contact') .'">anna@hunkydorycakes.co.uk</a> or give us a call on 0114 2664573.<br /><br />To look at our latest creations or to get more ideas, please take a look at our photographs on the <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes facebook page</a>.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Children\'s Cake');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, victoria sponge, cup cakes, fruit cake, lemon tart, biscuits, chocolate cake, coffee, cappuccino,  red velvet', 'keywords');
		        $this->view->headMeta('You really should try Hunkydory Cakes Capuccion cake it is delicious.', 'description');
				break;
			case 'heart' :
	    		$cakeId = 92;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'anniversary';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'anniversary-cakes';
		        $this->view->image = 'anniversary-heart.png';
		        $this->view->header = 'heart shaped cake with roses';
		        $this->view->info = '<p>Image shown: shown: 10&quot; sponge cake. Decorated with handmade red roses and a scattering of rose petals with diamante trim detail and a beautiful brooch.<br />Finished with your choice of coloured ribbon.<br />Available in 8&quot;, 10&quot; and 12&quot; heart shapes.<br /><br />You may wish to personalise the cake and incorporate a message.<br />The message will go on the the top on a sugar scroll as seen in the picture.<br /><br />To place an order please contact Hunkydory Cakes on 0114 2664573 or, email <a href="'. $this->view->url(array(), 'contact') .'">enquiries@hunkydorycakes.co.uk</a>. Hunkydory Cakes hand deliver cakes within Sheffield and the surrounding area. Collection from our Sheffield address is also option.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Anniversary Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			case 'rose' :
	    		$cakeId = 93;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'anniversary';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'anniversary-cakes';
		        $this->view->image = 'anniversary-rose.png';
		        $this->view->header = 'roses and brooch';
		        $this->view->info = '<p>Image shown: shown: 11&quot; square fruit cake. Decorated with handmade white Roses and scattered with handmade sugar rose petals. The sides of the cake are decorated with hand piped dot detail. Choose from a choice of coloured ribbon and add your own personailed message. Finished with a beautiful brooch.<br /><br />Prices:  Fruit: &pound;125.00. Sponge: &pound;85.00.<br /><br />Available in a range of sizes on circular cakes and square cakes.<br /><br />Presented in a white ribboned box. Delivery available within Sheffield and the surrounding areas. Collection also available.<br /><br />Please do not hesitate to contact Anna at Hunkydory Cakes to place an order.<br />Contact her on 0114 2664573 or email <a href="'. $this->view->url(array(), 'contact') .'">enquiries@hunkydorycakes.co.uk</a>.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Anniversary Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			
			case 'numbers' :
	    		$cakeId = 94;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'childrens-numbers.png';
		        $this->view->header = 'number cakes';
		        $this->view->info = '<p>Image shown: Number shaped vanilla sponge cake. <br />Decorated with edible, hand made sugar decorations and character.<br /><br />Number cakes from 1 - 99 available.<br /><br />Have the birthday boy/girls name encorporated and their favourate character.<br /><br />Single number cakes from &pound;50.00, double number cakes from &pound;75.00.<br /><br />At Hunkydory Cakes we try our best to make the cake of your dreams, so tell us exactly what you are after and we will try our best to make it! Most of our cake orders come from people who are after something tailored to their ideas.<br /><br />Please feel free to get in contact for a free no obligation quote &amp; consultation. Our prices will include delivery and set-up within Sheffield, South Yorkshire &amp; the Derbyshire area. If you are wanting a delivery for further afield, please just let us know and we will do our best to cater for you.<br /><br />To look at our latest creations or to get more ideas, please take a look at our photographs on the <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes facebook page</a>.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Childrens Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			
			case 'xbox' :
	    		$cakeId = 95;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'xbox.png';
		        $this->view->header = 'xbox cake';
		        $this->view->info = '<p>Image shown: XBOX and controller shaped sponge cake. <br />Decorated with edible, hand made sugar decorations and message.<br /><br />This cake is very realistic and sure to be a big hit with computer games fanatics of all ages!<br /><br />Price &pound;65.00<br />At Hunkydory Cakes we try our best to make the cake of your dreams, so tell us exactly what you are after and we will try our best to make it! Most of our cake orders come from people who are after something tailored to their ideas.<br /><br />Hunkydory Cakes can hand deliver your cake within Sheffield, South Yorkshire &amp; the Derbyshire area. If you are wanting a delivery for further afield, please just let us know and we will do our best to cater for you. Alternatively, you can collect the cake yourself.<br /><br />To look at our latest creations or to get more ideas, please take a look at our photographs on the <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes facebook page</a>.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Childrens Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			
			case 'cruise-themed' :
	    		$cakeId = 96;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'cruise-themed.png';
		        $this->view->header = 'cruise themed cake';
		        $this->view->info = '<p>Image shown: 2 tier cake, with a hand made sugar cruise ship on the top.<br />Decorations include hand made sugar anchors and life rings and a sugar rope that circles the cake. The base has a scattering of edible sand.<br />The perfect birthday cake for people who enjoy cruise holidays.<br /><br />At Hunkydory Cakes we try our best to make the cake of your dreams, so tell us exactly what you are after and we will try our best to make it! Most of our cake orders come from people who are after something tailored to their own ideas.<br /><br />Hunkydory Cakes deliver within Sheffield, South Yorkshire &amp; the Derbyshire area. If you are wanting a delivery for further afield, please just let us know and we will do our best to cater for you. Alternatively, you can collect the cake yourself.<br /><br />To look at our latest creations or to get more ideas, please take a look at our photographs on the <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes facebook page</a>.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			
			case 'rugby' :
	    		$cakeId = 97;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'rugby.png';
		        $this->view->header = 'rugby cake';
		        $this->view->info = '<p>Image shown: 11&quot; square sponge cake. Rugby pitch and bespoke rugby players. The players are made to look like the birthday boy/girl and their friends.<br /><br />Names are added to the rugby tops and any message can be included on the cake. Choose the team colours/numbers.<br /><br />Covered in chocolate to give the muddy effect this is one very tasty birthday cake!<br /><br />Presented in a white ribboned box.<br /><br />All our cakes are freshly baked and made specific to your needs.<br />At Hunkydory Cakes we pride ourselves on making bespoke cakes tailored to your ideas.<br /><br />To place an order please call us on 0114 2664573 or email <a href="'. $this->view->url(array(), 'contact') .'">enquiries@hunkydorycakes.co.uk</a></p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			
			case 'golf-themed' :
	    		$cakeId = 98;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'golf-themed.png';
		        $this->view->header = 'golfing theme';
		        $this->view->info = '<p>Image shown:  8&quot; (20cm), sponge cake.<br />At Hunkydory Cakes we make our cakes around your ideas.<br />This cake was created for a customer who wanted a golfing cake with Bruce Springsteen thrown in. <br /><br />Please don\'t hesitate to get in contact armed with any ideas you have.<br /><br />Call Anna at Hunkydory Cakes on 0114 2664572 or email her at <a href="'. $this->view->url(array(), 'contact') .'">anna@hunkydorycakes.co.uk</a></p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			
			case 'suitcase' :
	    		$cakeId = 99;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'suitcase.png';
		        $this->view->header = 'suitcase cake';
		        $this->view->info = '<p>100% edible!<br />3 tier suitcase cake.<br />Flavors: Chocolate Orange, Lemon Zest and Victoria sponge cake.<br /><br />Handmade bespoke edible decorations include: <br />Polaroids, visa, passport, badges, buckles, tags, currency &amp; flags.<br /><br />Hunkydory Cakes can hand deliver your cake within Sheffield, South Yorkshire &amp; the Derbyshire area. If you are wanting a delivery for further afield, please just let us know and we will do our best to cater for you. Alternatively, you can collect the cake yourself.<br /><br />To see more pictures of this suitcase cake, or to see more cake creations, please take a look at our photographs on the <a href="https://www.facebook.com/hunkydorycakes" target="_blank">Hunkydory Cakes facebook page</a>.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			break;
			
			case 'mandy':
				
	    		$cakeId = 100;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'mandy.png';
		        $this->view->header = 'mandy';
		        $this->view->info = '<p>Image shown: 8&quot;, 10&quot; and 12&quot; pink and ivory vintage sugar lace tiered cake.<br />1&quot; charcoal seperators.<br />Available for fruit and sponge cakes.<br /><br />Available in a range of sizes on circular cakes.<br />Various colour themes available.<br /><br />You may wish to personalise your cake to stay in keeping with the theme of your wedding. There are also a huge variety of wedding cake toppers available.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'franchesca':
				$cakeId = 101;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'franchesca.png';
		        $this->view->header = 'francesca';
		        $this->view->info = '<p>Image shown: 4 tiers: 4&quot; (10cm),  6&quot; (15cm), 8&quot; (20cm), 10&quot; (25cm).<br />Handmade pastel flowers with piped sugar pearls and white and ivory satin ribbon.<br /><br />Various colour themes and flavours available.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'helen':
				$cakeId = 102;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'helen.png';
		        $this->view->header = 'helen';
		        $this->view->info = '<p>Image shown: 3 tiers, 4&quot; (10cm), 7&quot; (18cm), 10&quot; (25cm).<br />3 tiered wedding cake, with handmade sugar white roses and butterfly decoration.<br /><br />Various colour themes available and flavours available.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'victoria':
				$cakeId = 103;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'victoria.png';
		        $this->view->header = 'victoria';
		        $this->view->info = '<p>Image shown: 3 tiers Victoria sponge cake with a vanilla bean buttercream and raspberry preserve. Decorated with strawberries, raspberries and fresh roses. Turning a classic cake into something extraordinary!<br /><br />Price: 3 tiers  4&quot; (10cm) 7&quot; (18cm) 10&quot; (25cm) : &pound;300.00<br /><br />Price includes cake assembly and delivery within Sheffield.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'amy':
				$cakeId = 104;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'amy.png';
		        $this->view->header = 'amy';
		        $this->view->info = '<p>Image shown: 3 tiers, 5&quot; (13cm), 7&quot; (18cm), 10&quot; (25cm).<br />A beautiful natural wedding cake with cascading hand made sugar leaves. <br />Matching cake pops available.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'anna':
				$cakeId = 105;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'anna.png';
		        $this->view->header = 'anna';
		        $this->view->info = '<p>Image shown: 4 tiers (10cm),  6&quot; (15cm), 8&quot; (20cm), 10&quot; (25cm).<br />Hand placed sugar pearls and petal leaves.<br />Available in white and ivory.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'basia':
				$cakeId = 106;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'basia.png';
		        $this->view->header = 'basia';
		        $this->view->info = '<p>Image shown: 3 tiers,  5&quot; (13cm), 8&quot; (20cm), 10&quot; (25cm). A beautiful vintage styled wedding cake. Handmade sugar white roses and piped sugar pearls. Ivory and white satin ribbon, with white lace trimmings and pearl strands. <br /><br />Various colour themes available and flavours available.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'claire':
				$cakeId = 107;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'claire.png';
		        $this->view->header = 'claire';
		        $this->view->info = '<p>Image shown: 4 tiers 4&quot; (10cm),  6&quot; (15cm), 8&quot; (20cm), 10&quot; (25cm).<br />A very regal wedding cake. Damask sugar work with sugar buttons &amp; brooch detail, with a handmade sugar bow, pearls and satin ribbon.<br /><br />Various colour themes and flavours available.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'cupcake-and-cake':
				$cakeId = 108;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'cupcake-and-cake-tower.png';
		        $this->view->header = 'wedding cupcake/cake tower';
		        $this->view->info = '<p>Often couples who choose cupcake towers still want to have a cake to cut and have the picture of them doing so on the big day.<br />Our wedding cupcake tower and top cake combinations are the perfect option.<br />Enabling you to get the best of both worlds!<br /><br />There are so many different looks and flavours available. Book a cake tasting session and consultation to discuss all these options in more depth.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'bird':
				$cakeId = 109;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'christening';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'christening-cakes';
		        $this->view->image = 'bird.png';
		        $this->view->header = 'bird';
		        $this->view->info = '<p>Image shown: Two tier cake with sugar bird and polkadot decoration.<br />Hunkydory Cakes are happy to make cakes to suit your specific design ideas.<br />If you would like to see more fabulous designs please take a look at the <a href="https://www.facebook.com/hunkydorycakes" target="_blank">Hunkydory Cakes facebook page</a>.<br /><br />We can deliver within Sheffield and the surrounding areas, or you can collect your cake from our Sheffield address.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'jungle':
				$cakeId = 110;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'christening';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'christening-cakes';
		        $this->view->image = 'jungle.png';
		        $this->view->header = 'jungle';
		        $this->view->info = '<p>Image shown: Two tier cake with animal print design. Handmade sugar animals and tree. <br /><br />Hunkydory Cakes are happy to make cakes to suit your specific design ideas. <br />If you would like to see more fabulous designs please take a look at the <a href="https://www.facebook.com/hunkydorycakes" target="_blank">Hunkydory Cakes facebook page</a>.<br /><br />We can deliver within Sheffield and the surrounding areas, or you can collect your cake from our Sheffield address.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Christening Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'yacht':
				$cakeId = 111;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'yacht.png';
		        $this->view->header = 'cakes that make you go \'wow\'';
		        $this->view->info = '<p>At Hunkydory Cakes we love nothing more than turning a customers incredible and sometimes downright crazy ideas into cake reality! Just take a look below...<br /><br />A scaled replica of an Oyster 56 yacht. <br />Scale 1:15, measuring 1.5m x 1.15m.<br /><br />Working from the yacht\'s blueprints to incorporate every minute detail including plug sockets, cleats, ropes and controls, to the pattern of the decking and the name, printed on to edible icing. The sails were hand stitched out of actual sail material (sourced from the same company that made the \'real\' sails) and finished off with blue number and logo detail. Every aspect of the cake was 100% hand crafted!<br />Just one example of the lengths we are prepared to go to at Hunkydory Cakes to make your cake a spectacular masterpiece! <br />So, whether you have a very special birthday to celebrate or an important corporate event and want a show stopping cake, then please contact Hunkydory Cakes, we can not wait to hear from you!</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		        $this->renderScript('product/cake-id-111.phtml');
		       break;
		       
			case 'nightmare-before-christmas':
				$cakeId = 112;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'nightmare-before-christmas.png';
		        $this->view->header = 'the nightmare before christmas';
		        $this->view->info = '<p>Image shown: 2 tier cake decorated in a Tim Burton\'s &quot;The Nightmare Before Christmas&quot; theme. With tombstone with a chiselled message \'Happy Birthday\'.<br />Dirty flower and butterfly decoration and lots of black edible glitter!<br />Jack and Sally characters are purchased models.<br /><br />Hunkydory Cakes aims to create each cake to your precise requirements.<br />So, if you like aspects of this cake and want to combine it with some of your own ideas we are very open minded. <br />Please email <a href="'. $this->view->url(array(), 'contact') .'">Anna@hunkydorycakes.co.uk</a> or give her a call on 0114 2664573.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'peacock':
				$cakeId = 113;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'peacock.png';
		        $this->view->header = 'peacock';
		        $this->view->info = '<p>Image shown: 2 tier cake decorated with a handmade &quot;60&quot;, silk flowers &amp; gold and vivid blue icing.<br /><br />We have lots more cakes that you can view on our <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes facebook page</a>, please take the time to have a look. Especially if you are after some inspiration!<br /><br />We are happy to hand deliver our cakes within Sheffield and the surrounding areas.<br />Alternatively, you can collect your cake from our Sheffield address.<br />Hunkydory Cakes. 126 Blair Athol Road, Sheffield S11 7GD</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'lace':
				$cakeId = 114;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'lace.png';
		        $this->view->header = 'lace';
		        $this->view->info = '<p>Image shown: 2 tier cake decorated with handmade sugar yellow roses and lace &amp; pearl decoration. Finished off with a large sugar bow and brooch.<br />A selection of brooches are available.<br /><br />Hunkydory Cakes aims to create each cake to your precise requirements.<br />So, if you like aspects of this cake and want to combine it with some of your own ideas we are open to ideas! <br />Please email <a href="'. $this->view->url(array(), 'contact') .'">Anna@hunkydorycakes.co.uk</a> or give her a call on 0114 2664573.<br /><br />We are happy to hand deliver our cakes within Sheffield and the surrounding areas.<br />Alternatively, you can collect your cake from our Sheffield address.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'champagne':
				$cakeId = 115;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'party';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'party-cakes';
		        $this->view->image = 'champagne.png';
		        $this->view->header = 'champagne';
		        $this->view->info = '<p>Image shown: 100% edible champagne bottle and bucket. Edible ice, serviette and bespoke edible champagne label with the person\'s name on.<br />This is a great cake for a party, guests will be hard pressed to know it\'s cake and not the real thing!<br /><br />We have lots more cakes that you can view on our <a href="https://www.facebook.com/hunkydorycakes" target="_blank">Hunkydory Cakes facebook page</a>, please take the time to have a look. Especially if you are after some inspiration!<br /><br />We are happy to hand deliver our cakes within Sheffield and the surrounding areas.<br />Alternatively, you can collect your cake from our Sheffield address.<br />Hunkydory Cakes. 126 Blair Athol Road, Sheffield S11 7GD</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Party Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'winnie':
				$cakeId = 116;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'winnie.png';
		        $this->view->header = 'winnie the pooh';
		        $this->view->info = '<p>Image: Two tier Winnie the Pooh cake.<br />All the decorations and characters are handmade and 100% edible.<br /><br />Please get in touch if you would like to order this cake by emailing <a href="'. $this->view->url(array(), 'contact') .'">anna@hunkydorycakes.co.uk</a> or by phone on 0114 2664573.<br /><br />Hunkydory Cakes can deliver within Sheffield and the surrounding area. We pride ourselves on producing tasty fresh cakes and beautiful designs!</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Childrens Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'spiderman':
				$cakeId = 117;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'spiderman.png';
		        $this->view->header = '3d spiderman cake';
		        $this->view->info = '<p>Sculpted Spiderman Cake, accentuating all his muscles. <br />A fantastic cake for Comic book fans and children alike!<br /><br />Made from Red Velvet sponge cake, so as you cut into the cake the inside is a vivid red!<br /><br />If you would prefer a different Super Hero please get in contact for a no obligation quote.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Childrens Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'fireman-sam':
				$cakeId = 118;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'fireman-sam.png';
		        $this->view->header = 'fireman sam';
		        $this->view->info = '<p>Fireman Sam and his red fire engine. All the decorations are handmade. Child\'s name can go on to the number plates.<br /><br />If you would prefer a different character please get in touch.<br />To view lots more cakes like this, visit the <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes Facebook page</a>.<br /><br />Hunkydory Cakes can deliver within Sheffield and the surrounding areas.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Childrens Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'hook':
				$cakeId = 119;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'childrens';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'childrens-cakes';
		        $this->view->image = 'hook.png';
		        $this->view->header = 'hook';
		        $this->view->info = '<p>Hook themed cake. All the decorations are handmade. <br /><br />If you would prefer a different character please get in touch.<br />To view lots more cakes like this, visit the <a href="http://www.facebook.com/hunkydorycakes">Hunkydory Cakes Facebook page</a>.<br /><br />Hunkydory Cakes can deliver within Sheffield and the surrounding areas.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Childrens Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'jemma':
				$cakeId = 120;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'jemma.png';
		        $this->view->header = 'jemma';
		        $this->view->info = '<p>Image shown: 4 tiers 4&quot; (10cm),  6&quot; (15cm), 8&quot; (20cm), 10&quot; (25cm).<br />A beautiful white wedding cake. Damask sugar work with sugar buttons &amp; brooch detail, handmade sugar bow, pearls and satin ribbon. Topped off with beautiful handmade sugar roses and butterflies.<br /><br />Various colour themes and flavours available.<br /><br />PLEASE ARRANGE AN APPOINTMENT TO DISCUSS YOUR WEDDING CAKE. ALLOW 28 WORKING DAYS NOTICE ON ALL WEDDING CAKES, THE EARLIER THE BETTER TO ENSURE AVAILABILITY.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
		       
			case 'charlotte':
				$cakeId = 121;
		        $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		        
		        $this->view->titleClass = 'wedding';
		        $this->view->title = ucwords($this->view->titleClass);
		        $this->view->route = 'wedding-cakes';
		        $this->view->image = 'charlotte.png';
		        $this->view->header = 'charlotte';
		        $this->view->info = '<p>Image shown: 3 deep tiers: 4&quot; (10cm),  7&quot; (18cm), 10&quot; (25cm).<br />Dip dyed look, tiered wedding cake with beautiful icing ruffles and folds.<br /><br />Various colour themes and flavours available.<br /><br />PLEASE ARRANGE AN APPOINTMENT TO DISCUSS YOUR WEDDING CAKE. ALLOW 28 WORKING DAYS NOTICE ON ALL WEDDING CAKES, THE EARLIER THE BETTER TO ENSURE AVAILABILITY.</p>';
				$this->view->days_required = $data['days_required'];
		        
				$this->view->headTitle('Wedding Cakes');
				$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       break;
			
			case 'vintage-rose':
		       	$cakeId = 122;
		       	$data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		       
		       	$this->view->titleClass = 'childrens';
		       	$this->view->title = ucwords($this->view->titleClass);
		       	$this->view->route = 'childrens-cakes';
		       	$this->view->image = 'vintage-rose.png';
		       	$this->view->header = 'vintage rose';
		       	$this->view->info = '<p>Image shown: Handmade sugar roses, teddy bear and pearls on a bird cage inspired cake with hand piped detailing. Building blocks spell out the child\'s name.<br /><br />Matching cupakes available. See image below.<br /><br />We have lots more cakes that you can view on our Hunkydory Cakes facebook page, please take the time to have a look. Especially if you are after some inspiration! <br /><br />We are happy to hand deliver our cakes within Sheffield and the surrounding areas. <br />Alternatively, you can collect your cake from our Sheffield address. <br />Hunkydory Cakes. 126 Blair Athol Road, Sheffield S11 7GD</p>';
		       	$this->view->days_required = $data['days_required'];
		       
		       	$this->view->headTitle('Childrens Cakes');
		       	$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       	break;

			case 'christening-vintage-rose':
		       	$cakeId = 123;
		       	$data = $this->_product->setCakeId($cakeId)->getCakeInfo();
		       
		       	$this->view->titleClass = 'christening';
		       	$this->view->title = ucwords($this->view->titleClass);
		       	$this->view->route = 'christening-cakes';
		       	$this->view->image = 'vintage-rose.png';
		       	$this->view->header = 'vintage rose';
		       	$this->view->info = '<p>Image shown: Handmade sugar roses, teddy bear and pearls on a bird cage inspired cake with hand piped detailing. Building blocks spell out the child\'s name.<br /><br />Matching cupakes available. See image below.<br /><br />We have lots more cakes that you can view on our Hunkydory Cakes facebook page, please take the time to have a look. Especially if you are after some inspiration! <br /><br />We are happy to hand deliver our cakes within Sheffield and the surrounding areas. <br />Alternatively, you can collect your cake from our Sheffield address. <br />Hunkydory Cakes. 126 Blair Athol Road, Sheffield S11 7GD</p>';
		       	$this->view->days_required = $data['days_required'];
		       
		       	$this->view->headTitle('Christening Cakes');
		       	$this->view->headTitle($data['title'] . ' Cake');
		        $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
		        $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
		       	break;
		       	 
			case 'toy-story':
			    $cakeId = 124;
			    $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
			     
			    $this->view->titleClass = 'childrens';
			    $this->view->title = ucwords($this->view->titleClass);
			    $this->view->route = 'childrens-cakes';
			    $this->view->image = 'toy-story.png';
			    $this->view->header = 'toy story';
			    $this->view->info = '<p>Image shown: Three tiered Toy Story themed cake. Handmade characters and decoration.<br /><br />We have lots more cakes that you can view on our Hunkydory Cakes facebook page, please take the time to have a look. Especially if you are after some inspiration!<br /><br />We are happy to hand deliver our cakes within Sheffield and the surrounding areas. <br />Alternatively, you can collect your cake from our Sheffield address.<br />Hunkydory Cakes. 126 Blair Athol Road, Sheffield S11 7GD</p>';
			    $this->view->days_required = $data['days_required'];
			     
			    $this->view->headTitle('Childrens Cakes');
			    $this->view->headTitle($data['title'] . ' Cake');
			    $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
			    $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			    break;
		       	 
			case 'camera':
			    $cakeId = 125;
			    $data = $this->_product->setCakeId($cakeId)->getCakeInfo();
			     
			    $this->view->titleClass = 'party';
			    $this->view->title = ucwords($this->view->titleClass);
			    $this->view->route = 'party-cakes';
			    $this->view->image = 'camera.png';
			    $this->view->header = 'camera cake';
			    $this->view->info = '<p>Image shown: 100% edible Nikon D5000 camera cake. A cake replica of any camera can be made, provided we have good images to work from. <br /><br />The ideal cake for any photography fanatic!<br /><br />We are happy to hand deliver our cakes within Sheffield and the surrounding areas. <br />Alternatively, you can collect your cake from our Sheffield address.<br />Hunkydory Cakes. 126 Blair Athol Road, Sheffield S11 7GD</p>';
			    $this->view->days_required = $data['days_required'];
			     
			    $this->view->headTitle('Party Cakes');
			    $this->view->headTitle($data['title'] . ' Cake');
			    $this->view->headMeta('Sheffield, Chesterfield, South Yorkshire, Hunkydory Cakes, Anna Williams, golden, silver, 50th, 25th, year, wedding, rings, paper, marriage, celebration, party', 'keywords');
			    $this->view->headMeta('Sheffield based Hunkydory Cakes make beautiful Anniversary cakes for all anniversaries including silver and golden.', 'description');
			    break;
			endswitch;
    }


}




