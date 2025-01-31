<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\User;
use App\Models\Delivery;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderProcessingMail;
use Carbon\Carbon;

class OrderManagement extends Component
{
    public $orders;
    public $deliveryMen;
    public $selectedOrder;
    public $selectedDeliveryPerson;

    public function mount()
    {
        // Fetch pending orders
        $this->orders = Order::where('status', 'pending')->get();

        // Fetch delivery personnel (RoleID = 3)
        $this->deliveryMen = User::where('RoleID', 3)->get();
    }

    public function assignDelivery()
    {
        // Ensure order and delivery person are selected
        if (!$this->selectedOrder || !$this->selectedDeliveryPerson) {
            session()->flash('error', 'Please select an order and a delivery person.');
            return;
        }

        $order = Order::find($this->selectedOrder);
        $deliveryPerson = User::find($this->selectedDeliveryPerson);

        if (!$order || !$deliveryPerson) {
            session()->flash('error', 'Invalid selection.');
            return;
        }

        // Assign order to delivery person
        $delivery = Delivery::create([
            'order_id' => $order->id,
            'delivery_person_id' => $deliveryPerson->id,
            'delivery_status' => 'pending',
            'delivery_time' => Carbon::now(),
        ]);

        // Update order status
        $order->update(['status' => 'processing']);

        // Send email notification
        $recipientEmail = $order->user_id ? $order->user->email : $order->guest_email;
        //Mail::to($recipientEmail)->send(new OrderProcessingMail($order));

        // Refresh data
        $this->mount();
        session()->flash('success', 'Delivery assigned and email sent.');
    }

    public function render()
    {
        return view('livewire.order-management');
    }
}
