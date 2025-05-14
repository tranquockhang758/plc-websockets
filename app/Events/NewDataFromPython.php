<?php
// app/Events/NewMessage.php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadCastNow;

class NewDataFromPython implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $allData;
    public function __construct($data, $allData)
    {
        $this->data = $data;
        $this->allData = $allData;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('python');
    }

    public function broadcastWith()
    {
        return [
            'data' => $this->data,
            'allData' => $this->allData,
        ];
    }
}
