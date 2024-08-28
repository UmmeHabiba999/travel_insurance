<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\CreateQuotes;

class CreatePolicyController extends Controller
{


    public function createPolicy(Request $request)
    {
        $quoteName = $request->input('quote_name');
        $quote = CreateQuotes::where('name', $quoteName)->first();
        // $price = $quote->price_after_discount_incl_tax;

        // $code = $quote->quote_code;
        // dd($code);
        // dd($price);
        // $consent = $quote->consent;
        // dd($consent);
//    dd($quote->quote_code , $quote->price_after_discount_incl_tax , $quote->consent);


        $data = [
            'quote_code' => $quote->quote_code,
            'price' => [
                'currency' => 'EUR',
                'price_after_discount_inc_tax' => $quote->price_after_discount_incl_tax,
            ],
            'policy_holder' => [
                'title' => 'MR',
                'first_name' => 'Depp',
                'middle_name' => 'string',
                'last_name' => 'Johnny',
                'birth_date' => '1990-04-25',
                'email' => 'johnny.depp@mail.com',
                'registrations' => [
                    [
                        'registration_type' => 'ID_CARD',
                        'value' => 'string'
                    ]
                ],
                'spoken_language' => 'en',
                'phone' => [
                    'international_prefix' => 'strin',
                    'number' => 'string'
                ],
                'address' => [
                    'street_address' => 'string',
                    'postal_code' => 'string',
                    'city' => 'string',
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

        $url = 'https://api-test.axa-assistance.com/sales/v2/individual/travel/policies';
        $headers = [
            'Accept-Language' => 'en-US',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InhobHdPb3h2M1YwbmpiSTU1eDlEVCJ9.eyJtaSI6ZmFsc2UsImlzcyI6Imh0dHBzOi8vYXV0aC1zdGcuYXBpLmF4YXBhcnRuZXJzLmNvbS8iLCJzdWIiOiJQSVFiYjN0T29UbzE5Y1VwZ3lNTGp2MUR2aDZtNTFSRkBjbGllbnRzIiwiYXVkIjoiaHR0cHM6Ly9hcGktdGVzdC5heGEtYXNzaXN0YW5jZS5jb20vIiwiaWF0IjoxNzI0NzY1NTIzLCJleHAiOjE3MjQ3NjkxMjMsInNjb3BlIjoidXJuOmF4YS5wYXJ0bmVycy5zYWxlcy5pbmRpdmlkdWFsLnRyYXZlbC5vcmRlcnMud3JpdGUgdXJuOmF4YS5wYXJ0bmVycy5zYWxlcy5pbmRpdmlkdWFsLnRyYXZlbC5wb2xpY2llcy5yZWFkX29ubHkgdXJuOmF4YS5wYXJ0bmVycy5zYWxlcy5pbmRpdmlkdWFsLnRyYXZlbC5wb2xpY2llcy53cml0ZSB1cm46YXhhLnBhcnRuZXJzLnNhbGVzLmluZGl2aWR1YWwudHJhdmVsLnF1b3Rlc3JlcXVlc3RzLndyaXRlIiwiZ3R5IjoiY2xpZW50LWNyZWRlbnRpYWxzIiwiYXpwIjoiUElRYmIzdE9vVG8xOWNVcGd5TUxqdjFEdmg2bTUxUkYifQ.hOQVCl7Wn-asG5lkzGj_2Wz3QzuEoGQun45nBuqLOMPBs3gpDYN6MK7PeD_xv2bvkAUm-O-9s1vAepGlWJj39rBjYb6pwRLO2O6pkVscPjoYJynxIrj-UrEs68yB7cwwYzgLT_qsZTnIGu4goXKADc5zOvGUe5uUbKFIEdDLAd3_b4Rm3sr1jO9uZ1XaX2uk5jPdzb6EZXhAt2SQ0hks-h5fnEPlbCgC_hDBq_0_rLOjxaU7s7cNU76jRgojAg9ti7b9hPdCbOuJ66DskWVqwOQBiPQujGV87SObd3CbQTZ6gx7Bfcea3l4JvLIEUGPgw5p1shEb2Q59jM_j9Fi4TQ',
            'Cookie' => 'TS0175b6a9=01b805b14644a5a26b6fbc005692e63d995dc47a7b7bd8ecad8bd88cf95e36b6ed897e1853660ef58c6cd890020731b4eedcfec552'
        ];


        $response = Http::withHeaders($headers)->post($url, $data);

        if ($response->successful()) {

            $responseData = json_decode($response, true);

            $policy_id = $responseData['policy_id'];

            // dd($policy_id);

            if ($policy_id) {

                // dd($policy_id);

                //create payment api starts

                $data = [
                    'payment' => [
                        'type' => 'CREDIT_CARD'
                    ]
                ];

                $url = 'https://api-test.axa-assistance.com/specific/neo/travel/v1/policies/e7cc9152-ee84-4db4-b2f1-989756bf95f4/payments';
                // $url = $baseUrl.$policy_id.'/payments';

                $headers = [
                    'Accept-Language' => 'en-US',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InhobHdPb3h2M1YwbmpiSTU1eDlEVCJ9.eyJtaSI6ZmFsc2UsImlzcyI6Imh0dHBzOi8vYXV0aC1zdGcuYXBpLmF4YXBhcnRuZXJzLmNvbS8iLCJzdWIiOiJQSVFiYjN0T29UbzE5Y1VwZ3lNTGp2MUR2aDZtNTFSRkBjbGllbnRzIiwiYXVkIjoiaHR0cHM6Ly9hcGktdGVzdC5heGEtYXNzaXN0YW5jZS5jb20vIiwiaWF0IjoxNzI0NzY1NTIzLCJleHAiOjE3MjQ3NjkxMjMsInNjb3BlIjoidXJuOmF4YS5wYXJ0bmVycy5zYWxlcy5pbmRpdmlkdWFsLnRyYXZlbC5vcmRlcnMud3JpdGUgdXJuOmF4YS5wYXJ0bmVycy5zYWxlcy5pbmRpdmlkdWFsLnRyYXZlbC5wb2xpY2llcy5yZWFkX29ubHkgdXJuOmF4YS5wYXJ0bmVycy5zYWxlcy5pbmRpdmlkdWFsLnRyYXZlbC5wb2xpY2llcy53cml0ZSB1cm46YXhhLnBhcnRuZXJzLnNhbGVzLmluZGl2aWR1YWwudHJhdmVsLnF1b3Rlc3JlcXVlc3RzLndyaXRlIiwiZ3R5IjoiY2xpZW50LWNyZWRlbnRpYWxzIiwiYXpwIjoiUElRYmIzdE9vVG8xOWNVcGd5TUxqdjFEdmg2bTUxUkYifQ.hOQVCl7Wn-asG5lkzGj_2Wz3QzuEoGQun45nBuqLOMPBs3gpDYN6MK7PeD_xv2bvkAUm-O-9s1vAepGlWJj39rBjYb6pwRLO2O6pkVscPjoYJynxIrj-UrEs68yB7cwwYzgLT_qsZTnIGu4goXKADc5zOvGUe5uUbKFIEdDLAd3_b4Rm3sr1jO9uZ1XaX2uk5jPdzb6EZXhAt2SQ0hks-h5fnEPlbCgC_hDBq_0_rLOjxaU7s7cNU76jRgojAg9ti7b9hPdCbOuJ66DskWVqwOQBiPQujGV87SObd3CbQTZ6gx7Bfcea3l4JvLIEUGPgw5p1shEb2Q59jM_j9Fi4TQ',
                    'Cookie' => 'TS0175b6a9=01b805b146829e262684f55c7becfff1dfd7e8c7eaa440910d2dad5bf50b06d70319473397aa0d16df184e5fb0f2b34640dbfccd32',
                ];

                $response = Http::withHeaders($headers)->post($url, $data);

                if ($response->successful()) {

                    $payment_response = json_decode($response, true);
                    // dd($payment_response);
                    if ($payment_response) {

                        $paymentJsToken = $payment_response['payment_technical_information']['ixopay_access']['payment_js_token'];
                        // dd($paymentJsToken);

                        if ($paymentJsToken) {

                            //creditcard api starts

                            $cardResponse = Http::asMultipart()
                                ->post('https://secure.ixopay.com/v1/LzUACpPAPXS6m4m6kU6GLqhejD6JQ7yAwTYBajCOLl4ZPJcWMPVLNL34lBXGDyfZ/tokenize/creditcard', [
                                    'origin' => 'webserver-salesaxapartners-dev.lfr.cloud',
                                    'cardHolder' => 'test test',
                                    'month' => '10',
                                    'year' => '2029',
                                    'pan' => '4242 4242 4242 4242',
                                    'cvv' => '123',
                                ]);

                            if ($cardResponse->successful()) {

                                $cardResponse = json_decode($cardResponse, true);
                                $creditcard_token = $cardResponse['token'];
                                $creditcard_fingerprint = $cardResponse['fingerprint'];

                                // dd($creditcard_token,$creditcard_fingerprint);

                                if ($creditcard_token) {

                                    //creditcard tokenize API

                                    $client = new Client();

                                    $tokanizeResponse = $client->request('POST', 'https://axagroup.ixopaysandbox.com/integrated/tokenize/zIpsekOOs7Fgy1NYtWkW', [
                                        'multipart' => [
                                            [
                                                'name' => 'token',
                                                'contents' => '8UoluUMMuxST2M16IULfETcj+85bresSmRWoKVpQ3U5dj3/WLEChfSu2yTTBcA/VlT3300vngPfCxD0pGcBhOw8'
                                            ],
                                            [
                                                'name' => 'additionalData[card_type]',
                                                'contents' => 'visa'
                                            ],
                                            [
                                                'name' => 'additionalData[full_name]',
                                                'contents' => 'test test'
                                            ],
                                            [
                                                'name' => 'additionalData[bin_digits]',
                                                'contents' => '42424242'
                                            ],
                                            [
                                                'name' => 'additionalData[first_six_digits]',
                                                'contents' => '424242'
                                            ],
                                            [
                                                'name' => 'additionalData[last_four_digits]',
                                                'contents' => '4242'
                                            ],
                                            [
                                                'name' => 'additionalData[month]',
                                                'contents' => '10'
                                            ],
                                            [
                                                'name' => 'additionalData[year]',
                                                'contents' => '2029'
                                            ],
                                            [
                                                'name' => 'additionalData[fingerprint]',
                                                'contents' => 'aOwo4e+lR96iPNF922uxHDhRsvbpLnVfyWZnwWz0/MbJeYrCr+aPOLNM4YcwhqyHpRHqZlybrukUSUUwjNytQg'
                                            ],
                                            [
                                                'name' => 'fp',
                                                'contents' => 'af5b9fc681d13b3728e53a8a0f8f59d5'
                                            ],
                                            [
                                                'name' => 'threeDBrowserData[java]',
                                                'contents' => 'false'
                                            ],
                                            [
                                                'name' => 'threeDBrowserData[language]',
                                                'contents' => 'en'
                                            ],
                                            [
                                                'name' => 'threeDBrowserData[colorDepth]',
                                                'contents' => '24'
                                            ],
                                            [
                                                'name' => 'threeDBrowserData[screenHeight]',
                                                'contents' => '864'
                                            ],
                                            [
                                                'name' => 'threeDBrowserData[screenWidth]',
                                                'contents' => '1536'
                                            ],
                                            [
                                                'name' => 'threeDBrowserData[tz]',
                                                'contents' => '-120'
                                            ],
                                            [
                                                'name' => 'threeDBrowserData[userAgent]',
                                                'contents' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
                                            ],
                                            [
                                                'name' => 'threeDBrowserData[platform]',
                                                'contents' => 'Win32'
                                            ]
                                        ]
                                    ]);
                                    $tokanizeResponse = json_decode($tokanizeResponse, true);

                                    dd($tokanizeResponse);
                            }

                        } else {
                            return response()->json([
                                'error' => 'Failed to create policy',
                                'message' => $response->body()
                            ], $response->status());
                        }

                    } else {
                        return response()->json([
                            'error' => 'Failed to create policy',
                            'message' => $response->body()
                        ], $response->status());
                    }



                    // return view('pages.website.checkout');
                } else {
                    return response()->json([
                        'error' => 'Failed to create policy',
                        'message' => $response->body()
                    ], $response->status());
                }

            } else {
                return response()->json([
                    'error' => 'Failed to create policy',
                    'message' => $response->body()
                ], $response->status());
            }
        }

    }
}
}

