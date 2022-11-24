<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Roles;
use App\RoleModules;




class RoleController extends Controller
{
    public function index()
    {
        $roles = DB::table('roles')
                ->get();
        return view('role.index')->with('roles', $roles);
    }

    public function addRollandModule()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|unique:roles',
        ]);

        $roles = Roles::get();
        $inputs = $request->all();
        $lastCreatedRoleId = Roles::create($inputs)->roleId;

        if ($request->moduleId != null) 
        {
            foreach($request->moduleId as $module=>$v)
            {
                $moduleData=array
                (
                    'roleId'=>$lastCreatedRoleId,
                    'moduleId'=>$request->moduleId[$module],
                );
                RoleModules::insert($moduleData);
            }
        }
        return view('role.index', compact('roles'))->with('successMsg', 'Role successfully added !!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $roleData = Roles::where('roleId','=', $id)->get();
        return view('role.edit', compact('roleData'));
    }

    public function update(Request $request, $roleId)
    {
        $this->validate($request, [
            'role' => 'required|unique:roles,role,'.$request->roleId.',roleId', // forcing to accept duplicate for that record not for others
        ]);

        Roles::where('roleId', $roleId)->update($request->except(['_token', '_method', 'roleId', 'moduleId'])); 

        RoleModules::where('roleId', $roleId)->delete();

        if ($request->moduleId != null) {
            foreach($request->moduleId as $modules=>$v)
            {
                $moduleData=array
                (
                    'roleId'=>$roleId,
                    'moduleId'=>$request->moduleId[$modules],
                );
                RoleModules::insert($moduleData);
            }
        }


        return view('role.index')->with('successMsg', 'Role successfully updated !!');
    }

    public function destroy($id)
    {
        Roles::find($id)->delete(); 

        return redirect(Route('role.index'))->with('successMsg', 'Role successfully deleted !!');
    }

}
