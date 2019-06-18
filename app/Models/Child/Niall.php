<?php
declare(strict_types=1);

namespace App\Models\Child;

use App\Models\Child;

/**
 * @package App\Models\Child
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Niall extends Child
{
    public function __construct()
    {
        $this->id = 'Eq9g6BgJL0';

        $this->uri = '/niall';

        $this->version = 'Our second child';
        $this->name = 'Niall Blackborough';
        $this->dob = '22nd April 2019 17:46';
        $this->sex = 'Male';
        $this->weight = '3.458kg (7lb 10oz)';
        $this->short_name = 'Niall';
        $this->image_uri = 'images/theme/niall.jpg';
    }
}
