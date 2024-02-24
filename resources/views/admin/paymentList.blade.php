@extends('layout.admin')


@section('inner-content')
@section('title','Dashboard | Admin')
@section('admin-title','Payment List')

<div class="container card p-5">
        <button id="printButton">PRINT PAYMENT LIST</button>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Payment ID</th>
            <th scope="col">Payment Title</th>
            <th scope="col">Payment Description</th>
            <th scope="col">Payment Fee</th>
            <th scope="col">Payment Deadline</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $p)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->title}}</td>
                    <td>{{$p->description}}</td>
                    <td>IDR {{$p->fee}}</td>
                    <td>{{ \Carbon\Carbon::parse($p->deadline)->format('d F Y') }}</td>
                    <td class="row gap-2">
                        <a class="col-auto btn btn-group" href="{{route('admin.mappingStudent', $p->id)}}">mapping</a>
                        <a class="col-auto btn btn-info" href="{{route('admin.updatePayment', $p->id)}}">update</a>
                        <a class="col-auto btn btn-danger" href="{{route('admin.handleDeletePayment', $p->id)}}">delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
            document.getElementById('printButton').addEventListener('click', function() {
                window.print();
            });
        </script>

@endsection
