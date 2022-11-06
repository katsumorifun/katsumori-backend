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
        $relations = [];
        $fields = [];

        foreach ($model->getFillable() as $name) {
            $fields[$name] = '';
        }

        foreach ($model->getRelations() as $name) {
            $relations[$name] = '';
        }

        $searchDTO = new self();

        foreach ($request->query as $name => $params) {

            if (lcfirst($name) == 'order') {
                $searchDTO->order = $params;

            } elseif(array_key_exists(lcfirst($name), $relations)) {

                $ids = str_replace(' ', '', $params);
                $ids = explode(',', $ids);

                $name = 'of'.ucfirst($name);
                $searchDTO->relations[lcfirst($name)] = $ids;
            } elseif (array_key_exists(lcfirst($name), $fields)) {
                $params = str_replace(' ', '', $params);
                $params = explode(',', $params);
                $searchDTO->fields[lcfirst($name)] = str_replace(' ', '', $params);
            }
        }

        return $searchDTO;
    }
}
