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

        $this->uri = '/jack';

        $this->version = 'Our first child';
        $this->name = 'Jack Blackborough';
        $this->dob = '28th June 2013 05:41';
        $this->sex = 'Male';
        $this->weight = '3.373kg (7lb 7oz)';
        $this->short_name = 'Jack';
        $this->image_uri = 'images/theme/jack.jpg';

    }
}
