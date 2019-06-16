<?php
declare(strict_types=1);

namespace App\Models;

/**
 * @package App\Models
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
class Child
{
    protected $id;

    protected $name;
    protected $dob;
    protected $sex;
    protected $weight;

    public function details(): array
    {
        return [
            'name' => $this->name,
            'dob' => $this->dob,
            'sex' => $this->sex,
            'weight' => $this->weight
        ];
    }

    public function id(): string
    {
        return $this->id;
    }
}
