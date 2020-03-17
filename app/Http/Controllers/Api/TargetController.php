<?php

namespace App\Http\Controllers\Api;

use App\Filters\TargetFilter;
use App\Hospital;
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
     *      path="/hospitals/{hospital}/targets",
     *      summary="get hospital targets paginated",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="hospital",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="product",
     *         in="query",
     *         type="string",
     *         format="string",
     *         description="opsumit, uptravi ,tracleer",
     *      ),@SWG\Parameter(
     *         name="year",
     *         in="query",
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="month",
     *         in="query",
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Hospital $hospital
     * @param TargetFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Hospital $hospital,TargetFilter $filter)
    {
        $auth_user = auth()->user();
        $rows =$hospital->targets()->where('user_id',$auth_user->id)->filter($filter)->with('hospital')->paginate($this->api_paginate_num);
        return TargetResource::collection($rows);
    }

    /**
     *
     * @SWG\post(
     *      tags={"targets"},
     *      path="/hospitals/{hospital}/targets",
     *      summary="add add new target",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="hospital",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="product",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         description="opsumit, uptravi ,tracleer",
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
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Hospital $hospital
     * @param TargetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Hospital $hospital,TargetRequest $request)
    {
        $auth_user = auth()->user();
        $inputs = $request->all();
        $inputs['user_id'] = $auth_user->id;
        if ($hospital->targets()->where('product',$request->product)->where('year',$request->year)->where('month',$request->month)->first())
        {
            return $this->responseJson('Error, You insert Target of this Month Before!',400);
        }
        $target = $hospital->targets()->create($inputs);
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
     *      path="/hospitals/{hospital}/targets/{target}",
     *      summary="update target",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="hospital",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="target",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="product",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         description="opsumit, uptravi ,tracleer",
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
     *         name="_method:put",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Hospital $hospital
     * @param TargetRequest $request
     * @param UserTargets $target
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Hospital $hospital,TargetRequest $request, UserTargets $target)
    {
        $target->update($request->all());
        return $this->responseJson('updated Successfully',200);
    }

    /**
     *
     * @SWG\Delete(
     *      tags={"targets"},
     *      path="/hospitals/{hospital}/targets/{target}",
     *      summary="Delete target",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="hospital",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="target",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Hospital $hospital
     * @param UserTargets $target
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Hospital $hospital,UserTargets $target)
    {
        $target->delete();
        return $this->responseJson('Delete Successfully',200);
    }
}
