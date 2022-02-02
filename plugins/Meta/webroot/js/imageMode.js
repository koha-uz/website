var $image_type_block = $('#image-type-block');
var $generate_image_type_block = $('#generate-image-type-block');
var $image_bg_block = $('#image-bg-block');

$(document).ready(function() {
    $image_type_block.find('input').change(function() {
        if ($(this).val() == 2) {
            $generate_image_type_block.css('display', 'block');
            $generate_image_type_block.find('input').prop('disabled', false);
            $generate_image_type_block.find('input:first').prop('checked', true);
        }

        if ($(this).val() == 1) {
            $generate_image_type_block.css('display', 'none');
            $generate_image_type_block.find('input').prop('disabled', true);
            $generate_image_type_block.find('input').prop('checked', false);

            $image_bg_block.css('display', 'none');
            $image_bg_block.find('input').prop('disabled', true);
        }
    });

    $generate_image_type_block.find('input').change(function() {
        if ($(this).val() == 2) {
            $image_bg_block.css('display', 'block');
            $image_bg_block.find('input').prop('disabled', false);
        }

        if ($(this).val() == 1) {
            $image_bg_block.css('display', 'none');
            $image_bg_block.find('input').prop('disabled', true);
        }
    });
});
