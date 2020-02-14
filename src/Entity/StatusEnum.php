<?php

declare(strict_types=1);

namespace App\Entity;

final class StatusEnum
{
    const $COMMANDE = 'COMMANDE EN COURS';
    const $PREPARATION = 'PREPATATION EN COURS';
    const $ENCAISSER = 'A ENCAISSER';
    const $PRETE = 'PRETE';
}
