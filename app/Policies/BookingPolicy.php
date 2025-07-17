<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookingPolicy
{
  public function view(User $user, Booking $booking)
{
    return $user->id === $booking->user_id;
}

public function update(User $user, Booking $booking)
{
    return $user->id === $booking->user_id;
}

public function delete(User $user, Booking $booking)
{
    return $user->id === $booking->user_id;
}

}
