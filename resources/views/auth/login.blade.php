@extends('layout.default')

@section('title','Sign In | SppPayment')

@section('content')

<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <form method="POST" action="{{route('guest.handleLogin')}}" class="card-body p-5 text-center">
              @csrf
              <img src="{{url('images/logo.jpeg')}}" alt="" class="img-fluid" style="width: 120px">
              <h3 class="my-3">Sign In</h3>


              <div class="form-outline mb-4">
                <input type="email" id="form2Example17" class="form-control form-control-lg" placeholder="email" name="email">
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="form2Example27" class="form-control form-control-lg" placeholder="password" name="password"/>
              </div>

              @if ($errors->any())
                <div class="alert alert-danger" role="alert" >
                    {{$errors->first()}}
                </div>
              @endif

              <button class="mb-4 btn btn-primary btn-lg btn-block" type="submit">Login</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
