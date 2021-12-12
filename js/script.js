// Скрипт кнопки скролла вверх
(function() {
    'use strict';
  
    function trackScroll() {
      var scrolled = window.pageYOffset;
      var coords = document.documentElement.clientHeight;
  
      if (scrolled > coords) {
        goTopBtn.classList.add('back_to_top-show');
      }
      if (scrolled < coords) {
        goTopBtn.classList.remove('back_to_top-show');
      }
    }
  
    function backToTop() {
      if (window.pageYOffset > 0) {
        window.scrollBy(0, -80);
        setTimeout(backToTop, 0);
      }
    }
  
    var goTopBtn = document.querySelector('.back_to_top');
  
    window.addEventListener('scroll', trackScroll);
    goTopBtn.addEventListener('click', backToTop);
})();




//Меню хедера
var header = document.getElementsByClassName('header-mobile');
var menu = document.getElementsByClassName('header-mobile__menu');
var main_menu = document.getElementsByClassName('header-mobile__menu__active-main');
var menu_list = document.getElementsByClassName('header-mobile__menu__active');
var category = document.getElementsByClassName('header-mobile__category');
var close = document.getElementsByClassName('close-menu');

// Открыть шторку главного меню
menu[0].onclick = function() {
  close[0].classList.add("block");
  category[0].classList.add("none");
  main_menu[0].classList.add("active-menu");
  // main_menu[0].classList.add("block");
  document.getElementsByClassName('body')[0].style.overflow = "hidden";

}
//  Открыть шторку категорий
category[0].onclick = function() {
  close[0].classList.add("block");
  menu[0].classList.add("none");
  menu_list[0].classList.add("active-menu");
  // menu_list[0].classList.add("block");
  document.getElementsByClassName('body')[0].style.overflow = "hidden";
}
// Закрыть любую шторку
close[0].onclick = function() {
  menu_list[0].classList.remove("active-menu");
  main_menu[0].classList.remove("active-menu");
  menu_list[0].classList.remove("block");
  main_menu[0].classList.remove("block");
  category[0].classList.remove("none");
  menu[0].classList.remove("none");
  
  close[0].classList.remove("block");
  document.getElementsByClassName('body')[0].style.overflow = "auto";
}






  