<?php

namespace App\Enums;

enum ActionType: string
{
    case CREATE = 'create';
    case EDIT = 'edit';
    case DELETE = 'delete';
    case RESTORE = 'restore';
    case FORCE_DELETE = 'force_delete';

    public function label(): string
    {
        return match ($this) {
            self::CREATE => 'Crear',
            self::EDIT => 'Editar',
            self::DELETE => 'Borrado Lógico',
            self::RESTORE => 'Restaurar',
            self::FORCE_DELETE => 'Borrado Físico',
        };
    }
}
