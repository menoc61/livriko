<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Session;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Languages = [
            [
                'name' => 'English',
                'locale' => 'en',
                'app_locale' => 'en_EN',
                'is_rtl' => 0,
                'system_reserve' => 1,
                'flag' => 'US.png',
                'status' => 1,
            ],
            [
                'name' => 'Arabic',
                'locale' => 'ar',
                'app_locale' => 'ar_SA',
                'is_rtl' => 1,
                'system_reserve' => 0,
                'flag' => 'AF.png',
                'status' => 1,
            ],
            [
                'name' => 'German',
                'locale' => 'de',
                'app_locale' => 'de_DE',
                'is_rtl' => 0,
                'system_reserve' => 0,
                'flag' => 'BE.png',
                'status' => 1,
            ],
            [
                'name' => 'French',
                'locale' => 'fr',
                'app_locale' => 'fr_FR',
                'is_rtl' => 0,
                'system_reserve' => 0,
                'flag' => 'CS.png',
                'status' => 1,
            ],
        ];

        foreach ($Languages as $lang) {
            Language::updateOrCreate($lang);
        }

        Session::put('locale', 'en');
        app()->setLocale(Session::get('locale'));
    }
}
