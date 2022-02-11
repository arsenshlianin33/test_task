<!DOCTYPE html>
<html>
<head>
    <title>Short Url</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"/>
</head>
<body>

<div class="container">
    <h1 class="text-center mt-5">Short Url</h1>

    <div class="card">
        <div class="card-header">
            <form method="POST" action="{{ route('generate.short.url') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="link" class="form-control w-100" placeholder="Enter URL"
                           aria-label="Recipient's username" aria-describedby="basic-addon2">
                </div>
                <div class="d-flex justify-content-between">
                    <input type="text" name="transitions" class="form-control" placeholder="Enter transitions"
                           aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <input type="text" name="time_of_action" class="form-control" placeholder="Enter time of action"
                           aria-label="Recipient's username" aria-describedby="basic-addon2">
                </div>
                <div class="input-group-append">
                    <button class="btn btn-success w-100 mt-5" type="submit">Generate Shorten Link</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            @if ($shortUrl ?? '')
                <div class="text-center">
                    <h3>Your shorted link</h3>
                    <a href="{{ route("short.url", ['shortUrl' => $shortUrl->short_url]) }}" target="_blank">{{ $shortUrl->short_url }}</a>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
