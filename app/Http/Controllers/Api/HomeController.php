<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Patient;
use App\PatientReferrals;

class HomeController extends Controller
{

    /**
     *
     * @SWG\Get(
     *      tags={"targets-details"},
     *      path="/refreral/targets-details",
     *      summary="get my refreral targets-details",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function refreralTargetsDetails()
    {
        $auth_user = auth()->user();
        $referals = $auth_user->patients()->has('referrals');
        $no_update = clone $referals;
        $not_ph = clone $referals;
        $confirmed = clone $referals;
        $status = [
            'all'=>$referals->count(),
            'no_update'=>$no_update->where('status','no update')->count(),
            'not_ph'=>$not_ph->where('status','not ph')->count(),
            'confirmed'=>$confirmed->where('status','confirmed')->count(),
        ];
        return response()->json($status);
    }
}
