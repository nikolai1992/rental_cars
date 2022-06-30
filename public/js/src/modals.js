document.addEventListener('DOMContentLoaded', () => {

  // ESLint globals - https://eslint.org/docs/user-guide/configuring#specifying-globals
  /* global $ */

  /**
   * Magnific popup
   */

  const magnificPopup = $.magnificPopup.instance;

  initMagnificPopups();

  function initMagnificPopups() {

    let prevModalSel;

    // Open new modal from another modal with another parameters
    // https://stackoverflow.com/a/44893576/8313588
    $('.modal-open').click(function(e) {
      e.preventDefault();
      e.stopPropagation();

      const id = $(this).attr('href');

      // if this opener is in another modal, then save it id
      if (String($(this).data('go-back')) === 'true' && $(this).parents('.modal').length && $(this).parents('.modal').attr('id')) {
        prevModalSel = '#' + $(this).parents('.modal').attr('id');
      }

      modalOpen(id);
    });

    $('.modal-video-open').click(function(e) {
      e.preventDefault();
      e.stopPropagation();

      const videoUrl = $(this).attr('href');
      modalOpen(videoUrl, 'iframe', true);
    });

    // Open modal form hash
    const modalHash = window.location.hash;
    if ($(modalHash).hasClass('modal')) {
      modalOpen(modalHash);
    }

    function modalOpen(src, type, clsBtn = false) {
      $.magnificPopup.close();

      $.magnificPopup.open({
        items: {
          src: src
        },
        type: type || 'inline',
        preloader: false,
        focus: '.modal-focus', // focus this element after open a modal
        showCloseBtn: clsBtn,
        // closeOnBgClick: false,
      });
    }

    // если нужно вручную закрыть, код ниже. Нужно тогда отключить - closeOnBgClick: false в опциях модалки
    // не помню зачем делал, но пусть будет
    // $(window).click(function (e) {
    //   if (!!$(e.target).closest('.mfp-wrap').length && !$(e.target).closest('.modal').length) {
    //     modalClose();
    //   }
    // });

    $('.modal__close, .modal-close').click(function (e) {
      e.preventDefault();
      e.stopPropagation();

      modalClose();
    });

    function modalClose() {
      magnificPopup.close();

      if (prevModalSel) {
        modalOpen(prevModalSel);
        prevModalSel = null;
      }
    }
  }

});