
@extends('layouts.master.app')

@section('title', 'الإشعارات')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i class="fas fa-bell"></i> الإشعارات
            </h1>
        </div>
    </div>

    @if ($notifications->count() > 0)
        <div class="notifications-list">
            @foreach ($notifications as $notification)
                <div class="card mb-3 notification-item">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h6 class="card-title">
                                    <i class="fas fa-user-circle"></i> {{ $notification->user->name }}
                                </h6>
                                <p class="card-text mb-2">
                                    {{ $notification->message }}
                                </p>
                                <small class="text-muted">
                                    <i class="fas fa-clock"></i> {{ $notification->created_at->diffForHumans() }}
                                </small>

                            </div>

                            <div class="btn-group-vertical" role="group">
                                @can('view', $notification)
                                    <a href="{{ route('notifications.show', $notification) }}" class="btn btn-sm btn-info"
                                        title="عرض">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $notifications->links() }}
        </div>
    @else
        <div class="card text-center py-5">
            <div class="card-body">
                <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <p class="text-muted mt-3">لا توجد إشعارات حالياً</p>
            </div>
        </div>
    @endif

    <style>
        .notification-item {
            border-left: 5px solid #ddd;
            transition: all 0.3s ease;
        }

        .notification-item.border-left.border-primary {
            background-color: #f0f7ff;
        }

        .notification-item:hover {
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.12);
        }
    </style>
@endsection
