@extends('layout.default')

@section('title','Update Payment | Admin')

@section('content')

<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <form method="POST" action="{{route('admin.handleUpdatePayment', $payment->id)}}" class="card-body p-5 text-center">
              @csrf
              <h3 class="mb-5">Update Payment</h3>

              <div class="form-outline mb-4">
                <input type="text" id="form2Example17" class="form-control form-control-lg" placeholder="title" name="title" value="{{$payment->title}}">
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="form2Example17" class="form-control form-control-lg" placeholder="description" name="description" value="{{$payment->description}}">
              </div>

              <div class="form-outline mb-4">
                <input type="number" id="form2Example17" class="form-control form-control-lg" placeholder="fee (IDR)" name="fee" value="{{$payment->fee}}">
              </div>

              <div class="form-outline mb-4">
                <input type="date" id="form2Example27" class="form-control form-control-lg" placeholder="deadline" name="deadline" value="{{$payment->deadline}}"/>
              </div>

              @if ($errors->any())
                <div class="alert alert-danger" role="alert" >
                    {{$errors->first()}}
                </div>
              @endif

              <button class="mb-4 btn btn-primary btn-lg btn-block" type="submit">Update Payment</button>

              <p class="" style="color: #393f81;">Cancel Update? <a href="{{route('admin.paymentList')}}" style="color: #508bfc;">Back to payment list page</a></p>

            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
