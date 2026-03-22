<!-- Navigation -->
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
                <li class="nav-item"><a class="nav-link active" href="#header">{{ __('messages.about_us') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#details">{{ __('messages.why_us') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">{{ __('messages.courses') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#projects">{{ __('messages.projects') }}</a></li>
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

                <a class="btn-outline-sm me-3 p-4" href="#contact" style="white-space: nowrap;">
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
                            <a class="btn-outline-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user me-2"></i> {{ __('messages.profile') }}
                                    </a>
                                </li>
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
<!-- end of navigation -->

<!-- Language Switcher - ikkinchi qism -->
<span class="nav-item">
    <div class="dropdown">
        <a class="btn-outline-sm dropdown-toggle d-flex align-items-center" href="#" role="button" id="languageDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
            @switch(app()->getLocale())
                @case('en')
                    <img src="{{ asset('flags/en.png') }}" alt="EN" class="flag-icon me-1" style="width: 20px; height: 15px; object-fit: cover;"> En
                    @break
                @case('ru')
                    <img src="{{ asset('flags/ru.png') }}" alt="RU" class="flag-icon me-1" style="width: 20px; height: 15px; object-fit: cover;"> Ru
                    @break
                @case('uz')
                    <img src="{{ asset('flags/uz.png') }}" alt="UZ" class="flag-icon me-1" style="width: 20px; height: 15px; object-fit: cover;"> Uz
                    @break
                @default
                    <img src="{{ asset('flags/en.png') }}" alt="EN" class="flag-icon me-1" style="width: 20px; height: 15px; object-fit: cover;"> En
            @endswitch
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown2" style="min-width: 120px;">
            <li>
                <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="javascript:void(0)" onclick="changeLanguage('en')">
                    <img src="{{ asset('flags/en.png') }}" alt="English" class="flag-icon me-2" style="width: 20px; height: 15px; object-fit: cover;"> 
                    <span>{{ __('messages.english') }}</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item {{ app()->getLocale() == 'ru' ? 'active' : '' }}" href="javascript:void(0)" onclick="changeLanguage('ru')">
                    <img src="{{ asset('flags/ru.png') }}" alt="Russian" class="flag-icon me-2" style="width: 20px; height: 15px; object-fit: cover;"> 
                    <span>{{ __('messages.russian') }}</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item {{ app()->getLocale() == 'uz' ? 'active' : '' }}" href="javascript:void(0)" onclick="changeLanguage('uz')">
                    <img src="{{ asset('flags/uz.png') }}" alt="Uzbek" class="flag-icon me-2" style="width: 20px; height: 15px; object-fit: cover;"> 
                    <span>{{ __('messages.uzbek') }}</span>
                </a>
            </li>
        </ul>
    </div>
</span>
                
<span class="nav-item ms-2">
    @guest
        <a class="auth-btn btn-login-custom" href="{{ route('login') }}">
            {{ app()->getLocale() == 'en' ? 'Login' : __('messages.login') }}
        </a>
        <a class="auth-btn btn-signup-custom" href="{{ route('register') }}">
            {{ app()->getLocale() == 'en' ? 'Sign Up' : __('messages.sign_up') }}
        </a>
    @else
    <div class="dropdown d-inline-block">
        <a class="btn-outline-sm dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user-edit me-2"></i> {{ __('messages.profile') }}
                </a>
            </li>
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
</span>
                
<span class="nav-item">
    <a class="btn-outline-sm" href="#contact">{{ __('messages.contact_us') }}</a>
</span>