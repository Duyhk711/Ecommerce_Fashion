<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
// use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\StringeeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Firebase\JWT\JWT;
use Hamcrest\Type\IsString;
use Twilio\Rest\Client;

class OtpController extends Controller
{
    protected $authService;
    protected $twilio;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
      

    }
    // protected $stringeeService;

    // public function __construct(StringeeService $stringeeService)
    // {
    //     $this->stringeeService = $stringeeService;
    // }

    public function sendOtp(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Email không tồn tại trong hệ thống.']);
        }

        $this->authService->setEmailToSession($email);
        $this->authService->sendOtp($email);

        return response()->json(['success' => true, 'message' => 'OTP đã được gửi tới email của bạn.']);
    }


    // Phương thức để xác thực OTP
    public function verifyOtp(Request $request)
    {
        $otp = $request->input('otp');

        // Lấy OTP từ session
        $sessionOtp = session('otp');
        $email = session('email');

        if (!$sessionOtp || !$email) {
            return redirect()->route('login')->with('error', 'Phiên của bạn đã hết hạn. Vui lòng thử lại.');
        }

        // Kiểm tra mã OTP
        if ($otp == $sessionOtp) {
            // OTP hợp lệ, đăng nhập người dùng
            $user = User::where('email', $email)->first();
            Auth::login($user);

            // Xóa OTP khỏi session
            session()->forget(['otp', 'email']);

            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect()->back()->with('error', 'Mã OTP không chính xác. Vui lòng thử lại.');
        }
    }
    // Hiển thị form đăng nhập OTP qua email
    public function loginOtpEmail()
    {
        return view('client.login-email-otp'); // Cần tạo view login-otp-email.blade.php
    }

    // Xử lý gửi OTP qua email và xác minh
    public function verifyOtpEmail(Request $request)
    {
        // Giả sử bạn có hệ thống gửi OTP qua email và lưu OTP trong session
        $otp = $request->input('otp');
        $email = $request->input('email');

        if ($otp == session('otp_email') && $email == session('otp_email_address')) {
            // OTP đúng, xử lý đăng nhập
            // Tìm user theo email
            $user = User::where('email', $email)->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('home')->with('success', 'Đăng nhập thành công');
            }
        }

        return back()->with('error', 'OTP không hợp lệ');
    }

    // Hiển thị form đăng nhập OTP qua điện thoại
    public function loginOtpPhone()
    {
        return view('client.otp-phone'); // Cần tạo view login-otp-phone.blade.php
    }


    public function sendOtpPhone(Request $request)
    {
        // Kiểm tra và định dạng số điện thoại
        $phoneData = $this->validateAndFormatPhone($request->input('phone'));

        // Nếu không hợp lệ, trả về thông báo lỗi
        if (is_null($phoneData)) {
            return response()->json(['success' => false, 'message' => 'Số điện thoại không hợp lệ!'], 400);
        }

        $phone = $phoneData['formatted'];
        $originalPhone = $phoneData['original'];
        // Lấy số điện thoại đã được định dạng
        $user = User::where('phone', $originalPhone)->first(); // Giả sử bạn có trường 'phone' trong bảng 'users'

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Số điện thoại chưa được đăng ký!'], 404);
        }

        $otp = rand(100000, 999999); // Tạo mã OTP ngẫu nhiên

        try {
            $this->sendSms($phone, "Mã OTP của bạn là: $otp"); // Chú ý dấu nháy kép để biến $otp được thay thế

            Session::put('otp_code', $otp);
            Session::put('otp_phone', $phone);
            Log::info('OTP đã được gửi đến: ' . $phone);

            return response()->json(['success' => true, 'message' => 'OTP đã được gửi!']);
        } catch (\Exception $e) {
            Log::error('Gửi OTP thất bại: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gửi OTP thất bại.']);
        }
    }

    public function validateAndFormatPhone($phone)
    {
        // Biểu thức chính quy để kiểm tra định dạng số điện thoại
        $phonePattern = '/^(0|\+84)([0-9]{9,10})$/';

        // Kiểm tra định dạng số điện thoại
        if (preg_match($phonePattern, $phone)) {
            // Nếu số điện thoại bắt đầu bằng 0, thay thế bằng mã quốc gia
            if (strpos($phone, '0') === 0) {
                $formattedPhone = '+84' . substr($phone, 1); // Thay '0' bằng '+84'
                return ['formatted' => $formattedPhone, 'original' => $phone]; // Trả về cả hai định dạng
            } elseif (strpos($phone, '+84') === 0) {
                $originalPhone = '0' . substr($phone, 3); // Chuyển đổi về số điện thoại gốc
                return ['formatted' => $phone, 'original' => $originalPhone]; // Trả về cả hai định dạng
            }
        }

        // Nếu không hợp lệ, trả về null
        return null;
    }

    private function sendSms($phone, $message)
    {
        try {
            // Đảm bảo $phone là chuỗi, không phải mảng
            $response = $this->twilio->messages->create(
                $phone, // $phone là chuỗi số điện thoại
                [
                    'from' => env('TWILIO_PHONE_NUMBER'), // Số điện thoại gửi
                    'body' => $message // Nội dung tin nhắn
                ]
            );

            Log::info('Phản hồi từ Twilio: ' . $response->sid);
            return $response;
        } catch (\Exception $e) {
            Log::error('Lỗi khi gửi OTP qua Twilio: ' . $e->getMessage());
            return false;
        }
    }


    public function resendOtpPhone(Request $request)
    {
        $inputOtp = $request->input('otp');
        $sessionOtp = Session::get('otp_code');

        if ($inputOtp == $sessionOtp) {
            Session::forget(['otp_code', 'otp_phone']);
            return response()->json(['success' => true, 'message' => 'OTP xác minh thành công.']);
        }

        return response()->json(['success' => false, 'message' => 'Mã OTP không đúng.']);
    }


    public function verifyOtpPhone(Request $request)
    {
        $inputOtp = $request->input('otp');
        $sessionOtp = Session::get('otp_code'); // Lấy mã OTP từ session

        if ($inputOtp == $sessionOtp) {
            Session::forget(['otp_code', 'otp_phone']); // Xóa OTP sau khi xác minh
            return redirect()->route('home')->with("success", "Đăng nhập thành công");
        }

        return response()->json(['success' => false, 'message' => 'Mã OTP không đúng.']);
    }
}
