<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        // throttle chỉ cần cho resend là đủ
        $this->middleware('throttle:6,1')->only('resend');
    }

    // Trang thông báo cần xác minh
    public function show(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/'); // hoặc route('index')
        }
        return view('auth.verify-email');
    }

    // Xử lý link xác minh từ email
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill(); // đánh dấu đã verify
        return redirect()->intended('/')->with('verified', true); // hoặc route('index')
    }

    // Gửi lại email xác minh
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/'); // đã xác minh thì đưa về trang chính
        }

        $request->user()->sendEmailVerificationNotification();

        // CHUẨN: dùng key 'status' = 'verification-link-sent'
        return back()->with('status', 'verification-link-sent');
    }
}
