<?php

namespace App\Http\Livewire\Admin\Account;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,$email,$password,$role_as,$user_id;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6',
        'role_as' => 'nullable'
    ];

    protected $messages = [

    ];

    public function resetInput(){
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->role_as = 1;
        $this->user_id = null;
    }

    public function storeAccount(){
        $validatedData = $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        if(!isset($validatedData['role_as'])){
            $this->role_as = 1;
        }
        $user->role_as = $this->role_as;
        $user->save();
        session()->flash('message','Thêm tài khoản thành công');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function getIdDelete($user_id){
        $this->user_id = $user_id;
    }

    public function deleteAccount(){
        $user = User::findOrFail($this->user_id);
        $user->delete();
        session()->flash('message','Xóa người dùng thành công');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function changeRole($user_id){
        $user = User::findOrFail($user_id);
        if($user->role_as == '1'){
            $user->role_as = '0';
            $user->update();
        }else{
            $user->role_as = '1';
            $user->update();
        }
        session()->flash('message','Chỉnh sửa quyền thành công');
    }

    public function render()
    {
        $users = User::orderBy('id','DESC')->paginate(5);
        return view('livewire.admin.account.index', compact('users'));
    }
}
