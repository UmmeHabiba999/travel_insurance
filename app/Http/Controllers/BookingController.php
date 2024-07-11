<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\ResponseTraits;
use App\Http\Traits\UploadFilesTraits;
use App\Models\User;
use App\Models\Booking;
use App\Models\TravelerInfo;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    use ResponseTraits;



    public function AddBooking(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'state_of_residence' => 'required|string|max:255',
                'destination_country' => 'required|string|max:255',
                'departure_date' => 'required|date|after_or_equal:today',
                'return_date' => 'required|date|after_or_equal:departure_date',
                'first_deposit_date' => 'required|date',
                'total_trip_cost' => 'required|numeric|min:0',
                'number_of_travelers' => 'required|integer|min:1',
                'age_of_travelers' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $booking = Booking::create($request->all());
            $request->session()->put('booking_id', $booking->id);

            if ($booking) {

                return $this->sendResponse('booking  saved successfully.');
            } else {
                return $this->sendError('Failed to add data');
            }

        } catch (\Exception $e) {
            return $this->sendError('Error: ' . $e->getMessage());
        }
    }

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
                'cvc' => 'required|numeric',
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
