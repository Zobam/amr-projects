<nav id="nav" style="opacity: 0;">
    <ul>
        <li><a href="/" class="{{ (request()->is('/')) ? 'active' : '' }}">Home</a></li>
        <li><a href="/contact" class="{{ (request()->is('contact')) ? 'active activeContact' : '' }}">Contact Us</a></li>
    </ul>

</nav>