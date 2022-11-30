<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
Use App\Interfaces\VendorRepositoryInterface;
use App\Interfaces\DashboardRepositoryInterface;

class VendorController extends Controller
{
    public function __construct(VendorRepositoryInterface $vendorRepository, DashboardRepositoryInterface $dashboardRepository)
    {
        $this->vendorRepository = $vendorRepository;
        $this->dashboardRepository = $dashboardRepository;
    }

    public function ticketsInformation()
    {
        return $this->dashboardRepository->getTicketsInfo();
    }

    public function getOpenTickets(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $details = $this->dashboardRepository->getTicketUsingStatus($request);
        return DataTables::of($details)
            ->addColumn('reference_number', function ($details) {
                return $details->reference_number;
            })
            ->addColumn('name', function ($details) {
                return $details->name;
            })
            ->addColumn('email', function ($details) {
                return $details->email;
            })
            ->addColumn('contact_number', function ($details) {
                return $details->contact_number;
            })
            ->addColumn('created_at', function ($details) {
                return $details->created_at;
            })
            ->addColumn('status', function ($details) {
                return view('dashboard', compact('details'))->render();
            })
            ->make(true);
    }

    public function getTicketInfoUsingId(Request $request)
    {
        return $this->dashboardRepository->getTicketsInfoUsingId($request->id);
    }

    public function updateTicket(Request $request)
    {
        dd($request);
        $request->validate([
            'id' => 'required',
        ]);

        $data = $this->dashboardRepository->updateTicket($request);
        if($data){
            return redirect()->back()->with('success', 'Your request successfully send!');
        } else{
            return redirect()->back()->withInput()->with('error', 'There was a Notification failure!');
        }
    }
}
