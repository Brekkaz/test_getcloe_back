<?php

namespace Core\Base;


abstract class BaseRepo implements BaseRepoInterface
{

    abstract public function getModel();


    public function find($id)
    {
        try {
            return jsend_success($this->getModel()->findOrFail($id));
        } catch (\Exception $e) {
            return jsend_error('Error when returning record: ' . $e->getMessage());
        }
    }

    public function all($searchable, $query)
    {
        $search = $query["search"];
        $offset = $query["offset"];
        $pageSize = $query["pageSize"];

        try {
            $query = $this->getModel();
            $query =$query->where(function ($query) use ($searchable, $search) {
                foreach ($searchable as $field) {
                    $query->orWhere($field, 'like', '%' . $search . '%');
                }
            });
            //$query = $query->where('first_name', 'like', '%' . $search . '%');

            $query = $query->orderBy("id", "DESC")->skip($offset)->take($pageSize);

            return jsend_success([
                "data" => $query->get(),
                "totalRecords" => $query->count()
            ]);
        } catch (\Exception $e) {
            return jsend_error('Error to list: ' . $e->getMessage());
        }
    }

    public function findByAttributes(array $attributes)
    {
        try {
            $query = $this->buildQueryByAttributes($attributes);
            return $query->first();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc')
    {
        try {
            $query = $this->buildQueryByAttributes($attributes, $orderBy, $sortOrder);
            return $query->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function findByMany(array $ids)
    {
        try {
            $query = $this->getModel()->query();
            return $query->whereIn("id", $ids)->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function clearCache()
    {
        return true;
    }

    private function buildQueryByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc')
    {
        $query = $this->getModel()->query();
        if (method_exists($this->getModel(), 'translations')) {
            $query = $query->with('translations');
        }
        foreach ($attributes as $field => $value) {
            $query = $query->where($field, $value);
        }
        if (null !== $orderBy) {
            $query->orderBy($orderBy, $sortOrder);
        }
        return $query;
    }

    public function create($data)
    {
        return false;
    }

    public function update($request, $id)
    {
        return false;
    }

    public function destroy($id)
    {
        return false;
    }
}
