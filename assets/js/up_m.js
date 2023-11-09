// croppie
$(document).ready(function () {
    $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 230,
            type: 'square' //circle
        },
        boundary: {
            width: 350,
            height: 350
        }
    });

    $('#upload_image').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#editGambar').modal('hide');
        $('#uploadimageModal').modal('show');
    });

    $('.crop_image').click(function (event) {
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $.ajax({
                url: "<?= base_url('Profil_m/upload') ?>",
                type: "POST",
                data: {
                    "image": response
                },
                success: function (data) {
                    $('#uploadimageModal').modal('hide');
                    $('#uploaded_image').html(data);
                }
            });
        })
    });
});