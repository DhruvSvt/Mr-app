<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function statusUpdate(Request $request)
    {
        try {
            $modelName = "App\Models\\" . $request->model;

            $model = app($modelName)->findOrFail($request->var_id);
            $model->status = $request->status;
            $model->save();

            $message = $request->status == 1 ? 'Successfully Status ON !!' : 'Successfully Status OFF !!';
            $status = $request->status == 1 ? 'on' : 'off';

            return response()->json(['message' => $message, 'status' => $status]);
        } catch (\Exception $e) {
            // \Log::error('Error occurred while updating status: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred while updating city status. Please try again later.'], 500);
        }
    }
}
