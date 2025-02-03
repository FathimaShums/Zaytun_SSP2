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
    public $selectedDeliveryPersons = [];

    public function mount()
    {
        $this->orders = Order::where('status', 'pending')->get();
        $this->deliveryMen = User::where('RoleID', 3)->get();
    }

    public function assignDelivery($orderId)
    {
        // Ensure a delivery person is selected for this order
        if (!isset($this->selectedDeliveryPersons[$orderId]) || !$this->selectedDeliveryPersons[$orderId]) {
            session()->flash('error', 'Please select a delivery person for Order ID ' . $orderId);
            return;
        }

        $deliveryPersonId = $this->selectedDeliveryPersons[$orderId];
        $order = Order::find($orderId);
        $deliveryPerson = User::find($deliveryPersonId);

        if (!$order || !$deliveryPerson) {
            session()->flash('error', 'Invalid selection.');
            return;
        }

        // Assign order to delivery person
        Delivery::create([
            'order_id' => $order->id,
            'delivery_person_id' => 8, // Example delivery person ID, change accordingly
            'delivery_status' => 'assigned', // Correct enum value
            'delivery_time' => Carbon::now(),
        ]);

        // Update order status
        $order->update(['status' => 'in progress']);

        // Send email notification
        $recipientEmail = $order->user_id ? $order->user->email : $order->guest_email;
        // Mail::to($recipientEmail)->send(new OrderProcessingMail($order));

        // Refresh data
        $this->mount();
        session()->flash('success', 'Delivery assigned for Order ID ' . $orderId);
    }

    public function render()
    {
        return view('livewire.order-management');
    }
}
