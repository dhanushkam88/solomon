<?php
use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketInformation;
use Illuminate\Support\Facades\Auth;

class CommonHelper
{
    public static function getTicketInformation($id){
        $data = Ticket::where('id',$id)->with('ticketInformation')->get();
        return $data;
    }

    public static function generateUniqueCode()
    {
        $characters = '123456789';
        $charactersNumber = strlen($characters);
        $codeLength = 16;

        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (Ticket::where('reference_number', $code)->exists()) {
            $code = $this->generateUniqueCode();
        }

        return $code;
    }

    public static function getUser($id)
    {
        return User::find($id)->first();
    }

    public static function getUserSpecificRole()
    {
        return User::role('vendor')->get();
    }

    public static function getTicketsInfo()
    {
        $user = Auth::user();
        $newTickets = Ticket::where('status','pending')->where('vendor_id', $user->id)->count();
        $openTickets = Ticket::where('status','reviewing')->where('vendor_id', $user->id)->count();
        $closeTickets = Ticket::where('status','closed')->where('vendor_id', $user->id)->count();

        $data = [
            'newTickets' => ($newTickets) ? $newTickets : 0,
            'openTickets' => ($openTickets) ? $openTickets : 0,
            'closeTickets' => ($closeTickets) ? $closeTickets : 0
        ];

        return $data;
    }

    public static function findTicketInfoUsingReferenceNumber($id)
    {
        $ticket = Ticket::where('reference_number', $id)->first();
        $ticketInfo = TicketInformation::where('ticket_id', $ticket->id)->get();
        return $data=[
            'ticket' => $ticket,
            'ticketInfo' => $ticketInfo
        ];
    }

    public static function createTicketUsingCustomerInfo($data)
    {
        $getVendorByRole = CommonHelper::getUserSpecificRole();

        try{
            $reference_number = CommonHelper::generateUniqueCode();

            $createTicket = new Ticket();
            $createTicket->reference_number = $reference_number;
            $createTicket->invoice_number = $data->invoice_number;
            $createTicket->vendor_id = $data->vendor;
            $createTicket->name = $data->customer_name;
            $createTicket->email = $data->customer_email;
            $createTicket->contact_number = $data->phone_number;
            $createTicket->description = $data->describe;
            $createTicket->status = 'pending';
            $createTicket->save();

            $createTicketInfo = new TicketInformation();
            $createTicketInfo->ticket_id = $createTicket->id;
            $createTicketInfo->details = $data->describe;
            $createTicketInfo->message_status = 'pending';
            $createTicketInfo->sender = 'user';
            $createTicketInfo->save();

            $data = [
                'roles' => $getVendorByRole,
                'refNumber' => $reference_number
            ];
            return $data;
        }catch(Exception $e){
            \Log::error($e->getMessage().' - CommonHelper - createTicketUsingCustomerInfo - '.__LINE__.' - '.$e->getLine().' - '.$e->getFile());
            $data = [
                'roles' => $getVendorByRole,
                'refNumber' => ''
            ];
            return $data;
        }
    }
}
