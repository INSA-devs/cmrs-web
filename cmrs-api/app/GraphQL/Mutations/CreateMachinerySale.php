<?php

namespace App\GraphQL\Mutations;

use App\Models\MachinerySale;

final class CreateMachinerySale
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $machinery_sale = MachinerySale::create([
            'name' => $args['name'],
            'description' => $args['description'],
            'phone' => $args['phone'],
            'price' => $args['price'],
            'status' => $args['status'],
            'address' =>  (object) [
                'region' => $args['region'],
                'woreda' => $args['woreda'],
                'city' => $args['city'],
            ],
            'equipment_id' => $args['equipment']['connect'],
            'user_id' => $args['user']['connect']
        ]);

        if (isset($args['images'])) {
            foreach ($args['images'] as $key => $image) {
                $machinery_sale->addMedia($image)->toMediaCollection('images');
            }
        }

        return $machinery_sale;
    }
}
