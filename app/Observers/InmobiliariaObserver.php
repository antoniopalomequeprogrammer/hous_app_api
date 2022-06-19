<?php

namespace App\Observers;

use App\Inmobiliaria;

class InmobiliariaObserver
{
    /**
     * Handle the inmobiliaria "created" event.
     *
     * @param  \App\Inmobiliaria  $inmobiliaria
     * @return void
     */
    public function created(Inmobiliaria $inmobiliaria)
    {
        //
    }

    /**
     * Handle the inmobiliaria "updated" event.
     *
     * @param  \App\Inmobiliaria  $inmobiliaria
     * @return void
     */
    public function updated(Inmobiliaria $inmobiliaria): void
    {
         
    }

    /**
     * Handle the inmobiliaria "deleted" event.
     *
     * @param  \App\Inmobiliaria  $inmobiliaria
     * @return void
     */
    public function deleted(Inmobiliaria $inmobiliaria)
    {
        //
    }

    /**
     * Handle the inmobiliaria "restored" event.
     *
     * @param  \App\Inmobiliaria  $inmobiliaria
     * @return void
     */
    public function restored(Inmobiliaria $inmobiliaria)
    {
        //
    }

    /**
     * Handle the inmobiliaria "force deleted" event.
     *
     * @param  \App\Inmobiliaria  $inmobiliaria
     * @return void
     */
    public function forceDeleted(Inmobiliaria $inmobiliaria)
    {
        //
    }
}
