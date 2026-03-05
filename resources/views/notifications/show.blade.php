@extends('layouts.master.app')

@section('title', 'الإشعار')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-bell"></i> الإشعار
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">من</label>
                        <p>
                            <i class="fas fa-user-circle"></i>
                            <strong>{{ $notification->user->name }}</strong>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">الرسالة</label>
                        <p class="lead">{{ $notification->message }}</p>
                    </div>


                    <div class="mb-3">
                        <label class="form-label text-muted">تاريخ الإنشاء</label>
                        <p>{{ $notification->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>

                <div class="card-footer d-flex gap-2">
                    <a href="{{ route('notifications.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> الرجوع
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
