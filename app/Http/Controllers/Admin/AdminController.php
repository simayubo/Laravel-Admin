<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Requests\AdminRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\AdminRepository;

class AdminController extends Controller
{
    protected $admin;
    public function __construct(AdminRepository $admin)
    {
        $this->middleware('check.permission:admin');
        $this->admin = $admin;
    }

    /**
     * 用户列表
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $list = $this->admin->getAdminList($request);

        return view('admin.admin.list')->with(compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role_list = Role::select('id', 'display_name')->get()->toArray();
        return view('admin.admin.create')->with(compact('role_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(AdminRequest $request)
    {
        $this->admin->addAdmin($request);
        return redirect('admin/admin');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $admin = $this->admin->getAdminInfo($id);
//        dump($admin);
        $role_list = Role::select('id', 'display_name')->get()->toArray();
        return view('admin.admin.edit')->with(compact('admin', 'role_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $this->admin->updateAdmin($request, $id);
        return redirect('admin/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->admin->destoryAdmin($id);
        return redirect('admin/admin');
    }
}
