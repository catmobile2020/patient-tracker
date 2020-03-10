<?php

namespace App\Http\Controllers\Api;

use App\Filters\PatientFilter;
use App\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PatientRequest;
use App\Http\Requests\Api\ReferalRequest;
use App\Http\Requests\Api\TreatmentRequest;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PatientsResource;
use App\Patient;
use Illuminate\Http\Request;

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
     *      },@SWG\Parameter(
     *         name="status",
     *         in="query",
     *         type="string",
     *         format="string",
     *        description="no update , confirmed , not ph",
     *      ),@SWG\Parameter(
     *         name="city_id",
     *         in="query",
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="country_id",
     *         in="query",
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="hospital_id",
     *         in="query",
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="doctor_id",
     *         in="query",
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="hospital_type",
     *         in="query",
     *         type="string",
     *         format="string",
     *        description="coe , referal",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param PatientFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(PatientFilter $filter)
    {
        $auth_user = auth()->user();
        $rows =$auth_user->patients()->filter($filter)->paginate($this->api_paginate_num);
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
     *      ),@SWG\Parameter(
     *         name="type_medication",
     *         in="formData",
     *         type="string",
     *         format="string",
     *         description="uptravi , opsumit",
     *      ),@SWG\Parameter(
     *         name="etiology",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="other_medication",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param PatientRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(PatientRequest $request)
    {
        $inputs = $request->all();
        $auth_user = auth()->user();
        $hospital = Hospital::find($request->hospital_id);
        if ($hospital->type != 'coe')
        {
            return $this->responseJson("This Hospital Doesn't Support COE Type.",400);
        }
        $inputs['status'] = 'confirmed';
        $patient =$auth_user->patients()->create($inputs);
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

    /**
     *
     * @SWG\post(
     *      tags={"patients"},
     *      path="/patients/add-referal",
     *      summary="add new refaral patient",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="name",
     *         in="formData",
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
     *      ),@SWG\Parameter(
     *         name="to_hospital",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param ReferalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeReferal(ReferalRequest $request)
    {
        $inputs = $request->all();
        $auth_user = auth()->user();
        $inputs['status'] = 'no update';
        $patient =$auth_user->patients()->create($inputs);

        if ($patient)
        {
            $patient->referrals()->create(['from_hospital'=>$request->hospital_id,'to_hospital'=>$request->to_hospital]);
            $patient->histories()->create(['user_id'=>$auth_user->id,'status'=>$patient->status]);
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }
}
