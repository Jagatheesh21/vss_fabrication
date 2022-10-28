<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_name' => 'Venkateswara Steels & Springs(I) Ltd.',
            'gst_number' => 'ABC1212221212',
            'address' => 'Coimbatore',
            'pan_number' => 'ABC1234566666',
            'vendor_code' => 'ABC123456',
            'phone_number' => '9889899898989',
            'hsn_code' => '123456'
        ];
    }
}
