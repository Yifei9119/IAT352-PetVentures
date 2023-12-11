$(document).ready(function() {
    handleDataByButton("addFavorite");
    handleDataFromBackEnd("addFavorite");
});

function handleDataByButton(keyName){
    $('.' + keyName).click(function() {
        if (!isLogin) {
            window.location.href = '../php/login.php';
            return;
        }
        let button = $(this);
        let myUrl;
        if (keyName === "addFavorite"){
            myUrl = "favoriteListAjax.php";
        }
        else return;
        let guideId = $(this).data('guide-id');
        let field = keyName + '_guideId';
        $.ajax({
            type: 'POST',
            url: myUrl,
            data: { [field]: guideId },
            success: function(response) {
                button.toggleClass('style');
            },
            error: function() {
                alert('failed to add to favourites');
            }
        });
    });
}

function handleDataFromBackEnd(keyName){
    let myUrl;
    if (keyName === "addFavorite") myUrl = "add_favorite.php";
    else return;
    $.ajax({
        type: 'GET',
        url: myUrl,
        success: function(response) {
            let hotels = JSON.parse(response);
            hotels.forEach(function(guideId) {
                $('button.' + keyName + '[data-guide-id="' + guideId + '"]').addClass('style');
            });
        }
    });
}