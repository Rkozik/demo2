<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Rules\EmployeeIDValidation;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        return response()->json(Users::all());
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email|max:255',
            'name' => 'required|string|max:255',
            'employee_id' => ['required', new EmployeeIDValidation]
        ]);

        Users::created([
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'employee_id' => $request->get('employee_id')
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function update(string $employee_id, Request $request)
    {
        validator($request->route()->parameters(), [
            'employee_id' => ['required', new EmployeeIDValidation]
        ])->validate();

        $this->validate($request, [
            'email' => 'email|max:255',
            'name' => 'string|max:255',
            'employee_id' => ['required', new EmployeeIDValidation]
        ]);

        $updateArr = [];
        if($request->get('email') != ''){
            $updateArr['email'] = $request->get('email');
        }
        if($request->get('name') != ''){
            $updateArr['name'] = $request->get('name');
        }
        if($request->get('employee_id') != ''){
            $updateArr['employee_id'] = $request->get('employee_id');
        }

        $user = Users::query()->from('users')->where('employee_id', '=', $employee_id);
        $user->update($updateArr);

        return response()->json([
            'success' => true
        ]);
    }

    public function delete(string $employee_id, Request $request)
    {
        validator($request->route()->parameters(), [
            'employee_id' => ['required', new EmployeeIDValidation]
        ])->validate();

        $user = Users::query()->from('users')->where('employee_id', '=', $employee_id);
        $user->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
