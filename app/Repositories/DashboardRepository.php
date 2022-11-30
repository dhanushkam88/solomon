<?php

namespace App\Repositories;

use Exception;
use CommonHelper;
use App\Models\Ticket;
use App\Interfaces\DashboardRepositoryInterface;
use App\Models\TicketInformation;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendVendorFeedbackEmail;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getTicketUsingStatus($data)
    {
        $user = Auth::user();
        return Ticket::where('vendor_id',$user->id)->where('status',$data->status)->get();
    }

    public function getTicketsInfo()
    {
        $getInfo = CommonHelper::getTicketsInfo();
        return $getInfo;
    }

    public function getTicketsInfoUsingId($id)
    {
        $newTickets = CommonHelper::getTicketInformation($id);
        return $newTickets;
    }

    public function updateTicket($request)
    {
        try{
            $newTickets = CommonHelper::getTicketInformation($request->id);

            $updateTicket = Ticket::find($request->id);
            $updateTicket->status = $request->status;
            $updateTicket->save();


            $createTicketInfo = new TicketInformation();
            $createTicketInfo->ticket_id = $request->id;
            $createTicketInfo->details = $request->reply;
            $createTicketInfo->message_status = 'viewed';
            $createTicketInfo->sender = 'vendor';
            $createTicketInfo->save();

            $details = [
                'customerName' => $updateTicket->name,
                'customerEmail' => $updateTicket->email,
                'description' => $updateTicket->description,
                'reply' => $request->reply,
                'reference_number' => $updateTicket->reference_number,
                'invoice_number' => $updateTicket->invoice_number,
                'status' => $updateTicket->status,
            ];

            SendVendorFeedbackEmail::dispatch($details);

            return true;
        }catch(Exception $e){
            \Log::error($e->getMessage().' - DashboardRepository - '.__LINE__.' - '.$e->getLine().' - '.$e->getFile());
            return false;
        }
    }
}
