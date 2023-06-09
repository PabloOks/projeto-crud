<?php

namespace App\Enums;

enum ResponseStatusCode: int
{
  case Success = 201;
  case Unauthorized = 401;
  case InternalServerError = 500;
}
