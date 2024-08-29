<?php


namespace App\Repositories;

use App\Models\UserHistory;

class UserHistoryRepository extends BaseRepository
{
    /**
     * Specify Model class name
     * @return mixed
     */
    function model()
    {
        return UserHistory::class;
    }
}
