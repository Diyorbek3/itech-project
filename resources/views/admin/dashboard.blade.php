@extends('layouts.app')

@section('styles')
    <style>
        .stat-card {
            background: #fff;
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform .3s ease;
            height: 100%
        }

        .stat-card:hover {
            transform: translateY(-5px)
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: .25rem
        }

        .stat-label {
            color: #64748b;
            font-size: .9rem
        }

        .bg-purple-light {
            background: #e9d5ff;
            color: #9333ea
        }

        .bg-orange-light {
            background: #ffedd5;
            color: #ea580c
        }

        .bg-green-light {
            background: #dcfce7;
            color: #16a34a
        }

        .bg-blue-light {
            background: #dbeafe;
            color: #2563eb
        }

        .chart-container,
        .table-container {
            background: #fff;
            border-radius: 24px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05)
        }

        .table th {
            background: #f8fafc;
            font-weight: 600
        }

        /* Feedback uchun maxsus stillar */
        .feedback-card {
            background: #fff;
            border-radius: 20px;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid #9333ea;
            transition: all 0.3s ease;
        }

        .feedback-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .feedback-name {
            font-weight: 700;
            color: #1e293b;
        }

        .feedback-email {
            font-size: 12px;
            color: #94a3b8;
        }

        .feedback-message {
            color: #475569;
            font-size: 14px;
            margin-top: 8px;
            line-height: 1.5;
        }

        .feedback-date {
            font-size: 11px;
            color: #cbd5e1;
            margin-top: 8px;
        }

        .feedback-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .feedback-header {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        /* Kontaktlar uchun stillar */
        .contact-card {
            background: #fff;
            border-radius: 20px;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid #3b82f6;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .contact-name {
            font-weight: 700;
            color: #1e293b;
        }

        .contact-email {
            font-size: 12px;
            color: #94a3b8;
        }

        .contact-phone {
            font-size: 12px;
            color: #3b82f6;
            margin-top: 5px;
        }

        .contact-message {
            color: #475569;
            font-size: 14px;
            margin-top: 8px;
            line-height: 1.5;
        }

        .contact-date {
            font-size: 11px;
            color: #cbd5e1;
            margin-top: 8px;
        }

        .contact-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .contact-header {
            display: flex;
            gap: 12px;
            align-items: center;
        }
    </style>
@endsection

@section('content')
   <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">📊 {{ __('messages.admin_dashboard') }}</h2>
            <p class="text-muted">{{ __('messages.all_statistics_and_registrations') }}</p>
        </div>
    </div>

    {{-- STATISTICS CARDS (4 cards) --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-purple-light"><i class="fas fa-chalkboard-user"></i></div>
                <div class="stat-number">{{ $totalMasterclass ?? 0 }}</div>
                <div class="stat-label">{{ __('messages.masterclass_registrations') }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-orange-light"><i class="fas fa-book-open"></i></div>
                <div class="stat-number">{{ $totalCourseRegistrations ?? 0 }}</div>
                <div class="stat-label">{{ __('messages.course_registrations') }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-green-light"><i class="fas fa-comment-dots"></i></div>
                <div class="stat-number">{{ $totalFeedbacks ?? 0 }}</div>
                <div class="stat-label">{{ __('messages.feedbacks') }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-blue-light"><i class="fas fa-envelope"></i></div>
                <div class="stat-number">{{ $totalContacts ?? 0 }}</div>
                <div class="stat-label">{{ __('messages.contacts') }}</div>
            </div>
        </div>
    </div>

    {{-- CHARTS --}}
    <div class="chart-container">
        <h5 class="fw-bold mb-3">📈 {{ __('messages.last_7_days_registrations') }}</h5>
        <canvas id="weeklyChart" height="100"></canvas>
    </div>

    <div class="chart-container">
        <h5 class="fw-bold mb-3">📊 {{ __('messages.monthly_statistics') }}</h5>
        <canvas id="monthlyChart" height="100"></canvas>
    </div>

    {{-- MASTERCLASS REGISTRATIONS TABLE --}}
    <div class="table-container">
        <h5 class="fw-bold mb-3">📋 {{ __('messages.masterclass_registrations_list') }}
            <span class="badge bg-primary ms-2">{{ $totalMasterclass ?? 0 }}</span>
        </h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.phone') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.masterclass') }}</th>
                        <th>{{ __('messages.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($masterclassRegistrations ?? [] as $reg)
                        <tr>
                            <td>{{ $reg->id }}</td>
                            <td><strong>{{ $reg->name }}</strong></td>
                            <td>{{ $reg->phone }}</td>
                            <td>{{ $reg->email ?? '-' }}</td>
                            <td>{{ $reg->masterclass->title ?? __('messages.unknown') }}</td>
                            <td>{{ $reg->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <p class="text-muted mb-0">{{ __('messages.no_masterclass_registrations') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- COURSE REGISTRATIONS TABLE --}}
    <div class="table-container">
        <h5 class="fw-bold mb-3">📚 {{ __('messages.course_registrations_list') }}
            <span class="badge bg-primary ms-2">{{ $totalCourseRegistrations ?? 0 }}</span>
        </h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.phone') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.course') }}</th>
                        <th>{{ __('messages.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courseRegistrations ?? [] as $reg)
                        <tr>
                            <td>{{ $reg->id }}</td>
                            <td><strong>{{ $reg->name }}</strong></td>
                            <td>{{ $reg->phone }}</td>
                            <td>{{ $reg->email ?? '-' }}</td>
                            <td>{{ $reg->course->title ?? __('messages.unknown') }}</td>
                            <td>{{ $reg->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <p class="text-muted mb-0">{{ __('messages.no_course_registrations') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Weekly Chart (Jami o'rniga Feedback)
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: @json($last7Days->pluck('date')),
                datasets: [
                    {
                        label: 'Masterclass',
                        data: @json($last7Days->pluck('masterclass')),
                        backgroundColor: '#9333ea',
                        borderRadius: 8
                    },
                    {
                        label: 'Kurslar',
                        data: @json($last7Days->pluck('courses')),
                        backgroundColor: '#ea580c',
                        borderRadius: 8
                    },
                    {
                        label: 'Kontaktlar',
                        data: @json($last7Days->pluck('contacts')),
                        backgroundColor: '#3b82f6',
                        borderRadius: 8
                    },
                    {
                        label: 'Feedback',
                        data: @json($last7Days->pluck('feedbacks')),
                        backgroundColor: '#16a34a',
                        borderRadius: 8
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });

        // Monthly Chart (Jami o'rniga Feedback)
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: @json($monthlyData->pluck('month')),
                datasets: [
                    {
                        label: 'Masterclass',
                        data: @json($monthlyData->pluck('masterclass')),
                        borderColor: '#9333ea',
                        backgroundColor: 'rgba(147,51,234,0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Kurslar',
                        data: @json($monthlyData->pluck('courses')),
                        borderColor: '#ea580c',
                        backgroundColor: 'rgba(234,88,12,0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Kontaktlar',
                        data: @json($monthlyData->pluck('contacts')),
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Feedback',
                        data: @json($monthlyData->pluck('feedbacks')),
                        borderColor: '#16a34a',
                        backgroundColor: 'rgba(22,163,74,0.1)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    </script>

@endsection