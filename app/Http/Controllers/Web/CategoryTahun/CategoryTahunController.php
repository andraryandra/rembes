<?php

namespace App\Http\Controllers\Web\CategoryTahun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryTahunController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:category-tahun-list|category-tahun-create|category-tahun-edit|category-tahun-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:category-tahun-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-tahun-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-tahun-delete', ['only' => ['destroy']]);
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        $data = [
            'category_tahun' => \App\Models\CategoryTahun::get(),
            'active' => 'category-tahun',
        ];

        return view('pages.s_user.admin.m_category_tahun.index', $data);
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        $data = [
            'active' => 'category-tahun',
        ];
        return view('pages.s_user.admin.m_category_tahun.create', $data);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate(
            $request,
            [
                'nama_category_tahun' => 'required',
                'slug' => 'required',
                'status' => 'required',
                'deskripsi' => 'required',
            ],
            [
                'nama_category_tahun.required' => 'Nama Category Tahun harus diisi!',
                'slug.required' => 'Slug harus diisi!',
                'status.required' => 'Status harus diisi!',
                'deskripsi.required' => 'Deskripsi harus diisi!',
            ]
        );

        $data = [
            'nama_category_tahun' => $request->input('nama_category_tahun'),
            'slug' => $request->input('slug'),
            'status' => $request->input('status'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        \App\Models\CategoryTahun::create($data);

        return redirect()->route('dashboard.category-tahun.index')->with('success', 'Category Tahun berhasil ditambahkan!');
    }

    public function show($id): \Illuminate\Contracts\View\View
    {
        $data = [
            'category_tahun' => \App\Models\CategoryTahun::findOrFail($id),
            'active' => 'category-tahun',
        ];

        return view('pages.s_user.admin.m_category_tahun.show', $data);
    }

    public function edit($id): \Illuminate\Contracts\View\View
    {
        $data = [
            'category_tahun' => \App\Models\CategoryTahun::findOrFail($id),
            'active' => 'category-tahun',
        ];

        return view('pages.s_user.admin.m_category_tahun.edit', $data);
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate(
            $request,
            [
                'nama_category_tahun' => 'required',
                'slug' => 'required',
                'status' => 'required',
                'deskripsi' => 'required',
            ],
            [
                'nama_category_tahun.required' => 'Nama Category Tahun harus diisi!',
                'slug.required' => 'Slug harus diisi!',
                'status.required' => 'Status harus diisi!',
                'deskripsi.required' => 'Deskripsi harus diisi!',
            ]
        );

        $data = [
            'nama_category_tahun' => $request->input('nama_category_tahun'),
            'slug' => $request->input('slug'),
            'status' => $request->input('status'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        \App\Models\CategoryTahun::findOrFail($id)->update($data);

        return redirect()->route('dashboard.category-tahun.index')->with('success', 'Category Tahun berhasil diupdate!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        \App\Models\CategoryTahun::findOrFail($id)->delete();

        return redirect()->route('dashboard.category-tahun.index')->with('success', 'Category Tahun berhasil dihapus!');
    }
}
