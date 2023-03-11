<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\BannerRespositoryInterface;
use Exception;
use Illuminate\Support\Facades\File;

class BannerRespository extends BaseRepository implements BannerRespositoryInterface
{

    private $_model;
    public function __construct(Banner $model)
    {
        $this->_model = $model;
        parent::__construct($model);
    }

    public function getList($request)
    {
        $builder =  $this->_model->where(function ($query) use ($request) {
            if (!empty($request->keySearch)) {
                $query->whereLike('title', $request->keySearch);
            }

            if (!empty($request->fromTo)) {
                $query->whereExplodeDate('created_at', $request->fromTo);
            }

            if (isset($request->status)) {
                $query->where('status', $request->status);
            }
        })->paginate($this->page);
        return $builder;
    }

    public function handleDelete($request)
    {
        $rec = $this->_model->find(request()->itemId);
        if ($rec) {
            $this->deleteImage(@$rec->img_url);
            $rec->delete();
        }
        return true;
    }

    public function lockOrUnlockByID($input)
    {
        $rec = $this->_model->find(request()->itemId);
        if ($rec) {
            $rec->update([
                'status' => !$rec->status,
            ]);
        }
        return true;
    }

    public function handleCreateOrUpdate($id, $request)
    {

        $data = $request->all();
        $input = [
            'title' => @$data['title'] ?? "",
            'description' => @$data['description'] ?? "",
            'slug' => \Str::slug($data['title']) ?? "",
            'btn_title' => @$data['title'] ?? "",
            'btn_href' => @$data['btn_href'] ?? "",
            'status' => config('global.default.status.banner.active.key'),
            'img_src' => @$data['img_src'] ?? "",
        ];
        $rec = $this->_model->find($id);
        $input['img_src'] = $this->handleUpdateImage($rec, $input) ?? "";
        if ($rec) {
            return $this->update($input, $id);
        }

        return $this->create($input);
    }

    public function handleUpdateImage($data, $input)
    {
        try {
            if (request()->file('img_src')) {
                $slug = \Str::slug($data['title'] ?? "");
                $imageName = time() . '-' . $slug . '.' . $input['img_src']->extension();
                $input['img_src']->move(public_path('admin/images/banners'), $imageName);
                $input['img_src'] = $imageName;
                //delete old image when update
                if (@$data->img_src) {
                    $this->deleteImage(@$data->img_src);
                }
                return $input['img_src'];
            } else {
                return  @$data->img_src;
            }
        } catch (Exception $e) {
            return  @$data->img_src;
        }
    }

    public function deleteImage($src)
    {
        File::delete(public_path('admin/images/banners/' . @$src));
    }
}
