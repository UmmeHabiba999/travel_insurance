<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\GenerateToken;
use Illuminate\Console\Scheduling\Schedule;

class CreateToken extends Command
{
    protected $signature = 'generate:token';
    protected $description = 'Generate and update the token in the database every hour';

    // Schedule the command to run hourly
    #[Schedule('hourly')]
    public function handle()
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

        $this->info('Token generated and updated successfully.');
    }
}
