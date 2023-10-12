<?php

namespace App\Policies;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BarangPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Barang $barang): bool
    {
        if ($user->isAdmin()) {
            return true; // Admin dapat melihat semua barang
        }

        if ($user->isSarpras() || $user->isKepala()) {
            return $user->unit_id === $barang->unit_id; // Sarpras hanya dapat melihat barang dari unit mereka
        } else {
            return false;
        }
    }

    public function create(User $user)
    {
        // Admin dapat membuat barang untuk semua unit
        if ($user->isAdmin() || $user->isSarpras()) {
            return true;
        }
        return false;
    }

    // public function update(User $user, Barang $barang): bool
    public function update(User $user): bool
    {
        // Admin dapat mengupdate semua barang
        if ($user->isAdmin() || $user->isSarpras()) {
            return true;
        } else
            return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Barang $barang): bool
    {
        // Admin dapat menghapus semua barang
        if ($user->isAdmin()) {
            return true;
        }

        // Sarpras hanya dapat menghapus barang dari unit mereka
        if ($user->isSarpras() || $user->isKepala() && $user->unit_id === $barang->unit_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Barang $barang): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Barang $barang): bool
    {
        //
    }
}
