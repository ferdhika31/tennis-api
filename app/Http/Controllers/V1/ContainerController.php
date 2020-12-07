<?php
/**
 * ContainerController.php
 *
 * @package App\Http\Controllers\V1
 * @author  Ferdhika Yudira
 * @email   fer@dika.web.id
 */

namespace App\Http\Controllers\V1;

use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Container;

class ContainerController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request){
        // get user info
        $user = Auth::user();

        // get containers user
        $data = Container::search($request)->where('user_id', $user->id)->get();

        return $this->returnData($data, "Data retrieved.");
    }

    /**
     * @param Request $request
     * @return JsonResponse|Response|ResponseFactory
     */
    public function store(Request $request)
    {
        // get user info
        $user = Auth::user();

        // validation input
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'max_balls' => 'required|integer',
        ]);

        // check if fail
        if ($validator->fails()) {
            return $this->returnStatus(false, $validator->errors(), 422);
        }

        try {
            // create container
            $container = new Container($request->only(['name', 'max_balls']));
            // foreign to user
            $container->user()->associate($user);
            // save container
            $container->save();

            return $this->returnData($container, "Container created.", 201);
        } catch (\Throwable $th) {
            return $this->returnError($th);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse|Response|ResponseFactory
     */
    public function update(Request $request, $id)
    {
        // validation input
        $validator = Validator::make($request->all(),[
            'max_balls' => 'required|integer',
        ]);

        // check if fail
        if ($validator->fails()) {
            return $this->returnStatus(false, $validator->errors(), 422);
        }

        try {
            // update container
            $container = Container::findOrFail($id)->update($request->only(['name', 'max_balls']));

            return $this->returnData($container, "Container updated.", 200);
        } catch (\Throwable $th) {
            return $this->returnError($th);
        }
    }
}
