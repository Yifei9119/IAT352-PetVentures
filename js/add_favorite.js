$(document).ready(function() {
    handleDataByButton("addFavorite");
    handleDataFromBackEnd("addFavorite");
});

function handleDataByButton(keyName){
    $('.' + keyName).click(function() {
        // if (!isLogin) {
        //     window.location.href = '../php/login.php?loginRequest=' + keyName;
        //     return;
        // }
        let button = $(this);
        let myUrl;
        if (keyName === "addFavorite"){
            myUrl = "favoriteList.php";
        }
        // else if (keyName === "userFavorite"){
        //     myUrl = "../php/handleUserFavorites.php";
        // }
        // else if (keyName === "commentLike"){
        //     myUrl = "../php/handleCommentLikes.php";
        // }
        else return;
        let guideId = $(this).data('guide-id');
        let field = keyName + '_guideId';
        $.ajax({
            type: 'POST',
            url: myUrl,
            data: { [field]: guideId },
            success: function(response) {
                button.toggleClass('style');
                // let guideId = button.data('guide-id');
                alert('hotel has been added to favourites');
                // updateCount(keyName, guideId);
            },
            error: function() {
                alert('failed to add to favourites');
            }
        });
    });
}

// function updateCount(keyName, guideId) {
//     let countUrl;
//     if (keyName === "userLike"){
//         countUrl = "../php/getLikeCount.php";
//     }
//     else if (keyName === "userFavorite"){
//         countUrl = "../php/getFavoriteCount.php";
//     }
//     else if (keyName === "commentLike"){
//         countUrl = "../php/getCommentLikeCount.php";
//     }
//     $.ajax({
//         url: countUrl,
//         type: 'GET',
//         data: { guideId: guideId },
//         success: function(count) {
//             $('p.count[data-' + keyName + '-guide-id="' + guideId + '"]').text(count);
//         }
//     });
// }

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