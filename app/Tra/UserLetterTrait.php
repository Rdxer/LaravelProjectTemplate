<?php
/**
 * Created by PhpStorm.
 * User: Rdxer
 * Date: 2018/7/5
 * Time: 下午4:12
 */

namespace App\Tra;

use App\Models\Letter;

trait UserLetterTrait
{
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function letters()
    {
        return $this->hasMany(Letter::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get the entity's read .
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function readLetters()
    {
        return $this->letters()->whereNotNull('read_at');
    }

    /**
     * Get the entity's unread .
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function unreadLetters()
    {
        return $this->letters()->whereNull('read_at');
    }
}