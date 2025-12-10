<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class EventType extends Component
{
    public $event_name;
    public $event_id;
    public $Edit = false;


    public function create ()
    {
        $validatedData = $this->validate([
            'event_name' => 'required|string|max:255',
        ]);

        \App\Models\EventType::create($validatedData);

        // Reset input fields
        $this->event_name = '';

    }

    public function edit ($id)
    {
        $eventType = \App\Models\EventType::findOrFail($id);
        $this->event_id = $eventType->id;
        $this->event_name = $eventType->event_name;
        $this->Edit = true;
    }

    public function update ()
    {
        $validatedData = $this->validate([
            'event_name' => 'required|string|max:255',
        ]);

        $eventType = \App\Models\EventType::findOrFail($this->event_id);
        $eventType->update($validatedData);

        // Reset input fields
        $this->event_id = '';
        $this->event_name = '';
        $this->Edit = false;
    }

    public function delete ($id)
    {
        $eventType = \App\Models\EventType::findOrFail($id);
        $eventType->delete();
    }

    public function render()
    {
        $datas = \App\Models\EventType::all();
        return view('livewire.admin.event-type', compact('datas'));
    }
}
