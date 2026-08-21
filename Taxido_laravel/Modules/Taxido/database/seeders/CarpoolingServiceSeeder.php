<?php

namespace Modules\Taxido\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Taxido\Models\Service;
use Modules\Taxido\Models\ServiceCategory;
use Modules\Taxido\Enums\ServicesEnum;
use Modules\Taxido\Enums\ServiceCategoryEnum;

class CarpoolingServiceSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::firstOrCreate(
            ['name' => ucfirst(ServicesEnum::CARPOOLING)],
            [
                'type' => ServicesEnum::CARPOOLING,
                'description' => 'Share your ride and split the cost with other passengers.',
                'is_primary' => false,
            ]
        );

        ServiceCategory::firstOrCreate(
            ['name' => ucfirst(ServiceCategoryEnum::CARPOOLING)],
            [
                'slug' => 'carpooling',
                'type' => ServiceCategoryEnum::CARPOOLING,
                'description' => 'Find or offer shared rides with available seats.',
                'service_id' => $service->id,
            ]
        );
    }
}
