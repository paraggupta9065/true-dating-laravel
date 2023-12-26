<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Dotenv\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use HasApiTokens;
class AuthController extends Controller
{
    public function register(Request $Request){
        $validator  = Validator($Request->all(),[
            'UserName' => 'required',
            'UserEmail' => 'required | email', 
            'Password' => 'required', 
            'ConfirmPassword' => 'required | same:Password'

        ]);

        if($validator->fails()){
            $Response =[
                'success' => false,
                'message' => $validator->errors()
            ]; 
            return response()->json($Response,400); 
        }

        $input = $Request->all(); 
        $input['Password']= bcrypt($input['Password']);
        $user  = User::create($input); 

        $success['token'] =$user->createToken('MyApp')->plainTextToken; 
        $success['UserName'] = $user->UserName; 
        $Response = [
            'success' => true, 
            'data' => $success,
            'message' => "Register Successfully"
        ]; 

        return response()->json($Response,200);
    } 

    public function login(Request $request){
        if(Auth::attempt(['UserEmail'=> $request->UserEmail,'Password'=>$request->Password])){
            $user = Auth::user(); 

             
            $success['token'] =$user->createToken('MyApp')->plainTextToken; 
            $success['UserName'] = $user->UserName; 
            $Response = [
                'success' => true, 
                'data' => $success,
                'message' => "Login Successfully"
            ]; 

            return response()->json($Response,200);

        }else{
            $Response = [
                'success' => false, 
                'message' => "User Not Exist"
            ];
            
            return response()->json($Response);
        }
    }



    public function forgotPassword(Request $request)
    {
        $email = $request->input('email');

        // Check if email exists in the database
        $user = DB::table('users')->where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        // Generate a unique token (you can customize the logic as needed)
        $token = str_random(60);

        // Store the token in the password_resets table
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Send email with the token (customize the email view and subject as needed)
        Mail::send('emails.forgot_password', ['token' => $token], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Reset Password');
        });

        return response()->json(['message' => 'Reset password link sent to your email'], 200);
    }
}
