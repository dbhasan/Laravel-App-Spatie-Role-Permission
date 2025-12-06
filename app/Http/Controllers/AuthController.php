<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Exception;
use Session;

class AuthController extends Controller
{
    // Display the login form
    public function login()
    {
        return view('auth.login');
    }

    public function adminlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
        }
    }

    // Display the logout
    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect()->route('login');
    }

    public function indexuser()
    {
        $userRole = auth()->user()->rolename;

        if ($userRole === 'admin') {
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'superadmin');
            })->get();
            $roles = Role::where('name', '!=', 'superadmin')->pluck('name', 'name')->all();
        } else {
            $users = User::all();
            $roles = Role::pluck('name', 'name')->all();
        }

        return view('auth.index', compact('users', 'roles'));
    }


    public function createuser()
    {
        $userRole = auth()->user()->rolename;

        if ($userRole === 'superadmin') {
            $roles = Role::where('name', '!=', 'superadmin')->pluck('name', 'name')->all();
        } elseif ($userRole === 'admin') {
            $roles = Role::whereNotIn('name', ['superadmin', 'admin'])->pluck('name', 'name')->all();
        } else {
            $roles = Role::pluck('name', 'name')->all();
        }

        return view('auth.create', compact('roles'));
    }


    public function storeuser(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'number' => 'required|digits_between:11,14|unique:users,number',
            'roles' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'new_password' => [
                'required',
                'confirmed',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/'
            ],
        ], [
            'new_password.min' => 'The password must be at least 8 characters long.',
            'new_password.regex' => 'Password must be uppercaser, lowercase, number, and special character.',
        ]);


        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->number = $request->number;
            $user->rolename = $request->roles;
            $user->password = Hash::make($request->new_password);
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $user->image = $imageName;
            }
            $user->save();

            $user->syncRoles($request->input('roles'));

            return redirect()->route('user.index')->with('success', 'user created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function edituser($id)
    {
        $loginuser = User::find($id);
        return view('auth.edit', compact('loginuser'));
    }


    public function updateuser(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'number' => 'required|digits_between:11,14|unique:users,number,' . $user->id,
            'status' => 'required|in:1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'new_password' => [
                'nullable',
                'confirmed',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/'
            ],
        ], [
            'new_password.min' => 'The password must be at least 8 characters long.',
            'new_password.regex' => 'Password must be uppercaser, lowercase, number, and special character.',
        ]);

        try {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->number = $request->input('number');
            $user->status = $request->input('status');

            // Only hash and set the new password if it is provided
            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->input('new_password'));
            }

            if ($request->hasFile('image')) {
                // Check if the old image exists and delete it
                if ($user->image && file_exists(public_path('images/' . $user->image))) {
                    unlink(public_path('images/' . $user->image));
                }

                // Upload the new image
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $user->image = $imageName; // Update the img field
            }

            $user->save();


            // Invalidate the user's sessions if the status is changed
            if ($request->input('status') != 1) {
                // Clear all sessions for the user
                DB::table('sessions')
                    ->where('user_id', $user->id)
                    ->delete();

                // Optionally, if the user is currently logged in, log them out
                if (Auth::id() == $user->id) {
                    Auth::logout();
                    Session::flush();
                }
            }

            return redirect()->route('user.index')->with('success', 'Data update successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
        }
    }


    // Display the Password Update
    public function profileupdate()
    {
        $users = Auth::user();
        return view('auth.password', compact('users'));
    }

    public function passwordupdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return redirect()->route('profle.update')->with('error', 'Old password not match.');
        }

        // Update password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('profle.update')->with('success', 'Password updated successfully.');
    }
}
