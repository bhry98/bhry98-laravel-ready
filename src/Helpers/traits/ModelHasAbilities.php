<?php

namespace Bhry98\Helpers\traits;


trait ModelHasAbilities
{

    protected function canEdit(): bool
    {
        if ($this->hasAttribute('deleted_at') && $this->getAttribute('deleted_at')) return false;
        return true;
    }

    protected function canDelete(): bool
    {
        if ($this->hasAttribute('deleted_at') && $this->getAttribute('deleted_at')) return false;
        return true;
    }

    protected function canForceDelete(int $relationsCount = 0): bool
    {
        if ($this->hasAttribute('deleted_at') && $this->getAttribute('deleted_at')) return false;
        if ($relationsCount < 0) return false;
        return true;
    }

    protected function canRestore(): bool
    {
        if ($this->hasAttribute('deleted_at') && !$this->getAttribute('deleted_at')) return false;
        return true;
    }
}
