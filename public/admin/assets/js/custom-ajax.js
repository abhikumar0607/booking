$(document).ready(function(){
    $('.driver-select').change(function(){
        var driverId = $(this).val();
        var bookingId = $(this).data('booking-id');
        var selectElement = $(this);
        var messageDiv = $('#driver-message-' + bookingId);

        if(driverId){
            // Disable select and show loader
            selectElement.prop('disabled', true);
            messageDiv.html('<span class="text-blue-500">Assigning driver, please wait...</span>');

            $.ajax({
                url: base_url + '/booking/assign-driver',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    booking_id: bookingId,
                    driver_id: driverId
                },
                success: function(response){
                    if(response.success){
                        messageDiv
                            .text('Driver assigned successfully and email sent!')
                            .removeClass('text-red-500 text-blue-500')
                            .addClass('text-green-500');
                        // Keep select disabled
                    } else {
                        messageDiv
                            .text('Something went wrong: ' + response.message)
                            .removeClass('text-green-500 text-blue-500')
                            .addClass('text-red-500');
                        selectElement.prop('disabled', false); // re-enable
                        selectElement.val(''); // reset selection
                    }
                },
                error: function(){
                    messageDiv
                        .text('Error occurred while assigning driver.')
                        .removeClass('text-green-500 text-blue-500')
                        .addClass('text-red-500');
                    selectElement.prop('disabled', false); // re-enable
                    selectElement.val('');
                }
            });
        }
    });
});
