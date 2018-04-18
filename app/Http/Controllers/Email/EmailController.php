<?php

namespace App\Http\Controllers\Email;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }
    public static function sendMail($data)

    {

        $data['title'] = "Welcome to Tin Tức 24h";
        $result = Mail::send('admin.emails.welcomemail', $data, function($message) use ($data){

            $message->to($data['email'])

                ->subject('[sf-cms]');

        });
    }
}
