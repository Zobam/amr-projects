<nav id="nav">
    <button class="menu"><i class="fa fa-bars"></i> Menu</button>
    <ul>
        <li><a href="/intro" class="{{ request()->is('intro') ? 'active' : '' }}">Intro</a></li>
        <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="/contact" class="{{ request()->is('contact') ? 'active activeContact' : '' }}">Contact Us</a></li>
        <li class="case-study"><a id="case-study-link" href="/case-study"
                class="{{ request()->is('case-study') ? 'active activeContact' : '' }}">Case Study <span
                    class="icon">
                    @guest
                    <i class="fa fa-lock"></i>
                    @endguest
                </span> </a>
            <div class="toast">
                Fill out the contact form to have <strong>access</strong> to the Case Study <span></span>
            </div>
        </li>
        {{-- @auth
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        @endauth --}}
        
    </ul>
    <script>
        const navUl = document.querySelector('ul');
        const menuBtn = document.querySelector('button.menu');
        const navElem = document.querySelector('nav');
        const menuIcon = document.querySelector('button i.fa');
        const toastSpan = document.querySelector('.toast');



        menuBtn.addEventListener('click', function() {
            if (navUl.style.display) {
                hideNavUl();
            } else {
                navUl.style.display = 'block';
                navElem.classList.add('mobile-nav');
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            }
        });

        function hideNavUl() {
            navUl.style.display = null
            navElem.classList.remove('mobile-nav');
            menuIcon.classList.remove('fa-times');
            menuIcon.classList.add('fa-bars');
        }
        // hide case-study link if passport is not verified
        if (localStorage.getItem('verifiedPassport')) {
            document.querySelector('nav span.icon').classList.add('hide');
        }
        // prevent navigation when disabled link is clicked
        /* caseStudyLink.addEventListener('click', (e) => {
            if (!localStorage.getItem('verifiedPassport')) {
                toastSpan.style.display = 'inline-block';
                setTimeout(() => {
                    toastSpan.style.display = null;
                }, 7490);
                e.preventDefault();
                return;
            }
        }); */
        // hide menu if clicked outside for mobile
        document.addEventListener('click', (e) => {
            if (!navElem.contains(e.target)) {
                hideNavUl();
            }
        });
        // hide menu if open on window resize
        window.addEventListener('resize', function(e) {
            // Call the function to check window size
            if (e.target.innerWidth > 564) {
                if (navUl.style.display) {
                    hideNavUl();
                } else {}
            }
        });
    </script>
</nav>
