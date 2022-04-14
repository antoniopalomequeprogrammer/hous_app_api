<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassMail;
use App\Models\User;
use App\Models\Prescriptor;
use App\Models\PasswordReset;
use DateTime;
use App\Http\Controllers\API\ResponseController as ResponseController;

class PasswordResetController extends ResponseController{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request){
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user){
            return $this->sendError("No se ha encontrado un usuario con esa dirección de correo", 404);
        }

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            ['email' => $user->email, 'token' => str_random(60)]
        );

        if ($user && $passwordReset){
            if (config('global.develop_mode')) {
                $toEmail = config('global.email_testing');
            }else{
                $toEmail = $user->email;
            }

            Mail::to($toEmail)->send(new ForgotPassMail($user, $passwordReset->token));
        }

        return $this->sendResponse('Se ha enviado un email con un link para resetear la contraseña');
    }

    public function changePass($token){

        $passwordReset = PasswordReset::where('token', $token)->first();
        if ($passwordReset) {
            $user = User::where('email', $passwordReset->email)->first();

            $data = [];
            $data['token'] = $token;
            $data['email'] = $user->email;
            $data['validation'] = false;
            return view('user.validate', $data);
        }

        return response()->view('errors.404', [], 404);
    }

    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token){
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (!$passwordReset){
            return $this->sendError("El token no es válido", 404);
        }

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return $this->sendError("El token no es válido", 404);
        }

        return $this->sendResponse($passwordReset);
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request){

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);

        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();

        if (!$passwordReset){
            return $this->sendError("El token no es válido", 404);
        }

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user){
            return $this->sendError("No se ha encontrado un usuario con esa dirección de correo", 404);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();

        return $this->sendResponse($user);
    }
}
