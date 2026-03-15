<x-app-layout>
    <style>
        /* Tepadagi ortiqcha chiziqni va fonni tozalash */
        .min-h-screen { background-color: #fcfafa !important; }
        nav { border-bottom: none !important; box-shadow: none !important; }

        .profile-container { 
            padding-top: 3rem; 
            padding-bottom: 5rem;
        }

        .profile-card { 
            background: white; 
            border-radius: 24px; 
            padding: 2.5rem; 
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); 
            border: 1px solid #f3f0f1;
            margin-bottom: 2.5rem;
        }

        /* Inputlar dizayni */
        .profile-input {
            width: 100%;
            padding: 12px 18px;
            border: 1.5px solid #eee;
            border-radius: 14px;
            margin-top: 8px;
            transition: all 0.3s ease;
            display: block;
        }

        .profile-input:focus {
            border-color: #eb427e;
            outline: none;
            box-shadow: 0 0 0 4px rgba(235, 66, 126, 0.1);
        }

        .btn-pink {
            background: #eb427e;
            color: white;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .btn-pink:hover { 
            background: #d6336c; 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(235, 66, 126, 0.3);
            color: white;
        }

        .section-title { font-size: 1.6rem; font-weight: 800; color: #1a202c; margin-bottom: 0.5rem; }
        .section-desc { color: #718096; font-size: 0.95rem; margin-bottom: 2rem; }
        
        .card-danger { border-left: 6px solid #f56565 !important; }

        /* Tepada Go Home tugmasi uchun maxsus joylashuv */
        .header-actions {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1.5rem;
        }
    </style>

    <div class="profile-container">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="header-actions">
    <a href="{{ url('/') }}" class="btn-pink" style="padding: 10px 25px; font-size: 0.9rem;">
        ← {{ __('messages.home') }}
    </a>
</div>      

            <div class="profile-card">
                <div class="mt-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="profile-card">
                <div class="mt-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="profile-card card-danger">
                <div class="mt-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>