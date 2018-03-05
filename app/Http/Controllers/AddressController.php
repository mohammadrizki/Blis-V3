<?php

namespace App\Http\Controllers;

/*
 * (c) @iLabAfrica
 * BLIS      - a port of the Basic Laboratory Information System (BLIS) to Laravel.
 * Team Lead     - Emmanuel Kweyu.
 * Devs      - Brian Maiyo|Ann Chemutai|Winnie Mbaka|Ken Mutuma.
 * More Devs     - Derrick Rono|Anthony Ereng|Emmanuel Kitsao.
 */

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $address = Address::orderBy('id', 'ASC')->paginate(20);

        return response()->json($address);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'patient_id' => 'required',
            'text' => 'required',
        ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator);
        } else {
            $address = new Address;
            $address->patient_id = $request->input('patient_id');
            $address->text = $request->input('text');
            $address->line = $request->input('line');
            $address->city = $request->input('city');
            $address->district = $request->input('district');
            $address->state = $request->input('state');
            $address->postal_code = $request->input('postal_code');
            $address->country = $request->input('country');
            $address->period = $request->input('period');

            try {
                $address->save();

                return response()->json($address);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::findOrFail($id);

        return response()->json($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  request
     * @param  int  id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'patient_id' => 'required',
            'text' => 'required',

        ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator, 422);
        } else {
            $address = Address::findOrFail($id);
            $address->patient_id = $request->input('patient_id');
            $address->text = $request->input('text');
            $address->line = $request->input('line');
            $address->city = $request->input('city');
            $address->district = $request->input('district');
            $address->state = $request->input('state');
            $address->postal_code = $request->input('postal_code');
            $address->country = $request->input('country');
            $address->period = $request->input('period');

            try {
                $address->save();

                return response()->json($address);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $address = Address::findOrFail($id);
            $address->delete();

            return response()->json($address, 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}