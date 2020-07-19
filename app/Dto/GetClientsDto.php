<?php

namespace App\Dto;


/**
 * Class GetClientsDto
 *
 * @package App\Dto
 */
class GetClientsDto
{
    public int $page = 1;

    public int $limit = 30;

    public string $search_by = 'all';

    public ?string $search_str;
}