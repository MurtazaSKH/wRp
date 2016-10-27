@extends('../app')
@section('content')
<div class="row z-depth-1">
    <div class="col s8 m6 offset-s2 offset-m3">
        <form class="" method="post" action="postSignup">
            
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <h1 class="center" style="color:#e57373 ">Sign Up</h1>
            </div>
            <div class="row">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="full_name" type="text" name="name" value="{{ old('name') }}" class="validate">
                    <label for="full_name">Full Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" name="password" class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <button class="waves-effect waves-light btn right">Sign Up</button>
            </div>
            <div class="row">
                <p>Already a member <a href="login"><b>Log In</b></a></p>
            </div>
        </form>
    </div>    
</div>
@endsection