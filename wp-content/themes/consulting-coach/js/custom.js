jQuery(document).ready(function ($) {
  $('.main-navigation .toggle-button').on('click', function () {
    $(this).parent('.main-navigation').toggleClass('menu-toggled');
  });
  $('.mobile-menu-wrapper .main-header .toggle-button').on('click', function () {
    $('.nav-slide-wrapper').toggleClass('menu-toggled');
    $('.mobile-menu-wrapper').toggleClass('m-toggled');
  });
  $('.mobile-menu-wrapper .header-t > .close').on('click', function () {
    $('.mobile-menu-wrapper .nav-slide-wrapper').removeClass('menu-toggled');
  });
  $('.one-page .main-navigation ul li').on('click', function () {
    $(this).parents('.main-navigation').removeClass('menu-toggled');
  });

  $('.main-navigation .menu').on('scroll', function () {
    if ($(this).scrollTop() > 20) {
      $('.main-navigation.menu-toggled .toggle-button').hide();
    } else {
      $('.main-navigation.menu-toggled .toggle-button').show();
    }
  });
	
	//custom add. Move info banner higher on homepage
	$('section#cta_section').insertBefore('div#banner_section');
});

// mobile search accessibility
const focusElement =
  'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';


const modal = document.querySelector('.mobile-menu-wrapper .header-search-form'); // select the modal by it's id
if (null !== modal) {
  const firstFocusElement = modal.querySelectorAll(focusElement)[0]; // get first element to be focused inside modal
  const focusContent = modal.querySelectorAll(focusElement);
  const lastFocusElement = focusContent[focusContent.length - 1]; // get last element to be focused inside modal


  document.addEventListener('keydown', function (e) {
    let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

    if (!isTabPressed) {
      return;
    }

    if (e.shiftKey) { // if shift key pressed for shift + tab combination
      if (document.activeElement === firstFocusElement) {
        lastFocusElement.focus(); // add focus for the last focusable element
        e.preventDefault();
      }
    } else { // if tab key is pressed
      if (document.activeElement === lastFocusElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
        firstFocusElement.focus(); // add focus for the first focusable element
        e.preventDefault();
      }
    }
  });

  firstFocusElement.focus();
}

