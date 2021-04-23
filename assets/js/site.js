// $(document).on('click', '#add-prize-image', function (e) {
//    e.preventDefault();
//
//    $.ajax({
//       url: '/add-block-prize-image',
//       type: 'POST',
//       success: function (data) {
//          $('.prise-image').append(data);
//          setTimeout(showImageBlock, 1000);
//       }
//    })
// })
//
// function showImageBlock()
// {
//    $('.prise-image').css({"display" : "block"});
//
// }

$(document).on('click', '#add-prise-block-image', function (e) {
   e.preventDefault();
   $.ajax({
      url: '/add-block-prize',
      type: 'POST',
      success: function (data) {
         $('.prises').append(data);
      }
   })
})

$(document).on('click', '#create-contest', function (e) {
   e.preventDefault();

   let form = new FormData(document.getElementById('form-contest-create'));
   let image = $('.input-file-now').val();
   $('.input-file-now').each(function () {
      form.append('prize[image][]', $(this).val());
   })


   let image2 = $('.input-file-now');
   console.log(image2);


   $.ajax({
      url: '/create-contest',
      data: form,
      type: 'POST',
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (data) {
         console.log(data);
      }
   })
})