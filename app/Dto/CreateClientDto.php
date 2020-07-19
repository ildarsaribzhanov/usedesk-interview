<?php

namespace App\Dto;


/**
 * Class CreateClientDto
 *
 * @package App\Dto
 */
class CreateClientDto
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $f_name;

    /** @var string */
    public string $l_name;

    /** @var string[] */
    public array $email_list;

    /** @var string[] */
    public array $phone_list;

    /** @return array */
    public function toArray()
    {
        return [
            'first_name' => $this->f_name,
            'last_name'  => $this->l_name,
        ];
    }
}