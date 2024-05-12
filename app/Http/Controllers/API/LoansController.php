<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Loan;

class LoansController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Loan::all()
        ]);
    }
}
