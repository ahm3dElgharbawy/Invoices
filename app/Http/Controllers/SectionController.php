<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{

    public function index()
    {
        $sections = Section::get();
        return view('sections.section', compact('sections'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'section_name' => 'required|unique:sections|max:255',
                'description' => 'required',
            ],
            $messages = [
                'section_name.required' => 'اسم القسم مطلوب',
                'section_name.unique' => 'القسم موجود بالفعل',
                'description.required' => 'الوصف مطلوب'
            ]
        );

        if ($validator->fails()) {
            return redirect('sections')
                ->withErrors($validator)
                ->withInput();
        }

        Section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => Auth::user()->name
        ]);
        return redirect('sections')->with('add', 'تم اضافة القسم بنجاح');
    }


    public function show(Section $section)
    {
        //
    }

    public function edit(Section $section)
    {
        //
    }


    public function update(Request $request)
    {
        $id = $request->id;

        $validator = Validator::make(
            $request->all(),
            $rules = [
                'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
                'description' => 'required',
            ],
            $messages = [
                'section_name.required' => 'اسم القسم مطلوب',
                'section_name.unique' => 'القسم موجود بالفعل',
                'description.required' => 'الوصف مطلوب'
            ]
        );

        if ($validator->fails()) {
            return redirect('sections')
                ->withErrors($validator)
                ->withInput();
        }
        Section::find($id)->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => Auth::user()->name
        ]);
        return redirect('sections')->with('edit', 'تم تعديل القسم بنجاح');
    }

    public function destroy(Request $request)
    {
        Section::destroy($request->id);
        return redirect('sections')->with('delete','تم حذف القسم بنجاح');
    }
}
