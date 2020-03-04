<?php

namespace App\Http\Controllers\Api;

use App\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\HospitalRequest;
use App\Http\Resources\HospitalResource;

class HospitalController extends Controller
{

    /**
     *
     * @SWG\Get(
     *      tags={"hospitals"},
     *      path="/hospitals",
     *      summary="get all hospitals paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $rows = Hospital::with('doctors')->paginate(20);
        return HospitalResource::collection($rows);
    }


    /**
     *
     * @SWG\post(
     *      tags={"hospitals"},
     *      path="/hospitals",
     *      summary="add new hospital",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="type",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="rheuma",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="crdio",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="pulmo",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="pah_expert	",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="rhc",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="rwe",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="echo",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="pah_attentive",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="city_id",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="country_id",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param HospitalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HospitalRequest $request)
    {
        $hospital = Hospital::create($request->all());
        if ($hospital)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }


    /**
     *
     * @SWG\Get(
     *      tags={"hospitals"},
     *      path="/hospitals/{hospital}",
     *      summary="get single hospitals",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="poll",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function show(Hospital $hospital)
    {
        return HospitalResource::make($hospital);
    }





    public function update(HospitalRequest $request, Hospital $hospital)
    {
        $hospital->update($request->all());
        return $this->responseJson('Send Successfully',200);
    }


    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return $this->responseJson('Send Successfully',200);
    }
}
