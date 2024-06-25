<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'AMR :: Project Consultancy' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">
    <link href="{{ asset($styleLink ?? 'css/main.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/animation.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="{{ asset('build/assets/app-0d91dc04.js') }}"></script>
    <link rel="icon" href="{{ asset('images/amr_favicon.png') }}" type="image/x-icon">

</head>

<body class="fix-scroll">
    <x-navigation />
    <main class="">
        {{ $slot }}
    </main>
    <section id="video-container">
        <video id="verified-video" controls autoplay muted>
            <source
                src="https://firebasestorage.googleapis.com/v0/b/rutride-fb-d85a7.appspot.com/o/AMR_intro.mp4?alt=media&token=14d10214-774d-4f0f-9a37-044c7f4db925"
                type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
            Your browser does not support the video tag.
        </video>
        <div class="close-btn-container"><button class="close-btn">X Close</button></div>
    </section>
    <!-- include animation library -->
    <script src="{{ asset('/js/jsap.js') }}"></script>
    <script>
        const closeBtn = document.querySelector('.close-btn');
        const videoContainer = document.querySelector('#video-container');
        // don't play video again if user has watched it
        if (localStorage.getItem('watchedVideo') == 'true' && (window.location.pathname != '/intro')) {
            videoContainer.style.display = 'none';
            document.body.classList.remove('fix-scroll');
        }
        // hide nav
        if (!videoContainer.style.display) {
            navElem.style.display = "none";
            document.querySelector('main').style.display = "none";
        }

        // close the video
        closeBtn.addEventListener('click', function() {
            videoContainer.style.display = 'none';
            document.body.classList.remove('fix-scroll');
            localStorage.setItem('videoClosed', true);

            localStorage.setItem('videoClosed', null);
            localStorage.setItem('watchedVideo', true);
            window.location = '/';
        });

        gsap.from('.close-btn-container', {
            opacity: 0,
            duration: 2,
            y: -100,
            // scale: .25,
            delay: 3,
        })
    </script>
</body>

</html>
