<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title?? 'AMR &#8211; Project Consultancy at its finest.'}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">
    <link href="{{ asset($styleLink?? 'css/main.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/animation.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body class="">
    <x-navigation />
    <main class="">
        {{ $slot}}
    </main>
    <!-- include animation library -->
    <script src="{{asset('/js/jsap.js')}}"></script>
    <!-- <script>
        // const duration = 4;
        gsap.from('#nav', {
            opacity: 0,
            duration: 1,
            // scale: .25,
            delay: 3,
        }) -->
    </script>
</body>

</html>