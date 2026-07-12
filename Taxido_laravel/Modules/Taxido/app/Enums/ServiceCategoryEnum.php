<?php

namespace Modules\Taxido\Enums;

enum ServiceCategoryEnum: string
{
    const RENTAL = 'rental';
    const INTERCITY = 'intercity';
    const RIDE = 'ride';
    const SCHEDULE = 'schedule';
    const PACKAGE = 'package';
    const ONEWAY = 'oneway';
    const ROUNDTRIP ='roundtrip';
    const OUTSTATION = 'outstation';
    const  DAILY = 'daily';
}
