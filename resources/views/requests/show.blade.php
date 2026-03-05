@extends('layouts.master.app')

@section('title', 'تفاصيل الطلب')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">{{ $request->title }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">العنوان</label>
                        <p class="lead">{{ $request->title }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">الوصف</label>
                        <p>{{ nl2br(e($request->description)) }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">الحالة</label>
                        <p>
                            <span class="badge bg-{{ $request->status->color() }}">
                                <i class="fas {{ $request->status->icon() }}"></i>
                                {{ $request->status->label() }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">المعلومات</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label text-muted">المُنشئ</label>
                            <p>{{ $request->creator->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">تاريخ الإنشاء</label>
                            <p>{{ $request->created_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>

                    @if ($request->approved_by)
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label text-muted">معالج بواسطة</label>
                                <p>{{ $request->approver->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">تاريخ المعالجة</label>
                                <p>{{ $request->updated_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card sticky-top">
                <div class="card-header">
                    <h5 class="mb-0">الإجراءات</h5>
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <a href="{{ route('requests.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> الرجوع
                    </a>

                    @can('approve', $request)
                        <form method="POST" action="{{ route('requests.approve', $request) }}"
                            onsubmit="return confirm('هل تريد الموافقة على هذا الطلب؟')">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-check-circle"></i> موافقة
                            </button>
                        </form>
                    @endcan

                    @can('reject', $request)
                        <form method="POST" action="{{ route('requests.reject', $request) }}"
                            onsubmit="return confirm('هل تريد رفض هذا الطلب؟')">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-times-circle"></i> رفض
                            </button>
                        </form>
                    @endcan

                </div>
            </div>
        </div>
    </div>
@endsection
