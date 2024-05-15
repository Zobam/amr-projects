<x-layout styleLink='css/homepage.css'>
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thank you.</strong> We received your message.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section>
        <div class="d-flex justify-content-center">
            <img src="/images/AMR-PC-yellow-1-min.png" id="amr-logo" alt="amr logo">
        </div>
        <div class="p-content" style="opacity: 0;">
            <p>Welcome to AMR Project Consultancy</p>
            <p>
                You are a Government or a Multinational Organisation <br>
                You are facing Security Challenges <br>
                You want independent vetting of your existing Security Architecture / Structure <br>
                You are looking for Solutions to Security Challenges
            </p>
            <h2>
                YOU ARE AT THE RIGHT PLACE
            </h2>
            <p>
                <a href="/contact">Click here</a> to fill and send our Contact Form, we will contact you!
            </p>
        </div>
    </section>
    <!-- include animation library -->
    <script src="{{ asset('/js/jsap.js') }}"></script>
    <script>
        window.onload = function() {
            document.getElementById('amr-logo').style.opacity = '1';

            const duration = 3;
            let checkCount = 1;
            const intVar = setInterval(() => {
                const closed = localStorage.getItem('videoClosed');
                // closed === 'true' || localStorage.getItem('watchedVideo') == 'true'
                if (closed === 'true' || localStorage.getItem('watchedVideo') == 'true') {
                    gsap.to('#nav', {
                        opacity: 1,
                        duration: duration / 4,
                        // scale: .25,
                        delay: duration - duration / 8,
                    })
                    gsap.to('.p-content', {
                        opacity: 1,
                        duration: 1,
                        // scale: .25,
                        delay: duration - duration / 8,
                    })
                    gsap.to('#amr-logo', {
                        scale: 1,
                        duration,
                        delay: duration / 16,
                    });
                    clearCurrentInt();
                }
                console.log('just checking: ' +
                    checkCount++);
            }, 1000 / 2);

            function clearCurrentInt() {
                clearInterval(intVar);
                localStorage.setItem('videoClosed', null);
            }
        }
    </script>
</x-layout>
