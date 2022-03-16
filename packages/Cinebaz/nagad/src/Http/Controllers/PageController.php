<?php

namespace Cinebaz\Page\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cinebaz\Page\Http\Requests\PageFV;
use Cinebaz\Page\Models\Page;
use Validator;
use DataTables;
use Cinebaz\Seo\Traits\TSeo;

class PageController extends Controller
{
    use TSeo;
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['webview']]);
    }



    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Page::latest()->get();

            return DataTables::of($data)
                ->addColumn('status', function ($data) {
                    if ($data->is_active == 'Yes') {
                        return '<button type="button" class="edit btn btn-success btn-sm">Active</button>';
                    } else {
                        return '<button type="button" class="edit btn btn-primary btn-sm">Inactive</button>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group btn-group-sm">';
                    $button .= '<button type="button" class="btn btn-danger btn-flat"><i class="lar la-question-circle"></i></button>';
                    $button .= '<a href="' . route('admin.page.edit', $data->id) . '" class="btn btn-info btn-flat"><i class="las la-pen"></i></a>';
                    $button .= '<button type="button" class="btn btn-primary btn-flat"><i class="las la-trash"></i></button>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['role', 'status', 'action'])
                ->make(true);
        }
        $fdata = null;
        $mdata = null;
        return view('page::index', compact('mdata', 'fdata'));
    }
    public function webview($slug)
    {
        $mdata = Page::where(['slug' => $slug])->first();
        // dd($mdata);

        return view('page::webview')
            ->with(['mdata' => $mdata]);
    }
    public function add()
    {

        $fdata = null;
        $mdata = null;

        return view('page::add')
            ->with(['fdata' => $fdata, 'mdata' => $mdata]);
    }


    public function edit(Request $request, $id)
    {
        $fdata = Page::findOrFail($id);

        $mdata = null;

        return view('page::add')
            ->with(['fdata' => $fdata, 'mdata' => $mdata]);
    }


    public function store(PageFV $request)
    {

        // dd($request);
        $id = $request->get('id');
        // store
        // $seo_id = $this->Seogenarate($request);


        $attributes = [
            'title_en' => $request->get('title_en'),
            'title_bn' => $request->get('title_bn'),
            'title_hn' => $request->get('title_hn'),
            'sub_title_en' => $request->get('sub_title_en'),
            'sub_title_bn' => $request->get('sub_title_bn'),
            'sub_title_hn' => $request->get('sub_title_hn'),
            'slug' => $request->get('slug'),
            'description_en' => $request->get('description_en'),
            'description_bn' => $request->get('description_bn'),
            'description_hn' => $request->get('description_hn'),
            'remarks' => $request->get('remarks'),
            'sort_by' => $request->get('sort_by'),
            'is_active' => $request->get('is_active') ? $request->get('is_active') : 'No',
            'modified_by' => auth('web')->user()->id,
        ];

        if (!$id) {
            $attributes['create_by']  = auth('web')->user()->id;
        }

        //dump($id);

        try {

            if ($id) {
                $existing = Page::findOrFail($id);
                Page::where('id', $id)->update($attributes);
                $this->seoPost([
                    'data' => $request,
                    'able_id' => $id,
                    'able_type' => Page::class,
                ]);
            } else {
                $data = Page::create($attributes);

                $this->seoPost([
                    'data' => $request,
                    'able_id' => $data->id,
                    'able_type' => Page::class,
                ]);
            }



            return redirect()->route('admin.page.all')->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
    }

    public function getslug(Request $request)
    {

        $search = [
            'slug' => $request->get('slug'),
            'table' => $request->get('table'),
            'column' => $request->get('column'),
            'id' => $request->get('id'),
        ];

        $getslug = dynamicslug($search);
        return response()->json(['slug' => $getslug]);
    }
}
