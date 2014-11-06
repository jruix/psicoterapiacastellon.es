;(function ($, window, undefined) {
  'use strict';
  var $doc = $(document), Modernizr = window.Modernizr;
  $.fn.foundationAlerts           ? $doc.foundationAlerts() : null;
  $.fn.foundationAccordion        ? $doc.foundationAccordion() : null;
  $.fn.foundationTooltips         ? $doc.foundationTooltips() : null;
  $('input, textarea').placeholder();
  $.fn.foundationButtons          ? $doc.foundationButtons() : null;
  $.fn.foundationNavigation       ? $doc.foundationNavigation() : null;
  $.fn.foundationTopBar           ? $doc.foundationTopBar() : null;
  $.fn.foundationCustomForms      ? $doc.foundationCustomForms() : null;
  $.fn.foundationMediaQueryViewer ? $doc.foundationMediaQueryViewer() : null;
  $.fn.foundationTabs             ? $doc.foundationTabs() : null;
  $('.block-grid.two-up>li:nth-child(2n+1)').css({clear: 'both'});
  $('.block-grid.three-up>li:nth-child(3n+1)').css({clear: 'both'});
  $('.block-grid.four-up>li:nth-child(4n+1)').css({clear: 'both'});
  $('.block-grid.five-up>li:nth-child(5n+1)').css({clear: 'both'});
  if (Modernizr.touch) {
    $(window).load(function () {
      setTimeout(function () {
        window.scrollTo(0, 1);
      }, 0);
    });
  }
  $('#slider').orbit({
    timer: false 
  });
  $('#tooltip_sello p').css('font-size','10px');
  $('#tooltip_sello p').css('margin-bottom','4px');
  $('#cursos-menu').click(function() {
    $('a[href="#cursos"]').trigger('click');
  });
  $('#actividades-menu').click(function() {
    $('a[href="#gratuitas"]').trigger('click');
  });
  $('#psicoterapia-menu').click(function() {
    $('a[href="#psicoterapia"]').trigger('click');
  });
  $('#sexual-menu').click(function() {
    $('a[href="#educacion"]').trigger('click');
  });
})(jQuery, this);


$(document).ready(function() {
	$('#promotion').change(function() {
		var selected = $('#promotion :selected').data('show');
		$('.show').hide();
		if(selected != 'undefined') {
			$('.' + selected).show();
		}
	});
});
