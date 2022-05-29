<?php

namespace App\GraphQL\Mutations;

use App\Models\Rental;

final class CreateRental
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $rental = Rental::create([
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
            '_geo' => (object) [
                'lat' => $args['lat'],
                'lng' => $args['lng'],
            ],
            'equipment_id' => $args['equipment']['connect'],
            'pricing_type_id' => $args['pricing_type']['connect'],
            'user_id' => $args['user']['connect']
        ]);

        if (isset($args['images'])) {
            foreach ($args['images'] as $key => $image) {
                $rental->addMedia($image)->toMediaCollection('images');
            }
        }

        return $rental;
    }
}
