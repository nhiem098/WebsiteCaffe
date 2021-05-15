<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, Order, OrderDetail};
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        try {
            $orders = Order::all();
            foreach($orders as $order){
                $order['product_type'] =  $this->countTypeProduct($order->orderDetail);
            }
            return response()->json([
                'code'  => 200,
                'status' => 'success',
                'message' => 'Get all order successfully.',
                'result' => $orders
            ], 200);
        } catch (\Exception  $e) {
            return $this->outputError($e);
        }
    }

    public function getOrderUser(Request $request){
        try {
            $user_id = $request->get('user_id', null);
            if($user_id){
                $order = Order::where('user_id', $user_id)->get();
                if($order){
                    foreach($order as $item){
                        $item['product_type'] =  $this->countTypeProduct($item->orderDetail);
                    }
                    return response()->json([
                        'code'  => 200,
                        'status' => 'success',
                        'message' => 'Get order by user successfully.',
                        'result' => $order
                    ], 200);
                }
                return response()->json([
                    'code'  => 400,
                    'status' => 'failed',
                    'message' => 'Order by user not found.',
                ], 400);
            }else{
                return response()->json([
                    'code'  => 422,
                    'status' => 'error',
                    'message' => 'The user_id field is required.',
                ], 422);
                
            }
        } catch (\Exception  $e) {
            return $this->outputError($e);
        }
    }

    public function show($order){
        try {
            $order = Order::find($order);
            $order['product_type'] =  $this->countTypeProduct($order->orderDetail);
            if($order){
                return response()->json([
                    'code'  => 200,
                    'status' => 'success',
                    'message' => 'Find order successfully.',
                    'result' => $order
                ], 200);
            }else{
                return response()->json([
                    'code'  => 400,
                    'status' => 'failed',
                    'message' => 'Order not found.',
                ], 400);
            }
        } catch (\Exception  $e) {
            return $this->outputError($e);
        }
    }

    private function countTypeProduct($order){
        $total = 0;
        $type = array();
        foreach($order as $key => $detail){
            $product = Product::find($detail->product_id);
            if(!in_array($product->category_id, $type)){
                $type[] = $product->category_id;
                $total++;
            }
        }
        return $total;
    }

    protected function outputError($e){
        return response()->json([
            'code'  => 500,
            'status' => 'failed',
            'message' => 'Something wrong!.',
            'error' => $e->getMessage()
        ], 500);
    }

    public function store(CreateOrderRequest $request){
        try {
            $total = 0;
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'total'   => $total
            ]);
            foreach($request->product as $value){
                $product = Product::find($value->id ?? $value['id']);
                $number = (int) ($value->number ?? $value['number']) ?? 1;
                $detail = $order->orderDetail()->create([
                    'product_id' => $product->id,
                    'number'     => $number,
                    'price'      => $product->price,
                    'total'      => $number * $product->price,
                ]);
                $total = $total + $detail->total;
            }
            $order->update(['total' => $total]);
            return response()->json([
                'code'  => 200,
                'status' => 'success',
                'message' => 'Create order successfully.',
            ], 200);
        } catch (\Exception $e) {
            return $this->outputError($e);
        }
    }

    public function destroy(Request $request){
        try {
            if($request->get('order_id', null)){
                // $order = Order::without('orderDetail', 'user')->find($request->order_id);
                $order = Order::without('orderDetail')->find($request->order_id);
                if(!$order)
                    return response()->json([
                        'code'  => 400,
                        'status' => 'failed',
                        'message' => 'Order not found.',
                    ], 400);
                else{
                    $order->orderDetail()->delete();
                    $order->delete();
                    return response()->json([
                        'code'  => 200,
                        'status' => 'success',
                        'message' => 'Delete order successfully.',
                    ], 200);
                }
            }else{
                return response()->json([
                    'code'  => 422,
                    'status' => 'error',
                    'message' => 'The order_id field is required.',
                ], 422);
            }
        } catch (\Exception $e) {
            return $this->outputError($e);
        }
    }
}
