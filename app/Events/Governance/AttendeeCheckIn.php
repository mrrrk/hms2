<?php

namespace App\Events\Governance;

use HMS\Entities\User;
use HMS\Entities\Governance\Meeting;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use HMS\Repositories\Governance\ProxyRepository;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AttendeeCheckIn implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Meeting
     */
    public $meeting;

    /**
     * @var User
     */
    public $attendee;

    /**
     * @var string
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Meeting $meeting, User $attendee, string $message)
    {
        $this->meeting = $meeting;
        $this->attendee = $attendee;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('meetings.' . $this->meeting->getID() . '.attendeeCheckIn');
    }

    /**
     * Get the data that should be sent with the broadcasted event.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $representedProxies = resolve(ProxyRepository::class)->countRepresentedForMeeting($this->meeting);
        $checkInCount = $this->meeting->getAttendees()->count() + $representedProxies;

        return [
            'id' => $this->meeting->getId(),
            'title' => $this->meeting->getTitle(),
            'startTime' => $this->meeting->getStartTime()->toJSON(),
            'extraordinary' => $this->meeting->isExtraordinary(),
            'currentMembers' => $this->meeting->getCurrentMembers(),
            'votingMembers' => $this->meeting->getVotingMembers(),
            'quorum' => $this->meeting->getQuorum(),
            'attendees' => $this->meeting->getAttendees()->count(),
            'proxies' => $this->meeting->getProxies()->count(),
            'representedProxies' => $representedProxies,
            'checkInCount' => $checkInCount,
            'checkInUser' => [
                'name' => $this->attendee->getFullname(),
                'message' => $this->message,
            ],
        ];
    }
}
