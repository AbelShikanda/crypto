<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class NexmoSMSController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        try {
  
            $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
            $client = new \Nexmo\Client($basic);

            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS("254759537406", 'BRAND_NAME', 'A text message sent using the Nexmo SMS API')
            );
            
            $message = $response->current();
            
            if ($message->getStatus() == 0) {
                echo "The message was sent successfully\n";
            } else {
                echo "The message failed with status: " . $message->getStatus() . "\n";
            }
              
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}
