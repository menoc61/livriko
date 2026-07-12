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
            'images/light.svg',
            'images/dark.svg',
            'images/favicon.svg',
        ];

        $attachments = createAttachment();
        foreach ($defaultImagePaths as $defaultImagePath) {
            $fullImagePath = public_path($defaultImagePath);
            $attachments->copyMedia($fullImagePath)->toMediaCollection('attachment');
        }

        $attachments->delete($attachments?->id);
    }
}
