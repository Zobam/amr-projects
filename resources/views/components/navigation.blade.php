<nav id="nav">
    <ul>
        <li><a href="/" class="{{ request()->is('intro') ? 'active' : '' }}">Intro</a></li>
        <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="/contact" class="{{ request()->is('contact') ? 'active activeContact' : '' }}">Contact Us</a></li>
        <li><a href="/contact" class="{{ request()->is('contact') ? 'active activeContact' : '' }}">Case Study</a></li>
    </ul>

</nav>
