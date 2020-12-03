<?php

namespace Core\Base;


abstract class BaseRepoAll extends BaseRepo
{
    public function create($data)
    {
        try {
            return jsend_success($this->getModel()->create($data));
        }catch (\Exception $e) {
            return jsend_error('Error when saving: '.$e->getMessage());
        }
    }

    public function update($request, $id)
    {
        try {
            $query = $this->getModel()::findOrFail($id);
            $query->fill($request);
            if($query->save()){
                return $this->find($id);
            }
            return null;
        }catch (\Exception $e) {
            return jsend_error('Error updating record: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $query = $this->getModel()->findOrFail($id);
            $query->delete();
            return jsend_success($query);
            //$delete = $dato->delete();
        }catch (\Exception $e) {
            return jsend_error('Fail to deactivate registration: '.$e->getMessage());
        }
    }


}
