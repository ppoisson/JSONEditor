// JQuery for JSONEditor

$(document).on("keyup, blur", ".home-config", function(e){

  var home_config = {};

  $(".node").each(function(){

    var _name = $(this).attr("data-name");

    home_config[_name] = [];

    $(this).find(".well").each(function(w){

      home_config[_name][w] = {};

      $(this).find("input").each(function(i){

        var _iname = $(this).attr("name");
        var _ivalu = $(this).val();

        home_config[_name][w][_iname] = _ivalu;

      });

      $(this).find("textarea").each(function(i){

        var _itype = $(this).attr("data-type");
        var _iname = $(this).attr("name");

        if(_itype == "array"){
          var _ivalu = $(this).val().split("\r");
        } else {
          var _ivalu = $(this).val();
        }

        home_config[_name][w][_iname] = _ivalu;

      });

    });

  });

  $("#config").val( JSON.stringify(home_config, null, 4) );

});

$(document).ready(function() {

  // check for the hash, if its present use it need to retain the users tab

  if (location.hash) {

    $("a[href='" + location.hash + "']").tab("show");

  }

  // set the hash at this event

  $(document.body).on("click", "a[data-toggle]", function(event) {

    location.hash = this.getAttribute("href");

  });

});

// show the proper tab

$(window).on("popstate", function() {

  var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");

  $("a[href='" + anchor + "']").tab("show");

});
