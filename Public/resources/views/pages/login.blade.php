@extends('../app')
@section('content')
<div class="row z-depth-1">
        <form method="post" class="col s8 m6 offset-s2 offset-m3 " action="postLogin">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <h1 class="center" style="color:#e57373 ">Log In</h1>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email" class="validate"  required>
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" name="password"  required class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <!--<div class="row">
                <p>
                    <input type="checkbox" id="remember" name="remember"/>
                    <label for="remember">Remember Me</label>
                </p>
            </div>-->
            <div class="row">
                <button class="waves-effect waves-light btn right">Log In</button>
            </div>
            <div class="row">
                <p>Don't have an account <a href="signup"><b>Sign Up</b></a></p>
            </div>
        </form>    
    </div>
</div>
@endsection