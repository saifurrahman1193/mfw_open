<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Offer;


use DB;


class OfferController extends Controller
{

    public function offerManagement()
    {
        $offerData = DB::table('offer')->get();

        return view('frontend.offerManagement', compact('offerData'));
    }

    public function offerUpdate(Request $request)
    {
        Offer::find($request->offerId)->update($request->all()); 
        return back()->with('successMsg', 'Offer successfully updated!');
    }

}
