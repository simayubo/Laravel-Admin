<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\LogsRepository;
use App\Http\Requests\LogsRequest;

class LogsController extends Controller
{
    protected $logs;

    public function __construct(LogsRepository $logs)
    {
        $this->logs = $logs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->logs->getLogsList();
        return $this->returnMsg(true, 0, 'success', ['logs_list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LogsRequest $request)
    {
        if ($id = $this->logs->create($request->all())){
            return $this->returnMsg(true, 0, 'success', ['id'  => $id]);
        }else{
            return $this->returnMsg(false, 1001, '添加日志失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = $this->logs->find($id);
        if ($info){
            return $this->returnMsg(true, 0, 'success', ['logs'=> $info]);
        }else{
            return $this->returnMsg(false, 1003, '日志不存在');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->logs->find($id);
        if (!$info){
            return $this->returnMsg(false, 1003, '日志不存在');
        }else{
            return $this->returnMsg(true, 0, 'success', ['logs'      => $info]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LogsRequest $request, $id)
    {
        $res = $this->logs->updateLogs($request, $id);
        if ($res == 1){
            return $this->returnMsg(true, 0, 'success');
        }elseif ($res == -1){
            return $this->returnMsg(false, 102, '日志更新失败');
        }elseif($res == -2){
            return $this->returnMsg(false, 1003, '日志不存在');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->logs->destoryLogs($id)){
            return $this->returnMsg(true, 0, 'success');
        }else{
            return $this->returnMsg(false, 104, '日志删除失败');
        }

    }
    public function returnMsg($success = true, $code = 0, $msg = '', $data = [], $status = '200', $url = ''){
        return [
            'success'   =>  $success,
            'code'      =>  $code,
            'msg'       =>  $msg,
            'data'      =>  $data,
            'status'    =>  $status,
            'url'       =>  $url
        ];
    }
}
