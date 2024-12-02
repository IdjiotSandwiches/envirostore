<?php

namespace App\Http\Controllers;

use App\Interfaces\SessionKeyInterface;
use App\Models\User;
use App\Models\Admin;
use App\Models\ErrorLog;
use App\Providers\RouteServiceProvider;
use App\Services\Login\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Interfaces\StatusInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller implements StatusInterface, SessionKeyInterface
{
    /**
     * Return Login View
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Login Attempt
     * @param \App\Http\Requests\LoginRequest $loginRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $loginRequest, LoginService $loginService)
    {
        $validated = $loginRequest->validated();
        try {
            DB::beginTransaction();

            [$user, $isAdmin] = $loginService->login($validated['email'], $validated['password']);
            $sessionData = $loginService->setSessionData($user, $isAdmin);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            $errorLog = new ErrorLog();
            $errorLog->error = $e->getMessage();
            $errorLog->save();

            $response = [
                'status' => self::STATUS_ERROR,
                'message' => $e->getMessage(),
            ];

            return back()->withInput()->with($response);
        }

        session($sessionData->all());
        Auth::guard($sessionData['identity']->auth)->login($user);
        $loginRequest->session()->regenerate();
        $response = [
            'status' => self::STATUS_SUCCESS,
            'message' => 'Logged In.'
        ];

        if ($isAdmin) {
            return to_route('admin.home')->with($response);
        }

        return to_route('home')->with($response);
    }

    /**
     * Logout
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $response = [
            'status' => self::STATUS_SUCCESS,
            'message' => 'Logged Out.'
        ];

        return redirect()->route('home')
            ->with($response);
    }
}
