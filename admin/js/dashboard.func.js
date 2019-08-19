// gestion dashboard valider/effacer
$(document).ready(function(){

    $('.modal-trigger').leanModal();
    // désafficher en direct un commentaire en le passant comme vu en bdd
    $(".see_comment").click(function(){
        var id = $(this).attr("id");
        $.post('ajax/see_comment.php',{id:id},function(){
            $("#commentaire_"+id).hide();
        });
    });
    // désafficher en direct un commentaire en le supprimant de la bdd
    $(".delete_comment").click(function(){
        var id = $(this).attr("id");
        $.post('ajax/delete_comment.php',{id:id},function(){
                $("#commentaire_"+id).hide();
        });
    });

});