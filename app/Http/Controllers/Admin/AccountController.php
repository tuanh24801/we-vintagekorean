<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.accounts.index', compact('users'));
    }

    public function create(){
        return view('admin.accounts.create');
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
        $messages = [
            'name.required' => 'Không để trống tên tài khoản',
            'email.required' => 'Không để trống email',
            'password.required' => 'Không để trống mật khẩu',
            'name.string' => 'Tên tài khoản không đúng định dạng',
            'email.email' => 'Phải nhập đúng định dạng email',
            'password.min' => 'Mật khẩu phải lớn hơn :min ký tự',
        ];
        $request->validate([$rules, $messages]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('we-admin/accounts')->with('message', 'Thêm tài khoản thành công');
    }

    public function update(int $user_id){ //update role_as user
        $user = User::findOrFail($user_id);
        if($user->role_as == '1'){
            $user->role_as = '0';
            $user->update();
        }else{
            $user->role_as = '1';
            $user->update();
        }
        return redirect('we-admin/accounts')->with('message', 'Cập nhật quyền admin thành công');
    }
}
