@extends('app')
@section('title', 'Scores')
@section('content')
<div class="row z-depth-1">
    <div class="col s12 ">
        <table class="highlight centered responsive-table ">
            <tr>
                <h4 class="center">Users</h4>
            </tr>
            <thead>
                <tr>
                    <th>Name</td>
                    <th>Email</th>
                    <th>Score</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($data))
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->score }}%</td>
                            <td>{{ $row->created_at }}</td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <th>
                        No Scores
                    </th>
                </tr>
                @endif 
            </tbody>
        <table>
    <div>
</div>
@endsection