<?php

namespace App\Livewire;

use Livewire\Component;

class ProfileDropdown extends Component
{
    public $open = false;

    public function toggleDropdown()
    {
        $this->open = !$this->open;
    }

    public function closeDropdown()
    {
        $this->open = false;
    }
    
    public function render()
    {
        return view('livewire.profile-dropdown');
    }
}
