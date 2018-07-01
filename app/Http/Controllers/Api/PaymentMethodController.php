<?php

namespace App\Http\Controllers\Api;

use App\Models\Sales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    public function all()
    {
        return response()->json(Sales::$paymentMethods);
    }
}
