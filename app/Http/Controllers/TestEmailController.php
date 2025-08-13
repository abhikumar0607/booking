<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mail;
use App\Mail\TestEmail; 

class TestEmailController extends Controller
{
    //Function to send email
    function test_email(Request $request) { 
        //Mail data 
        $mail_data = [
            'testing' => "testingg"
        ];
        //Send Email 
        $send_email = Mail::to("amitdeveloper99@gmail.com")->send(new TestEmail($mail_data));
        //Check if mail is sent or not 
        if($send_email){
            echo "yess";
        } else { 
            echo "no";
        }
        echo "<pre>"; print_r($send_email); echo "</pre>";
    }
}
