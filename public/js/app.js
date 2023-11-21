// Ajax Send
function ajaxSend(url, method, formData) {
    $('.lds-ring').fadeIn('fast');

    $.ajax({
        type: method,
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.code === 200){
                $('#response').append(`
                    <div class="col-md-12 alert alert-success" role="alert">
                        ${data.data.message}
                    </div>
                `);
            }else{
                $('#response').append(`
                    <div class="col-md-12 alert alert-danger" role="alert">
                        ${data.data.message}
                    </div>
                `);
            }

            $('.lds-ring').fadeOut('fast');
        },
        error: function (errors) {
            $.each(errors.responseJSON.errors, function (key, message) {
                $('#response').append(`
                    <div class="col-md-12 alert alert-danger" role="alert">
                        ${message[0]}
                    </div>
                `);
            });

            $('.lds-ring').fadeOut('fast');
        }
    });
}

function getData(url, method, formData) {
    $('.lds-ring').fadeIn('fast');

    return $.ajax({
        type: method,
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function personFetch(url)
{
    $('#parse-btn').on('click', function () {
        let providerId = $('#provider_id').val();
        let providerName = $('#provider_name').val();
        let parseLanguage = $('#parse_language').val();

        $.ajax({
            type: 'GET',
            url: url,
            data: {
                'provider_id': providerId,
                'provider_name': providerName,
                'language': parseLanguage,
            },
            success: function (data) {
                let person = data['data'];

                if (person.length !== 0) {
                    $('#name').val(person['name']);
                    $.each($('#gender option'), function (key, option) {
                        if (option.value === person['gender']) {
                            option.setAttribute('selected', 'selected');
                        }
                    });
                    $('#dbd').val(person['dbd']);
                    $('#names_'+parseLanguage).val(person['name']);
                    $('#biography_'+parseLanguage).val(person['biography']);

                    $('#image_url').val(person['image_url']);
                    $('#file_img').attr('src', person['image_url']);
                }
            }
        });
    });
}
