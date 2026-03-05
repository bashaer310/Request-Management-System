@extends('layouts.master.app')

@section('title', 'إنشاء طلب جديد')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">
                <i class="fas fa-plus"></i> إنشاء طلب جديد
            </h1>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">بيانات الطلب</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('requests.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading"></i> العنوان
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" placeholder="أدخل عنوان الطلب" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left"></i> الوصف
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="6" placeholder="اكتب وصفاً تفصيلياً للطلب" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">الحد الأدنى 10 أحرف</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> إرسال الطلب
                            </button>
                            <a href="{{ route('requests.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
