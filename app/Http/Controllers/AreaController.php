<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AreaController extends Controller
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
                $rows = Area::count();
            }
            // Get the table columns
            $areaAllColumns = Schema::getColumnListing((new Area())->getTable());
            $cityAllColumns = Schema::getColumnListing((new City())->getTable());

            $areas = Area::with('city')
                ->when(isset($keyword), function ($query) use ($keyword, $areaAllColumns, $cityAllColumns) {
                    /* Searching in Area table */
                    $query->where(function ($query) use ($keyword, $areaAllColumns) {
                        // Dynamically construct the search query
                        foreach ($areaAllColumns as $column) {
                            $query->orWhere($column, 'LIKE', "%$keyword%");
                        }
                    });
                    /* Searching in City table */
                    $query->orWhereHas('city', function ($query) use ($keyword, $cityAllColumns) {
                        $query->where(function ($query) use ($keyword, $cityAllColumns) {
                            foreach ($cityAllColumns as $column) {
                                $query->orWhere($column, 'LIKE', "%$keyword%");
                            }
                        });
                    });
                })
                ->latest()
                ->paginate($rows);

            $cities = City::whereStatus(true)->get();
            return view('admin.area.area', compact('areas', 'cities', 'keyword', 'rows'));
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
                'area_name' => 'required',
                'pincode' => 'required |max:6|min:6',
                'city_id' => 'required'
            ]);

            Area::create($request->post());

            return redirect()->route('area.index')->with('success', 'Successfully Data Stored !!');
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->back()->withErrors($e->validator->errors())->with('error', 'Some Error Occured Please Try Again !!')->withInput();
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $area = Area::findOrFail($id);
            return response()->json($area);
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'pincode' => 'max:6|min:6',
            ]);

            $area = Area::findOrFail($id);
            $area->update($request->all());

            return redirect()->route('area.index')->with('success', 'Successfully Data Updated !!');
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->back()->withErrors($e->validator->errors())->with('error', 'Some Error Occured Please Try Again !!')->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}
