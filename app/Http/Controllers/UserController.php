<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Interfaces\UserRepositoryInterface;
Use CommonHelper;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function landingPage()
    {
        $getVendorByRole = CommonHelper::getUserSpecificRole();

        return view('user.createTracking')->with('role',$getVendorByRole);
    }

    public function createTicket(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email:rfc,dns',
            'phone_number' => 'required',
            'invoice_number' => 'required',
            'vendor' => 'required',
            'describe' => 'required',
        ]);

        $create = $this->userRepository->createTicket($request);
        if($create['refNumber']){
            return redirect()->back()->with('success', 'Your Request Successfully Created! Please keep this #'.$create['refNumber'] .' reference number for further conversation')->with('role',$create['roles']);
        }else{
            return redirect()->back()->with('error', 'There was a failure while creating your request!')->with('role',$create['roles']);
        }
    }

    public function ticketTracking(Request $request)
    {
        $data = $this->userRepository->getTrackingInfo($request->reference_number);
        return $data;
    }
}
