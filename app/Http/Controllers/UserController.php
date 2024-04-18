<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function login()
    {
        return view('user.pages.login');
    }

    public function loginPost(Request $request)
    {
        $data =  $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Vui lòng nhập email !',
                'email.email' => 'Nhập đúng định dạng email !',
                'password.required' => 'Vui lòng nhập mật khẩu !',
            ]
        );

        $check = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        if ("$check") {
            echo '<script>alert("Bạn đăng nhập thành công")</script>';
            return redirect('/');
        } else {
            echo '<script>alert("Đăng nhập thằt bại")</script>';
            return redirect('/login')->with('error', 'Tài khoản hoặc mật khẩu sai !');
        }

        // return response()->json($request->all());
    }

    public function register()
    {
        return view('user.pages.register');
    }

    public function registerPost(Request $request)
    {
        $data =  $request->validate(
            [
                'name' => 'required',
                "email" => "required|email|unique:users",
                "password" => "required",
                "check_password" => "required|same:password",
            ],
            [
                'name.required' => 'Vui lòng phải nhập tên !',
                "email.required" => "Vui lòng nhập email !",
                "email.email" => "Vui lòng nhập đúng định dạng email !",
                "email.unique" => "Email đã đăng ký !",
                "password.required" => "Vui lòng nhập password !",
                "check_password.required" => "Vui lòng nhập lại password !",
                "check_password.same" => "Hai password phải trùng nhau !",
            ]
        );

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect('/login')->with('success', 'Đăng kí thành công.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
