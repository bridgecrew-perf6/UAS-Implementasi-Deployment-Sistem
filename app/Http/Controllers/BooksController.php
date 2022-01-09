<?php
   
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
        public function show()
        {
            // return response()->json(DB::table('barang')->get(),200);
            return response()->json(Book::all(),200);
        }
    
        public function insert(Request $request)
        {
            $book = new Book;
            $book->name = $request->name;
            $book->author = $request->author;
            $book->save();
             return response()->json([
                "message" => "Book Berhasil Di input!",
                 "data" => $book
            ],201);
        }
    
        public function update(Request $request,$id){
            $cek_book = Book::firstWhere('id',$id);
            if($cek_book){
                $book = Book::find($id);
                $book->name = $request->name;
                $book->author = $request->author;
                $book->save();
                return response()->json([
                    "message" => "Book Berhasil Di Update!",
                     "data" => $book
                ],200);
            } else {
                return response()->json([
                    "message" => "Id Book tidak ditemukan!"
                ],404);
            }
        }
    }
        
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }

