<div class="row">
    <nav class="" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Quiz</a>
        @if(Auth::user())
        <ul class="right">
            <li><a href="account" class="waves-effect waves-light">{{ Auth::user()->name}}</a></li>
            @if(Auth::user()->type == 1)
                <li><a href="users" class="waves-effect waves-light">Users</a></li>
                <li><a href="categories" class="waves-effect waves-light">Categories</a></li>
                <li><a href="questions" class="waves-effect waves-light">Questions</a></li>
            @endif
            <li><a href="logout" class="waves-effect waves-light">Logout</a></li>
        </ul>
        @endif
    </div>
    </nav>    
</div>
