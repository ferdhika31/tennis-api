<?php

namespace App\Http\Controllers\V1;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Container;
use App\Models\ContainerBall;

class UserController extends Controller {

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|unique:users',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return $this->returnData(['errors' =>  $validator->errors()], "Validation errors.", 422);
            }

            $req = $request->only(['username', 'name', 'email']);
            $req['email_verified_at'] = Carbon::now();
            $req['password'] = Hash::make($request->password);

            $user = User::create($req);

            return $this->returnData($user, "Register successfully.");
        } catch (\Throwable $t) {
            return $this->returnError($t);
        }
    }

    /**
     * @return JsonResponse
     */
    public function me(){
        $user = Auth::user();

        $containerFull = Container::getFullContainer()
            ->where('user_id', $user->id)
            ->get();

        $user['ready_to_play'] = !$containerFull->isEmpty();

        return $this->returnData($user, "Data retrieved.", 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse|Response|ResponseFactory
     */
    public function putBall(Request $request){
        try {
            // user info
            $user = Auth::user();

            // check containers if capacity is full
            $containerFull = Container::getFullContainer()
                ->where('user_id', $user->id)
                ->get();

            if(!$containerFull->isEmpty()){
                return $this->returnStatus(false, "Some container were full of balls. Ready to play :)");
            }

            // pick random container
            $container = Container::where('user_id', $user->id)->inRandomOrder()->first();

            // if player dont have container
            if(empty($container)){
                return $this->returnStatus(false, "Container not found.", 404);
            }

            // send ball to container
            $containerBall = new ContainerBall(['qty'=>1]);
            // select container
            $containerBall->container()->associate($container);
            // send ball
            $containerBall->save();

            return $this->returnStatus(true, "Put ball to container {$container->name} successfully.");
        } catch (\Throwable $t) {
            return $this->returnError($t);
        }
    }

    public function readyToPlay(){
        $user = Auth::user();

        $containerFull = !Container::getFullContainer()
            ->where('user_id', $user->id)
            ->get()->isEmpty();

        $message = $containerFull ? "Ready to play!" : "Not ready yet!";

        return $this->returnStatus($containerFull, $message, 200);
    }

    /**
     * @param Request $request
     * @return Response|ResponseFactory
     */
    public function logout(Request $request){
        Auth::logout();
        return $this->returnStatus(true, "Successfully Logout.", 200);
    }
}
