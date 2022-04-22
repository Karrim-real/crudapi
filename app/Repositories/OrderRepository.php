<?php
namespace App\Repositories;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    public function getAllOrders()
    {
        return Order::all();
    }

    public function GetOrderById($orderId)
    {
        return Order::find($orderId);
    }

    public function deleteOrder($orderId)
    {
        return Order::destroy($orderId);
    }

    public function createOrder(array $orderDetails)
    {

        return Order::create($orderDetails);
    }

    public function updateOrder($orderId, array $newDetails)
    {
        return Order::whereId($orderId)->update($newDetails);
    }

    public function getFulfilledOrders()
    {
        return Order::where('is_fulfilled', true)->get();
    }
    public function searchOrder($searchText)
    {
        return Order::where('client', 'LIKE', '%'.$searchText.'%')->get();
    }
}
