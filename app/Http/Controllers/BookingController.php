<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\ResponseTraits;
use App\Http\Traits\UploadFilesTraits;
use App\Models\User;
use App\Models\Booking;
use App\Models\CreateQuotes;
use App\Models\TravelerInfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

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
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $booking = Booking::create($request->all());

            if ($booking) {

                $data = [
                    "context" => [
                        "currency" => "USD",
                        "country" => "US"
                    ],
                    "product_criteria" => [
                        "catalog" => [
                            "code" => "b2c_retail_direct",
                            "version" => "1"
                        ],
                        "category" => "b2c_retail_direct_retail",
                        "sub_category" => "b2c_retail_direct_retail_single_trip"
                    ],
                    "travel" => [
                        "travelers" => [
                            "adults" => 1,
                            "children" => 0,
                            "infants" => 0,
                            "travelers_ages" => [34]

                        ],
                        "destination_country" => "ES",
                        "origin_state" => "IL",
                        "cost" => 1500,
                        "booking_date" => "2024-07-17",
                        "destination_area" => "2",
                        "end_date" => "2024-12-04",
                        "start_date" => "2024-12-03"

                    ]
                ];


                $url = 'https://api-test.axa-assistance.com/sales/v2/individual/travel/quotes_requests';
                $headers = [
                    'Accept-Language' => 'en-US',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InhobHdPb3h2M1YwbmpiSTU1eDlEVCJ9.eyJtaSI6ZmFsc2UsImlzcyI6Imh0dHBzOi8vYXV0aC1zdGcuYXBpLmF4YXBhcnRuZXJzLmNvbS8iLCJzdWIiOiJQSVFiYjN0T29UbzE5Y1VwZ3lNTGp2MUR2aDZtNTFSRkBjbGllbnRzIiwiYXVkIjoiaHR0cHM6Ly9hcGktdGVzdC5heGEtYXNzaXN0YW5jZS5jb20vIiwiaWF0IjoxNzI0NzYxNDUyLCJleHAiOjE3MjQ3NjUwNTIsInNjb3BlIjoidXJuOmF4YS5wYXJ0bmVycy5zYWxlcy5pbmRpdmlkdWFsLnRyYXZlbC5vcmRlcnMud3JpdGUgdXJuOmF4YS5wYXJ0bmVycy5zYWxlcy5pbmRpdmlkdWFsLnRyYXZlbC5wb2xpY2llcy5yZWFkX29ubHkgdXJuOmF4YS5wYXJ0bmVycy5zYWxlcy5pbmRpdmlkdWFsLnRyYXZlbC5wb2xpY2llcy53cml0ZSB1cm46YXhhLnBhcnRuZXJzLnNhbGVzLmluZGl2aWR1YWwudHJhdmVsLnF1b3Rlc3JlcXVlc3RzLndyaXRlIiwiZ3R5IjoiY2xpZW50LWNyZWRlbnRpYWxzIiwiYXpwIjoiUElRYmIzdE9vVG8xOWNVcGd5TUxqdjFEdmg2bTUxUkYifQ.WrBleG5B1TDYaZKSIOd7HYgS3Ym69-uoXuzl914XP03KlTkzz-E_hdoAjyryV8e4BnvrHNPWv4KrCDARgsjWA6PP_TY7SFMRGt-ao_KkiHvfJcKmMctBr7Nsy7JB5JFiTBVSifrLu5F3s4s_SVLGhr4cCgU5bU0UosP_J9kf-68Rtwk9zZo_ZrYR4Xrk9lEo-E5Nz7pJnHW53P87DuBaYoSjJrl_NDRTLWhsVjoDCNGY4YUfJ3ScMpyIh0NfCjLqCnEQpq4vYfT4HmTBwrg3w1LXbfCpxfgANf9OyoH9ltrAMjb6Q5zCcM-c6-GUnGp6aolvb-tWdb09234nleUsMg',
                    'Cookie' => 'TS0175b6a9=01b805b1462e11e62193604617eaaa029caf62b26aebcb2c22710ba4b810defe9a8d8bd183b49a655893a1d36b05eb5b19480fec97'
                ];

                $response = Http::withHeaders($headers)->post($url, $data);

                if ($response->successful()) {

                    $responseData = json_decode($response, true);

                    foreach ($responseData['products'] as $product) {
                        $name = $product['name'];
                        $quote_code = $product['quote_code'];
                        $consent = $product['consents'][2]['code'];
                        $price_after_discount = $product['prices']['price_after_discount_incl_tax'];
                        $premium_after_discount = $product['prices']['premium_after_discount_excl_tax'];
                        $content_url = $product['attachments'][0]['content_url'];
                        $trip_cancellation = $product['guarantees'][0]['limit'];
                        $trip_interruption = $product['guarantees'][1]['limit'];
                        $medical_expenses = $product['guarantees'][2]['limit'];
                        $emergency_evacuation = $product['guarantees'][3]['limit'];


                       $createQuote = CreateQuotes::create([
                            'booking_id' => $booking->id,
                            'name' => $name,
                            'quote_code' => $quote_code,
                            'consent' => $consent,
                            'price_after_discount_incl_tax' => $price_after_discount,
                            'premium_after_discount_excl_tax' => $premium_after_discount,
                            'content_url' => $content_url,
                            'trip_cancallation' => $trip_cancellation,
                            'trip_interuption' =>  $trip_interruption,
                            'medical_expenses'=> $medical_expenses,
                            'emergency_evacuation' => $emergency_evacuation,
                        ]);

                    }


                    $goldQuote = CreateQuotes::where('booking_id', $booking->id)->where('name', 'Gold')->first();
                    $silverQuote = CreateQuotes::where('booking_id', $booking->id)->where('name', 'Silver')->first();
                    $platinumQuote = CreateQuotes::where('booking_id', $booking->id)->where('name', 'Platinum')->first();

                    return view('pages.website.get-quote', compact('goldQuote', 'silverQuote', 'platinumQuote'))->with('success', 'Booking saved and quote retrieved successfully.');
                } else {
                    return response()->json([
                        'error' => 'Failed to create policy',
                        'message' => $response->body()
                    ], $response->status());
                }
            } else {
                return redirect()->back()->with('error', 'Failed to add data');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


}
