<?php

namespace App\Livewire\Admin\AppManagement;

use Livewire\Component;
use function Livewire\Volt\protect;

class UserManagement extends Component
{

    public $first_name;
    public $last_name;
    public $email;
    public $contact;
    public $role;
    public $user_id;
    public $Edit = false;

    protected function restFileds (){
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->contact = '';
        $this->role = '';
    }

    protected $rules = [

      'first_name' => 'required|string|max:255',
      'last_name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'contact' => 'required|string|max:20',
      'role' => 'required|string|max:50',
        
    ];

   public function resetFileds()  {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->contact = '';
        $this->role = '';

    
   }       


    public function edit ($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $this->user_id = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->contact = $user->contact;
        $this->role = $user->role;
        $this->Edit = true;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'contact' => 'required|string|max:20',
            'role' => 'required|string|max:50',
        ]);
        $user = \App\Models\User::findOrFail($this->user_id);
        $user->update($validatedData);
        $this->restFileds();
        $this->Edit = false;
        $this->dispatch(event: 'toast', message: 'User Updated Successfully.');


    }

    public function closeModal(){
        $this->Edit = false;
    }

    public function delete($id){
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        $this->dispatch(event: 'toast', message: 'User Deleted Successfully.');
    }

    public function render()
    {
        $datas = \App\Models\User::all();
        $users = \App\Models\User::count();
        return view('livewire.admin.app-management.user-management', compact('datas', 'users'));
    }
}
