jQuery(function () {
    jQuery("#age_verif .over18").on("click", function () {
        console.log("clicked over18");

        let remember = jQuery(this).data("remember");

        let date = new Date();
        date.setDate(date.getDate() + remember);
        document.cookie = "is_over_18=true;path=/;expires="+date.toGMTString();

        jQuery("#age_verif").remove();
    });

    jQuery("#age_verif .younger").on("click", function () {
        jQuery("#age_verif .question").hide();
        jQuery("#age_verif button").hide();
        jQuery("#age_verif .not18").show();
    });
});