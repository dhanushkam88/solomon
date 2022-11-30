<?php

namespace App\Repositories;

use CommonHelper;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getTrackingInfo($data)
    {
        return CommonHelper::findTicketInfoUsingReferenceNumber($data);
    }

    public function createTicket($data)
    {
        return CommonHelper::createTicketUsingCustomerInfo($data);
    }
}
