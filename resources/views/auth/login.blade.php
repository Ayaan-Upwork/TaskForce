<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"
  rel="stylesheet"
/>
<script src="{{ URL::to('')}}/admins/plugins/toastr/toastr.min.js"></script><!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.js"
></script>

</head>
<style>
    .form-outline .form-control {
    border: 1px solid #ffca28 !important;
    box-shadow: none !important;
}
</style>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
    	
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
              	<div class="text-center bg-dark p-2">
              		 <img src="{{url('assets/logo.png')}}" class="img-fluid text-center" width="200" height="150">
              		</div>
                <!--<p class="text-center h5 fw-bold mb-5 mx-1 mx-md-4 mt-4">Customer Login</p>-->

                    <form class="mx-1 mx-md-4" method="POST" action="{{ route('login') }}">
                        @csrf

                       @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                  
                  <div class="d-flex flex-row align-items-center mb-4 mt-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw mt-4"></i>
                    <div class="form-outline flex-fill mb-0">
                         <label class="form-label" for="form3Example3c">Your Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required >

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                     
                     
                     
                    </div>
                  </div>

                 
                   <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw mt-4"></i>
                    <div class="form-outline flex-fill mb-0">
                         <label class="form-label" for="form3Example3c">Password</label>
                     
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                     
                    </div>
                  </div>

                  

                  

                  <div class="d-flex justify-content-around mx-4 mb-3 mb-lg-4">
                    
                    <button style="background-color: purple" type="submit" class="btn btn-primary btn-lg">Login</button>
                    {{-- <button onclick="window.location='{{ route('register') }}'" type="button" class="btn btn-primary btn-lg">Register</button> --}}

                  </div>
                  
                  <div class="d-flex justify-content-around mx-4 mb-3 mb-lg-4">
                      <a style="color: purple" class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                      </a>
                  </div>
                  

                 

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>










