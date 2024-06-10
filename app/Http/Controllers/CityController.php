<?php

namespace App\Http\Controllers;

use App\Models\City;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CityController extends Controller
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
                $rows = City::count();
            }

            // Get the table columns
            $cityAllColumns = Schema::getColumnListing((new City())->getTable());

            $cities = City::when(isset($keyword), function ($query) use ($keyword, $cityAllColumns) {
                $query->where(function ($query) use ($keyword, $cityAllColumns) {
                    // Dynamically construct the search query
                    foreach ($cityAllColumns as $column) {
                        $query->orwhere($column, 'LIKE', "%$keyword%");
                    }
                });
            })
                ->latest()
                ->paginate($rows);

            return view('admin.city.city', compact('cities', 'keyword', 'rows'));
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
                'city_name' => 'required',
                'state_name' => 'required',
            ]);

            City::create($request->post());

            return redirect()->route('city.index')->with('success', 'Successfully Data Stored !!');
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->back()->withErrors($e->validator->errors())->with('error', 'Some Error Occured Please Try Again !!')->withInput();
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $city = City::findOrFail($id);
            return response()->json($city);
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $city = City::findOrFail($id);
            $city->update($request->all());

            return redirect()->route('city.index')->with('success', 'Successfully Data Updated !!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
