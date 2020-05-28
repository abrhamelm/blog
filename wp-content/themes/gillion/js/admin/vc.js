jQuery(function($) {

    $(".sh-categories-container li").on("click", function() {
        $(".sh-categories-container li").removeClass("active");
        $(this).addClass("active");

        if( $(this).attr("data-sort") == "all" ) {
            $(".sh-templates-container .sh-template").css("display", "block");
        } else {
            $(".sh-templates-container .sh-template").css("display", "none");
            $(".sh-templates-container").find( ".sh-template." + $(this).attr("data-sort") ).css("display", "block");
        }
    });

    $(".sh-template-add").on( "click", function() {
        $(this).closest(".sh-template-container").find(".sh-template-loading").addClass( "active" );
    });

    $(window).load(function() {
        $(".vc_templates-panel").bind("DOMSubtreeModified", function(e) {
            $(".vc_templates-panel .sh-template-loading.active").removeClass("active");
            $("#vc_templates_name_filter").focus();
        });
    });

});
