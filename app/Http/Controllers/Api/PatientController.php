<?php

namespace App\Http\Controllers\Api;

use App\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PatientRequest;
use App\Http\Requests\Api\TreatmentRequest;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PatientsResource;
use App\Patient;

class PatientController extends Controller
{

    /**
     *
     * @SWG\Get(
     *      tags={"patients"},
     *      path="/patients",
     *      summary="get all patients paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $auth_user = auth()->user();
        $rows =$auth_user->patients()->paginate($this->api_paginate_num);
        return PatientsResource::collection($rows);
    }

    /**
     *
     * @SWG\post(
     *      tags={"patients"},
     *      path="/patients",
     *      summary="add new patient",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
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
     *         name="hospital_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="doctor_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param PatientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PatientRequest $request)
    {
        $inputs = $request->all();
//        return response()->json($inputs);
        $auth_user = auth()->user();
        $hospital = Hospital::find($request->hospital_id);
        $hospital_owner = $hospital->user;
        if ($hospital_owner->id == $auth_user->id)
        {
            $inputs['status'] = 'confirmed';
            $patient =$auth_user->patients()->create($inputs);
        }else
        {
            $inputs['status'] = 'no update';
            $patient =$hospital_owner->patients()->create($inputs);
            $patient->referrals()->create(['from_user'=>$auth_user->id,'to_user'=>$hospital_owner->id]);
        }
        if ($patient)
        {
            $patient->histories()->create(['user_id'=>$auth_user->id,'status'=>$patient->status]);
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }


    /**
     *
     * @SWG\Get(
     *      tags={"patients"},
     *      path="/patients/{patient}",
     *      summary="get single patient",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="patient",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Patient $patient
     * @return PatientResource
     */
    public function show(Patient $patient)
    {
        return PatientResource::make($patient);
    }

    /**
     *
     * @SWG\post(
     *      tags={"patients"},
     *      path="/patients/{patient}/treatments",
     *      summary="add new treatments",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="patient",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="type_medication",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         description="uptravi , opsumit",
     *      ),@SWG\Parameter(
     *         name="etiology",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="other_medication",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Patient $patient
     * @param PatientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTreatments(Patient $patient,TreatmentRequest $request)
    {
        $treatment = $patient->treatments()->create($request->all());
        if ($treatment)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }
}
