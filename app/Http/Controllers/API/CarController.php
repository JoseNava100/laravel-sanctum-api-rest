<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function index() {

        $cars = Car::all();

        if ($cars->isEmpty()) {
            
            $message = [
                'message' => 'Do not have cars',
                'status' => 400,
            ];

            return response()->json($message, 400);

        } else {

            $message = [
                'message' => 'All cars',
                'data' => $cars,
                'status' => 200,
            ];
            
            return response()->json($message, 200);
        }

    }

    public function store(Request $request) {
        
        $validation = Validator::make($request->all(), [
            'brand' => 'required|string|max:30',
            'model' => 'required|string|max:60',
            'year' => 'required|string|max:30',
            'color' => 'required|string|max:60',
            'plate_number' => 'required|string|max:30',
        ]);

        if ($validation->fails()) {
            
            $message = [
                'message' => 'Error in data validation',
                'error' => $validation->errors(),
                'status' => 401,
            ];

            return response()->json($message, 401);

        } else {
            
            if (Car::where('brand', $request->brand)->exists() && 
                Car::where('model', $request->model)->exists() &&
                Car::where('year', $request->year)->exists() &&
                Car::where('color', $request->color)->exists() &&
                Car::where('plate_number', $request->plate_number)->exists()) {
                
                $message = [
                    'message' => 'The car already exists, please enter a new one',
                    'status' => 402,
                ];

                return response()->json($message, 402);

            } else {
                
                $cars = Car::create($request->only([
                    'brand',
                    'model',
                    'year',
                    'color',
                    'plate_number',
                ]));
    
                if (!$cars) {
                    
                    $message = [
                        'message' => 'Error creating car',
                        'status' => 403,
                    ];
    
                    return response()->json($message, 403);
    
                } else {

                    $message = [
                        'message' => 'Car created',
                        'data' => $cars,
                        'status' => 201,
                    ];
    
                    return response()->json($message, 201);
    
                }
            }
        }
    }

    public function show(string $id)
    {
        $cars = Car::find($id);

        if (!$cars) {
            
            $message = [
                'message' => 'Car not found',
                'status' => 404,
            ];

            return response()->json($message, 404);

        } else {

            $message = [
                'message' => 'Car found',
                'data' => $cars,
                'status' => 404,
            ];
            
            return response()->json($message, 200);

        }
    }

    public function update(Request $request, string $id)
    {
        $cars = Car::find($id);

        if (!$cars) {
            
            $message = [
                'message' => 'Car not found',
                'status' => 405,
            ];

            return response()->json($message, 405);

        } else {

            $validation = Validator::make($request->all(), [
                'brand' => 'string|max:30',
                'model' => 'string|max:60',
                'year' => 'string|max:30',
                'color' => 'string|max:60',
                'plate_number' => 'string|max:30',
            ]);

            if ($validation->fails()) {
                
                $message = [
                    'message' => 'Error in data validations',
                    'errors' => $validation->errors(),
                    'status' => 406,
                ];

                return response()->json($message, 406);

            } else {

                if (Car::where('brand', $request->brand)->exists() && 
                    Car::where('model', $request->model)->exists() &&
                    Car::where('year', $request->year)->exists() &&
                    Car::where('color', $request->color)->exists() &&
                    Car::where('plate_number', $request->plate_number)->exists()) {
                    
                    $message = [
                        'message' => 'The dates already exists, please enter a new one',
                        'status' => 407,
                    ];
    
                    return response()->json($message, 407);
    
                } else {
                    
                    $cars->fill($request->only([
                        'brand', 
                        'model', 
                        'year', 
                        'color', 
                        'plate_number',
                    ]))->save();
    
                    $message = [
                        'message' => 'Update car',
                        'character' => $cars,
                        'status' => 200
                    ];
    
                    return response()->json($message, 200);

                }
            }
        }
    }

    public function destroy(string $id)
    {
        $cars = Car::find($id);

        if (!$cars) {
            
            $message = [
                'message' => 'Car not found',
                'status' => 408
            ];

            return response()->json($message, 408);

        } else {
            
            $cars->delete();

            $message = [
                'message' => 'Delete car',
                'status' => 200
            ];

            return response()->json($message, 200);
        }
    }
}
