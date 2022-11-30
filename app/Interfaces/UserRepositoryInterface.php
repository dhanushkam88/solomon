<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getTrackingInfo($data);
    public function createTicket($data);
}
