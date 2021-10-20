$(document).ready(function(){

    //onclick like function
    $(".likeButton").on("click", function(){
        //get the current count set in the p tag of the div as a integer
        var currentCount = parseInt($(this).children("p").text()); 
        //get the id of the mood that was clicked on with the data attr
        var moodId = $(this).data("id");
        console.log(moodId);

        //perform AJAX
        $.ajax({
            url: "/moods",
            type: "POST",
            data: { id: moodId },
            dataType: "text",
            async: true,

            success: function(data) {
                console.log(data);
                //TODO: - update the UI if successful
            },
            error: function(error) {
            }
        });

        //update the UI after ajax done - even though error happened
        $(this).children("p").text(currentCount + 1);
    });
});