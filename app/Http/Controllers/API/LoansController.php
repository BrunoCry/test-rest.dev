<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'summ' => 'required|int',
            'client_id' => 'required|int'
        ]);

        $model = Loan::create($validated);

        return response()->json([
            'data' => $model
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        try {
            $model = Loan::findOrFail($id);

            $data = $this->validate($request, [
                'name' => 'string',
                'summ' => 'int',
                'client_id' => 'int'
            ]);

            $model->fill($data)->save();

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

    public function delete(string $id)
    {
        try {
            $model = Loan::findOrFail($id);
            $model->delete();

            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => "Model with ID {$id} not found"
            ], 404);
        }
    }
}
