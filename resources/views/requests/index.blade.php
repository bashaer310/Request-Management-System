@extends('layouts.master.app')

@section('title', 'الطلبات')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i class="fas fa-list"></i> قائمة الطلبات
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('requests.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> طلب جديد
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($requests->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>العنوان</th>
                                <th>المُنشئ</th>
                                <th>الحالة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td><strong>#{{ $request->id }}</strong></td>
                                    <td>{{ Str::limit($request->title, 30) }}</td>
                                    <td>{{ $request->creator->name }}</td>
                                    <td>
                                        <span class="badge bg-{{ $request->status->color() }}">
                                            <i class="fas {{ $request->status->icon() }}"></i>
                                            {{ $request->status->label() }}
                                        </span>
                                    </td>
                                    <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('requests.show', $request) }}" class="btn btn-sm btn-info"
                                            title="عرض التفاصيل">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @can('approve', $request)
                                            <form method="POST" action="{{ route('requests.approve', $request) }}"
                                                style="display:inline;"
                                                onsubmit="return confirm('هل تريد الموافقة على هذا الطلب؟')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="موافقة">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endcan

                                        @can('reject', $request)
                                            <form method="POST" action="{{ route('requests.reject', $request) }}"
                                                style="display:inline;" onsubmit="return confirm('هل تريد رفض هذا الطلب؟')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" title="رفض">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $requests->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">لا توجد طلبات حالياً</p>
                </div>
            @endif
        </div>
    </div>
@endsection
