<?php

namespace App\Http\Controllers;

use App\Recurrence;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class RecurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reccurences = Recurrence::all();
        return response()->json($reccurences);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Récupération des inputs pertinents
        if (!$request->has([
            'recurrenceDisponibiliteID',
            'recurrencetDateDebut',
            'recurrenceDateFin',
            'recurrenceFrequence',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }
        $valuesRecurrence['disponibilite_id'] = $request->recurrenceDisponibiliteID;
        $valuesRecurrence['dateDebut'] = $request->recurrencetDateDebut;
        $valuesRecurrence['dateFin'] = $request->recurrenceDateFin;
        $valuesRecurrence['frequence'] = $request->recurrenceFrequence;

        DB::beginTransaction();
        try {
            $validate = Recurrence::getValidation($valuesRecurrence);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $newRecurrence = Recurrence::saveOne($valuesRecurrence);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $newRecurrence;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Recurrence::find($id));
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
        if (!$request->has([
            'recurrenceDisponibiliteID',
            'recurrencetDateDebut',
            'recurrenceDateFin',
            'recurrenceFrequence',
        ])
        ) {
            return response()->json(['error' => 'empty request'], 400);
        }

        $recurrence = Recurrence::find($id);

        $valuesRecurrence['disponibilite_id'] = $request->recurrenceDisponibiliteID;
        $valuesRecurrence['dateDebut'] = $request->recurrencetDateDebut;
        $valuesRecurrence['dateFin'] = $request->recurrenceDateFin;
        $valuesRecurrence['frequence'] = $request->recurrenceFrequence;

        DB::beginTransaction();
        try {

            $valuesRecurrence['update'] = 1;
            $validate = Recurrence::getValidation($valuesRecurrence);
            if ($validate->fails()) {
                return $validate->errors();
            }

            $recurrence->update($valuesRecurrence);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error',$e->getMessage()]);
        }
        return $recurrence;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recurrence = Recurrence::find($id);
        $recurrence->delete();

        return $recurrence;
    }
}
