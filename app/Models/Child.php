<?php
declare(strict_types=1);

namespace App\Models;

/**
 * @package App\Models
 * @author Dean Blackborough <dean@g3d-development.com>
 * @copyright Dean Blackborough 2019
 */
abstract class Child
{
    protected $id;

    protected $uri;

    protected $version;
    protected $name;
    protected $dob;
    protected $sex;
    protected $weight;
    protected $short_name;
    protected $image_uri;

    public function details(): array
    {
        return [
            'version' => $this->version,
            'name' => $this->name,
            'dob' => $this->dob,
            'sex' => $this->sex,
            'weight' => $this->weight,
            'short_name' => $this->short_name,
            'image_uri' => $this->image_uri
        ];
    }

    public function id(): string
    {
        return $this->id;
    }

    public function uri(): string
    {
        return $this->uri;
    }
}
