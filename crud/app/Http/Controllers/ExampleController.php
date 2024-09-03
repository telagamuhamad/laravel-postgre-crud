<?php

namespace App\Http\Controllers;

use App\Services\KafkaProducer;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    protected $producer;

    public function __construct(KafkaProducer $producer)
    {
        $this->producer = $producer;
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $this->producer->send($message);

        return response()->json(['status' => 'Message sent']);
    }
}
