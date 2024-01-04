<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function PDFDownload($record)
    {
        $order = Order::with('division','district', 'state', 'customer')->where('id', $record)->first();

        $order_item = OrderProduct::with('product')->where('order_id', $record)->get();

        $pdf = Pdf::loadView('order.order_invoice', compact('order','order_item'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),   
            'chroot' => public_path(), 
        ]);
        return $pdf->download('invoice.pdf');


    }
}
