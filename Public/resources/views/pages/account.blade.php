@extends('../app')
@section('content')
@section('title', Auth::user()->name)
@if(isset($data))
<div class="row ">
    <div class="col s12 ">
        <div class="card light-blue lighten-2 white-text z-depth-1">
            <div class="card-content">
                Please select one of the category
            </div>
        </div>
    </div>
</div>    
<div class="row">
    @foreach($data as $row)
    <div class="col s12 m6">
        <div class="card ">
            <div class="card-content center">
                <span class="card-title  activator grey-text text-darken-4">{{ $row->title }}</span>
            </div>
            <div class="card-reveal center">
                <span class="card-title grey-text text-darken-4"><a href="#startquiz">Start Quiz</a></span>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif    
@endsection