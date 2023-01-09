<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use ReflectionException;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $allowedFields = [
        'receiver_id',
        'reference_no',
        'message',
        'category',
        'seen',
        'date_seen',
        'created_at'
    ];

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }

    public function create_notification($receiver_id, $message, $reference_no, $category = 'reservation-new'): bool
    {
        try {
            return $this->save([
                'receiver_id' => $receiver_id,
                'reference_no' => $reference_no,
                'message' => $message,
                'category' => $category
            ]);
        } catch (ReflectionException $e) {
            return false;
        }
    }

    public function get_notifications($user_id, $seen = 0): array
    {
        $data = $this->select('*')->where('receiver_id', $user_id)->where('seen', $seen)->findAll();
        if ($data) {
            foreach ($data as $key => $datum) {
                $data[$key]['category'] = config(\Config\Notification::class)->categories_style[$datum['category']];
            }
        }
        return $data;
    }

    public function mark_seen_by_reference($reference_no): bool
    {
        return $this->mark_seen($reference_no, 'reference_no');
    }

    public function mark_seen($id, $col = 'id'): bool
    {
        try {
            return $this->set('seen', 1)->where($col, $id)->update();
        } catch (ReflectionException $e) {
            return false;
        }
    }
}
