<nav class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
    <div class="container-fluid px-0">
        <a class="navbar-brand font-weight-bolder ms-sm-3" href="https://demos.creative-tim.com/soft-ui-design-system/index.html" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
            Sertifikat Training Online
        </a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
            <ul class="navbar-nav navbar-nav-hover ps-lg-5 w-100">
                <li class="nav-item mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="javascript:;" id="Home" data-bs-toggle="" aria-expanded="false">
                        Home                        
                    </a>                    
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="javascript:;" id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false">
                        Training
                        <img src="layouts/user-layout/assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-1">
                    </a>
                    <div class="dropdown-menu dropdown-menu-animation dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages">
                        <div class="d-none d-lg-block">                            
                            <a href="./pages/about-us.html" class="dropdown-item border-radius-md">
                                <span class="">Topik Training</span>
                            </a>
                            <a href="./pages/contact-us.html" class="dropdown-item border-radius-md">
                                <span class="">Instruktur</span>
                            </a>                            
                        </div>                        
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="javascript:;" id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false">
                        Pages
                        <img src="layouts/user-layout/assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-1">
                    </a>
                    <div class="dropdown-menu dropdown-menu-animation dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages">
                        <div class="d-none d-lg-block">                            
                            <a href="./pages/about-us.html" class="dropdown-item border-radius-md">
                                <span class="">About Us</span>
                            </a>
                            <a href="./pages/contact-us.html" class="dropdown-item border-radius-md">
                                <span class="">Contact Us</span>
                            </a>                            
                        </div>                        
                    </div>
                </li>   
                @if (Auth::guest())               
                <li class="nav-item ms-lg-auto">
                    <a class="nav-link nav-link-icon me-2" href="{{Route('login')}}" target="_blank">                        
                        <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Star us on Github">LOG IN</p>
                    </a>
                </li>
                <li class="nav-item my-auto ms-3 ms-lg-0">                    
                    <a href="{{Route('register')}}" class="btn btn-sm  bg-gradient-custom btn-round mb-0 me-1 mt-2 mt-md-0">SIGN UP</a>                    
                </li>
                @else
                <li class="nav-item ms-lg-auto">
                    <a class="nav-link nav-link-icon me-2" href="/profile" target="_blank">                        
                        <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Star us on Github">Hello, {{Auth::user()->name}}</p>
                    </a>
                </li>
                <li class="nav-item my-auto ms-3 ms-lg-0">                    
                    <a href="{{Route('register')}}" class="btn btn-sm  bg-gradient-custom btn-round mb-0 me-1 mt-2 mt-md-0">Logout</a>                    
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>