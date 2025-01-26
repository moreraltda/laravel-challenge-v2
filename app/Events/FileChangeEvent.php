<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileChangeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $file;

    /**
     * Create a new event instance.
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('change-files.' . $this->file->id),
        ];
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->file->id,
            'name' => $this->file->name,
            'content' => $this->file->content,
            'updated_at' => $this->file->updated_at,
        ];
    }
}
