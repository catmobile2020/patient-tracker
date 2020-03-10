<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TargetRequest;
use App\Http\Resources\TargetResource;
use App\UserTargets;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TargetController extends Controller
{

    /**
     *
     * @SWG\Get(
     *      tags={"targets"},
     *      path="/targets",
     *      summary="get all targets paginated",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="hospital_id",
     *         in="query",
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $auth_user = auth()->user();
        $rows =$auth_user->targets()->with('hospital');
        if ($request->has('hospital_id') and $request->hospital_id)
        {
            $rows=$rows->where('hospital_id',$request->hospital_id);
        }
        $rows= $rows->paginate($this->api_paginate_num);
        return TargetResource::collection($rows);
    }

    /**
     *
     * @SWG\post(
     *      tags={"targets"},
     *      path="/targets",
     *      summary="add add new target",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="number",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="year",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="month",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="hospital_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param TargetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TargetRequest $request)
    {
        $auth_user = auth()->user();
        $target = $auth_user->targets()->create($request->all());
        if ($target)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }

    /**
     *
     * @SWG\Put(
     *      tags={"targets"},
     *      path="/targets/{target}",
     *      summary="update target",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="target",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="number",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="year",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="month",
     *         in="formData",
     *         required=true,
     *         type="integer",
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
     * @param TargetRequest $request
     * @param UserTargets $target
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TargetRequest $request, UserTargets $target)
    {
        $target->update($request->all());
        return $this->responseJson('updated Successfully',200);
    }

    /**
     *
     * @SWG\Delete(
     *      tags={"targets"},
     *      path="/targets/{target}",
     *      summary="Delete target",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="target",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param UserTargets $target
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(UserTargets $target)
    {
        $target->delete();
        return $this->responseJson('Delete Successfully',200);
    }
}
