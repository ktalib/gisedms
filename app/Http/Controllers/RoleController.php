<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class RoleController extends Controller
{

    public function index()
    {
         $roleData = Role::where('parent_id', parentId())->get();
            return view('role.index', compact('roleData'));
    }


    public function create()
    {
        $permissionList = new Collection();
        foreach (\Auth::user()->roles as $role) {
            $permissionList = $permissionList->merge($role->permissions);
        }
        return view('role.create', compact('permissionList'));
    }


    public function store(Request $request)
    {

       $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required|unique:roles,name,null,id,parent_id,' . parentId(),
                    'user_permission' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->route('role.index')->with('error', $messages->first());
            }

            $userRole = new Role();
            $userRole->name = $request->title;
            $userRole->parent_id = parentId();
            $userRole->save();
            foreach ($request->user_permission as $permission) {
                $result = Permission::find($permission);
                $userRole->givePermissionTo($result);
            }
            return redirect()->route('role.index')->with('success', __('Role successfully created.'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $role = Role::find($id);
        $permissionList = new Collection();
        foreach (\Auth::user()->roles as $userRole) {
            $permissionList = $permissionList->merge($userRole->permissions);
        }

        $assignPermission = $role->permissions;
        $assignPermission = $assignPermission->pluck('id')->toArray();

        return view('role.edit', compact('role', 'permissionList', 'assignPermission'));
    }


    public function update(Request $request, $id)
    {
       $userRole = Role::find($id);
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required|unique:roles,name,' . $userRole->id . ',id,parent_id,' . parentId(),
                    'user_permission' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->route('role.index')->with('error', $messages->first());
            }
            $permissionData = $request->except(['permissions']);
            $assignPermissions = $request->user_permission;
            $userRole->fill($permissionData)->save();

            $permissionList = Permission::all();
            foreach ($permissionList as $revokePermission) {
                $userRole->revokePermissionTo($revokePermission);
            }
            foreach ($assignPermissions as $assignPermission) {
                $assign = Permission::find($assignPermission);
                $userRole->givePermissionTo($assign);
            }
            return redirect()->route('role.index')->with('success', __('Role successfully updated.'));

    }


    public function destroy($id)
    {
       $userRole = Role::find($id);
            $userRole->delete();
            return redirect()->route('role.index')->with('success', 'Role successfully deleted.');
    }

}
