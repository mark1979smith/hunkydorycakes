var navTimeoutId = 0;
$(document).ready(function() {
	$('a[href^="http:"]').attr('target', '_blank');
	$('ol#top-nav li ol').hide();
	$('ol#top-nav li').bind('mouseover', function() {
		$('ol#top-nav li ol').hide();
		$(this).find('ol').show();
		clearNavTimeout();
	});
	$('ol#top-nav>li>ol').bind('mouseover', function() {
		clearNavTimeout();
	});
	$('ol#top-nav>li').bind('mouseout', function() {
		//navTimeoutId = setTimeout( "$(this).find('ol').hide()", 3000);
		setNavTimeout();
	});
	$('div#banner>a[id$="gallery"]').parent().css('cursor', 'pointer');
	$("div#banner").bind('click', function() {
		if ($(this).find('a').length > 0)
		{
			window.location = $(this).find('a').attr('href');
		}
	});
	if ($('#cake_size').length > 0 && $('#cake_filling').length > 0)
		var cakeTotal = prices[$('#cake_size option').index($('#cake_size option:selected'))][$('#cake_filling').val().toLowerCase()];
	else if ($('#cake_size').length > 0)
		var cakeTotal = prices[$('#cake_size option').index($('#cake_size option:selected'))]['sponge'];
	else if ($('#qty').length > 0 && $('#cake_flavour').length > 0)
		var cakeTotal = (prices[0]['sponge']*$('#qty').val()).toFixed(2);
	else if ($('#qty').length > 0)
		var cakeTotal = prices[$('#qty').val()];
	$('#cake_size').bind('change', function() {
		if ($('#cake_size').length > 0 && $('#cake_filling').length > 0)
			cakeTotal = prices[$('#cake_size option').index($('#cake_size option:selected'))][$('#cake_filling').val().toLowerCase()];
		else
			cakeTotal = prices[$('#cake_size option').index($('#cake_size option:selected'))]['sponge'];
		$('#cakeTotal span').text(cakeTotal);
		$('#amount').val(cakeTotal);
	});
	$('#cake_filling').bind('change', function() {
		if ($('#cake_size').length > 0 && $('#cake_filling').length > 0)
			cakeTotal = prices[$('#cake_size option').index($('#cake_size option:selected'))][$('#cake_filling').val().toLowerCase()];
		else
			cakeTotal = prices[$('#cake_size option').index($('#cake_size option:selected'))]['sponge'];
		$('#cakeTotal span').text(cakeTotal);
		$('#amount').val(cakeTotal);
	});
	$('#qty').bind('change', function() {
		if ($('#cake_flavour').length > 0)
			cakeTotal = (prices[0]['sponge']*$('#qty').val()).toFixed(2);
		else
			cakeTotal = prices[$('#qty').val()];
		$('#cakeTotal span').text(cakeTotal);
		$('#amount').val(cakeTotal);
	});
	$('#cakeTotal span').text(cakeTotal);
	$('#amount').val(cakeTotal);
});

function setNavTimeout()
{
	navTimeoutId = setTimeout( "$('ol#top-nav>li>ol:visible').hide()", 1000);
}

function clearNavTimeout()
{
	clearTimeout( navTimeoutId );
}
