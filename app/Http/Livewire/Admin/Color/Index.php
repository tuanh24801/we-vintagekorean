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
        session()->flash('message','Thêm màu thành công');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function toggleStatus(int $id_color){
        $color = Color::findOrFail($id_color);
        if($color->status == 1){
            $color->status = 0;
        }else{
            $color->status = 1;
        }
        $color->update();
        session()->flash('message','Sửa trạng thái màu sắc thành công');
    }

    public function editColor(int $id_color){
        $this->color_id = $id_color;
        $color = Color::findOrFail($this->color_id);
        $this->name = $color->name;
        $this->code = $color->code;
    }

    public function updateColor(){
        $validateData = $this->validate();
        $color = Color::findOrFail($this->color_id);
        $color->name = $validateData['name'];
        $color->code = $validateData['code'];
        $color->update();
        session()->flash('message','Sửa màu sắc thành công');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteColor(int $id_color){
        $this->color_id = $id_color;
    }

    public function destoyColor(){
        $color = Color::findOrFail($this->color_id);
        $color->delete();
        session()->flash('message','Xóa màu sắc thành công');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $colors = Color::orderBy('id','DESC')->paginate(7);
        return view('livewire.admin.color.index', compact('colors'));
    }
}
