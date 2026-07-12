<?php

namespace Modules\Taxido\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Taxido\Models\Driver;
use Modules\Taxido\Models\DriverDocument;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NotifyDriverDocStatusEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $driver;

    public $document;

    /**
     * @param  Driver         $driver    The driver whose document status changed.
     * @param  DriverDocument $document  The document that was updated.
     */
    public function __construct(Driver $driver, DriverDocument $document)
    {
        $this->driver   = $driver;
        $this->document = $document;
    }
}
