<?php

namespace App\Http\Controllers\Api;

use App\Activity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ActivityRequest;
use App\Http\Resources\ActivityResource;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     *
     * @SWG\Get(
     *      tags={"activities"},
     *      path="/activities",
     *      summary="get all activities paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $rows = Activity::with('city','user','speakers')->paginate($this->api_paginate_num);
        return ActivityResource::collection($rows);
    }


    /**
     *
     * @SWG\post(
     *      tags={"activities"},
     *      path="/activities",
     *      summary="add new activity",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="type",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         description=" 1=> MedicalEducation , 2=> MarketAccess , 3=> Commercial",
     *      ),@SWG\Parameter(
     *         name="subtype",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="date",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="no_attendees",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="city_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param ActivityRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ActivityRequest $request)
    {
        $auth_user = auth()->user();
        $activity = $auth_user->activities()->create($request->all());
        if ($activity)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }


    /**
     *
     * @SWG\Get(
     *      tags={"activities"},
     *      path="/activities/{activity}",
     *      summary="get single activity",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="activity",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Activity $activity
     * @return ActivityResource
     */
    public function show(Activity $activity)
    {
        return ActivityResource::make($activity);
    }


    /**
     *
     * @SWG\Put(
     *      tags={"activities"},
     *      path="/activities/{activity}",
     *      summary="update activity",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="activity",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="type",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         description=" 1=> MedicalEducation , 2=> MarketAccess , 3=> Commercial",
     *      ),@SWG\Parameter(
     *         name="subtype",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="date",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="no_attendees",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="city_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param ActivityRequest $request
     * @param Activity $activity
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ActivityRequest $request, Activity $activity)
    {
        $activity->update($request->all());
        return $this->responseJson('updated Successfully',200);
    }

    /**
     *
     * @SWG\Delete(
     *      tags={"activities"},
     *      path="/activities/{activity}",
     *      summary="Delete activity",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="activity",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Activity $activity
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return $this->responseJson('Delete Successfully',200);
    }
}
