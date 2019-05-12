<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Notifications\NewUserNotification;
use App\Role;
use App\User;
use DB;
use Faker;
use Illuminate\Database\QueryException;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->orderBy('name')->paginate(10);

        return view('panel.users.index', compact('users'));
    }

    public function create()
    {
        return view("panel.users.create");
    }

    public function store(UserRequest $request)
    {
        try {
            $user = new User;
            $user->fill($request->all());
            $faker = Faker\Factory::create();
            $password = $faker->password();
            $user->password = bcrypt($password);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            $roleAdmin = Role::where('name', 'client')->firstOrFail();

            $user->roles()->attach($roleAdmin->id);

            $user->notify(new NewUserNotification($password));

            return redirect('usuarios')->with('success', 'Usuario registrado');
        } catch (Exception | QueryException $e) {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        if ($user->hasRole('admin')) {
            abort(403);
        }
        return view("panel.users.show", compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user->hasRole('admin')) {
            abort(403);
        }
        return view("panel.users.edit", compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        try {
            User::updateOrCreate(['id' => $id], $request->all());

            return redirect('usuarios')->with('success', 'Usuario actualizado');
        } catch (Exception | QueryException $e) {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            if ($user->hasRole('admin')) {
                abort(403);
            }
            $user->delete();

            DB::commit();

            return redirect('usuarios')->with('success', 'Usuario "' . $user->name . '" eliminado');
        } catch (Exception | QueryException $e) {
            DB::rollBack();

            return back()->withErrors(['exception' => 'No se pudo eliminar el usuario "' . $user->name . '"']);
        }
    }
}
