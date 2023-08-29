<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCreatedNotification;
use App\Events\OrderCreated;
use App\Models\User;



class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {

        
      //$store = $event->order->store;
        $order = $event->order;
        $user = User::where('store_id',$order->store_id)->first(); 
        $user->notify(new OrderCreatedNotification($order));
      /*  if ($user) {
            $user->notify(new OrderCreatedNotification($order));
        }
*/
       
        /*$users = User::where('store_id',$order->store_id)->get();
        foreach($users as $user){
            $user->notify( new OrderCreatedNotification($order));
        };*/


      /*  $users = User::where('store_id', $order->store_id)->get();*/
      /*  Notification::send($users, new OrderCreatedNotification($order));*/
      

      
 
    }
}
