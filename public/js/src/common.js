document.addEventListener('DOMContentLoaded', () => {

  // ESLint globals - https://eslint.org/docs/user-guide/configuring#specifying-globals
  /* global $, objectFitImages, flatpickr*/

  // object-fit and object-position polyfill
  objectFitImages();


  // Device changed event

  function isDesktop() {
    return window.matchMedia('(min-width: 992px)').matches;
  }

  let itIsDesktop = isDesktop(); // Можно проверять при загрузке

  const deviceChangedDesktopEvent = new CustomEvent('desktop');
  const deviceChangedMobileEvent = new CustomEvent('mobile');

  window.addEventListener('resize', function() {
    if (itIsDesktop === isDesktop()) return;

    itIsDesktop = isDesktop();

    if (itIsDesktop) {
      document.dispatchEvent(deviceChangedDesktopEvent);
    } else {
      document.dispatchEvent(deviceChangedMobileEvent);
    }
  });

  // Можно проверять при изменении ширины экрана
  // document.addEventListener('mobile', function() {
  //   console.log('mobile');
  // });
  // document.addEventListener('desktop', function() {
  //   console.log('desktop');
  // });


  /**
   * Custom Select
   */

  let customSelectsArr = [];

  if (itIsDesktop) {
    // console.log('desk init');
    customSelectsInit();
  } else {
    // console.log('mob init');
    customSelectsDestroy();
  }

  document.addEventListener('mobile', function() {
    customSelectsDestroy();
  });
  document.addEventListener('desktop', function() {
    customSelectsInit();
  });

  function customSelectsInit() {
    const select1 = $('.custom-select').select2({
      // Use data attributes to replace properties
      // https://select2.org/configuration/data-attributes
      minimumResultsForSearch: Infinity, // hide search bar
      width: '100%', // proper way to set width
      placeholder: '', // you must have a blank <option> as the first option in your <select> control (exept multiple select)
      dropdownCssClass: 'custom-select-dropdown', // unique class for dropdown
    });

    const select2 = $('.custom-select-multiple').select2({
      minimumResultsForSearch: Infinity, // hide search bar
      width: '100%', // proper way to set width
      placeholder: '', // you must have a blank <option> as the first option in your <select> control (exept multiple select)
      dropdownCssClass: 'custom-select-multiple-dropdown', // unique class for dropdown
    });

    customSelectsArr = [select1, select2];
    // console.log(customSelectsArr);
  }

  function customSelectsDestroy() {
    for (let i = 0; i < customSelectsArr.length; i++) {
      customSelectsArr[i].select2('destroy');
    }
    customSelectsArr = [];
  }


  /**
   * Carousels
   */

  //https://owlcarousel2.github.io/OwlCarousel2/demos/rtl.html
  const isRTL = document.dir.toLowerCase() === 'rtl';

  $('.hero__slider .owl-carousel').owlCarousel({
    rtl: isRTL,
    items: 1,
    nav: false,
    dots: false,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplaySpeed: 2000,
    mouseDrag: false,
    touchDrag: false,
  });

  const carouselNavSVGIcon = `
    <svg viewBox="0 0 208 320">
      <path
        d="
          M7.65
          143.15l136-136c9.4-9.4
          24.6-9.4
          33.9
          0l22.6
          22.6c9.4
          9.4
          9.4
          24.6
          0
          33.9l-96.4
          96.4
          96.4
          96.4c9.4
          9.4
          9.4
          24.6
          0
          33.9l-22.6
          22.6c-9.4
          9.4-24.6
          9.4-33.9
          0l-136-136c-9.4-9.2-9.4-24.4
          0-33.8z
        "
        fill="#000"
      />
    </svg>`;

  $('.car-carousel .owl-carousel').owlCarousel({
    rtl: isRTL,
    items: 5,
    nav: true,
    dots: false,
    navText: [carouselNavSVGIcon, carouselNavSVGIcon],
    responsive: {
      0: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 4,
        dots: true,
      },
      1480: {
        items: 5,
        dots: true,
      },
    }
  });


  // articles slider

  $('.articles-slider .owl-carousel').owlCarousel({
    rtl: isRTL,
    items: 6,
    nav: true,
    dots: false,
    navText: [carouselNavSVGIcon, carouselNavSVGIcon],
    responsive: {
      0: {
        items: 1,
      },
      500: {
        items: 2,
      },
      768: {
        items: 3,
      },
      992: {
        items: 4,
      },
      1200: {
        items: 5,
      },
      1480: {
        items: 6,
      },
    }
  });


  // single pgae carousels

  const singleCarouselMain = $('.single-carousels__main .owl-carousel');
  const singleCarouselNav = $('.single-carousels__nav .owl-carousel');

  // https://github.com/OwlCarousel2/OwlCarousel2/issues/1472#issuecomment-245233611
  singleCarouselNav.on('initialized.owl.carousel', function() {
    setActiveSingleCarouselItem(0);
  });

  // https://github.com/OwlCarousel2/OwlCarousel2/issues/1472#issuecomment-245233611
  singleCarouselMain.on('initialized.owl.carousel', function(e) {
    const counter = this.nextElementSibling;
    updateSingleCarouselCounter(counter, e.item);
  });

  singleCarouselMain.owlCarousel({
    rtl: isRTL,
    loop: false,
    nav: true,
    navText: [carouselNavSVGIcon, carouselNavSVGIcon],
    items: 1,
    // mouseDrag: false,
    // autoHeight: true,
    dots: false
  });

  singleCarouselNav.owlCarousel({
    rtl: isRTL,
    loop: false,
    nav: true,
    navText: [carouselNavSVGIcon, carouselNavSVGIcon],
    items: 3,
    mouseDrag: false,
    touchDrag: false,
    dots: false,
  });

  singleCarouselMain.on('dragged.owl.carousel', function(e) {
    const direction = e.relatedTarget['_drag']['direction'];
    if (direction == 'right') {
      singleCarouselNav.trigger('prev.owl.carousel');
    } else {
      singleCarouselNav.trigger('next.owl.carousel');
    }
  });

  singleCarouselMain.find('.owl-prev').on('click', function() {
    singleCarouselNav.trigger('prev.owl.carousel');
  });
  singleCarouselMain.find('.owl-next').on('click', function() {
    singleCarouselNav.trigger('next.owl.carousel');
  });

  singleCarouselMain.on('changed.owl.carousel', function(e) {
    setActiveSingleCarouselItem(e.item.index);

    const counter = this.nextElementSibling;
    updateSingleCarouselCounter(counter, e.item);
  });

  singleCarouselNav.on('dragged.owl.carousel', function(e) {
    const direction = e.relatedTarget['_drag']['direction'];
    if (direction == 'right') {
      singleCarouselMain.trigger('prev.owl.carousel');
    } else {
      singleCarouselMain.trigger('next.owl.carousel');
    }
  });

  singleCarouselNav.find('.owl-prev').on('click', function() {
    singleCarouselMain.trigger('prev.owl.carousel');
  });
  singleCarouselNav.find('.owl-next').on('click', function() {
    singleCarouselMain.trigger('next.owl.carousel');
  });

  singleCarouselNav.find('.owl-item').on('click', function(e) {
    singleCarouselMain.trigger('to.owl.carousel', $(e.currentTarget).index());
  });


  function updateSingleCarouselCounter(elem, counterObj) {
    if (!elem) return;

    const span1 = elem.querySelector('* > span:nth-child(1)');
    const span2 = elem.querySelector('* > span:nth-child(2)');

    if (!span1 || !span2) return;

    span1.innerHTML = counterObj.index + 1;
    span2.innerHTML = counterObj.count;
  }

  function setActiveSingleCarouselItem(index) {
    setTimeout(() => {
      singleCarouselNav.find('.owl-item.active').removeClass('choosen');
      singleCarouselNav.find('.owl-item').eq(index).addClass('choosen');
    }, 0);
  }


  /**
   * Gallery
   */

  // https://fancyapps.com/fancybox/3/docs/#options
  $('[data-fancybox="gallery"]').fancybox({
    buttons: [
      // "zoom",
      // "share",
      // "slideShow",
      // "fullScreen",
      // "download",
      'thumbs',
      'close'
    ],
    animationEffect: false,
    transitionEffect: 'fade',
    touch: !isRTL,
    idleTime: null,
    thumbs: {
      // autoStart: true, // Display thumbnails on opening
    },
    backFocus: false, // Put focus back to active element after closing
    btnTpl: {
      arrowLeft:
        '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}">' +
        '<div>' + carouselNavSVGIcon + '</div>' +
        '</button>',
      arrowRight:
        '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}">' +
        '<div>' + carouselNavSVGIcon + '</div>' +
        '</button>',
    },
    youtube: {
      autoplay: 0,
    },
  });


  /**
   * Dropdowns
   */

  let selectedDropdownTrigger, selectedDropdown;

  document.addEventListener('click', function(e) {
    if (e.target.closest('[data-dropdown]')) return;

    const target = e.target.closest('[data-toggle-dropdown]');
    const dropdown = target ? target.parentElement.querySelector('[data-dropdown]') : null;

    if (selectedDropdownTrigger && selectedDropdownTrigger != target) {
      selectedDropdownTrigger.classList.remove('active');
      selectedDropdownTrigger = null;
    }

    if (selectedDropdown) {
      selectedDropdown.style.marginLeft = '';
      selectedDropdown = null;
    }

    if (!target || !dropdown) return;

    e.preventDefault();
    selectedDropdownTrigger = target;
    selectedDropdown = dropdown;
    selectedDropdownTrigger.classList.toggle('active');

    const dropdownCoords = dropdown.getBoundingClientRect();

    if (dropdownCoords.right > document.documentElement.clientWidth) {
      dropdown.style.marginLeft = `-${dropdownCoords.right - document.documentElement.clientWidth}px`;
    }

    if (dropdownCoords.left < 0) {
      dropdown.style.marginLeft = `${Math.abs(dropdownCoords.left)}px`;
    }
  });


  /**
   * Body lock
   */

  function toggleBodyLock() {
    let body = document.querySelector('body');
    if (body.classList.contains('locked')) {
      unLockBody();
    } else {
      lockBody();
    }
  }

  function lockBody() {
    let body = document.querySelector('body');
    body.classList.add('locked');
  }

  function unLockBody() {
    let body = document.querySelector('body');
    body.classList.remove('locked');
  }


  /**
   * Header mobile menu
   */

  const headerMenuBtn = document.querySelector('.header-mobile__menu-btn');
  const headerMenu = document.querySelector('.header-mobile__menu');

  const headerTopCopy = document.querySelector('.header-mobile__top').cloneNode(true);
  headerMenu
    .querySelector('.header-mobile__menu-inner')
    .insertBefore(headerTopCopy, headerMenu.querySelector('.header-mobile__menu-inner').firstChild);
  const headerTopCopyMenuBtn = headerTopCopy.querySelector('.header-mobile__menu-btn');
  const headerTopCopyUserMenuBtn = headerTopCopy.querySelector('.header-mobile__user--logged');

  function headerMenuAddEvent(event, elem) {
    elem.addEventListener(event, () => {
      headerMenuBtn.classList.toggle('active');
      headerTopCopyMenuBtn.classList.toggle('active');
      headerMenu.classList.toggle('active');
      toggleBodyLock();
    });
  }

  headerMenuAddEvent('click', headerMenuBtn);
  headerMenuAddEvent('click', headerTopCopyMenuBtn);
  if (headerTopCopyUserMenuBtn) headerMenuAddEvent('click', headerTopCopyUserMenuBtn);


  // mobile user menu

  const headerUserMenuBtn = document.querySelector('.header-mobile__user--logged');
  const headerUserMenu = document.querySelector('.header-mobile__user-menu');
  let headerTopCopy2UserMenuBtnBurger;
  let headerTopCopy2UserMenuBtn;

  function headerUserMenuAddEvent(event, elem) {
    elem.addEventListener(event, () => {
      headerUserMenuBtn.classList.toggle('active');
      headerTopCopy2UserMenuBtnBurger.classList.toggle('active');
      headerUserMenu.classList.toggle('active');
      toggleBodyLock();
    });
  }

  if (headerUserMenuBtn && headerUserMenu) {
    const headerTopCopy2 = document.querySelector('.header-mobile__top').cloneNode(true);
    headerUserMenu
      .querySelector('.header-mobile__user-menu-inner')
      .insertBefore(headerTopCopy2, headerUserMenu.querySelector('.header-mobile__user-menu-inner').firstChild);
    headerTopCopy2UserMenuBtnBurger = headerTopCopy2.querySelector('.header-mobile__menu-btn');
    headerTopCopy2UserMenuBtn = headerTopCopy2.querySelector('.header-mobile__user--logged');

    headerUserMenuAddEvent('click', headerUserMenuBtn);
    headerUserMenuAddEvent('click', headerTopCopy2UserMenuBtnBurger);
    headerUserMenuAddEvent('click', headerTopCopy2UserMenuBtn);
    headerUserMenuAddEvent('click', headerTopCopyUserMenuBtn);
  }


  // mobile submenu

  const headerMobileSubmenuLinks = document.querySelectorAll('.header-mobile__menu-submenu-link');

  headerMobileSubmenuLinks.forEach(link => {
    link.addEventListener('click', function() {
      this.classList.toggle('active');
    });
  });


  /**
   * Menu search
   */

  const menuSearch = document.getElementById('menu-search');

  menuSearch.oninput = function() {
    const filter = this.value.toLowerCase().trim();
    const ul = document.getElementById('menu-search-list');
    const lis = ul.querySelectorAll('li');

    for (let i = 0; i < lis.length; i++) {
      const liText = lis[i].querySelector('a>span:nth-child(2)>span:first-child').textContent.toLowerCase();

      if (~liText.indexOf(filter)) {
        lis[i].style.display = '';
      } else {
        lis[i].style.display = 'none';
      }
    }
  };


  /**
   * View pass button
   */

  $('.input-group-password-viewer').click(function() {
    if ($(this).siblings('input').attr('type') == 'password') {
      $(this).siblings('input').attr('type', 'text');
    } else {
      $(this).siblings('input').attr('type', 'password');
    }
  });


  /**
   * Hero tabs
   */

  const heroTabs = document.querySelector('.hero-tabs');

  if (heroTabs) {
    heroTabs.onclick = function(e) {
      const btn = e.target;
      if (btn.tagName !== 'BUTTON') return;

      const btns = this.querySelectorAll('button');

      btns.forEach(btn => {
        btn.classList.remove('active');
      });

      btn.classList.add('active');

      let index;

      const parentChildren = btn.parentElement.children;

      for (let i = 0; i < parentChildren.length; i++) {
        if (parentChildren[i] === btn) index = i;
      }

      const tabs = this.querySelectorAll('.hero-tabs__content>div');

      tabs.forEach(tab => {
        tab.classList.remove('active');
      });

      tabs[index].classList.add('active');
    };
  }


  /**
   * Disabled state
   */

  // document.addEventListener('click', function(e) {
  //   const toggle = e.target.closest('[data-disabled-toggle]');
  //   if (!toggle) return;

  //   const toggleTarget = document.querySelector(`[data-disabled-target="${toggle.dataset.disabledToggle}"]`);
  //   if (!toggleTarget) return;

  //   toggleTarget.disabled = !toggleTarget.disabled;
  // });


  /**
   * Flatpickr
   * https://flatpickr.js.org/examples/
   */

  const flatpickrHero = flatpickr('.flatpickr-hero', {
    // https://flatpickr.js.org/localization/
    // https://unpkg.com/browse/flatpickr@4.6.3/dist/l10n/
    // locale: 'ru',
    inline: true,
    mode: 'range',
    showMonths: 2, //https://github.com/flatpickr/flatpickr/issues/747
    minDate: new Date().setHours(0, 0, 0, 0),
    onReady: function() {
      const dateFrom = document.querySelector(this.element.dataset.elemFrom);
      const dateTo = document.querySelector(this.element.dataset.elemTo);

      if (!dateFrom || !dateTo) return;

      dateFrom.autocomplete = true;
      dateTo.autocomplete = true;

      dateFrom.onfocus = function() {this.blur();};
      dateTo.onfocus = function() {this.blur();};

      const hide = this.element.dataset.hidden !== undefined;
      if (hide) setTimeout(() => this.element.parentElement.hidden = true, 0);

      // https://github.com/flatpickr/flatpickr/issues/278
      const lang = this.element.dataset.lang;
      if (lang) this.set('locale', lang);
    },
    onChange: function(selectedDates) {
      const dateFrom = document.querySelector(this.element.dataset.elemFrom);
      const dateTo = document.querySelector(this.element.dataset.elemTo);

      if (!dateFrom || !dateTo) return;

      dateFrom.value = dateTo.value = '';

      if (selectedDates.length === 2) {
        dateFrom.value = getOnlyDateISO(selectedDates[0]);
        dateTo.value = getOnlyDateISO(selectedDates[1]);

        const hide = this.element.dataset.hidden !== undefined;
        if (hide) this.element.parentElement.hidden = true;
      }

      // Synchronize all instances on the page
      if (Array.isArray(flatpickrHero)) {
        flatpickrHero.forEach(item => {
          if (item !== this) {
            item.setDate(this.selectedDates);
            // otherwise it jumps a month ahead
            item.changeMonth(this.currentMonth, false);
          }
        });
      }
    },
  });

  const dateFromInput = document.querySelector('[data-datepicker-from]');
  const dateToInput = document.querySelector('[data-datepicker-to]');

  const dateMobileFromInput = document.querySelector('[data-datepicker-mob-from]');
  const dateMobileToInput = document.querySelector('[data-datepicker-mob-to]');

  if (dateFromInput && dateToInput && dateMobileFromInput && dateMobileToInput) {
    dateMobileFromInput.min = getOnlyDateISO(new Date());
    dateMobileToInput.min = getOnlyDateISO(new Date());

    dateMobileFromInput.onchange = function() {
      dateMobileToInput.min = this.value || getOnlyDateISO(new Date());

      if (!this.value) return;

      // Дата не раньше, чем сегодня
      let date = new Date(this.value);
      date.setHours(0,0,0,0);
      let dateNow = new Date();
      dateNow.setHours(0,0,0,0);

      if (date.getTime() < dateNow.getTime()) {
        this.value = getOnlyDateISO(dateNow);
      }

      // Дата не позже, чем "До"
      let dateTo = dateMobileToInput.value;
      if (!dateTo) return;

      dateTo = new Date(dateTo);
      dateTo.setHours(0,0,0,0);

      if (date.getTime() > dateTo.getTime()) {
        this.value = getOnlyDateISO(dateTo);
      }
    };
    dateMobileToInput.onchange = function() {
      dateMobileFromInput.max = this.value;

      if (!this.value) return;

      // Не раньше, чем дата "От" и не раньше, чем сегодня
      let date = new Date(this.value);
      date.setHours(0,0,0,0);

      let dateFrom = dateMobileFromInput.value;

      if (dateFrom) {
        dateFrom = new Date(dateFrom);
        dateFrom.setHours(0,0,0,0);

        if (date.getTime() < dateFrom.getTime()) {
          this.value = getOnlyDateISO(dateFrom);
        }
      } else {
        let dateNow = new Date();
        dateNow.setHours(0,0,0,0);

        if (date.getTime() < dateNow.getTime()) {
          this.value = getOnlyDateISO(dateNow);
        }
      }

    };

    switchDateFromToInputsState();

    document.addEventListener('mobile', function() {
      switchDateFromToInputsState();
      synchronizeDateFromToInputsValues(false);
    });
    document.addEventListener('desktop', function() {
      switchDateFromToInputsState();
      synchronizeDateFromToInputsValues(true);
    });

    document.addEventListener('click', function(e) {
      dateFromToListener(e);
    });
  }

  function dateFromToListener(e) {
    const target = e.target.closest('[data-date-from-to-id]');

    if (!target) {
      if (e.target.closest('.date-from-to')) return;
      hideAllDateFromToInstances();
      return;
    }

    const id = target.dataset.dateFromToId;
    if (!id) return;

    const elem = document.getElementById(id);
    if (!elem) return;

    //elem.hidden = !elem.hidden;
    elem.hidden = false;
  }

  function switchDateFromToInputsState() {
    if (itIsDesktop) {
      dateMobileFromInput.disabled = true;
      dateMobileToInput.disabled = true;
      dateFromInput.disabled = false;
      dateToInput.disabled = false;
    } else {
      dateMobileFromInput.disabled = false;
      dateMobileToInput.disabled = false;
      dateFromInput.disabled = true;
      dateToInput.disabled = true;
    }
  }

  function synchronizeDateFromToInputsValues(desktop) {
    if (!desktop) {
      if (dateFromInput.value) dateMobileFromInput.value = dateFromInput.value;
      if (dateToInput.value) dateMobileToInput.value = dateToInput.value;
      dateMobileToInput.min = dateFromInput.value;
      dateMobileFromInput.max = dateToInput.value;
    } else {
      if (dateMobileFromInput.value && dateMobileToInput.value) {
        dateFromInput.value = dateMobileFromInput.value;
        dateToInput.value = dateMobileToInput.value;

        setDateFromToDesktopDates([dateMobileFromInput.value, dateMobileToInput.value]);
      } else if (dateMobileFromInput.value) {
        dateFromInput.value = dateMobileFromInput.value;

        setDateFromToDesktopDates([dateMobileFromInput.value, '']);
      } else if (dateMobileToInput.value) {
        dateToInput.value = dateMobileToInput.value;

        setDateFromToDesktopDates(['', dateMobileToInput.value]);
      }
    }
  }

  function setDateFromToDesktopDates(dates) {
    const firstDate = dates[0] ? new Date(dates[0]).getMonth() : Infinity;
    const secondDate = dates[1] ? new Date(dates[1]).getMonth() : Infinity;
    const currentMonth = Math.min(firstDate, secondDate);

    if (Array.isArray(flatpickrHero)) {
      flatpickrHero.forEach(item => {
        item.setDate(dates);
        // otherwise it jumps a month ahead
        item.changeMonth(currentMonth, false);
      });
    } else {
      flatpickrHero.setDate(dates);
      // otherwise it jumps a month ahead
      flatpickrHero.changeMonth(currentMonth, false);
    }
  }

  function hideAllDateFromToInstances() {
    document.querySelectorAll('.date-from-to').forEach(el => el.hidden = true);
  }

  function getOnlyDateISO(date) {
    let yy = date.getFullYear();
    let mm = date.getMonth() + 1;
    if (mm < 10) mm = '0' + mm;
    let dd = date.getDate();
    if (dd < 10) dd = '0' + dd;

    return `${yy}-${mm}-${dd}`;
  }


  // Single flatpickr

  flatpickr('.flatpickr', {
    // https://flatpickr.js.org/localization/
    // https://unpkg.com/browse/flatpickr@4.6.3/dist/l10n/
    // locale: 'ru',
    monthSelectorType: 'static',
    minDate: Date.now(),
    onReady: function() {
      // https://github.com/flatpickr/flatpickr/issues/278
      const lang = this.element.dataset.lang;
      if (lang) this.set('locale', lang);
      this.redraw();
    },
  });


  /**
   * FAQ
   */

  const faqLists = document.querySelectorAll('.faq-list');

  faqLists.forEach(list => {
    list.addEventListener('click', function(e) {
      const target = e.target.closest('li > a');

      if (!target) return;

      e.preventDefault();
      target.classList.toggle('active');
    });
  });


  /**
   * Share
   */

  let shareBtn = null;

  document.addEventListener('click', function(e) {
    const isTarget = e.target.classList.contains('share__btn');
    const isShareLinks = e.target.closest('.share__links');

    if (isShareLinks) return;

    if (shareBtn && !isTarget) {
      shareBtn.classList.remove('active');
      shareBtn = null;
      return;
    }

    if (shareBtn && isTarget && shareBtn !== e.target) {
      shareBtn.classList.remove('active');
      shareBtn = null;
    }

    if (!isTarget) return;

    shareBtn = e.target;
    shareBtn.classList.toggle('active');
  });


  /**
   * Write a comment
   */

  const writeComments = document.querySelectorAll('[data-write-a-comment]');

  writeComments.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();

      const messageContainer = document.querySelector('.write-a-comment');

      if (this.dataset.doNotHide == undefined) this.parentElement.hidden = true;

      let elemToHide = document.querySelector(this.dataset.hide);

      if (elemToHide) elemToHide.hidden = true;

      messageContainer.classList.add('active');
      // this.style.display = 'none';
      messageContainer.querySelector('textarea').focus();
    });
  });


  /**
   * User Profile Avatar
   */

  // const userProfileAvatarImg = document.querySelector('.user-block__profile>div>input[type="file"]');

  // if (userProfileAvatarImg) {
  //   const container = userProfileAvatarImg.parentElement;

  //   const initialSpan = container.querySelector('span');
  //   if (initialSpan) initialSpan.classList.add('initial');

  //   const initialImage = container.querySelector('img');
  //   if (initialImage) initialImage.classList.add('initial');
  // }

  // userProfileAvatarImg.addEventListener('change', function(e) {
  //   const file = e.target.files[0];

  //   const container = e.target.parentElement;

  //   let initialSpan, initialImage;
  //   initialSpan = container.querySelector('span.initial');
  //   initialImage = container.querySelector('img.initial');

  //   if (file) {
  //     const image = document.createElement('img');
  //     image.src = URL.createObjectURL(file);

  //     if (initialSpan) initialSpan.classList.add('hidden');
  //     if (initialImage) initialImage.classList.add('hidden');

  //     container.querySelectorAll('img:not(.initial)').forEach(el => {
  //       el.remove();
  //     });

  //     container.append(image);
  //   } else {
  //     if (initialSpan) initialSpan.classList.remove('hidden');
  //     if (initialImage) initialImage.classList.remove('hidden');

  //     container.querySelectorAll('img:not(.initial)').forEach(el => {
  //       el.remove();
  //     });
  //   }
  // });


  /**
   * user tabs toggler
   */

  const userTabsToggler = document.querySelector('.user-block__tabs-toggler');

  if (userTabsToggler) {
    userTabsToggler.onclick = function(e) {
      const togglers = this.querySelectorAll('label');
      const toggler1 = togglers[0];
      const toggler2 = togglers[1];
      const tabs = document.querySelectorAll('.user-block__add-car-tab');

      if (e.target !== toggler1 && e.target !== toggler2) return;

      tabs.forEach(tab => tab.classList.remove('active'));

      if (e.target === toggler1) {
        tabs[0].classList.add('active');
      }

      if (e.target === toggler2) {
        tabs[1].classList.add('active');
      }
    };
  }


  /**
   * User file uploader
   */

  const userFileUploaders = document.querySelectorAll('.user-image-uploader');

  userFileUploaders.forEach(uploader => {
    const input = uploader.querySelector('input[type="file"]');
    const uploadedText = input.dataset.uploadedText || 'Файл(ы) загружен(ы)';
    const textOutput = uploader.querySelector('span span');

    uploader.onkeypress = function(e) {
      if (e.keyCode == 13) {
        input.click();
      }
    };

    input.onchange = function() {
      if (input.multiple) {
        const numberOfFiles = this.files.length || 0;
        textOutput.innerText = `${uploadedText} ${numberOfFiles}`;
      } else {
        textOutput.innerText = `${uploadedText}`;
      }
    };
  });


  /**
   * Show and active
   */

  const showAndActive = document.querySelectorAll('[data-show-and-active]');

  showAndActive.forEach(item => {
    item.addEventListener('click', function showAndActiveListener(e) {
      const currentTarget = e.currentTarget;
      const targetSelector = currentTarget.dataset.showAndActive;

      if (!targetSelector) return;

      const targetElement = document.querySelector(targetSelector);

      currentTarget.classList.add('active');
      targetElement.hidden = false;

      if (targetElement.getBoundingClientRect().bottom > document.documentElement.clientHeight) {
        targetElement.scrollIntoView(false);
        window.scrollBy(0, 50);
      }

      currentTarget.removeEventListener('click', showAndActiveListener);
    });
  });


  /**
   * User table checkboxes
   */

  const groupedCheckboxes = document.querySelectorAll('.grouped-checkboxes input[type="checkbox"]');

  groupedCheckboxes.forEach((checkbox, index) => {
    if (index == 0) {
      checkbox.addEventListener('click', function() {
        groupedCheckboxes.forEach(checkbox => {
          checkbox.checked = this.checked;
        });
      });
    } else {
      checkbox.addEventListener('click', function() {
        if (!this.checked) {
          groupedCheckboxes[0].checked = false;
        }
      });
    }
  });


  /**
   * Attach file
   */

  const attachFile = document.querySelectorAll('.attach-file');

  attachFile.forEach(uploader => {
    const input = uploader.querySelector('input[type="file"]');
    const uploadedText = input.dataset.uploadedText || 'Файл(ы) загружен(ы)';
    const textOutput = uploader.querySelector('label');
    const initialText = textOutput.innerHTML;

    uploader.onkeypress = function(e) {
      if (e.keyCode == 13) {
        input.click();
      }
    };

    input.onchange = function() {
      if (this.files.length) textOutput.innerHTML = `${uploadedText}`;
      else textOutput.innerHTML = initialText;
    };

  });


  /**
   * To top button
   */

  checkToTopButton();

  $(window).on('scroll', function() {
    checkToTopButton();
  });

  function checkToTopButton() {
    var wHeight = window.innerHeight;

    if ($(window).scrollTop() > wHeight * 2) {
      $('.to-top-button').addClass('fixed');
    } else {
      $('.to-top-button').removeClass('fixed');
    }
  }

  $('.to-top-button').click(function(e) {
    e.preventDefault();
    e.stopPropagation();

    $('html, body').animate({
      scrollTop: 0
    }, 400);
  });


  /**
   * Sticky footer
   */

  function StickyFooter() {
    var footerHeight = $('.footer').outerHeight();
    $('.wrapper').css('paddingBottom', footerHeight);
  }

  $(window).resize(function(){
    StickyFooter();
  });

  StickyFooter();

});


window.onload = function() {

  /**
   * Relocate elements
   */

  setTimeout(() => {
    relocateElementsTo();
  }, 0);

  function relocateElementsTo() {
    const elems = document.querySelectorAll('[data-relocate-to]');

    elems.forEach(elem => {
      const relocateTo = elem.dataset.relocateTo;

      if (!relocateTo) return;

      const container = document.querySelector(relocateTo);

      if (!container) return;

      container.append(elem);
    });
  }

};