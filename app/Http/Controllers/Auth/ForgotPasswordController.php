<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetEmail;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::whereEmail($request->email)->first();
        $token = $this->broker()->getRepository()->create($user);

        Mail::to($user->email, $user->full_name)->send(new ResetEmail($token));

        alert('Te hemos enviado por correo el enlace para restablecer tu contraseña.');

        if ($request->ajax()) {
            return response('', 204, [
                'Redirect-To' => url('contrasena')
            ]);
        }

        return redirect('contrasena');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|exists:users,' . $this->username() . ',is_active,1',

        ], [
            'email.email' => 'El correo electrónico es inválido.',
            'email.exists' => 'El correo electrónico no está registrado.',
            $this->username() . '.exists' => 'El correo electrónico no está registrado o la cuenta ha sido desactivada.'
        ]);
    }
}
