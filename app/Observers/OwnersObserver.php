<?php

namespace App\Observers;

use App\Models\Resources;

class OwnersObserver
{
    /**
     * Handle the Resources "created" event.
     *
     * @param  \App\Models\Resources  $resources
     * @return void
     */
    public function creating(Resources $resources)
    {
        $userId = auth()->user()->id;
        $resources->created_by = $userId;
        $resources->updated_by = $userId;
    }

    public function created(Resources $resources)
    {
        //
    }

    /**
     * Handle the Resources "updated" event.
     *
     * @param  \App\Models\Resources  $resources
     * @return void
     */
    public function updating(Resources $resources)
    {
        $userId = auth()->user()->id;
        $resources->updated_by = $userId;
    }

    public function updated(Resources $resources)
    {
        //
    }

    /**
     * Handle the Resources "deleted" event.
     *
     * @param  \App\Models\Resources  $resources
     * @return void
     */
    public function deleted(Resources $resources)
    {
        //
    }

    /**
     * Handle the Resources "restored" event.
     *
     * @param  \App\Models\Resources  $resources
     * @return void
     */
    public function restored(Resources $resources)
    {
        //
    }

    /**
     * Handle the Resources "force deleted" event.
     *
     * @param  \App\Models\Resources  $resources
     * @return void
     */
    public function forceDeleted(Resources $resources)
    {
        //
    }
}