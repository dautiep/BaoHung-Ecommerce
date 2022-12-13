<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Enums\EStatus;
use App\Repositories\UserRepository;
use App\Services\AzOfficeConfigService;
use App\Services\IpAddressAcceptService;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        $preLoader = false;
        $page = 'login';
        return view('admin.auth.login', compact('preLoader', 'page'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $count = (int) $request->submitCount;
        $this->validate(
            $request,
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'required' => ':attribute Không được bỏ trống',
            ],
            [
                'username' => 'Tên đăng nhập hoặc email',
                'password' => 'Mật khẩu',
            ]
        );
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if (auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password']))) {
            //check user lock
            if (Auth::user()->is_active == config('global.default.status.users.deactive.key')) {
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
        if ($count == 2) {
            $notification = array(
                'message' => 'Có vẻ bạn đã quên thông tin đăng nhập. Vui lòng liên hệ admin!',
                'alert-type' => 'error'
            );
        } else {
            $notification = array(
                'message' => 'Sai thông tin đăng nhập. Vui lòng thử lại!',
                'alert-type' => 'error',
                'submitCount' => ++$count
            );
        }
        return redirect()->back()->withErrors($notification);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

    public function resetPassword(Request $request, $idUser)
    {

        if (!is_admin()) {
            return redirect()->back()->withErrors(array(
                'message' => 'Bạn không có quyền truy cập chức năng này. Vui lòng liên hệ admin!',
                'alert-type' => 'error'
            ));
        }
        $repositoyClass = app(UserRepository::class);
        $data = $repositoyClass->find($idUser);
        if ($request->isMethod('GET')) {
            if (!$data) {
                return redirect()->back()->withErrors(array(
                    'message' => 'Tài khoản này không tồn tại vui lòng kiểm tra lại',
                    'alert-type' => 'error'
                ));
            }
            return view('admin.auth.reset', compact('data'));
        }
        $validator = Validator::make($request->all(), [

            'password' => 'required|min:6'
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu không được ít hơn 6 kí tự'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag()->first());
        }
        $data = $data->update($request->only('password'));
        return redirect()->route('users.list')->with($this->getMessages('Cập nhật mật khẩu thành công', $this::$TYPE_MESSAGES_SUCCESS));
    }
}
