<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Session;

use function Ramsey\Uuid\v1;

class roleController extends Controller
{


    public function index()
    {
        $roles = Role::paginate(6);
        Session::put('role-url', request()->fullUrl());
        return view('admin.role.index', compact('roles'));
    }



    public function create(){
        return view('admin.role.create');
    }


    public function store(Request $request){
        if ($request->isMethod('POST')) {
            $rules = [
               'name' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
            ];
            $request->validate($rules, $messages);
        }

        try{
            $data = $request->all();
            unset($data['_token']);
            Role::create($data);
            if (Session::get('role-url')) {
                return redirect(session('role-url'))->with('success', 'Đã thêm role thành công');
            }
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }


    public function edit($id){
        $role = Role::find($id);
        return view('admin.role.edit', compact( 'role'));
    }


     public function update(Request $request,$id){
        $data = $request->all();
        try{
            $role = Role::find($id);
            $role->update($data);
            if (Session::get('role-url')) {
                return redirect(session('role-url'))->with('success', 'Đã sửa role thành công');
            }
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
     }

     public function destroy($id) {
        try{
            Role::find($id)->delete();
            if (Session::get('role-url')) {
                return redirect(session('role-url'))->with('success', 'Đã xóa role thành công');
            }
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
     }

}
