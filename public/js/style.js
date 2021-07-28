jQuery(function ($) {
  $('.js-accordion-title').on('click', function () {
    /*クリックでコンテンツを開閉*/
    $(this).next().slideToggle(200);
    /*矢印の向きを変更*/
    $(this).toggleClass('open', 200);
  });

});

// 4.x.1 モーダルの設置
$(function () {
  $('.modalopen').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      console.log(modal);
      $(modal).fadeIn();
      return false;
    });
  });
  // $('.modal-main').not('.form-control-edit .image-modal').on('click', function () {
  //   $('.js-modal').fadeOut();
  //   return false;
  // });
});
