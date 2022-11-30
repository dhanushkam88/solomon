<?php

namespace App\Interfaces;

interface DashboardRepositoryInterface
{
    public function getTicketUsingStatus($data);
    public function getTicketsInfo();
    public function getTicketsInfoUsingId($id);
    public function updateTicket($request);
}
