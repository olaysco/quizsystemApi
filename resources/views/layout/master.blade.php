<html>
<head>
    <title>Quiz System</title>
</head>
<body>
    <div class="container">
            @if (count($errors)>0)
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        @endif
        @yield('content')
    </div>
</body>
</html>