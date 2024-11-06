<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\AdminService;
use App\Services\CustomerService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAuthRequest;

class AuthController extends Controller
{
    public function __construct(
        protected AdminService $adminService,
        protected UserService $userService,
        protected CustomerService $customerService
    )
    {
       // $this->middleware('auth:sanctum')->except(['register', 'login']);
    }
    

    public function register(StoreAuthRequest $request)
    {
        DB::beginTransaction();
        try {
            $user        = $this->userService->createUser($request);
            $tipo_usuario = $request['type'];

            IF ($tipo_usuario == 'superAdmin') {
                $user->assignRole('superAdmin');
                $admin    = $this->adminService->createAdmin($user);
                $customer = $this->customerService->createCustomer($user);
            } 

            IF ($tipo_usuario == 'admin') {
                $user->assignRole('admin');
                $admin = $this->adminService->createAdmin($user);
            } 
            
            IF ($tipo_usuario == 'customer') {
                $user->assignRole('customer');
                $customer = $this->customerService->createCustomer($user);
            }

            DB::commit();
            return response()->json([
                'message' => 'Usuario creado',
                'token' => $user->createToken('API Token')->plainTextToken,
                'user' => $user
            ], 
            201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear usuario',
                'error' => $th->getMessage()
            ], 500);
        }
       
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return response()->json([
                'message' => 'Usuario autenticado',
                'token' => $user->createToken('API Token')->plainTextToken,
                'user' => $user
            ], 200);
        }
    
        return response()->json(['message' => 'Invalid credentials'], 401);
    }


    public function logout(Request $request)
    {
        try {
            if ($request->user()) {

                $request->user()->currentAccessToken()->delete();
                return response()->json(['message' => 'Usuario deslogueado'], 200);
            }
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al desloguear usuario',
                'error' => $th->getMessage()
            ], 500);
        }
    }

/*
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function refresh(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(['token' => $user->createToken('API Token')->plainTextToken], 200);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password,
        ]);

        return response()->json($user);
    }

    public function delete(Request $request)
    {
        $request->user()->delete();
        return response()->json(['message' => 'User deleted'], 200);
    }*/
}
