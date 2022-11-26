<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Enums\EStatus;
use App\Services\AzOfficeConfigService;
use App\Services\IpAddressAcceptService;

class LoginController extends Controller
{
    public function index() {
        $preLoader = false;
        $page = 'login';
        return view('admin.auth.login', compact('preLoader', 'page'));
    }

    public function store(Request $request) {
        $input = $request->all();
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'required' => ':attribute Không được bỏ trống',
        ],
        [
            'username' => 'Tên đăng nhập hoặc email',
            'password' => 'Mật khẩu',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        {
            //check user lock
            if(Auth::user()->is_active == config('global.default.status.users.deactive.key')) {
                auth()->logout();
                $notification = array(
                    'message' => 'Tài khoản đã bị khóa hoặc không có quyền đăng nhập! Hãy liên hệ với Admin.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->withErrors($notification);

            }
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        $notification = array(
            'message' => 'Sai thông tin đăng nhập. Vui lòng thử lại!',
            'alert-type' => 'error'
        );
        return redirect()->back()->withErrors($notification);
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
