$(document).ready(function() {
// document.getElementById("accountInfo").onclick = function () {
//     location.href = "accountInfo.php";
// }

    updateHotelCardsByDropdown();

});

function updateHotelCardsByDropdown(){
    $("#Province").on("change", function (){
        let result = $(this).val();
        $.ajax({
            url: "hotelCards.php",
            type: "POST",
            data: {'Province': result},
            success: function (response){
                $("#hotel-cards").html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        })
    });
}

// function sortingDataByDropdown(keyName, page, responseId) {
//     let myUrl = "../php/" + page + ".php";
//     let inputElement = '#' + keyName;
//     $(inputElement).on('change', function (){
//         let result = $(this).val();
//
//         $.ajax({
//             url: myUrl,
//             type: 'GET',
//             data: {[keyName]: "sorting_" + result},
//             success: function (response){
//                 console.log(response);
//                 $('#' + responseId).html(response);
//             },
//             error: function(xhr, status, error) {
//                 console.error(error);
//             }
//         });
//     });
// }
