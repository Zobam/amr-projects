<x-layout style-link='css/case-study.css'>
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thank you.</strong> We received your message.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section id="side-video">
        <div class="" style="">
            <button id="close-btn">X Close</button>
            <video id="verified-video" controls autoplay muted>
                <source
                    src="https://firebasestorage.googleapis.com/v0/b/rutride-fb-d85a7.appspot.com/o/AMR%20VO%20Clip%202_01-002.mp4?alt=media&token=36737cea-f221-4149-9a80-5080e598d467"
                    type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>
    <script>
        const videoElem = document.querySelector('#verified-video');
        const playBtn = document.querySelector('#play-btn');
        const bodyElem = document.querySelector('body');
        const alertElem = document.querySelector('div.alert');
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

        /* const cordinates = videoElem.getBoundingClientRect();

        function positionVideo() {

            console.log(cordinates);
            const spaceBelow = window.innerHeight - cordinates.y - cordinates.height;
            console.log('Space below: ', spaceBelow);
            if (spaceBelow > 0) {
                videoElem.style.marginTop = `${spaceBelow/2.25}px`;
            } else {
                videoElem.style.marginTop = '1rem';
            }
        }
        positionVideo();
        window.addEventListener('resize', function() {
            positionVideo();
        }); */
    </script>
</x-layout>
