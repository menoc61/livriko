<?php

namespace Modules\Taxido\Enums;

enum PackageTypeEnum: string
{
    const DOCUMENTS = 'documents';
    const CLOTHING = 'clothing';
    const FOOD = 'food';
    const ELECTRONICS = 'electronics';
    const FRAGILE = 'fragile';
    const OTHER = 'other';

    public static function values(): array
    {
        return [
            self::DOCUMENTS,
            self::CLOTHING,
            self::FOOD,
            self::ELECTRONICS,
            self::FRAGILE,
            self::OTHER,
        ];
    }
}
