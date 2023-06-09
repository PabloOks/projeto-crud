<?php

namespace App\Enums;

enum Status: string
{
    case NotStarted = 'Não iniciado';
    case InProgress = 'Em andamento';
    case Paused = 'Em pausa';
    case Completed = 'Finalizado';
    case Dropped = 'Cancelado';
}
