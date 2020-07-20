<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Resources;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    public function index()
    {
        return view(
            'admin.resources.index',
            [
                'resources' => Resources::query()->paginate(6),
            ]
        );
    }

    public function create()
    {
        return view('admin.resources.create');
    }

    public function edit(Resources $resource)
    {
        return view('admin.resources.create', ['resource' => $resource]);
    }

    public function update(Request $request, Resources $resource)
    {
        return $this->store($request, $resource);
    }

    public function store(Request $request, $resource = null)
    {
        if (!($resource instanceof Resources)) {
            $resource = new Resources();
        }

        $resource->fill($request->all());

        if ($resource->save()) {
            $successMessage = $request->isMethod('POST') ? 'Ссылка добавлена!' : 'Ссылка обновлена!';
            return redirect()->route('admin.resources.index')->with('success', $successMessage);
        }

        $request->flash();
        return redirect()->route('admin.resources.create');
    }


    public function destroy(Resources $resource)
    {
        $resource->delete();
        return redirect()->route('admin.resources.index');
    }
}
