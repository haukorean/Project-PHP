<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class NotificationBooking implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public string $message;
    public int $idUser;
    public array $schedule;

    public function __construct($idUser, $message, $schedule)
   {
      $this->idUser = $idUser;
      $this->message = $message;
      $this->schedule = $schedule;
  
    }

    public function broadcastOn()
      {
          return [new Channel('notificationbook.'.$this->idUser)];
      }

      public function broadcastAs()
      {
          return 'my-event';
      }

      public function broadcastWith(): array
       {
        return [
            'idUser' => $this->idUser,
            'message' => $this->message,
            'schedule' => $this->schedule
        ];
    }
}
