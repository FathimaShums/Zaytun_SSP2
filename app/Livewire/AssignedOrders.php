<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Delivery;
use App\Models\Order;

class AssignedOrders extends Component
{
    public $assignedOrders;
    public $deliveryStatusOptions = ['out for delivery', 'delivered'];

    public function mount()
    {
        // Get the orders assigned to the logged-in delivery person with statuses 'assigned' or 'out for delivery'
        $this->assignedOrders = Delivery::where('delivery_person_id', auth()->id())
            ->whereIn('delivery_status', ['assigned', 'out for delivery'])
            ->with(['order', 'order.user']) // Eager load the order and customer data
            ->get();
    }
    
    public function updateDeliveryStatus($deliveryId, $newStatus)
    {
        // Validate the new status
        if (!in_array($newStatus, $this->deliveryStatusOptions)) {
            session()->flash('error', 'Invalid status');
            return;
        }

        // Find the delivery
        $delivery = Delivery::find($deliveryId);

        if ($delivery && $delivery->delivery_person_id == auth()->id()) {
            // Update the delivery status
            $delivery->update([
                'delivery_status' => $newStatus,
            ]);

            // Optionally, update the delivery time when status changes to "out for delivery" or "delivered"
            if ($newStatus == 'out for delivery') {
                $delivery->update(['delivery_time' => now()]);
            }

            // If the delivery is marked as 'delivered', update the order status as well
            if ($newStatus == 'delivered') {
                $delivery->order->update([
                    'status' => 'delivered', // Mark the order status as 'delivered'
                ]);
            }

            session()->flash('success', 'Delivery status updated successfully');
            $this->mount(); // Refresh the data
        } else {
            session()->flash('error', 'Delivery not found or unauthorized');
        }
    }

    public function render()
    {
        return view('livewire.assigned-orders');
    }
}
