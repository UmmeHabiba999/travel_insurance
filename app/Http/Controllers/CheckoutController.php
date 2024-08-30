<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Booking;
use App\Models\CreateQuotes;
use App\Models\Payment;
use App\Models\TravelerInfo;
use App\Http\Traits\ResponseTraits;

class CheckoutController extends Controller
{
    use ResponseTraits;

        //Add Payments
        public function AddCheckout(Request $request)
        {

            try {

                $validator = Validator::make($request->all(), [

                    'country' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'address' => 'required|string',
                    'city' => 'required|string|max:255',
                    'zip_code' => 'required|string|max:10',
                    'state_of_residence' => 'required|string|max:255',
                    'phone_number' => 'required|string|max:15',
                    'email' => 'required|email|confirmed',
                    'birth_date' => 'required|date|before:today',
                    'age' => 'required|integer|min:0',

                    'full_name' => 'required|string|max:255',
                    'card_number' => 'required|numeric',
                    'expiration_date' => 'required|date',
                    'cvc' => 'required|numeric|max:3',
                    'payment_address' => 'required|string|max:255',
                    'payment_city' => 'required|string|max:255',
                    'payment_zip_code' => 'required|numeric',
                    'payment_country' => 'required|string|max:255',
                    'payment_state_of_residence' => 'required|string|max:255',

                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                $payment = Payment::create($request->all());
                $travelerInfo = TravelerInfo::create($request->all());

            } catch (\Exception $e) {
                return $this->sendError('Error: ' . $e->getMessage());
            }
        }

        public function CheckOut()
        {
            $bookingId = session('booking_id');
            $booking = Booking::where('id', $bookingId)->get()->first();
            // dd($bookingId);
             return view('pages.website.checkout', compact('booking'));
        }


}
