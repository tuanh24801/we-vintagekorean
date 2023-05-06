<?php

namespace App\Http\Livewire\Admin\Color;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Color;

class Index extends Component
{
    use WithPagination;
    public $color_id,$name,$code,$status;
    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required | string',
        'code' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Tên màu bắt buộc phải nhập',
        'name.string' => 'Tên màu phải đúng định dạng chữ',
        'code.required' => 'Mã màu bắt buộc phải nhập'
    ];

    public function resetInput(){
        $this->color_id = null;
        $this->name = null;
        $this->code = null;
        $this->status = null;
    }


    public function storeColor(){
        $validateData = $this->validate();
        $color = new Color();
        $color->name = $validateData['name'];
        $color->code = $validateData['code'];
        $color->save();
        session()->flash('message','Thêm tài khoản thành công');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $colors = Color::orderBy('id','DESC')->paginate(7);
        return view('livewire.admin.color.index', compact('colors'));
    }
}
