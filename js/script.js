$(document).ready(function() {
// get form ID and redirect to search results page with the search value
    $('#search').on('submit', function (ev) {
        ev.preventDefault();
        
        // original form action url
        var actionUrl = $(this).attr('action');
        console.log(actionUrl);
        
        // get form data
        var formData = $(this).serialize();
        console.log(formData);
        
        var form = $(this);
        
        $.ajax({
        		type: 'POST',
            url: actionUrl,
            data: formData,
            success: function (data) {
                var search = form.find('input[name="search"]').val();
                window.location.href = "searchResults.php?search="+encodeURIComponent(search);
            },
            error: function (data) {
            		console.log('Error:', data);
      			}
    		});
    });

 document.getElementById("accountInfo").onclick = function () {
    location.href = "accountInfo.php";
}

    updateHotelCardsByDropdown("Province");
    updateHotelCardsByDropdown("Availability");
});

function updateHotelCardsByDropdown(buttonId){
    $("#" + buttonId).on("change", function (){
        let result = $(this).val();
        $.ajax({
            url: "hotelCards.php",
            type: "POST",
            data: {[buttonId]: result},
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
