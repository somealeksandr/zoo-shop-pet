<?php

namespace App\DTO\News;

use App\DTO\BaseDTO;

class NewsDTO extends BaseDTO
{
    public ?int $amount;

    public ?int $per_page;
}
