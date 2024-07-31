<x-layout style-link='css/case-study.css'>
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thank you.</strong> We received your message.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section id="side-video">
        <div id="verified-video-container">
            <button id="close-btn">X Close</button>
            <video id="verified-video" controls>
                <source
                    src="https://firebasestorage.googleapis.com/v0/b/rutride-fb-d85a7.appspot.com/o/AMR_case-study.mp4?alt=media&token=36632954-c710-45af-9586-ef45917ae31c"
                    type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>
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
        if (!localStorage.getItem('verifiedPassport')) {
            window.location = '/';
        }
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
