$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#movie_file').on('change', function (e) {
        e.preventDefault();
        $('#movie_box_file').css('display', 'none');
        $('#movie_details').css('display', 'block');

        var movie = this.files[0];
        var movie_name = movie.name.split('.').slice(0, -1).join('.');
        var movie_id = $(this).attr('data-movie-id');
        var url = $(this).attr('data-url');

        $('#movie_name').val(movie_name);

        var form_data = new FormData();
        form_data.append('movie_id', movie_id);
        form_data.append('movie_name', movie_name);
        form_data.append('movie', movie);
        var interval;

        $.ajax({
            url: url,
            type: "POST",
            data: form_data,
            contentType: false,
            processData: false,
            cache: false,
            success: function (movieBeforeProcessing) {
                interval = setInterval(function () {
                    $.ajax({
                        url: `/dashboard/movies/${movieBeforeProcessing.id}`,
                        method: 'GET',
                        data: {},
                        success: function (movieWhileProcessing) {
                            $('#movie_uploading_label').html('Processing');
                            $('.progress-bar').css('width', movieWhileProcessing.percent + '%').html(movieWhileProcessing.percent + '%');

                            if (movieWhileProcessing.percent == 100) {
                                clearInterval(interval);
                                $('#movie_uploading_label').html('done processing').css('color', 'green');
                                $('#movie_submit_btn').css({
                                    'display': 'block',
                                    'margin': 'auto',
                                });
                            }
                        }
                    });
                }, 1000)
            },

            xhr: function () {
                var xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100) + '%';
                        $('.progress-bar').css('width', percentComplete).html(percentComplete);

                        if (percentComplete == '100%') {

                        }

                    }
                }, false);

                return xhr;
            },
        });
    })
});
