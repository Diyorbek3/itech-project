
<!-- Navigation -->
<nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow-sm">
    <div class="container position-relative">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.png') }}"
                 class='img-fluid rounded-circle'
                 style='width: 70px; height: 70px;'
                 alt="logo">
        </a>

        <!-- ==================== MOBILE VERSION ==================== -->
        <div class="d-flex align-items-center gap-2 ms-auto d-lg-none">
            
            <!-- Language -->
            <div class="dropdown">
                <a class="btn-outline-sm dropdown-toggle d-flex align-items-center justify-content-center px-3 py-2"
                   href="#" role="button" data-bs-toggle="dropdown"
                   style="font-size: 12px; border-radius: 16px; height: 42px; min-width: 78px;">
                    @php $locale = app()->getLocale(); @endphp
                    <img src="{{ asset('flags/'.$locale.'.png') }}"
                         class="me-1"
                         style="width: 16px; height: 11px; object-fit: cover;">
                    {{ strtoupper($locale) }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" style="font-size: 13px;">
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('en')">
                        <img src="{{ asset('flags/en.png') }}" width="18" class="me-2"> English
                    </a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('ru')">
                        <img src="{{ asset('flags/ru.png') }}" width="18" class="me-2"> Russian
                    </a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('uz')">
                        <img src="{{ asset('flags/uz.png') }}" width="18" class="me-2"> Uzbek
                    </a></li>
                </ul>
            </div>

            <!-- Aloqaga chiqish -->
            <a class="btn-outline-sm px-3 py-2 d-flex align-items-center justify-content-center"
               href="#contact"
               style="font-size: 12px; min-width: 110px; border-radius: 16px; height: 42px;">
                {{ __('messages.contact_us') }}
            </a>

            <!-- Auth Icons -->
            <div class="d-flex gap-2">
                @guest
                    <a class="btn-outline-sm d-flex align-items-center justify-content-center rounded-circle"
                       href="{{ route('login') }}"
                       style="width: 42px; height: 42px;">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                    <a class="btn-outline-sm d-flex align-items-center justify-content-center rounded-circle"
                       href="{{ route('register') }}"
                       style="width: 42px; height: 42px;">
                        <i class="fas fa-user-plus"></i>
                    </a>
                @else
                    <div class="dropdown">
                        <a class="btn-outline-sm d-flex align-items-center justify-content-center rounded-circle"
                           href="#" data-bs-toggle="dropdown"
                           style="width: 42px; height: 42px;">
                            <i class="fas fa-user-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile">
                                <i class="fas fa-user me-2"></i> {{ __('messages.profile') }}
                            </a></li>
                            @if (auth()->user()->role_id == 1)
                            <li><a class="dropdown-item" href="/my-courses">
                                <i class="fas fa-graduation-cap me-2"></i> {{ __('messages.courses') }}
                            </a></li>
                            <li><a class="dropdown-item" href="/">
                                <i class="fas fa-briefcase me-2"></i> {{ __('messages.projects') }}
                            </a></li>
                            <li><a class="dropdown-item" href="/">
                                <i class="fas fa-chart-line me-2"></i> {{ __('messages.careers') }}
                            </a></li>
                            @endif
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

        <!-- Toggler -->
        <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ==================== DESKTOP VERSION ==================== -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarsExampleDefault">
            <ul class="navbar-nav mx-auto gap-4">
                <li class="nav-item"><a class="nav-link" href="#header">{{ __('messages.about_us') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#details">{{ __('messages.why_us') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">{{ __('messages.courses') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#projects">{{ __('messages.projects') }}</a></li>
            </ul>

            <!-- Desktop Right Side -->
            <div class="d-none d-lg-flex align-items-center gap-3 ms-auto">
                
                <!-- Language -->
                <div class="dropdown">
                    <a class="btn-outline-sm dropdown-toggle d-flex align-items-center justify-content-center px-3 py-2"
                       href="#" role="button" data-bs-toggle="dropdown"
                       style="font-size: 12px; border-radius: 16px; height: 42px; min-width: 78px;">
                        @php $locale = app()->getLocale(); @endphp
                        <img src="{{ asset('flags/'.$locale.'.png') }}"
                             class="me-1"
                             style="width: 16px; height: 11px; object-fit: cover;">
                        {{ strtoupper($locale) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="font-size: 13px;">
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('en')">
                            <img src="{{ asset('flags/en.png') }}" width="18" class="me-2"> English
                        </a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('ru')">
                            <img src="{{ asset('flags/ru.png') }}" width="18" class="me-2"> Russian
                        </a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('uz')">
                            <img src="{{ asset('flags/uz.png') }}" width="18" class="me-2"> Uzbek
                        </a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <a class="btn-outline-sm px-3 py-2 d-flex align-items-center justify-content-center"
                   href="#contact"
                   style="font-size: 12px; min-width: 110px; border-radius: 16px; height: 42px;">
                    {{ __('messages.contact_us') }}
                </a>

                <!-- Auth -->
                <div class="d-flex gap-2">
                    @guest
                        <a class="btn-outline-sm d-flex align-items-center justify-content-center rounded-circle"
                           href="{{ route('login') }}"
                           style="width: 42px; height: 42px;">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                        <a class="btn-outline-sm d-flex align-items-center justify-content-center rounded-circle"
                           href="{{ route('register') }}"
                           style="width: 42px; height: 42px;">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    @else
                        <div class="dropdown">
                            <a class="btn-outline-sm d-flex align-items-center justify-content-center rounded-circle"
                               href="#" data-bs-toggle="dropdown"
                               style="width: 42px; height: 42px;">
                                <i class="fas fa-user-circle"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/profile">
                                    <i class="fas fa-user me-2"></i> {{ __('messages.profile') }}
                                </a></li>
                                @if (auth()->user()->role_id == 1)
                                <li><a class="dropdown-item" href="/my-courses">
                                    <i class="fas fa-graduation-cap me-2"></i> {{ __('messages.courses') }}
                                </a></li>
                                <li><a class="dropdown-item" href="/">
                                    <i class="fas fa-briefcase me-2"></i> {{ __('messages.projects') }}
                                </a></li>
                                <li><a class="dropdown-item" href="/">
                                    <i class="fas fa-chart-line me-2"></i> {{ __('messages.careers') }}
                                </a></li>
                                @endif
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

<!-- IKKINCHI LANGUAGE SWITCHER - butunlay olib tashlandi (takroriy edi) -->
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
