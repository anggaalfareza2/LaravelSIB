<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
                return response()->json([
                    'succes' => true,
                    'message' => 'Resource data not found'
                ], 200);
            }

            return response()->json([
                'succes' => true,
                'message' =>'Get all resource',
                'data' => $transactions
            ]);
    }

    public function store(Request $request) {
        //validator & cek validator
        $validator = Validator::make($request->all(),[
            'book_id'=> 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'succes'=> false,
                'message' => 'validation error',
            ], 422);
        }
        //generate ordernumber -> unique | ORD-0003
        $uniqueCode = "ORD-" . strtoupper(uniqid());
        //ambil user yang sedang login & cek login (apakah ada data user?)
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'succes'=> false,
                'message'=> 'Unauthorized'
            ], 401);
        }
        //mencari data buku dari request    
        $book = Book::find($request->book_id);
        //cek stok buku
        if ($book->stok < $request->quantity) {
            return response()->json([
                'succes'=>false,
                'message'=>'stok barang tidak cukup'
            ], 400);
        }
        //hitung total harga = price * quantity
        $totalAmount = $book->price * $request->quantity;
        //kurangi stok buku (update)
        $book->stok -= $request->quantity;
        $book->save();
        //simpan data transaksi
        $transactions = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);
        return response()->json([
            'succes' => true,
            'message' => 'transaction created succesfully',
            'data' => $transactions
        ], 201);
    }
}