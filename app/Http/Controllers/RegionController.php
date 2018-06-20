<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
        return response()->json($regions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->only('regionInputNom');

        $validate = Region::getValidation($inputs);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        DB::beginTransaction();
        try {
            Junior::saveOne($inputs);
            DB::commit();
            Message::success('region.saved');
            return redirect('region');
        } catch (\Exception $e) {
            DB::rollback();
            Message::error('bd.error', ['error' => $e->getMessage()]);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Region::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->only('regionInputNom');

        $region = Regions::find($id);

        $region->nom = $inputs['regionInputNom'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete();
    }
}
