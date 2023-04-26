$(document).ready(function(){
    $('#collapse1').hide();
    $('#collapse2').hide();
    $('#collapse3').hide();
    $('#collapse4').hide();
    $('#collapse5').hide();
    $('#collapse6').hide();
    $('#collapse7').hide();

    $('#my_collapse1').click(function(){
        $('#collapse1').slideToggle();
        $('#collapse2').hide();
        $('#collapse3').hide();
        $('#collapse4').hide();
        $('#collapse5').hide();
        $('#collapse6').hide();
        $('#collapse7').hide();
    });
    $('#my_collapse2').click(function(){
        $('#collapse2').slideToggle();
        $('#collapse1').hide();
        $('#collapse3').hide();
        $('#collapse4').hide();
        $('#collapse5').hide();
        $('#collapse6').hide();
        $('#collapse7').hide();
    });
    $('#my_collapse3').click(function(){
        $('#collapse3').slideToggle();
        $('#collapse1').hide();
        $('#collapse2').hide();
        $('#collapse4').hide();
        $('#collapse5').hide();
        $('#collapse6').hide();
        $('#collapse7').hide();
    });
    $('#my_collapse4').click(function(){
        $('#collapse4').slideToggle();
        $('#collapse2').hide();
        $('#collapse3').hide();
        $('#collapse1').hide();
        $('#collapse5').hide();
        $('#collapse6').hide();
        $('#collapse7').hide();
    });
    $('#my_collapse5').click(function(){
        $('#collapse5').slideToggle();
        $('#collapse1').hide();
        $('#collapse3').hide();
        $('#collapse4').hide();
        $('#collapse2').hide();
        $('#collapse6').hide();
        $('#collapse7').hide();
    });
    $('#my_collapse6').click(function(){
        $('#collapse6').slideToggle();
        $('#collapse1').hide();
        $('#collapse2').hide();
        $('#collapse3').hide();
        $('#collapse4').hide();
        $('#collapse5').hide();
        $('#collapse7').hide();
    });
    $('#my_collapse7').click(function(){
        $('#collapse7').slideToggle();
        $('#collapse1').hide();
        $('#collapse2').hide();
        $('#collapse3').hide();
        $('#collapse4').hide();
        $('#collapse5').hide();
        $('#collapse6').hide();
    });
});












