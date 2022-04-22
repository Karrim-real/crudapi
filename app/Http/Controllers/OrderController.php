<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'sucess',
            'data' => $this->orderRepository->getAllOrders()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(StoreOrderRequest $request)
    // {

    //     // $orderDetails = $request->validate([
    //     //     'details' => 'required',
    //     //     'client' => 'required'
    //     // ]);
    //     // return response()->json($orderDetails);
    //     $orderDetails = $request->validated();
    //     $result = $this->orderRepository->createOrder($orderDetails);
    //     // if(!$result){
    //     //     return response()->json([
    //     //         'status' => 'error',
    //     //         'message' => $result
    //     //     ]);
    //     // }
    //     return response()->json([
    //         'data' => $result,
    //         'status' => 'sucess',
    //         'message' => 'Data created'
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
         // return response()->json($orderDetails);
         $orderDetails = $request->validated();
         $result = $this->orderRepository->createOrder($orderDetails);
         // if(!$result){
         //     return response()->json([
         //         'status' => 'error',
         //         'message' => $result
         //     ]);
         // }
         return response()->json([
             'data' => $result,
             'status' => 'sucess',
             'message' => 'Data created'
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $orderId = $request->route('id');
        $result = $this->orderRepository->getOrderById($orderId);
        if(!$result){
            return response()->json([
                'status' => 'error',
                'message' => 'No Data Found'
            ],404);
        }

        return response()->json([
                'data' => $result,
                'status' => 'success'
            ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    // public function edit(Order $order)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request)
    {
        $orderId = $request->route('id');
        $orderDetails = $request->only([
            'client',
            'details'
        ]);

        $updateData = $this->orderRepository->updateOrder($orderId, $orderDetails);
        if(!$updateData)
            return response()->json([
                'status' => 'error',
                'message' => 'No Data Found with this ID'
            ],404);

                return response()->json([
                    'data' => $updateData,
                    'status' => 'sucess',
                    'message' => 'Data Updated'
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $orderId = $request->route('id');
        $result = $this->orderRepository->deleteOrder($orderId);
        if(!$result)
        return response()->json([
            'status' => 'error',
            'message' => 'No Data Found with this ID'
        ], 404);

        return response()->json([
            'data' =>$result,
            'status' => 'success',
            'message' => 'Data Deleted'
        ]);
    }

    public function fulfilledOrder()
    {

        return response()->json([
            'data' => $this->orderRepository->getFulfilledOrders(),
            'status' => 'success',
        ]);
    }

    public function search(Request $request)
    {
        $searchText = $request->get('search');
        // return response()->json($searchText);
        return response()->json([
            'status' => 'success',
            'data' => $this->orderRepository->searchOrder($searchText)
        ]);
    }
}
