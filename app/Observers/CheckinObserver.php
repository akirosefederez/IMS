<?php

namespace App\Observers;

use App\Models\Checkin;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckinObserver
{
    /**
     * Handle the Checkin "created" event.
     */

     public function creating(Checkin $checkin)
     {
         // When a checkin is being created, increment the product inventory
         $product = Product::where('sku', $checkin->sku)->first();
         if ($product) {
             $product->update([
                 'quantity' => $product->quantity + $checkin->quantity,
             ]);
         }
     }

    public function created(Checkin $checkin)
    {
        //
        // Inventory updates are now handled in CheckinController to avoid conflicts
    }




    /**
     * Handle the Checkin "updated" event.
     */
    public function updated(Checkin $checkin): void
    {
        //
    }

    /**
     * Handle the Checkin "deleted" event.
     */
    public function deleted(Checkin $checkin)
    {
        //
        // Restore inventory when a checkin is deleted (for example: checkout
        // deletes the checkin after creating an OrderItem). This ensures any
        // temporary deduction done for checkout is put back and net effect
        // on inventory is zero.
        $product = Product::where('sku', $checkin->sku)->first();
        if ($product) {
            $product->update([
                'quantity' => $product->quantity + $checkin->quantity,
            ]);
        }
    }

    /**
     * Handle the Checkin "restored" event.
     */
    public function restored(Checkin $checkin): void
    {
        //
    }

    /**
     * Handle the Checkin "force deleted" event.
     */
    public function forceDeleted(Checkin $checkin): void
    {
        //
    }
}
