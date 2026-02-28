<?php

namespace Database\Seeders;

use App\Enums\SmsProviderSlug;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use stdClass;

class SmsProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('sms_providers')
            ->insert([
                'name' => 'ESKIZ',
                'slug' => SmsProviderSlug::ESKIZ->value,
                'api_key' => Crypt::encryptString('eskiz-api-key'),
                'base_url' => 'https://eskiz.uz/api/messages',
                'credentials' => json_encode([
                    'username' => 'admin-user',
                    'password' => 'password'
                ]),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        \DB::table('sms_providers')
            ->insert([
                'name' => 'Playmobile',
                'slug' => SmsProviderSlug::PLAYMOBILE->value,
                'api_key' => Crypt::encryptString('playmobile-api-key'),
                'base_url' => 'https://api.playmobile.uz/messages',
                'credentials' => json_encode(new stdClass()),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        \DB::table('sms_providers')
            ->insert([
                'name' => 'Playmobile',
                'slug' => SmsProviderSlug::TWILIO->value,
                'api_key' => Crypt::encryptString('twilio-api-key'),
                'base_url' => 'https://api.playmobile.uz/messages',
                'credentials' => json_encode([
                    'account_sid' => 'A12345678',
                    'service_sid' => 'S12345678'
                ]),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
