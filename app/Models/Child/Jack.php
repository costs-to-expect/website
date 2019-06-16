<?php
declare(strict_types=1);

namespace App\Models\Child;

use App\Models\Child;

/**
 * @package App\Models\Child
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Jack extends Child
{
    public function __construct()
    {
        $this->id = 'kw8gLq31VB';
        $this->name = 'Jack Blackborough';
        $this->dob = '2018-06-28';
        $this->sex = 'male';
        $this->weight = '3.373kg (7lb 7oz)';
    }
}
