<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefaultImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultImagePaths = [
            'images/logo-livriko.png',
            'images/logo-dark-livriko.png',
            'images/favicon-livriko.png',
        ];

        $attachments = createAttachment();
        foreach ($defaultImagePaths as $defaultImagePath) {
            $fullImagePath = public_path($defaultImagePath);
            $attachments->copyMedia($fullImagePath)->toMediaCollection('attachment');
        }

        $attachments->delete($attachments?->id);
    }
}
