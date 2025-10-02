<?php

namespace App\Services;

use App\Models\Podcaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\UTCDateTime;
use Exception;

class AuthService
{
    protected $podcaster;

    public function __construct(Podcaster $podcaster)
    {
        $this->podcaster = $podcaster;
    }

    public function register($data)
    {
        try {
            // 1) Tạo tài khoản
            $podcaster = $this->podcaster->create($data);
            Log::info('Podcaster created: '.$podcaster->id);

            // 2) Thử gửi email xác minh, nhưng KHÔNG làm fail đăng ký nếu gửi lỗi
            try {
                $podcaster->sendEmailVerificationNotification();
                Log::info('Email verification sent to: '.$podcaster->email);
            } catch (\Throwable $mailEx) {
                Log::warning('Send verify mail failed: '.$mailEx->getMessage());
            }

            // 3) Thành công: trả về model
            return $podcaster;

        } catch (\Throwable $e) {
            Log::error('Registration error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return null; // chỉ null khi tạo tài khoản thật sự lỗi
        }
    
    }

    public function login($data)
    {
        $podcaster = $this->podcaster->where('email', $data['email'])->first();
        $isPasswordValid = Hash::check($data['password'], $podcaster->password);

        if (!$podcaster || !$isPasswordValid) {
            return [
                'status' => false,
                'message' => 'Invalid email or password'
            ];
        }

        return [
            'status' => true,
            'message' => 'Login successfully',
            'podcaster' => $podcaster
        ];
    }

    public function logout()
    {
        Auth::logout();
        return true;
    }

    public function loginSocial($params, string $provider)
    {
        try {
            return Podcaster::firstOrCreate(
                [$provider . '_id' => $params->id],
                [
                    'name' => $params->name,
                    'email' => $params->email,
                    'password' => 'SOCIAL_AUTHENTICATION',
                    'image' => $params->avatar,
                    $provider . '_id' => $params->id,
                    'email_verified_at' => new UTCDateTime(now()->timestamp * 1000)
                ]
            );
        } catch (Exception $e) {
            Log::error($e);
            return null;
        }
    }
}
