<?php


namespace App\Http\Traits;


trait ApiResponseTrait
{

    /**
     * [
     * code    => default 200 and dataType is int.
     * message => default null and dataType is String.
     * errors  => default null and dataType is Array.
     * data    => default null and dataType is Array.
     * ]
     *
     *
     *  if($validation->fails())
     *   {
     *      return $this->apiResponse(400,'Not Found',$validation->fails());
     *   }
     *
     *     return $this->apiResponse(200,'Account Was Created');
     *     return $this->apiResponse(400,'Not Found');
     */



    # To Use This apiResponse function

    # 1- call namespace -- use App\Http\Traits\ApiResponseTrait; --
    # 2- call -- use ApiResponseTrait; --



    # One Object
    # return $this->sendResponse(new Resource(Model::latest()->paginate($request->per_page ?? 10)), customModel:Model::get()->count());

    # All Objects
    # return $this->sendResponse(Resource::collection(Model::latest()->paginate($request->per_page ?? 10)->items()), customModel:Model::get()->count());



    public  function apiResponse($code = 200 , $message = null , $errors = null , $data = null)
    {


        $array = [
            'endpointName' => app('request')->route()->getName(),
            'status'  => $code,
            'message' => $message,
            "current_page" => (int)request()->page ?? 1,
        ];

        if(is_null($data) && !is_null($errors))
        {
            $array['errors'] = $code;
        }
        elseif (!is_null($data) && is_null($errors))
        {
            $array['data'] = $data;
        }
        else
        {
            $array['data'] = $data;
            $array['errors'] = $code;
        }



        return response($array , 200);
    }


    public function sendResponse($result = [], $message = 'Success.', $is_success = true, $status_code = 200, $customModel = false)
    {

        $result_key = $is_success ? 'data' : 'errors';

        $response = [
            'endpointName' => app('request')->route()->uri(),
            'is_success' => $is_success,
            'status_code' => $status_code,
            'message' => $message,
            "current_page" => (int)request()->page ?? 1,
            "total" => $customModel > 0 ? $customModel : (isset($this->model) ? $this->model->count() : 0),
            "per_page" => request()->per_page ? (int) request()->per_page : 10,
            "pages" => 0,

            $result_key => $result,
        ];

        $response["pages"] = ceil($response["total"] / $response["per_page"]);

        // for paginated data
        if (isset($result['data']) && isset($result['links']) && isset($result['meta'])) {
            $response['data'] = $result['data'];
            $response['links'] = $result['links'];
            $response['meta'] = $result['meta'];
        }

        return response()->json($response, $status_code);
    }


    public function sendResponseImage($result = [], $message = 'Success.', $is_success = true, $status_code = 200, $customModel = false)
    {

        $result_key = $is_success ? 'data' : 'errors';

        $response = [
            'endpointName' => app('request')->route()->uri(),
            'is_success' => $is_success,
            'status_code' => $status_code,
            'message' => $message,
            "current_page" => 1,
            "total" => 1,
            "per_page" => 1,
            "pages" => 0,

            $result_key => $result,
        ];

        $response["pages"] = ceil($response["total"] / $response["per_page"]);

        // for paginated data
        if (isset($result['data']) && isset($result['links']) && isset($result['meta'])) {
            $response['data'] = $result['data'];
            $response['links'] = $result['links'];
            $response['meta'] = $result['meta'];
        }

        return response()->json($response, $status_code);
    }



}
