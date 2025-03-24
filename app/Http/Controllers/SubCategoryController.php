<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage sub category')) {
            $sub_categories = SubCategory::where('parent_id', '=', \Auth::user()->id)->get();
            return view('sub_category.index', compact('sub_categories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function create()
    {
        $categories = Category::where('parent_id', '=', \Auth::user()->id)->get()->pluck('title','id');
        $categories->prepend(__('Select Category'),'');
        return view('sub_category.create',compact('categories'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create sub category')) {
            $validator = \Validator::make(
                $request->all(), [
                'title' => 'required',
                'category_id' => 'required',
            ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $subCategory = new SubCategory();
            $subCategory->title = $request->title;
            $subCategory->category_id = $request->category_id;
            $subCategory->parent_id = \Auth::user()->id;
            $subCategory->save();

            return redirect()->back()->with('success', __('Sub Category successfully created!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function show(subCategory $subCategory)
    {
        //
    }


    public function edit(subCategory $subCategory)
    {
        if (\Auth::user()->can('edit sub category') ) {
            $categories = Category::where('parent_id', '=', \Auth::user()->id)->get()->pluck('title','id');
            $categories->prepend(__('Select Category'),'');
            return view('sub_category.edit', compact('subCategory','categories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function update(Request $request, subCategory $subCategory)
    {
        if (\Auth::user()->can('edit sub category')) {
            $validator = \Validator::make(
                $request->all(), [
                'title' => 'required',
                'category_id' => 'required',
            ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $subCategory->title = $request->title;
            $subCategory->category_id = $request->category_id;
            $subCategory->save();

            return redirect()->back()->with('success', __('Sub Category successfully updated!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function destroy(subCategory $subCategory)
    {
        if (\Auth::user()->can('delete sub category')) {
            $subCategory->delete();
            return redirect()->back()->with('success', 'Sub Category successfully deleted!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }
}
