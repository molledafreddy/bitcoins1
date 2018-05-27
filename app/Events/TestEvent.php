<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Log;

class TestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $time;

    public function __construct()
    {
        $this->time = microtime();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        Log::debug('paso por aqui:broadcastOn');
        return ['service'];
    }

    public function broadcastWith()
    {
        Log::debug('paso por aqui: broadcastWith');
        return [
            'time' => microtime(),
            'version' => 0.1
        ];
    }

    public function broadcastAs()
    {
        Log::debug('paso por aqui: broadcastAs');
        return 'microtime';
    }
}
