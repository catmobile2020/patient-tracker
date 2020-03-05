<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DoctorRequest;
use App\Http\Resources\DoctorResource;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    /**
     *
     * @SWG\post(
     *      tags={"doctors"},
     *      path="/doctors",
     *      summary="add new doctor",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="speciality",
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
     *         description="Expert Speaker ,Raising Start",
     *      ),@SWG\Parameter(
     *         name="hospital_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param DoctorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DoctorRequest $request)
    {
        $doctor = Doctor::create($request->all());
        if ($doctor)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }


    /**
     *
     * @SWG\Get(
     *      tags={"doctors"},
     *      path="/doctors/{doctor}",
     *      summary="get single doctor",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="doctor",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Doctor $doctor
     * @return DoctorResource
     */
    public function show(Doctor $doctor)
    {
        return DoctorResource::make($doctor);
    }


    /**
     *
     * @SWG\Put(
     *      tags={"doctors"},
     *      path="/doctors/{doctor}",
     *      summary="update doctor",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="doctor",
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
     *         name="speciality",
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
     *         description="Expert Speaker , Raising Start",
     *      ),@SWG\Parameter(
     *         name="hospital_id",
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
     * @param DoctorRequest $request
     * @param Doctor $doctor
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->all());
        return $this->responseJson('updated Successfully',200);
    }

    /**
     *
     * @SWG\Delete(
     *      tags={"doctors"},
     *      path="/doctors/{doctor}",
     *      summary="Delete doctor",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="doctor",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Doctor $doctor
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return $this->responseJson('Delete Successfully',200);
    }
}
