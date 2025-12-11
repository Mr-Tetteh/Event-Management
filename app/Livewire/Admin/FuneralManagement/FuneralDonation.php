<?php

namespace App\Livewire\Admin\FuneralManagement;

use App\Models\beneficiary;
use Livewire\Component;

class FuneralDonation extends Component
{
    public $donor_name;
    public $amount;
    public $phone;
    public $beneficiaries;
    public $beneficiary_ids = []; 

    public $donation_id;
    public $Edit = false;

    protected $rules = [
        'donor_name' => 'required',
        'phone' => 'required|digits:10',
        'amount' => 'required',
        'beneficiary_ids' => 'required|array',
        'beneficiary_ids.*' => 'exists:beneficiaries,id',
    ];

    protected $messages = [
        'donor_name.required' => 'Donor name is required.',
        'amount.required' => 'Amount is required.',
        'phone.required' => 'Phone number is required.',
        'phone.digits' => 'Phone number must be 10 digits.',
        'beneficiary_ids.required' => 'Beneficiary selection is required.',
    ];

    public function resetInputFields()
    {
        $this->donor_name = '';
        $this->amount = '';
        $this->phone = '';
        $this->beneficiary_ids = [];
    }

    public function mount()
    {
        $this->beneficiaries = beneficiary::all();
    }
    


    public function create()
    {
        $this->validate();

        \App\Models\FuneralDonation::create([
            'donor_name' => $this->donor_name,
            'amount' => $this->amount,
            'phone' =>  '233' . substr($this->phone, -9),
            'beneficiary_ids' => $this->beneficiary_ids,
        ]);

         sendWithSMSONLINEGH('233' . substr($this->phone, -9), "Dear {$this->donor_name}, thank you for your generous donation of GHS {$this->amount} to support our funeral services. Your contribution is greatly appreciated. - " . config('app.name'));
         sendWithSMSONLINEGH('233' . substr($this->phone, -9), "Experience seamless event management with Novex Technologies. Book this system for funerals, weddings & birthdays. Call/WhatsApp 0559724772.");

            $this->dispatch(event: 'toast', message: 'Funeral donation record created successfully.');

        $this->resetInputFields();
        
    }

    public function edit($id)
    {
        $this->Edit = true;
        $donation = \App\Models\FuneralDonation::findOrFail($id);
        $this->donation_id = $id;
        $this->donor_name = $donation->donor_name;
        $this->amount = $donation->amount;
        $this->phone = $donation->phone;
         $this->beneficiary_ids = $donation->beneficiary_ids;

    }
    public function update()
    {
        $this->validate();

        $donation = \App\Models\FuneralDonation::findOrFail($this->donation_id);
        $donation->update([
            'donor_name' => $this->donor_name,
            'amount' => $this->amount,
            'phone' => $this->phone,
    'beneficiary_ids' => $this->beneficiary_ids,
        ]);

        $this->dispatch(event: 'toast', message: 'Funeral donation record updated successfully.');

        $this->resetInputFields();
        $this->Edit = false;
    }
    public function delete($id)
    {
        $donation = \App\Models\FuneralDonation::findOrFail($id);
        $donation->delete();

        $this->dispatch(event: 'toast', message: 'Funeral donation record deleted successfully.');
    }

    public function render()
    {
        $datas= \App\Models\FuneralDonation::latest()->paginate(10);
        return view('livewire.admin.funeral-management.funeral-donation', compact('datas'));
    }
}
