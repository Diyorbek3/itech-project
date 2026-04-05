<nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-light">
    <div class="container">

        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.png') }}" class='img-fluid rounded-circle'
                 style='width: 70px; height: 70px;' alt="logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mx-auto navbar-nav-scroll">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#header">{{ __('messages.about_us') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#details">{{ __('messages.why_us') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#services">{{ __('messages.courses') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#projects">{{ __('messages.projects') }}</a></li>
            </ul>
            
            <div class="d-flex align-items-center">
    
                <div class="dropdown me-3">
                    <a class="btn-outline-sm dropdown-toggle d-flex align-items-center" href="#" role="button" id="languageDropdown" data-bs-toggle="dropdown">
                        @php $locale = app()->getLocale(); @endphp
                        <img src="{{ asset('flags/'.$locale.'.png') }}" alt="{{ $locale }}" class="flag-icon me-1" style="width: 20px; height: 14px; object-fit: cover;"> 
                        {{ strtoupper($locale) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('en')"><img src="{{ asset('flags/en.png') }}" width="20" class="me-2"> English</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('ru')"><img src="{{ asset('flags/ru.png') }}" width="20" class="me-2"> Russian</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('uz')"><img src="{{ asset('flags/uz.png') }}" width="20" class="me-2"> Uzbek</a></li>
                    </ul>
                </div>

                <a class="btn-outline-sm me-3" href="{{ url('/') }}#contact" style="white-space: nowrap; padding: 10px 15px;">
                    {{ __('messages.contact_us') }}
                </a>
                
                <div class="auth-container">
                    @guest
                        <a class="btn-outline-sm me-2" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                        <a class="btn-outline-sm" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    @else
                        <div class="dropdown">
                            <a class="btn-outline-sm dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" style="padding: 5px 10px;">
                                <img id="headerAvatar" 
                                     src="{{ Auth::user()->avatar ? asset('storage/avatars/' . Auth::user()->avatar) : asset('storage/avatars/avatar.png') }}" 
                                     class="rounded-circle me-2" 
                                     style="width: 30px; height: 30px; object-fit: cover;"
                                     onerror="this.onerror=null; this.src='{{ asset('storage/avatars/avatar.png') }}';">
                                <span id="headerUserName">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="/profile">
                                        <i class="fas fa-user me-2"></i> {{ __('messages.profile') }}
                                    </a>
                                </li>

                                @if (auth()->user()->role_id == 1) 
                                    <li>
                                        <a class="dropdown-item" href="/my-courses">
                                            <i class="fas fa-graduation-cap me-2"></i> {{ __('messages.courses') }}
                                        </a>
                                    </li>
                                @endif
                               
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">
                                            <i class="fas fa-sign-out-alt me-2"></i> {{ __('messages.logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>

            </div>
        </div>
    </div>
</nav>