@extends('layout.student')


@section('inner-content')
@section('title','Dashboard | Student')
@section('student-title','Payment summary')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href=""" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-solid fa-money"></i> Total payment: IDR {{$total_payment->payments_done}}</a>
</div>

<div class="container card p-5">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Product Stock</th>
            <th scope="col">Product Price</th>
            <th scope="col">Product Price</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $p)
                <tr>
                    <td>{{$p->title}}</td>
                    <td>{{$p->description}}</td>
                    <td>IDR {{$p->fee}}</td>
                    <td>{{ \Carbon\Carbon::parse($p->deadline)->format('d F Y') }}</td>

                    <td class="row gap-2">
                        @if ($p->is_payment_done == '1')
                            <a class="col-auto btn btn-group" href="">payment done</a>
                        @else
                            <a class="col-auto btn btn-info" href="{{route('student.handleStudentPayment', $p->payment_id)}}">pay</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
