<div class="side-navbar">
    <ul>
        <li class="{{ activeLink('home') }}"><a href="{{ route('home') }}">Home</a></li>
        <li class="{{ activeLink('profile') }}"><a href="{{ route('profile', Auth::user()) }}">Profile</a></li>
        <li class="{{ activeLink('explore') }}"><a href="{{ route('explore') }}">Explore</a></li>
        <li class="{{ activeLink('chats') }}"><a href="{{ route('chats') }}">Chats</a></li>
    </ul>
</div>
