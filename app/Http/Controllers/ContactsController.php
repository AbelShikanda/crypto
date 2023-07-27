<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomEncryptionKeyMail;
use Exception;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customEncryptionKey = Str::random(32); // Generate a random 32-character key (you can adjust the length if needed)
        Config::set('app.key', $customEncryptionKey);

        try {
  
            $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
            $client = new \Nexmo\Client($basic);

            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS("254759537406", 'Crypto', $customEncryptionKey)
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

        $message = $request->validate([
            'users_id' => '',
            'message' => 'required',
        ]);
        
        try {
            DB::beginTransaction();
            // Logic For Save User Data

            $data = $request->input('message');
            $encryptedMessage = Crypt::encrypt($data);
            
            $message = Contacts::create([
                'users_id' => Auth::user()->id,
                'message' => $encryptedMessage,
            ]);

            if(!$message){
                DB::rollBack();

                return back()->with('message', 'Something went wrong while saving user data');
            }

            DB::commit();
            return redirect()->route('home')->with('message', 'your message has been sent Successfully.');


        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\messages  $contacts
     * @return \Illuminate\Http\Response
     */
    public function show(Contacts $contacts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $contacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacts $contacts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacts $contacts)
    {
        //
    }

    // public function encrypt(Request $request)
    // {
    //     $message = $request->input('message');
    //     $encryptedMessage = Crypt::encrypt($message);
    //     return redirect('/')->with('encryptedMessage', $encryptedMessage);
    // }

    public function decrypt(Request $request)
    {
        $pass = $request->validate([
            'key' => 'required',
        ]);

        $key = $request->input('key');

        if ($key == getenv("APP_KEY")) {

            $encryptedMessage = $request->input('encrypted_message');
            $decryptedMessage = Crypt::decrypt($encryptedMessage);

        }
        // return redirect()->route('home')->with('decryptedMessage', $decryptedMessage);
        return view('home', compact(
            'decryptedMessage'
        ));

        
    }
}
