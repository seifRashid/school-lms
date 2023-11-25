<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = "Admin😎 List";
        return view('admin.admin.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add new admin😎";
        return view('admin.admin.add', $data);
    }

    public function insert(Request $request)
    {
        // request()->validate() is used to validate input data submitted in an HTTP request, especially from a form input
        request()->validate([
            'email'=>'required|email|unique:users'
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfully created");

    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit admin😎";
            return view('admin.admin.edit', $data);
        }
        else
        {
            abort(404);
        }
        
    }

    public function update($id, Request $request)
    {
        //checks if email exists first before taking the email
        request()->validate([
            'email'=>'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name); //$request->name retrieves the 'name' input from an HTTP request
        $user->email = trim($request->email);
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfully updated🎉");
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect('admin/admin/list')->with('success', "Admin successfully deleted🎉");
    } 
}
