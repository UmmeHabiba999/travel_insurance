<?php

namespace App\Http\Controllers;

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

            if ($booking) {
                
                return $this->sendResponse('booking  saved successfully.');
            } else {
                return $this->sendError('Failed to add data');
            }

        } catch (\Exception $e) {
            return $this->sendError('Error: ' . $e->getMessage());
        }
    }

}
