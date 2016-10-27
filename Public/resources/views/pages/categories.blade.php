@extends('app')
@section('content')
<div class="row z-depth-1">
    <div class="col s12 ">
        <table class="highlight centered responsive-table ">
            <tr>
                <h4 class="center">Categories<a href="#create-modal" class="btn-floating btn-large waves-effect waves-light red right modal-trigger"><i class="material-icons">add</i></a></h4>
            </tr>
            <thead>
                <tr>
                    <th>Title</td>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($data))
                    @foreach($data as $row)
                        <tr>
                            <td>{{$row->title}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td><a href="#edit-modal{{ $row->id }}" class="yellow-text modal-trigger"><i class="material-icons ">mode_edit</i></a> <a href="deletecategory/{{ $row->id }}" class="red-text"><i class="material-icons">delete</i></a> </td>
                        </tr>
                        
                        
                        <!-- Edit Modal Structure -->
                        <div id="edit-modal{{ $row->id }}" class="modal z-depth-1">
                            <div class="modal-content">
                                <div class="row">
                                    <div class="col s8 offset-s2">    
                                        <form class="" method="post" action="editcategory/{{ $row->id }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="row">
                                                <h3 class="center teal-text">Edit Category</h2>
                                            </div>
                                            <div class="row modal-form-row">
                                                <div class="input-field col s12">
                                                    <input id="email" type="text" name="title" value="{{ $row->title }}" class="validate">
                                                    <label for="email">Caegory Title</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button type="submit" class="waves-effect waves-light btn right">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    @endforeach
                @endif    
            </tbody>
        </table>  
    </div>
</div>


<!-- Create Modal Structure -->
<div id="create-modal" class="modal z-depth-1">
    <div class="modal-content">
        <div class="row">
            <div class="col s8 offset-s2">    
                <form class="" method="post" action="createcategory">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <h3 class="center teal-text">Create Category</h2>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="text" name="title" value="" class="validate">
                            <label for="email">Caegory Title</label>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="waves-effect waves-light btn right">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection