<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Notification;
use App\Enums\UserRole;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Enums\RequestStatus;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = Auth::user();

        if ($user->role === UserRole::MANAGER) {
            $requests = Request::where('status', 'pending')
                ->with(['creator', 'approver'])
                ->latest()
                ->paginate(15);
        } else {
            $requests = Request::where('created_by', $user->id)
                ->with(['approver'])
                ->latest()
                ->paginate(15);
        }

        return view('requests.index', ['requests' => $requests]);
    }



    public function show(Request $request)
    {
        $this->authorize('view', $request);
        return view('requests.show', ['request' => $request]);
    }

    public function create()
    {
        $this->authorize('create', Request::class);
        return view('requests.create');
    }

    public function store(HttpRequest $request)
    {
        $this->authorize('create', Request::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ]);

        Request::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => RequestStatus::PENDING,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('requests.index')
            ->with('success', 'تم إنشاء الطلب');
    }


    public function approve(Request $request)
    {
        $this->authorize('approve', $request);

        $request->update([
            'status' =>  RequestStatus::APPROVED,
            'approved_by' => Auth::id(),
        ]);

        Notification::create([
            'user_id' => $request->created_by,
            'message' => "الطلب موافق: \"{$request->title}\"",
        ]);

        return redirect()->route('requests.index')
            ->with('success', 'موافقة الطلب تمت بنجاح');
    }


    public function reject(Request $request)
    {
        $this->authorize('reject', $request);

        $request->update([
            'status' => RequestStatus::REJECTED,
            'approved_by' => Auth::id(),
        ]);

        Notification::create([
            'user_id' => $request->created_by,
            'message' => "الطلب مرفوض: \"{$request->title}\"",
        ]);

        return redirect()->route('requests.index')
            ->with('success', 'تم رفض الطلب بنجاح');
    }
}
