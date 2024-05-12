<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoansController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Loan::all()
        ]);
    }

    public function show(string $id)
    {
        try {
            $model = Loan::findOrFail($id);

            return response()->json([
                'data' => $model
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => "Model with ID {$id} not found"
            ], 404);
        }
    }
}
