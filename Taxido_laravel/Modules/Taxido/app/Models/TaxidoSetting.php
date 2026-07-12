<?php

namespace Modules\Taxido\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaxidoSetting extends Model
{
    use HasFactory;

    /**
     * The values that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'cabbooking_values',
    ];

    protected $casts = [
        'cabbooking_values' => 'json',
    ];

    protected $visible = [
        'cabbooking_values'
    ];

    public function getTaxidoValuesAttribute($value)
    {
        $values = json_decode($value, true);
        return $values;
    }
}
