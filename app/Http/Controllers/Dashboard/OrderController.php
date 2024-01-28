<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceOrderMailable;
use App\Mail\Signedup;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function index(Request $request)
    {
          $todayDate = Carbon::now()->format('Y-m-d');
          $orders = Order::when($request->date !=null, 
                                function($q) use ($request){ 
                                    return $q->whereDate('created_at',$request->date);
                                },
                                function($q)use ($todayDate){
                                    return $q->whereDate('created_at',$todayDate);
                                }
                            )->when($request->status !=null, 
                                function($q) use ($request){ 
                                    return $q->where('status',$request->status);
                                }
                            )->orderBy('id','DESC')->paginate(10);

         // $orders = Order::whereDate('created_at',$todayDate)->orderBy('id','DESC')->paginate(10);
      //  $orders = Order::orderBy('id','DESC')->paginate(10);
        return view('dashboard.orders.index',compact('orders'));
    }

    public function edit($order_id)
    {
        if ($order_id) {
        // $order = Order::where('id',$order_id)->first();
        $order = Order::findOrFail($order_id);
    
           if ($order) {
                return view('dashboard.orders.edit',compact('order')); 
            }else {
                return redirect()->back()->with('message','عذرا الطلب غير موجود'); 
            }  

        }else {
            return redirect()->back()->with('message','عذرا الطلب غير موجود'); 
        }
    }
 
    public function update(int $order_id,Request $request)
    {
       // to update enum value
        $order = Order::findOrFail($order_id);
        if ($order) {
          //  $order->status = $request->status;
        // dd($request->status);
            $order->status = $request->status;;
            $order->update();
            
            return redirect('/dashboard/order/'.$order_id.'/edit/')->with('message','تم تعديل الطلب بنجاح'); 
        }else {
            return redirect('/dashboard/order/'.$order_id.'/edit/')->with('message','عذرا الطلب غير موجود'); 
        } 
    }

   public function viewInvoice($order_id)
   {
        if ($order_id) {
            $order = Order::findOrFail($order_id);
            if ($order) {
                return view('dashboard.orders.generate-invoice',compact('order')); 
            }else {
                return redirect()->back()->with('message','عذرا الطلب غير موجود'); 
            } 
        }else {
            return redirect('/dashboard/order')->with('message','عذرا الطلب غير موجود'); 
        }  
   }

   
   public function generateInvoice($order_id)
   {
      
      if ($order_id) {
     
        $order = Order::findOrFail($order_id);
        $data = ['order'=> $order];

        $pdf = Pdf::loadView('dashboard.orders.generate-invoice', $data)->setOptions(['defaultFont' => 'sans-serif']);
        $todayDate = Carbon::now()->format('Y-m-d');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'pdf');
       }else {
           return redirect()->back()->with('message','عذرا الطلب غير موجود'); 
       }
    }

    public function emailInvoice($order_id)
   {
      $order = Order::findOrFail($order_id);
     // dd($order->user->email);
      Mail::to($order->user->email)->send(new InvoiceOrderMailable($order));

    /*  try{ 
        return redirect('dashboard/order/'.$order_id.'/edit')->with('message','تم ارسال الفاتورة للايميل '.$order->email); 
      }catch(\Exception $e){
        return redirect('dashboard/order/'.$order_id.'/edit')->with('message','هناك خطأ . لم نتمكن من ارسال الايميل'); 

      }*/
    }


}
