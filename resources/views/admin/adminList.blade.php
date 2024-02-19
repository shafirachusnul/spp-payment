@extends('layout.admin')


@section('inner-content')
@section('title','Admin List | Headmaster')
@section('admin-title','List of all admin')
<div class="container card p-5">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Admin ID</th>
            <th scope="col">Admin Name</th>
            <th scope="col">Admin Email</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($admins as $a)
                    <tr>
                        <td>{{$a->id}}</td>
                        <td>{{$a->name}}</td>
                        <td>{{$a->email}}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>

@endsection
