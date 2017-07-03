// tabbed content
    // http://www.entheosweb.com/tutorials/css/tabs.asp
    $(".tab_content").hide();

  /* if in tab mode */
    $("ul.tabs li").click(function() {

      $(".tab_content").hide();
      var activeTab = $(this).attr("rel");
      $("#"+activeTab).fadeIn();

      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");

    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {

      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel");
      $("#"+d_activeTab).fadeIn();

	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");

	  $("ul.tabs li").removeClass("active");
	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });


	/* Extra class "tab_last"
	   to add border to right side
	   of last tab */
	$('ul.tabs li').last().addClass("tab_last");


    if($(window).width() > 769) {
      $(".tab_content:first").show();
    } else {
      $(".tab_drawer_heading").removeClass("d_active");
    }

    $(window).resize(function(){
      if($(window).width() > 769) {
        $(".tab_content:first").show();
        $(".tab_drawer_heading").removeClass("d_active");
        $('.tabs li').removeClass("active");
        $('.tabs li').eq(0).addClass("active");
      } else {
        $(".tab_content").hide();
        $(".tab_drawer_heading").removeClass("d_active");
      }
    });