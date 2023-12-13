

$(document).ready(function () {

    // get form ID and redirect to search results page with the search value
    $('#searchResults').on('submit', function (ev) {
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
                window.location.href = "searchResults.php?search=" + encodeURIComponent(search);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    // redirect to account info after button click on account

    $('#accountInfo').on('click', function (ev) {
        location.href = "accountInfo.php";
    });



    // call functions for filtering province and availability
    updateHotelCardsByDropdown("Province");
    updateHotelCardsByDropdown("Availability");
});

function updateHotelCardsByDropdown(buttonId) {
    $("#" + buttonId).on("change", function () {
        let result = $(this).val();
        $.ajax({
            url: "hotelCards.php",
            type: "POST",
            data: { [buttonId]: result },
            success: function (response) {
                $("#hotel-cards").html(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        })
    });
}