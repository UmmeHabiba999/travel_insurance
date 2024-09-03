<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\ResponseTraits;
use App\Models\Booking;
use App\Models\CreateQuotes;
use App\Models\GenerateToken;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
    
    public function AddBooking(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'state_of_residence' => 'required|string|max:255',
                'destination_country' => 'required|string|max:255',
                // 'departure_date' => 'required|date|after_or_equal:today',
                // 'return_date' => 'required|date|after_or_equal:departure_date',
                'first_deposit_date' => 'required|date',
                'total_trip_cost' => 'required|numeric|min:0',
                // 'number_of_travelers' => 'required|integer|min:1',
                // 'age_of_travelers' => 'required',
                'adults' => 'required|nullable',
                'children' => 'required|nullable',
                'infants' => 'required|nullable',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $booking = new Booking();
            $booking->state_of_residence = $request->state_of_residence;
            $booking->destination_country = $request->destination_country;
            $booking->departure_date = $request->departure_date;
            $booking->return_date = $request->return_date;
            $booking->first_deposit_date = $request->first_deposit_date;
            $booking->total_trip_cost = $request->total_trip_cost;

            $booking->save();

            //bearer token
            $token =  GenerateToken::where('id', 1)->first();
            $bearerToken = $token->token;

            $ages = $request->ages;
            $travelers_ages = is_array($ages) ? array_map('intval', $ages) : [(int) $ages];

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
                            "adults" => $request->adults,
                            "children" => $request->children,
                            "infants" => $request->infants,
                            "travelers_ages" => $travelers_ages

                        ],
                        "destination_country" => $request->destination_country,
                        "origin_state" => $request->state_of_residence,
                        "cost" => $request->total_trip_cost,
                        "booking_date" => $request->first_deposit_date,
                        "end_date" => $request->return_date,
                        "start_date" => $request->departure_date

                    ]
                ];


                // $bearerToken = config('services.axa.bearer_token');

                $url = 'https://api-test.axa-assistance.com/sales/v2/individual/travel/quotes_requests';
                $headers = [
                    'Accept-Language' => 'en-US',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $bearerToken,
                    'Cookie' => 'TS0175b6a9=01b805b1462e11e62193604617eaaa029caf62b26aebcb2c22710ba4b810defe9a8d8bd183b49a655893a1d36b05eb5b19480fec97'
                ];

                $response = Http::withHeaders($headers)->post($url, $data);

                if ($response->successful()) {

                    $responseData = json_decode($response, true);

                    foreach ($responseData['products'] as $product) {
                        $name = $product['name'];
                        $quote_code = $product['quote_code'];

                        if (strpos($name, 'Gold') !== false) {
                            $consent = $product['consents'][1]['code'];
                        } else {
                            $consent = $product['consents'][2]['code'];
                        }

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
                            'trip_interuption' => $trip_interruption,
                            'medical_expenses' => $medical_expenses,
                            'emergency_evacuation' => $emergency_evacuation,
                        ]);
                    }

                    $goldQuote = CreateQuotes::where('booking_id', $booking->id)
                        ->where('name', 'like', '%Gold%')
                        ->first();
                    $silverQuote = CreateQuotes::where('booking_id', $booking->id)->where('name', 'like', '%Silver%')
                        ->first();
                    $platinumQuote = CreateQuotes::where('booking_id', $booking->id)->where('name', 'like', '%Platinum%')
                        ->first();
                    return view('pages.website.get-quote', compact('goldQuote', 'silverQuote', 'platinumQuote'))->with('success', 'Booking saved and quote retrieved successfully.');
                } else {
                    // Session::flash('error', 'Failed to create policy: ' . $response->body());
                    // return redirect('/booking');
                    $responseBody = $response->body();
                    $responseData = json_decode($responseBody, true);
                    $errorMessage = isset($responseData['error']) ? $responseData['error'] : 'Unknown error';

                    Session::flash('error', 'Failed to create policy: ' . $errorMessage);
                    return redirect('/booking');

                }
            } else {
                return redirect()->back()->with('error', 'Failed to add data');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function generateToken()
    {

        $url = 'https://auth-stg.api.axapartners.com/oauth/token';

        $data = [
            'grant_type' => 'client_credentials',
            'client_id' => 'PIQbb3tOoTo19cUpgyMLjv1Dvh6m51RF',
            'client_secret' => 'aYtPT1oMA2SfP17LEc3JFm-lR0nAC1mesF7CNTDcKl6A6-Pw-4xHTVtozwxak-eU',
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: __cf_bm=f30udCiO6LN0xU16iNKyKseB1BWnDUUCi3EhaAR0ztM-1725013758-1.0.1.1-87sEPzqcpQa71z5rV8PYw2c.egw_eo0sLUmM0MjQmKPN01jffZEGA72gurzecTVr; did=s%3Av0%3Ad86fb33f-8ff0-4981-ae96-36817f90f35a.o9lXj0r2LfT%2BjEiNqTujXji7911PqEdZaY%2FV3YEIfEw; did_compat=s%3Av0%3Ad86fb33f-8ff0-4981-ae96-36817f90f35a.o9lXj0r2LfT%2BjEiNqTujXji7911PqEdZaY%2FV3YEIfEw',
        ]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

        GenerateToken::updateOrCreate(
            ['id' => 1],
            ['token' => $response['access_token']]
        );
    }
}
