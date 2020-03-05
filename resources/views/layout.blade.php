<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <style type="text/css">
        .is-complete {
            text-decoration: line-through;
        }
    </style>
    
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="wrapper" style="margin: auto 15px;">
                @yield('content')
            </div>
        </div>
    </section>
</body>
</html>