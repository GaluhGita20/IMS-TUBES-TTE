@extends('auth.auth')

@section('content')
<section>
    <div class="page-header min-vh-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h4 class="font-weight-bolder">Sign Up</h4>                
                        </div>
                        <div class="card-body">
                            <form role="form">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-lg" placeholder="Name" aria-label="Name" aria-describedby="name-addon">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control form-control-lg" placeholder="Confirm    Password" aria-label="Password" aria-describedby="password-addon">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Want to become an instructor?</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-lg bg-gradient-custom btn-lg w-100 mt-4 mb-0">Sign up</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Already have an account?
                                <a href="javascript:;" class="text-custom text-gradient font-weight-bold">Log in</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                    <div class="position-relative h-100 m-3 border-radius-lg d-flex flex-column justify-content-center">              
                        <img class="absolute top-0 b-auto right-0 pt-16 sm:w-6/12 -mt-48 sm:mt-0 w-10/12 max-h-860-px" src="../layouts/user-layout/assets/img/pattern_vue.png" alt="...">              
                        <h4 class="mt-5 text-white font-weight-bolder">"Attention is the new currency"</h4>
                        <p class="text-white">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection