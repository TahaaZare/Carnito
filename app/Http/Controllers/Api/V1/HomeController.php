<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\keys;
use Illuminate\Http\Request;
use Modules\Content\Entities\Projcet\Project;

/**
 * @OA\Get(
 ** path="/api/v1/show-projects",
 *  tags={"Projects"},
 *  description="Students Data",
 *   @OA\Response(
 *      response=200,
 *      description="Its Ok",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   )
 *)
 **/
class HomeController extends Controller
{
    public function projects()
    {
        return response()->json([
            'result' => true,
            'message' => 'all projects',
            'data' => [
                keys::projects => Project::getProjects(),
            ]
        ], 200);
    }
}
