<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Type;


class Categorytypechildpart extends Component
{
    public $categories;
    public $types;
    public $child_parts;

    public $selectedCategory = null;
    public $selectedType = null;
    public $selectedChildPart = null;

    public function mount($selectedChildPart = null)
    {
        $this->categories = Categories::all();
        $this->types = collect();
        $this->child_parts = collect();
        $this->selectedChildPart = $selectedChildPart;

        if (!is_null($selectedChildPart)) {
            $city = ChildPartNumber::with('state.country')->find($selectedCity);
            if ($city) {
                $this->cities = City::where('state_id', $city->state_id)->get();
                $this->states = State::where('country_id', $city->state->country_id)->get();
                $this->selectedCountry = $city->state->country_id;
                $this->selectedState = $city->state_id;
            }
        }
    }

    

    public function render()
    {
        return view('livewire.categorytypechildpart');
    }
    public function updatedSelectedCountry($country)
    {
        $this->states = State::where('country_id', $country)->get();
        $this->selectedState = NULL;
    }

    public function updatedSelectedState($state)
    {
        if (!is_null($state)) {
            $this->cities = City::where('state_id', $state)->get();
        }
    }
}
