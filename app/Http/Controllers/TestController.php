<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class TestController extends Controller
{
    public function index()
    {
        return view('/user');
    }

    public function search(Request $request)
    {

        if ($request->ajax()) {

            $data = Product::where('id', 'like', '%' . $request->search . '%')
                ->orwhere('item_code', 'like', '%' . $request->search . '%')
                ->orwhere('productname', 'like', '%' . $request->search . '%')
                ->orwhere('category', 'like', '%' . $request->search . '%')->get();

            $output = '';

            if (count($data) > 0) {
                $output = '
                    <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>';
                foreach ($data as $row) {
                    $output .= '
                            <tr>
                            <th scope="row">' . $row->id . '</th>
                            <td>' . $row->item_code . '</td>
                            <td>' . $row->productname . '</td>
                            <td>' . $row->category . '</td>
                            </tr>
                            ';
                }
                $output .= '
                    </tbody>
                    </table>';
            } else {
                $output .= 'No results';
            }
            return $output;
        }
    }
}
