$(document).ready(function(){
    $('.driver-select').change(function(){
        var driverId = $(this).val();
        var bookingId = $(this).data('booking-id');
        var selectElement = $(this);

        if(driverId){
            $.ajax({
                url: base_url+'/booking/assign-driver',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    booking_id: bookingId,
                    driver_id: driverId
                },
                success: function(response){
                    if(response.success){
                        alert('Driver assigned successfully and email sent!');
                        // Disable the select box so it cannot be changed
                        selectElement.prop('disabled', true);
                    } else {
                        alert('Something went wrong: ' + response.message);
                        selectElement.val(''); // reset selection
                    }
                },
                error: function(){
                    alert('Error occurred while assigning driver.');
                    selectElement.val('');
                }
            });
        }
    });
});


