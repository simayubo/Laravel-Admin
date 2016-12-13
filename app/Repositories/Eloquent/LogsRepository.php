<?php
namespace App\Repositories\Eloquent;

use App\Models\Logs;

class LogsRepository extends Repository {
    public function model()
    {
        return Logs::class;
    }
    public function getLogsList(){
        $list = $this->model->orderBy('id', 'desc')->get()->toArray();
        return $list;
    }
    public function updateLogs($request, $id){
        $logs = $this->model->find($id);
//        dd($request->id);
        if ($logs){
            $isUpdate = $logs->update($request->all());
            if ($isUpdate){
                return 1;
            }
            return -1;
        }
        return -2;
    }
    public function destoryLogs($id){
        $isDelete = $this->model->destroy($id);
        if ($isDelete){
            return true;
        }
        return false;
    }

}