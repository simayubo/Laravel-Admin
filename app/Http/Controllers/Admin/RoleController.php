<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Repositories\Eloquent\PermissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\RoleRepository;

class RoleController extends Controller
{
    protected $role;

    public function __construct(RoleRepository $role)
    {
        $this->middleware('check.permission:role');
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $list = $this->role->getRoleList($request);

        return view('admin.role.list')->with(compact('list'));
    }

    /**
     * Show the form for creating a new resource.

     */
    public function create(PermissionRepository $permission)
    {
        $permissions = $permission->findPermissionWithArray();

        return view('admin.role.create')->with(compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->role->addRole($request);
        return redirect('admin/role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('admin.role.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PermissionRepository $permission, $id)
    {
        $role = $this->role->find($id);
        $permissions = $this->role->getEditCheckedStatus($permission, $id);
        return view('admin.role.edit')->with(compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->role->updateRole($request, $id);
        return redirect('admin/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1) abort(404);
        $this->role->destroy($id);
        return redirect('admin/role');
    }
}
