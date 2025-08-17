<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Reservation;

class TimeOverlap implements Rule
{
    protected $timeIn;
    protected $timeOut;
    protected $date;
    protected $court;

    public function __construct($timeIn, $timeOut, $date, $court)
    {
        $this->timeIn = $timeIn;
        $this->timeOut = $timeOut;
        $this->date = $date;
        $this->court = $court;
    }

    public function passes($attribute, $value)
    {
        // Check if the selected time range overlaps with any existing reservations
        $overlap = Reservation::where('court', $this->court)
            ->where('date', $this->date)
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('time_in', '<', $this->timeOut)
                        ->where('time_out', '>', $this->timeIn);
                });
            })
            ->exists();

        return !$overlap;
    }

    public function message()
    {
        return 'The selected time range overlaps with an existing reservation on the same date and court.';
    }
}
