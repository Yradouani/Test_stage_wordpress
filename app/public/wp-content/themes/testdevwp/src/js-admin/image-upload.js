// import { media, select } from 'wp';

jQuery('.services-types-image-upload').on('click', function (event) {
    event.preventDefault();

    event.stopImmediatePropagation()

    const file_frame = wp.media.frames.file_frame = wp.media({
        title: 'Sélectionner une image',
        multiple: false
    });
    file_frame.open().on('select', function () {
        const uploadedImage = file_frame.state().get('selection').first().toJSON();
        console.log(uploadedImage);
        const imageId = uploadedImage.id;
        const imageSrc = uploadedImage.url;
        console.log(imageId);

        console.log(jQuery('#services_types_image'));
        jQuery('#services_types_image').val(imageId);
        if (jQuery('#update-img-container img').length > 0) {
            console.log("coucou")
            jQuery('#update-img-container img').attr('src', imageSrc);
        } else {
            var newImage = jQuery('<img>').attr('src', imageSrc);
            console.log("salut")
            console.log(newImage);
            jQuery('#update-img-container').append(newImage);
        }
    });
    return false;
});

jQuery('.services-types-image-remove').on('click', function (event) {
    jQuery('#services_types_image').val("");
})
