<?php

namespace App\Mail;

use App\Models\Employe;
use App\Models\Location;
use App\Models\Roaster;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RoasterSetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $roasterDetail;
    public $employee;

    // public $state;
    // public $city;

    // public $from;
    // public $to;
    /**
     * Create a new message instance.
     *
     * @return void
     *
     */
    // $roaster->from_date,$roaster->to_date,$city,$state,$address,$from,$to
    public function __construct($roasterDetail, $employee)
    // public function __construct(Employe $employee,Roaster $roaster,Location $location)
    {
        $this->roasterDetail = $roasterDetail;
        $this->employee = $employee;

        // $this->$state = $state;
        // $this->$city = $city;

        // $this->$from = $from;
        // $this->$to = $to;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.roaster.setRoasterConfirmMail');
    }
}
