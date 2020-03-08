<?php

namespace App\Http\Controllers\Api;

use App\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\HospitalRequest;
use App\Http\Resources\HospitalResource;
use App\Http\Resources\HospitalsResource;
use Illuminate\Http\Request;

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
     *      },@SWG\Parameter(
     *         name="type",
     *         in="query",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $rows = Hospital::with('city','country','user');
        if ($request->has('type') and $request->type)
        {
            $rows=$rows->where('type',$request->type);
        }
        $rows= $rows->paginate($this->api_paginate_num);
        return HospitalsResource::collection($rows);
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
     *         description="coe , referal",
     *      ),@SWG\Parameter(
     *         name="rheuma",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="crdio",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="pulmo",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="pah_expert",
     *         in="formData",
     *         type="integer",
     *         description="0 , 1",
     *      ),@SWG\Parameter(
     *         name="rhc",
     *         in="formData",
     *         type="integer",
     *         description="0 , 1",
     *      ),@SWG\Parameter(
     *         name="rwe",
     *         in="formData",
     *         type="integer",
     *         description="0 , 1",
     *      ),@SWG\Parameter(
     *         name="echo",
     *         in="formData",
     *         type="integer",
     *         description="0 , 1",
     *      ),@SWG\Parameter(
     *         name="pah_attentive",
     *         in="formData",
     *         type="integer",
     *         description="0 , 1",
     *      ),@SWG\Parameter(
     *         name="city_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="country_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param HospitalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HospitalRequest $request)
    {
        $auth_user = auth()->user();
        $hospital = $auth_user->hospitals()->create($request->all());
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
     *         name="hospital",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Hospital $hospital
     * @return HospitalResource
     */
    public function show(Hospital $hospital)
    {
        return HospitalResource::make($hospital);
    }


    /**
     *
     * @SWG\Put(
     *      tags={"hospitals"},
     *      path="/hospitals/{hospital}",
     *      summary="update hospital",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="hospital",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
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
     *         description="coe , referal",
     *      ),@SWG\Parameter(
     *         name="rheuma",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="crdio",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="pulmo",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="pah_expert",
     *         in="formData",
     *         type="integer",
     *         description="0 , 1",
     *      ),@SWG\Parameter(
     *         name="rhc",
     *         in="formData",
     *         type="integer",
     *         description="0 , 1",
     *      ),@SWG\Parameter(
     *         name="rwe",
     *         in="formData",
     *         type="integer",
     *         description="0 , 1",
     *      ),@SWG\Parameter(
     *         name="echo",
     *         in="formData",
     *         type="integer",
     *         description="0 , 1",
     *      ),@SWG\Parameter(
     *         name="pah_attentive",
     *         in="formData",
     *         type="integer",
     *         description="0 , 1",
     *      ),@SWG\Parameter(
     *         name="city_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="country_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="_method:put",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param HospitalRequest $request
     * @param Hospital $hospital
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(HospitalRequest $request, Hospital $hospital)
    {
        $hospital->update($request->all());
        return $this->responseJson('updated Successfully',200);
    }

    /**
     *
     * @SWG\Delete(
     *      tags={"hospitals"},
     *      path="/hospitals/{hospital}",
     *      summary="Delete Hospital",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="hospital",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Hospital $hospital
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return $this->responseJson('Delete Successfully',200);
    }
}
