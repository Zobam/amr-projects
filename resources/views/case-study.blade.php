<x-layout style-link='css/case-study.css'>
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thank you.</strong> We received your message.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Auth::check())
        <section id="side-video">
            <div id="verified-video-container">
                <button id="close-btn">X Close</button>
                <video id="verified-video" controls>
                    <source
                        src="https://amr-bexit.s3.us-east-1.amazonaws.com/cs_oiyhakdsl123ljghuy.mp4"
                        type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
            </div>
        </section>
    @else
        <section id="email-form" style="min-height:50vh; display: flex; justify-content: center; align-items: center;">
            <form action="/email/verify" method="post" style=" width: 100%;">
                @csrf
                <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <input type="email" name="email" id="email" placeholder="Enter your email" style=" padding: 1rem; border-radius: .5rem;" required>
                    <input type="submit" value="Watch Case-Study" style="padding: 6px 3px; margin-top: 1rem;">
                </div>
            </form>
        </section>
    @endif
    <a href="/"><button id="showFullscreenBtn">X Close video</button></a>
    <script>
        const verifiedVideoContainer = document.querySelector('#verified-video-container');
        const videoElem = document.querySelector('#verified-video');
        const playBtn = document.querySelector('#play-btn');
        const bodyElem = document.querySelector('body');
        const alertElem = document.querySelector('div.alert');
        const showFullscreenBtn = document.querySelector('#showFullscreenBtn');
        // showFullscreenBtn.addEventListener('click', customFullscreen);
        // setTimeout(() => playBtn.click(), 2000);
        /* bodyElem.addEventListener('mouseover', () => {
            videoElem.muted = false;
            console.log('checking');
        })

        function showFullcreen() {
            videoElem.play();
        } */
        // move to home if passport not verified
        /* if (!localStorage.getItem('verifiedPassport')) {
            window.location = '/';
        } */
        // hide alert after 3 seconds
        if (alertElem) {
            setTimeout(() => {
                alertElem.style.display = "none";
            }, 3000);
        }

        const cordinates = videoElem.getBoundingClientRect();

        function positionVideo() {

            const spaceBelow = window.innerHeight - cordinates.y - cordinates.height;
            if (spaceBelow > 0) {
                videoElem.style.marginTop = `${spaceBelow/2.25}px`;
            } else {
                videoElem.style.marginTop = '1rem';
            }
        }

        window.addEventListener('resize', function() {
            positionVideo();
        });

        // custom fullscreen
        makeFull = true;

        function customFullscreen() {
            if (makeFull) {
                verifiedVideoContainer.classList.add('fullscreen');
                // set video width
                let videoWidth = window.innerWidth;
                let videoHeight = window.innerHeight;
                if (videoWidth > videoHeight) {
                    videoWidth = videoHeight * 1.8;
                    videoElem.style.width = `${videoWidth}px`;
                }
                showFullscreenBtn.style.display = 'block';
            } else {
                window.location = '/';

                verifiedVideoContainer.classList.remove('fullscreen');
                videoElem.style.width = `${cordinates.width}px`;
                positionVideo();
                showFullscreenBtn.style.display = 'none';
            }
            makeFull = !makeFull;
        }

        customFullscreen();
    </script>
</x-layout>
