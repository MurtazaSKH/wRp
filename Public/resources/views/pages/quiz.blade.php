@extends('app')
@section('content')
@section('title', 'test')
    <div ng-app="quiz">
        <ng-view>
            <div class="row">
                <div class="col s12 center">
                    <div class="preloader-wrapper big active">
                      <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                          <div class="circle"></div>
                        </div><div class="gap-patch">
                          <div class="circle"></div>
                        </div><div class="circle-clipper right">
                          <div class="circle"></div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
      </ng-view>
    </div>
@endsection