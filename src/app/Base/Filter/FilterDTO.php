<?php

namespace App\Base\Filter;

use Illuminate\Http\Request;

class FilterDTO
{
    public array $relations = [];
    public array $fields = [];
    public string $order = '';

    public function transform(string $model, Request $request): FilterDTO
    {
        $model = new $model;
        $relations = $model->getRelations();
        $fields = $model->getFillable();
        $searchDTO = new self();

        foreach ($request->query as $name => $params) {

            if (lcfirst($name) == 'order') {
                $searchDTO->order = $params;

            } else if(array_key_exists(lcfirst($name), $relations)) {

                $ids = str_replace(' ', '', $params);
                $ids = explode(',', $ids);

                $name = 'of' . ucfirst($name);
                $searchDTO->relations[lcfirst($name)] = $ids;
            } else if (array_key_exists(lcfirst($name), $fields)) {
                $searchDTO->fields[lcfirst($name)] = $params;
            }
        }

        return $searchDTO;
    }
}
