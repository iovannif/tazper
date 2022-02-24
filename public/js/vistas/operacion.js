$(function(){
    jQuery('.registro').hover(function(){
        jQuery(this).find('.operacion').css('visibility','visible');
    }, function(){
        jQuery(this).find('.operacion').css('visibility','hidden');
    });
});