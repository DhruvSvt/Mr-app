<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Chemist;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ChemistController extends Controller
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
                $rows = Chemist::count();
            }
            // Get the table columns
            $chemistAllColumns = Schema::getColumnListing((new Chemist())->getTable());
            $areaAllColumns = Schema::getColumnListing((new Area())->getTable());
            $specialityAllColumns = Schema::getColumnListing((new Speciality())->getTable());

            $chemists = Chemist::with('speciality', 'area')
                ->when(isset($keyword), function ($query) use ($keyword, $chemistAllColumns, $areaAllColumns, $specialityAllColumns) {
                    /* Searching in Chemist table */
                    $query->where(function ($query) use ($keyword, $chemistAllColumns) {
                        // Dynamically construct the search query
                        foreach ($chemistAllColumns as $column) {
                            $query->orWhere($column, 'LIKE', "%$keyword%");
                        }
                    });
                    /* Searching in Speciality table */
                    $query->orWhereHas('speciality', function ($query) use ($keyword, $specialityAllColumns) {
                        $query->where(function ($query) use ($keyword, $specialityAllColumns) {
                            foreach ($specialityAllColumns as $column) {
                                $query->orWhere($column, 'LIKE', "%$keyword%");
                            }
                        });
                    });
                    /* Searching in Area table */
                    $query->orWhereHas('area', function ($query) use ($keyword, $areaAllColumns) {
                        $query->where(function ($query) use ($keyword, $areaAllColumns) {
                            foreach ($areaAllColumns as $column) {
                                $query->orWhere($column, 'LIKE', "%$keyword%");
                            }
                        });
                    });
                })
                ->latest()
                ->paginate($rows);

            return view('admin.chemist.chemist', compact('chemists', 'keyword', 'rows'));
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
        try {
            $specialities = Speciality::whereStatus(true)->get();
            $areas = Area::whereStatus(true)->get();
            return view('admin.chemist.create', compact('specialities', 'areas'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
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
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'speciality_id' => 'required|integer',
                'area_id' => 'required|integer',
                'contact_person' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'longitude.*' => 'required',
                'latitude.*' => 'required',
                'title.*' => 'required|string|max:255',
                'addresses.*' => 'required|string|max:255',
                'phn_no.*' => 'required|string|max:15',
            ]);

            // Handle the image upload if there is one
            if ($request->hasFile('image')) {
                $destinationPath = 'public/images/chemists';
                $imageName = time() . '.' . $request->image->extension();
                $request->image->storeAs($destinationPath, $imageName);
                $validatedData['image'] = $imageName;
            }

            // Save the chemist information
            Chemist::create($validatedData);

            return redirect()->route('chemist.index')->with('success', 'Chemist added successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->with('error', 'Validation error occurred. Please try again!')->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chemist  $chemist
     * @return \Illuminate\Http\Response
     */
    public function show(Chemist $chemist)
    {
        try {
            $chemist = Chemist::findOrFail($chemist->id);
            return view('admin.chemist.detail', compact('chemist'));
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chemist  $chemist
     * @return \Illuminate\Http\Response
     */
    public function edit(Chemist $chemist)
    {
        try {
            $chemist = Chemist::findOrFail($chemist->id);
            $specialities = Speciality::whereStatus(true)->get();
            $areas = Area::whereStatus(true)->get();
            return view('admin.chemist.edit', compact('chemist', 'specialities', 'areas'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request please try again later !!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chemist  $chemist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chemist $chemist)
    {
        try {
            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'speciality_id' => 'required',
                'area_id' => 'required',
                'contact_person' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'longitude.*' => 'required',
                'latitude.*' => 'required',
                'title.*' => 'required|string|max:255',
                'addresses.*' => 'required|string|max:255',
                'phn_no.*' => 'required|string|max:15',
            ]);

            // Handle the image updation
            if ($request->hasFile('image')) {
                $destinationPath = 'public/images/chemists/';
                $existingImagePath = $destinationPath . $chemist->image;

                if (Storage::exists($existingImagePath)) {
                    Storage::delete($existingImagePath);
                }

                $imageName = time() . '.' . $request->image->extension();
                $request->image->storeAs($destinationPath, $imageName);
                $chemist->image = $imageName;
            }

            // Update the chemist information
            $chemist->name = $request->name;
            $chemist->email = $request->email;
            $chemist->speciality_id = $request->speciality_id;
            $chemist->area_id = $request->area_id;
            $chemist->contact_person = $request->contact_person;
            $chemist->phn_no = $request->phn_no;
            $chemist->longitude = $request->longitude;
            $chemist->latitude = $request->latitude;
            $chemist->title = $request->title;
            $chemist->addresses = $request->addresses;

            $chemist->save();

            return redirect()->route('chemist.index')->with('success', 'Chemist updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->with('error', 'Validation Error occurred. Please try again!')->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chemist  $chemist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chemist $chemist)
    {
        //
    }
}
