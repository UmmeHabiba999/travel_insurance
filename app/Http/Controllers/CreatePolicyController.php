<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use App\Models\CreateQuotes;
use App\Models\Booking;
use App\Models\TravelerInfo;
use App\Models\Payment;
use Illuminate\Validation\Rule;
use App\Models\Policies;
use Illuminate\Support\Facades\Session;
use App\Models\GenerateToken;
use DateTime;


class CreatePolicyController extends Controller
{
    public function createPolicy(Request $request)
    {

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
            'card_number' => 'required',
            'expiration_date' => 'required|date',
            'cvc' => 'required|string|size:3',
            // 'payment_address' => 'required|string|max:255',
            // 'payment_city' => 'required|string|max:255',
            // 'payment_zip_code' => 'required|numeric',
            'payment_country' => 'required|string|max:255',
            // 'payment_state_of_residence' => 'required|string|max:255',

        ]);


        // Extract Month and Year from date to use in API Request
        $dateString = $request->expiration_date;
        $date = new DateTime($dateString);
        $month = $date->format('m');
        $year = $date->format('Y');

        // bearer token
        $token =  GenerateToken::where('id', 1)->first();
            $bearerToken = $token->token;

        // $bearerToken = config('services.axa.bearer_token');

        $quoteName = $request->input('quote_name');
        $quote = CreateQuotes::where('name', $quoteName)->first();

        $data = [
            'quote_code' => $quote->quote_code,
            'price' => [
                'currency' => 'EUR',
                'price_after_discount_inc_tax' => $quote->price_after_discount_incl_tax,
            ],
            'policy_holder' => [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->birth_date,
                'email' => $request->email,
                'spoken_language' => 'en',
                'phone' => [

                    'number' => $request->phone_number
                ],
                'address' => [
                    'street_address' => $request->address,
                    'postal_code' => $request->zip_code,
                    'city' => $request->city,
                    'country' => 'FR'
                ]
            ],
            'consents' => [
                [
                    'code' => $quote->consent,
                    'is_confirmed' => true
                ]
            ]
        ];

        // AXA API endpoint and headers
        $url = 'https://api-test.axa-assistance.com/sales/v2/individual/travel/policies';
        $headers = [
            'Accept-Language' => 'en-US',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $bearerToken,
            'Cookie' => 'TS0175b6a9=01b805b14644a5a26b6fbc005692e63d995dc47a7b7bd8ecad8bd88cf95e36b6ed897e1853660ef58c6cd890020731b4eedcfec552'
        ];

        //policy creation request
        $response = Http::withHeaders($headers)->post($url, $data);

        if ($response->successful()) {
            $responseData = $response->json();

            $policy_id = $responseData['policy_id'] ?? null;

            // dd($policy_id);

            if ($policy_id) {

                // Storing data in the policy table
                $policy = new Policies();
                $policy->policy_id = $policy_id;
                $policy->quote_code = $quote->quote_code;
                $policy->price_after_discount_inc_tax = $quote->price_after_discount_incl_tax;
                $policy->currency = 'EUR';
                $policy->policy_holder_name = $request->full_name;
                $policy->policy_holder_email = $request->email;
                $policy->birth_date = $request->birth_date;
                $policy->address = $request->address;
                $policy->consent_code = $quote->consent;
                $policy->is_payment_successful = false;

                $policy->save();

                // payment API request
                $paymentData = [
                    'payment' => [
                        'type' => 'CREDIT_CARD'
                    ]
                ];

                // payment request
                $paymentUrl = "https://api-test.axa-assistance.com/specific/neo/travel/v1/policies/{$policy_id}/payments";
                $paymentResponse = Http::withHeaders($headers)->post($paymentUrl, $paymentData);

                // dd($paymentResponse );
                if ($paymentResponse->successful()) {
                    $paymentResponseData = $paymentResponse->json();
                    $paymentJsToken = $paymentResponseData['payment_technical_information']['ixopay_access']['payment_js_token'] ?? null;

                    if ($paymentJsToken) {
                        // Tokenize the credit card
                        $cardResponse = Http::asMultipart()
                            ->post('https://secure.ixopay.com/v1/LzUACpPAPXS6m4m6kU6GLqhejD6JQ7yAwTYBajCOLl4ZPJcWMPVLNL34lBXGDyfZ/tokenize/creditcard', [
                                'origin' => 'webserver-salesaxapartners-dev.lfr.cloud',
                                'cardHolder' => $request->full_name,
                                'month' => $month,
                                'year' => $year,
                                'pan' => '4242424242424242',
                                'cvv' => $request->cvc,
                            ]);

                        if ($cardResponse->successful()) {
                            $cardResponseData = $cardResponse->json();
                            // dd($cardResponseData);
                            $creditcard_token = $cardResponseData['token'] ?? null;

                            if ($creditcard_token) {
                                // Finalize the credit card payment
                                $client = new Client();
                                $finalPaymentResponse = $client->post('https://axagroup.ixopaysandbox.com/integrated/tokenize/zIpsekOOs7Fgy1NYtWkW', [
                                    'multipart' => [
                                        [
                                            'name' => 'token',
                                            'contents' => $creditcard_token
                                        ],
                                        [
                                            'name' => 'additionalData[full_name]',
                                            'contents' => $request->full_name
                                        ],

                                        [
                                            'name' => 'additionalData[month]',
                                            'contents' => $month
                                        ],
                                        [
                                            'name' => 'additionalData[year]',
                                            'contents' => $year
                                        ],
                                        [
                                            'name' => 'additionalData[cvv]',
                                            'contents' => $request->cvc
                                        ]
                                    ]
                                ]);

                                if ($finalPaymentResponse->getStatusCode() == 200) {

                                    $ixopayTransactionId = $finalPaymentResponse->getBody()->getContents();

                                    // Finalize the policy creation
                                    $finalizeUrl = "https://api-test.axa-assistance.com/sales/v2/individual/travel/policies/{$policy_id}/finalize";
                                    $finalizeData = [
                                        "subscription_country" => "US",
                                        "payment" => [
                                            "type" => "CREDIT_CARD",
                                            "paymentTransationId" => $ixopayTransactionId,
                                            "psp_transaction_id" => $ixopayTransactionId
                                        ]
                                    ];

                                    $finalizeResponse = Http::withHeaders($headers)->post($finalizeUrl, $finalizeData);

                                    if ($finalizeResponse->successful()) {
                                        $policy->is_payment_successful = true;
                                        $policy->save();

                                        // dd($finalizeResponse);

                                        return redirect('/booking')->with('success', 'Policy and payment created successfully!');
                                    } else {
                                        return response()->json([
                                            'errors' => ['Failed to create policy: Policy ID not returned.'],
                                        ], 500);

                                    }
                                } else {
                                    // return response()->json($finalPaymentResponse->getBody(), 500);
                                    return response()->json([
                                        'errors' => ['Failed to create policy'],
                                    ], 500);
                                }
                            } else {
                                return response()->json([
                                    'errors' => ['Failed to create policy'],
                                ], 500);
                            }
                        } else {
                            return response()->json([
                                'errors' => ['Failed to create policy'],
                            ], 500);
                        }
                    } else {
                        return response()->json([
                            'errors' => ['Failed to create policy'],
                        ], 500);
                    }
                } else {
                    return response()->json([
                        'errors' => ['Failed to create policy'],
                    ], 500);
                }
            } else {
                return response()->json([
                    'errors' => ['Failed to create policy'],
                ], 500);
            }
        } else {
            return response()->json([
                'errors' => ['Failed to create policy'],
            ], 500);
        }
    }
}
