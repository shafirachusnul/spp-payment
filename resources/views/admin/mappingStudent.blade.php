@extends('layout.default')

@section('title','Mapping Payment | Admin')

@section('content')

<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <form method="POST" action="{{route('admin.handleInsertPayment')}}" class="card-body p-5 text-center">
                        @csrf
                        <h3 class="mb-3">Mapping {{$payment->title}}</h3>

                        <div class="mb-3">
                            <p>{{$payment->description}}</p>
                            <p>Deadline {{ \Carbon\Carbon::parse($payment->deadline)->format('d F Y') }}</p>
                            <p>IDR {{$payment->fee}}</p>
                        </div>

                        <div class="container-fluid">
                            <div class="container card p-5">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Student Email</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $s)
                                            @php
                                                $isMap = false;
                                            @endphp
                                            <tr>
                                                <td>{{$s->name}}</td>
                                                <td>{{$s->email}}</td>

                                                <td class="row gap-2">
                                                    @foreach ($payment_headers as $p)
                                                        @if ($s->id == $p->user_id && $payment->id == $p->payment_id)
                                                            @php
                                                                $isMap = true;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                        @if(!$isMap)
                                                            <a class="col-auto btn btn-info" href="{{route('admin.handleMappingStudent', ['user_id' => $s->id, 'payment_id' => $payment->id])}}">map</a>
                                                        @else
                                                                <a class="col-auto btn btn-danger" href="{{route('admin.handleRemoveMappingStudent', ['user_id' => $s->id, 'payment_id' => $payment->id])}}">unmap</a>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <p class="mt-4" style="color: #393f81;">Cancel Insertion? <a href="{{route('admin.paymentList')}}" style="color: #508bfc;">Back to payment list page</a></p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
