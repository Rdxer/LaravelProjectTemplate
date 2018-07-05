<?php

namespace App\Repositories;

use App\Models\Letter;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LetterRepository
 * @package App\Repositories
 * @version July 5, 2018, 3:59 pm CST
 *
 * @method Letter findWithoutFail($id, $columns = ['*'])
 * @method Letter find($id, $columns = ['*'])
 * @method Letter first($columns = ['*'])
*/
class LetterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'type',
        'title',
        'details'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Letter::class;
    }
}
