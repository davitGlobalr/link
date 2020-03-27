<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JS -->
    <title>Laravel</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"/>

</head>
<body>

<div class="container">
    <h2>Are you ready create url shortener using our test app? Let's do it</h2>

    <div class="card">
        <div class="card-header">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="link" class="form-control s-link" placeholder="Enter URL"
                       aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-success short-link" type="submit">Generate Shorten Link</button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="alert alert-success">
                <p>Линк успешно сгенерирован</p>
            </div>

            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>Short Link</th>
                    <th>Link</th>
                </tr>
                <tr>
                    <td id="shot-link"></td>
                    <td id="link"></td>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <div class="visible-print text-center qrCode">

            </div>
        </div>
    </div>

</div>
<script>
    $('.alert.alert-success').hide();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });

    $('.short-link').on('click', function(e) {
        e.preventDefault();
        var link = $('.s-link').val();
        $.ajax({
            type: "POST",
            url: "{{ route('generate.link.post') }}",
            data: {link:link},
            success: function(param)
            {
                if (param.success){
                    $('.alert.alert-success').slideDown(function () {
                        setTimeout(function () {
                            $('.alert.alert-success').slideUp("slow");
                        }, 1500);
                        $('#shot-link').html( "{{ route('base') }}/" + param.data.code);
                        $('#link').html(param.data.link);
                        $('.qrCode').html(param.data.qrCode);
                    });
                }
            },
            error: function(msg){
                console.log('error');
            }
        });
    });
</script>
</body>
</html>
