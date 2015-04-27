jQuery(document).ready(function($) {

  var realmodal_open_buttons = $('button[data-realmodal="open"]');
  if (realmodal_open_buttons.length) {
    realmodal_open_buttons.each(function() {
      var realmodal_open_button = $(this);
      realmodal_open_button.on('click', function() {
        realmodals_open(realmodal_open_button.attr('data-realmodal-target'));
        return false;
      });
    });
  }

  var realmodal_close_buttons = $('[data-realmodal="close"]');
  if (realmodal_close_buttons.length) {
    realmodal_close_buttons.on('click', function() {
      realmodals_close();
    });
  }

  function realmodals_open(target) {

    var target  = $(target),
        content = target.find('.realmodal-window');

    if (target.length == 0 || content.length == 0) return false;

    // Закрыть открытое окно
    realmodals_close();

    var win          = $(window),
        doc          = $(document),
        doc_width    = doc.width(),
        win_height   = win.height(),
        win_scroll_y = win.scrollTop(),
        offset_top   = ((win_height - content.outerHeight()) / 2) + win_scroll_y,
        offset_left  = (doc_width - content.outerWidth()) / 2;

    // Растянуть подложку
    target.css({
      'width':  doc.width(),
      'height': doc.height()
    });

    // Разместить окно по центру
    content.css({
      'top':  offset_top,
      'left': offset_left
    });

    // Показать окно
    target.css('visibility', 'visible').animate({
      'opacity': 1
    }, 300, function() {
      $(this).addClass('opened');
    });

    // Закрыть по нажатию клавиши "Esc"
    win.on('keyup', function(event) {
      if (event.which === 27) realmodals_close();
    });

  }

  function realmodals_close() {
    var opened = $('.realmodal.opened');
    if (opened.length) {
      opened.animate({
        'opacity': 0
      }, 300, function() {
        $(this).css('visibility', 'hidden').removeClass('opened');
        $(window).unbind('keyup');
      });
    }
  }

});