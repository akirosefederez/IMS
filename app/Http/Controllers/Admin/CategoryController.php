<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryFormRequest;


class CategoryController extends Controller
{

 public function index()
    {
        $role = Auth::user()->role_as;
        switch ($role) {
            case 3:
                return redirect()->back();
                break;

            default:
                return view('admin.category.index');
                break;
        }

    }
}
