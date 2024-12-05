<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merchant::create([
            'business_name' => 'Sample Hotel',
            'owner_name' => 'John Doe',
            'email' => 'sample@example.com',
            'phone' => '1234567890',
            'business_type' => 'Hotel',
            'province' => '160200000', // Replace with a valid province code
            'city' => '160202000',     // Replace with a valid city code
            'description' => 'A luxurious sample hotel in the city center.',
            'business_registration' => 'documents/sample-registration.pdf', // Path to a sample file
            'owner_id' => 'documents/sample-owner-id.pdf', // Path to a sample file
            'password' => Hash::make('password123'),
            'is_verified' => true,
        ]);
    }
}
