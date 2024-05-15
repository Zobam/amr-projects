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
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">
    <link href="{{ asset($styleLink ?? 'css/main.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/animation.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body class="fix-scroll">
    <x-navigation />
    <main class="">
        {{ $slot }}
    </main>
    <section id="video-container">
        <iframe width="560" height="315"
            src="https://www.youtube.com/embed/wZ4sPUcdlO4?si=3-cbphNlvXUgr0lQ&autoplay=1&mute=1"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <div class="close-btn-container"><button class="close-btn">X Close</button></div>
    </section>
    <!-- include animation library -->
    <script src="{{ asset('/js/jsap.js') }}"></script>
    <script>
        const closeBtn = document.querySelector('.close-btn');
        const videoContainer = document.querySelector('#video-container');
        // don't play video again if user has watched it
        if (localStorage.getItem('watchedVideo') == 'true') {
            videoContainer.style.display = 'none';
            document.body.classList.remove('fix-scroll');
        }
        closeBtn.addEventListener('click', function() {
            videoContainer.style.display = 'none';
            document.body.classList.remove('fix-scroll');
            localStorage.setItem('videoClosed', true);
            setTimeout(() => {
                localStorage.setItem('videoClosed', null);
                localStorage.setItem('watchedVideo', true);
            }, 2000);
        });

        const duration = 4;
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
