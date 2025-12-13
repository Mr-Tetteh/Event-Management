<?php

namespace App\Livewire\Admin\GeneralPurpose;

use Livewire\Component;
use Livewire\WithFileUploads;


class Brochure extends Component
{
   use WithFileUploads;

    public $name;
    public $brochure;
    public $brochure_id;
    public $Edit = false;


    protected $rules = [
        'name' => 'required',
        'brochure' => 'required|mimes:pdf',
    ];

    public function resetFiled()
    {
        $this->name = '';
        $this->brochure = '';
    }


    public function create(){
        $this->validate();

        if($this->brochure){
            $file =  $this->brochure->store('brochure', 'public');
        }

        \App\Models\Brochure::create([
            'name' => $this->name,
            'brochure' =>$file,
        ]);

        $this->resetFiled();

            $this->dispatch(event: 'toast', message: 'Brochure Created Successfully.');


    }

    public function edit($id)  {
        
        $brochure = \App\Models\Brochure::findOrFail($id);
        $this->brochure_id = $brochure->id;
        $this->name = $brochure->name;
        $this->Edit = true;
    }

    public function update(){     
        if($this->brochure){
            $file =  $this->brochure->store('brochure', 'public');
        }else{
            $file = \App\Models\Brochure::find($this->brochure_id)->brochure;
        }

        
        \App\Models\Brochure::find($this->brochure_id)->update([
            'name' => $this->name,
            'brochure' =>$file,
        ]);

        $this->dispatch(event: 'toast', message: 'Brochure Updated Successfully.');

        $this->resetFiled();
        $this->Edit = false;
    }



    public function delete($id)  {

        \App\Models\Brochure::find($id)->delete();
        $this->dispatch(event: 'toast', message: 'Brochure Deleted Successfully.');
        
    }





    public function render()
    {
        $datas = \App\Models\Brochure::all();
        return view('livewire.admin.general-purpose.brochure', compact('datas'));
    }
}
