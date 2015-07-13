<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sheet;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;

class SheetController extends Controller
{
    protected $user;
    protected $sheet;

    public function __construct(Guard $auth, Sheet $sheet)
    {
        $this->user = $auth->user();
        $this->sheet = $sheet;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $sheets = $this->sheet->where('user_id', $this->user->id)->orderBy('updated_at', 'desc')->get();
        return $sheets->toJson();
    }

    public function store(Request $request)
    {
        $sheet = new Sheet;
        $sheet->title = $request->input('title');
        $sheet->text = $request->input('text');
        $sheet->user_id = $this->user->id;
        $sheet->save();
        return $sheet->toJson();
    }


    public function update(Request $request, $id)
    {
        $sheet = $this->sheet->find($id);
        if(empty($sheet)) {
            abort(404);
        }
        $sheet->title = $request->input('title');
        $sheet->text = $request->input('text');
        $sheet->save();
        return $sheet->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $sheet = $this->sheet->find($id);
        if(empty($sheet)) {
            abort(404);
        }
        $sheet->delete();
        return $sheet->toJson();
    }
}
