@extends('layout.admin')


@section('inner-content')
@section('title','Student List | Admin')
@section('admin-title','List of all student')
<div class="container card p-5">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Student ID</th>
            <th scope="col">Student Name</th>
            <th scope="col">Student Email</th>
            <th scope="col">Student Payment Done</th>
            <th scope="col">Student Total Payment</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($students as $s)
                    <tr>
                        <td>{{$s->id}}</td>
                        <td>{{$s->name}}</td>
                        <td>{{$s->email}}</td>
                        <td>IDR {{$s->payments_done}}</td>
                        <td>IDR {{$s->total_fee}}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>

@endsection
