jQuery(document).ready(function ($) {
    var header = $('.header');
    var stickyOffset = header.offset().top; // starting point of header

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > stickyOffset) {
            header.addClass('sticky');
        } else {
            header.removeClass('sticky');
        }
    });
});


// Popup Sections Jquery
jQuery(document).ready(function($) {
    function openPopup(selector) {
        $(selector).fadeIn();
        $('body').addClass('popup-open');
    }
    function closePopup(popup) {
        popup.fadeOut(function() {
            $('body').removeClass('popup-open');
        });
    }
    $('.open-popup').on('click', function(e) {
        e.preventDefault();
        var selector = $(this).data('popup-selector');
        if(selector && $(selector).length) {
            openPopup(selector);
        }
    });
    $('a[href^="#"]').on('click', function(e) {
        var selector = $(this).attr('href');
        if($(selector).hasClass('popup')) {
            e.preventDefault();
            openPopup(selector);
        }
    });
    $('.popup-close').on('click', function() {
        closePopup($(this).closest('.popup'));
    });
    $('.popup').on('click', function(e) {
        if($(e.target).is('.popup')) {
            closePopup($(this));
        }
    });

});


// Guest Section Popups Section Jquery
document.addEventListener('DOMContentLoaded', function(){
  var modal = document.getElementById('guest-modal');
  var modalBody = document.getElementById('guest-modal-body');

  document.querySelectorAll('.guest-popup-btn').forEach(function(btn){
    btn.addEventListener('click', function(e){
      var key = btn.dataset.popupKey;
      var hidden = document.getElementById('guest_content_' + key);
      if (!hidden) { console.warn('no popup data for', key); return; }
      modalBody.innerHTML = hidden.innerHTML;
      modal.classList.add('active');
      modal.setAttribute('aria-hidden','false');
      document.body.style.overflow = 'hidden';
    });
  });

  modal.addEventListener('click', function(e){
    if (e.target === modal || e.target.closest('.guest-popup-close')) {
      modal.classList.remove('active');
      modal.setAttribute('aria-hidden','true');
      document.body.style.overflow = '';
      modalBody.innerHTML = '';
    }
  });
});

jQuery(document).ready(function($) {
    var perPage = parseInt($('#show-more').data('perpage'));
    var $guests = $('.guest-card');
    //var $hiddenGuests = $guests.slice(perPage);

    // initially hide extra guests
    //$hiddenGuests.hide();

    $('#show-more').on('click', function(e) {
        e.preventDefault();

        if ($(this).hasClass('expanded')) {
            // collapse to initial state
            $guests.slice(perPage).fadeOut(400).addClass('hidden-guest');
            $(this).removeClass('expanded').find('span.btn--primary:first').text('Show More');
        } else {
            // expand more guests
            $guests.slice(perPage).fadeIn(200).css('display','flex').removeClass('hidden-guest');
            $(this).addClass('expanded').find('span.btn--primary:first').text('Show Less');
        }
    });
});




// Toggle open/close on hamburger button
jQuery(document).ready(function ($) { 

  $('.header__toggle').on('click', function () {
    $(this).toggleClass('is-active');
    $('.header__inner').toggleClass('open');

    const expanded = $(this).attr('aria-expanded') === 'true' || false;
    $(this).attr('aria-expanded', !expanded);
  });
  $('.header__inner a').on('click', function () {
    $('.header__toggle').removeClass('is-active').attr('aria-expanded', false);
    $('.header__inner').removeClass('open');
  });

});



// Event Section
jQuery(function ($) {
  function revealOnScroll() {
    var winBottom = $(window).scrollTop() + $(window).height();
    $('.hideme').each(function () {
      var cardTop = $(this).offset().top + 100; 
      if (winBottom > cardTop) {
        $(this).addClass('show');
      }
    });
  }
  revealOnScroll();
  $(window).on('scroll', revealOnScroll);
});