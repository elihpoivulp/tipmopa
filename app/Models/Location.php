<?php

namespace App\Models;

use CodeIgniter\Model;

class Location extends Model
{
    protected $table = 'locations';

    public function get_destination_locations($start_id, $tti = false): array
    {
        $query = $this->orderBy('is_terminal', 'asc');
        if ($tti) {
            $query->where('id <>', $this->get_starting_point($start_id)['id']);
        } else {
            $query->where('id <>', 1);
        }
        return $query->findAll();
    }

    public function get_starting_point($start_id): array
    {
        return $this->find($start_id);
    }
}
