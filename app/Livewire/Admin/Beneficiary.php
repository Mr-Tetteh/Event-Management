<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Beneficiary extends Component
{
    public $Edit = false;
    public $beneficiary_id;
  public $full_name;
public $phone;

    public function resetInputFields()
    {
        $this->full_name = '';
        $this->phone = '';
    }
    

   protected $rules = [
    'full_name' => 'required',
    'phone' => 'digits:10',
];
    protected $messages = [
        'full_name.required' => 'Beneficiary full name is required.',
        'phone.min' => 'Contact number must be 10 digits.',
        'phone.max' => 'Contact number must be 10 digits.',
    ];

 public function create()
{
    $this->validate();

    \App\Models\Beneficiary::create([
        'full_name' => $this->full_name,
        'phone' => $this->phone,
    ]);

    $this->dispatch(event: 'toast', message: 'Beneficiary Created Successfully.');

    $this->resetInputFields();
}


public function edit($id){
    $this->Edit = true;
    $beneficiary = \App\Models\Beneficiary::findOrFail($id);
    $this->beneficiary_id = $id;
    $this->full_name = $beneficiary->full_name;
    $this->phone = $beneficiary->phone;
}

public function update()
{
    $this->validate();
    
    $beneficiary = \App\Models\Beneficiary::find($this->beneficiary_id);
    $beneficiary->update([
        'full_name' => $this->full_name,
        'phone' => $this->phone,
    ]);
    $this->dispatch(event: 'toast', message: 'Beneficiary Updated Successfully.');

    $this->resetInputFields();
    $this->Edit = false;
}

public function delete($id){
    \App\Models\Beneficiary::find($id)->delete();
    $this->dispatch(event: 'toast', message: 'Beneficiary Deleted Successfully.');

}
    public function render()
    {
        $datas = \App\Models\Beneficiary::all();
        return view('livewire.admin.beneficiary', compact('datas'));
    }
}
