<?php

namespace Database\Seeders;

use App\Enums\SmsProviderSlug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $twilioProviderId = \DB::table('sms_providers')->where('slug', SmsProviderSlug::TWILIO->value)->value('id');

        \DB::table('projects')
            ->insert([
                'name' => 'Main',
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem, vel?',
                'sms_provider_id' => $twilioProviderId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
