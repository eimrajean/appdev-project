<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
    use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
     public function show()
     {
     $user = Auth::user();
     return view('profile', compact('user'));
     }



    public function update(Request $request)
    {
    $user = Auth::user();

    $request->validate([
    'firstname' => 'required|string|max:255',
    'lastname' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    ]);

    try {
    DB::beginTransaction();

    DB::table('users')
    ->where('id', $user->id)
    ->update([
    'firstname' => $request->firstname,
    'lastname' => $request->lastname,
    'email' => $request->email,
    ]);

    DB::commit();

    return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    } catch (\Exception $e) {
    DB::rollBack();
    return redirect()->back()->with('error', 'Failed to update profile. ' . $e->getMessage());
    }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

     public function search($firstname)
    {
        return User::where('firstname', 'like', '%' . $firstname . '%')->get();
    }


//         public function register(RegisterUserRequest $request)
//     {
//         $validated = $request->validated();
      

//         $user = User::create([
//             'firstname' => $validated['firstname'],
//             'lastname' => $validated['lastname'],
//             'email' => $validated['email'],
//             'password' => bcrypt($validated['password']),
//             //  'role' => $validated['role'],
//         ]);

//         $token = $user->createToken('auth_token')->plainTextToken;

//         $response =[
//             'user' => $user,
//             'token' => $token
//         ];

//         return response($response, 201);
//     }

//     public function login(LoginUserRequest $request)
//     {
//          $request->validated();
//     //    $request->validate([
//     //     'email'=>'required|email',
//     //     'password'=>'required'
//     //    ]);

//        if(Auth::attempt($request->all())){
//         $user = User::where('email', $request->email)->first();
//         $token = $user->createToken("API token for{$request->email}")->plainTextToken;



//         return response()->json($token);
        
//        }
//        return response()->json('Invalid credentials');
//     }

//    public function logout(Request $request)
// {
//     // Ensure the request is coming from an authenticated user
//     $user = $request->user();

//     if ($user) {
//         // Revoke all tokens for the authenticated user
//         $user->tokens()->delete();

//         return response()->json(['message' => 'Logout successfully'], 200);
//     } else {
//         return response()->json(['message' => 'No authenticated user found'], 401);
//     }
// }



  public function register(RegisterUserRequest $request)
  {
  $validated = $request->validated();

  $user = User::create([
  'firstname' => $validated['firstname'],
  'lastname' => $validated['lastname'],
  'email' => $validated['email'],
  'password' => bcrypt($validated['password']),
  ]);

  Auth::login($user);

  return redirect('/home')->with('message', 'Registration successful!');
  }

  public function login(LoginUserRequest $request)
  {
  $credentials = $request->validated();

  if (Auth::attempt($credentials)) {
  $request->session()->regenerate();

  return redirect('/home')->with('message', 'Login successful!');
  }

  return back()->withErrors([
  'email' => 'The provided credentials do not match our records.',
  ]);
  }

  public function logout(Request $request)
  {
  $user = $request->user();

  if ($user) {
  $user->tokens()->delete();

  Auth::logout();

  $request->session()->invalidate();
  $request->session()->regenerateToken();

  return redirect('/login')->with('success', 'Logout successfully');
  }

  return response()->json(['message' => 'No authenticated user found'], 401);
  }
}
