//切換選取條件
  $(".dropdown-menu li a").click(function(){
    var selText = $(this).text();
    var selValue = $(this).attr("data-value");
    $(this).parents('.btn-group').find('.selectOption').html(selText);
    $(this).parents('.btn-group').find('.selectOption').attr("data-value",selValue);
  });

//--讀取明細--
$(document).on("click",".viewDt",function(){
    var diary_id =  $(this).parents("tr").find(".diary_id").html();
    //開關效果
    if($(this).hasClass("dtOpen")){
      $(".dt-box[dt-box='" + diary_id + "']").hide(250);
      $("[dt-row='" + diary_id + "']").slideUp(250);
      $(this).removeClass("dtOpen");
      $(this).text("瀏覽");
    }else{
      $(".dt-box[dt-box='" + diary_id + "']").show();
      $("[dt-row='" + diary_id + "']").slideDown(250);
      $(this).addClass("dtOpen");
      $(this).text("關閉");
    };
});

//--達成條--
$(document).ready(function(){
    //grains
    $(".grains-bar").each(function(){
      var grains = $(this).val();
      if (grains >= 2) {
          grains = 99.9;
          $(this).ionRangeSlider({
              hide_min_max: true,
              values: [0, 0.5, 1, 1.5, "完成"],
              from: grains,
              grid: false,
              disable: true
          });
      } else {
          $(this).ionRangeSlider({
              hide_min_max: true,
              values: [0, 0.5, 1, 1.5, 2],
              from: grains,
              grid: false,
              disable: true
          });
      };
    });
    //dairy
    $(".dairy-bar").each(function(){
      var dairy = $(this).val();
      if (dairy >= 1.5) {
          dairy = 99.9;
          $(this).ionRangeSlider({
              hide_min_max: true,
              values: [0, 0.5, 1, "完成"],
              from: dairy,
              grid: false,
              disable: true
          });
      } else {
          $(this).ionRangeSlider({
              hide_min_max: false,
              values: [0, 0.5, 1, 1.5],
              grid: false,
              disable: true
          });
      };
    });
    //fruits
    $(".fruits-bar").each(function(){
      var fruits = $(this).val();
      if (fruits >= 2) {
          fruits = 99.9;
          $(this).ionRangeSlider({
              hide_min_max: true,
              values: [0, 0.5, 1, 1.5, "完成"],
              from: fruits,
              grid: false,
              disable: true
          });
      } else {
          $(this).ionRangeSlider({
              hide_min_max: false,
              values: [0, 0.5, 1, 1.5, 2],
              grid: false,
              disable: true
          });
      };
    });
    //protein
    $(".protein-bar").each(function(){
      var protein = $(this).val();
      if (protein >= 4) {
          protein = 99.9;
          $(this).ionRangeSlider({
              hide_min_max: true,
              values: [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, "完成"],
              from: protein,
              grid: false,
              disable: true
          });
      } else {
          $(this).ionRangeSlider({
              hide_min_max: false,
              values: [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4],
              grid: false,
              disable: true
          });
      };
    });
    //vegetables
    $(".vegetables-bar").each(function(){
      var vegetables = $(this).val();
      if (vegetables >= 3) {
          vegetables = 99.9;
          $(this).ionRangeSlider({
              hide_min_max: true,
              values: [0, 0.5, 1, 1.5, 2, 2.5, "完美"],
              from: vegetables,
              grid: false,
              disable: true
          });
      } else {
          $(this).ionRangeSlider({
              hide_min_max: false,
              values: [0, 0.5, 1, 1.5, 2, 2.5, 3],
              grid: false,
              disable: true
          });
      };
    });
});