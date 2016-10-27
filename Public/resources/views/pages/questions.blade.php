@extends('app')
@section('content')
@section('title', 'Questions')
<div class="row z-depth-1">
    <div class="col s12 ">
        <table class="highlight centered responsive-table ">
            <tr>
                <h4 class="center">Questions<a href="#create-modal" class="btn-floating btn-large waves-effect waves-light red right modal-trigger"><i class="material-icons">add</i></a></h4>
            </tr>
            <thead>
                <tr>
                    <th>Category</td>
                    <th>Question</th>
                    <th>Possibilities</th>
                    <th>Correct</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($data))
                    @foreach($data as $row)
                        <tr>
                            @foreach($categories as $category)
                                @if($category->id == $row->category_id)
                                    <td>{{ $category->title }}</td>
                                @endif
                            @endforeach  
                            <td>{{ $row->question }}</td>
                            <td>{{ $row->possibilities[0] }}, {{ $row->possibilities[1] }}, {{ $row->possibilities[2] }}, {{ $row->possibilities[3] }}</td>
                            <td>{{ $row->possibilities[$row->correct] }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->updated_at }}</td>
                            <td><a href="#edit-modal{{ $row->id }}" class="yellow-text modal-trigger"><i class="material-icons ">mode_edit</i></a> <a href="deletequestion/{{ $row->id }}" class="red-text"><i class="material-icons">delete</i></a> </td>
                        </tr>
                        
                        
                        <!-- Edit Modal Structure -->
                        <div id="edit-modal{{ $row->id }}" class="modal z-depth-1">
                            <div class="modal-content">
                                <div class="row">    
                                    <form class="col s12" method="post" action="editquestion">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <div class="row">
                                            <div class="col s10 offset-s1">
                                                <h3 class="center teal-text">Edit Question</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s10 offset-s1">
                                                <select name="category_id" required>
                                                    @foreach($categories as $category)
                                                        @if($category->id == $row->category_id)
                                                            <option value="{{ $category->id }}" selected="selected" dissable>{{ $category->title }}</option>
                                                        @endif
                                                    @endforeach    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s10 offset-s1">
                                                <input id="question" type="text" value="{{ $row->question }}" name="question" required>
                                                <label for="question">Question</label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="input-field col s10 offset-s1">
                                                <i class="prefix">
                                                    <input type="radio" name="checkbox" value="0" id="option1edit" @if($row->correct == '0') checked  @endif>
                                                    <label for="option1edit"></label>
                                                </i>
                                                <input type="text" name="possibilities[]" value="{{ $row->possibilities[0] }}" id="option1">
                                                <label for="possibilities">Option 1</label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="input-field col s10 offset-s1">
                                                <i class="prefix">
                                                    <input type="radio" name="checkbox" value="1" id="option2edit" @if($row->correct == '1') checked  @endif">
                                                    <label for="option2edit"></label>
                                                </i>
                                                <input type="text" name="possibilities[]" value="{{ $row->possibilities[1] }}" id="option2">
                                                <label for="option2">Option 2</label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="input-field col s10 offset-s1">
                                                <i class="prefix">
                                                    <input type="radio" name="checkbox" value="2" id="option3edit" @if($row->correct == '2') checked @endif>
                                                    <label for="option3edit"></label>
                                                </i>
                                                <input type="text" name="possibilities[]" value="{{ $row->possibilities[2] }}" id="option3">
                                                <label for="option3">Option 3</label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="input-field col s10 offset-s1">
                                                <i class="prefix">
                                                    <input type="radio" name="checkbox" value="3" id="option4edit" @if($row->correct == '3') checked @endif>
                                                    <label for="option4edit"></label>
                                                </i>
                                                <input type="text" name="possibilities[]" value="{{ $row->possibilities[3] }}" id="option4">
                                                <label for="option4">Option 4</label>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col s10 offset-s1">    
                                                <button type="submit" class="waves-effect waves-light btn right">Save</button>
                                            </div>
                                        </div>
                                    </form>            
                                </div>
                            </div>
                        </div>                        
                    @endforeach
                @endif    
            </tbody>
        </table>  
    </div>
</div>

@if(isset($categories))
<!-- Create Modal Structure -->
<div id="create-modal" class="modal z-depth-1">
    <div class="modal-content">
        <div class="row">    
            <form class="col s10 offset-s1" method="post" action="createquestion">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <h3 class="center teal-text">Create Question</h2>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="category" required>                                
                                <option value="" disabled selected>Choose Category</option>    
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field  col s12">
                            <input id="question" type="text" name="question" required>
                            <label for="question">Question</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col s12">
                            <i class="prefix">
                                <input type="radio" name="checkbox" value="0" id="option1rs" required>
                                <label for="option1rs"></label>
                            </i>
                            <input type="text" name="possibilities[]" id="option1" required>
                            <label for="possibilities">Option 1</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col s12">
                            <i class="prefix">
                                <input type="radio" name="checkbox" value="1" id="option2rs" required>
                                <label for="option2rs"></label>
                            </i>
                            <input type="text" name="possibilities[]" id="option2s" required>
                            <label for="option2s">Option 2</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col s12">
                            <i class="prefix">
                                <input type="radio" name="checkbox" value="2" id="option3rs" required>
                                <label for="option3rs"></label>
                            </i>
                            <input type="text" name="possibilities[]" id="option3" required>
                            <label for="option3s">Option 3</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col s12">
                            <i class="prefix">
                                <input type="radio" name="checkbox" value="3" id="option4rs" required>
                                <label for="option4rs"></label>
                            </i>
                            <input type="text" name="possibilities[]" id="option4" required>
                            <label for="option4">Option 4</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="waves-effect waves-light btn right">Save</button>
                        </div>
                    </div>
                </div>    
            </form>            
        </div>
    </div>
</div>
@endif
@endsection