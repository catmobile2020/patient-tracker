<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountriesResource;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     *
     * @SWG\Get(
     *      tags={"countries"},
     *      path="/countries",
     *      summary="get all countries paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $rows = Country::with('cities')->paginate($this->api_paginate_num);
        return CountriesResource::collection($rows);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"countries"},
     *      path="/countries/{country}",
     *      summary="single country",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="country",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Country $country
     * @return CountryResource
     */
    public function singleCountry(Country $country)
    {
        return CountryResource::make($country);
    }
}
