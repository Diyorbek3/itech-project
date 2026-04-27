@extends('layouts.app')

@section('styles')
    <style>
        .stat-card {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
        }

        .bg-blue-light {
            background: #dbeafe;
            color: #2563eb;
        }

        .bg-purple-light {
            background: #e9d5ff;
            color: #9333ea;
        }

        .bg-green-light {
            background: #dcfce7;
            color: #16a34a;
        }

        .chart-container {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .table-container {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background: #f8fafc;
            font-weight: 600;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .status-approved {
            background: #d1fae5;
            color: #059669;
        }

        .status-rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-cancelled {
            background: #f3f4f6;
            color: #6b7280;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">📊 Dashboard / Analytics</h2>
                <p class="text-muted">Bog'lanishlar statistikasi</p>
            </div>
        </div>

        <!-- Stat Cards (ESKI HOLATDA) -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-light">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="stat-number">{{ $totalContacts }}</div>
                    <div class="stat-label">Kontakt orqali bog'langanlar</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-purple-light">
                        <i class="fas fa-chalkboard-user"></i>
                    </div>
                    <div class="stat-number">{{ $totalMasterclass }}</div>
                    <div class="stat-label">Masterclass ga yozilganlar</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-green-light">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">{{ $totalAll }}</div>
                    <div class="stat-label">Jami bog'lanishlar</div>
                </div>
            </div>
        </div>

        <!-- Chart - Oxirgi 7 kun (ESKI HOLATDA) -->
        <div class="chart-container">
            <h5 class="fw-bold mb-3">📈 Oxirgi 7 kundagi bog'lanishlar</h5>
            <canvas id="weeklyChart" height="100"></canvas>
        </div>

        <!-- Chart - Oylik (ESKI HOLATDA) -->
        <div class="chart-container">
            <h5 class="fw-bold mb-3">📊 Oylik bog'lanishlar statistikasi</h5>
            <canvas id="monthlyChart" height="100"></canvas>
        </div>

        <!-- Jadval - Oxirgi 7 kun batafsil (ESKI HOLATDA) -->
        <div class="table-container">
            <h5 class="fw-bold mb-3">📋 Oxirgi 7 kun batafsil</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sana</th>
                            <th>Kontakt</th>
                            <th>Masterclass</th>
                            <th>Jami</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($last7Days as $day)
                            <tr>
                                <td>{{ $day['date'] }}</td>
                                <td>{{ $day['contacts'] }}</td>
                                <td>{{ $day['masterclass'] }}</td>
                                <td><strong>{{ $day['total'] }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- YANGI QO'SHILGAN: Masterclass registratsiyalar jadvali -->
        <div class="table-container">
            <h5 class="fw-bold mb-3">
                📋 Masterclassga yozilganlar ro'yxati
                <span class="badge bg-primary ms-2">{{ $totalMasterclass }} ta</span>
            </h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ism</th>
                            <th>Telefon</th>
                            <th>Email</th>
                            <th>Masterclass</th>
                            <th>Yozilgan sana</th>
                            <th>Status</th>
                            <th>Telegram</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allRegistrations ?? [] as $reg)
                            <tr>
                                <td>{{ $reg->id }}</td>
                                <td><strong>{{ $reg->name }}</strong></td>
                                <td>{{ $reg->phone }}</td>
                                <td>{{ $reg->email ?? '-' }}</td>
                                <td>{{ $reg->masterclass->title ?? 'Noma\'lum' }}</td>
                                <td>{{ $reg->created_at->format('d.m.Y H:i') }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pending' => 'status-pending',
                                            'approved' => 'status-approved',
                                            'rejected' => 'status-rejected',
                                            'cancelled' => 'status-cancelled'
                                        ][$reg->status] ?? 'status-pending';

                                        $statusText = [
                                            'pending' => '⏳ Kutilmoqda',
                                            'approved' => '✅ Tasdiqlangan',
                                            'rejected' => '❌ Rad etilgan',
                                            'cancelled' => '🚫 Bekor qilingan'
                                        ][$reg->status] ?? $reg->status;
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td>
                                    @if($reg->telegram_sent)
                                        <span class="badge bg-success">✅ Yuborilgan</span>
                                    @else
                                        <span class="badge bg-secondary">⏳ Yuborilmagan</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <p class="text-muted mb-0">Hozircha hech kim masterclassga yozilmagan</p>
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
        // Oxirgi 7 kun grafigi (ESKI HOLATDA)
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: @json($last7Days->pluck('date')),
                datasets: [
                    {
                        label: 'Kontakt',
                        data: @json($last7Days->pluck('contacts')),
                        backgroundColor: '#3b82f6',
                        borderRadius: 8
                    },
                    {
                        label: 'Masterclass',
                        data: @json($last7Days->pluck('masterclass')),
                        backgroundColor: '#9333ea',
                        borderRadius: 8
                    },
                    {
                        label: 'Jami',
                        data: @json($last7Days->pluck('total')),
                        backgroundColor: '#10b981',
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

        // Oylik grafigi (ESKI HOLATDA)
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: @json($monthlyData->pluck('month')),
                datasets: [
                    {
                        label: 'Kontakt',
                        data: @json($monthlyData->pluck('contacts')),
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Masterclass',
                        data: @json($monthlyData->pluck('masterclass')),
                        borderColor: '#9333ea',
                        backgroundColor: 'rgba(147,51,234,0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Jami',
                        data: @json($monthlyData->pluck('total')),
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.1)',
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