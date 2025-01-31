jQuery(document).ready(function ($) {
    // Open modal
    $('#customize-now-button').on('click', function () {
        $('#customize-modal').fadeIn();
    });

    // Close modal
    $('.close').on('click', function () {
        $('#customize-modal').fadeOut();
    });

    // Validate form before submission
    $('#customization-form').on('submit', function (e) {
        e.preventDefault();
        const customerName = $('#customer_name').val();
        const customerMessage = $('#customer_message').val();
        const customerImages = $('#customer_images')[0].files;

        if (!customerName || !customerMessage || customerImages.length === 0) {
            alert('Please fill out all fields and upload at least one image.');
            return;
        }

        // Submit form data via AJAX or proceed to add to cart
        $(this).unbind('submit').submit();
    });
});