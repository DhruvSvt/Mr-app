<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            /* Query Parameters */
            $keyword = request()->keyword;
            $rows = request()->rows ?? 25;
            if ($rows == 'all') {
                $rows = Speciality::count();
            }

            // Get the table columns
            $specialityAllColumns = Schema::getColumnListing((new Speciality())->getTable());

            $specialities = Speciality::when(isset($keyword), function ($query) use ($keyword, $specialityAllColumns) {
                $query->where(function ($query) use ($keyword, $specialityAllColumns) {
                    // Dynamically construct the search query
                    foreach ($specialityAllColumns as $column) {
                        $query->orwhere($column, 'LIKE', "%$keyword%");
                    }
                });
            })
                ->latest()
                ->paginate($rows);

            return view('admin.speciality.speciality', compact('specialities','keyword','rows'));
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
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
        try {

            $request->validate([
                'name' => 'required',
                'specialized_in' => 'required',
            ]);

            Speciality::create($request->post());

            return redirect()->route('speciality.index')->with('success', 'Successfully Data Stored !!');
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->back()->withErrors($e->validator->errors())->with('error', 'Some Error Occured Please Try Again !!')->withInput();
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function show(Speciality $speciality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $speciality = Speciality::findOrFail($id);
            return response()->json($speciality);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $speciality = Speciality::findOrFail($id);
            $speciality->update($request->all());

            return redirect()->route('speciality.index')->with('success', 'Successfully Data Updated !!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speciality $speciality)
    {
        //
    }
}
