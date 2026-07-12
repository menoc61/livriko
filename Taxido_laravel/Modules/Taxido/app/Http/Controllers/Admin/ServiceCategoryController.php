<?php

namespace Modules\Taxido\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Taxido\Enums\ServicesEnum;
use Modules\Taxido\Http\Requests\Admin\UpdateServiceCategoryRequest;
use Modules\Taxido\Models\ServiceCategory;
use Modules\Taxido\Repositories\Admin\ServiceCategoryRepository;
use Modules\Taxido\Tables\ServiceCategoryTable;

class ServiceCategoryController extends Controller
{
    public $repository;

    public function __construct(ServiceCategoryRepository $repository)
    {
        $this->authorizeResource(ServiceCategory::class, 'service_category');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function cabIndex(ServiceCategoryTable $serviceCategoryTable)
    {
        request()->merge(['service' => ServicesEnum::CAB]);

        return $this->repository->index($serviceCategoryTable->generate());
    }

    /**
     * Display a listing of the resource.
     */
    public function parcelIndex(ServiceCategoryTable $serviceCategoryTable)
    {
        request()->merge(['service' => ServicesEnum::PARCEL]);

        return $this->repository->index($serviceCategoryTable->generate());
    }

    /**
     * Display a listing of the resource.
     */
    public function freightIndex(ServiceCategoryTable $serviceCategoryTable)
    {
       request()->merge(['service' => ServicesEnum::FREIGHT]);
        return $this->repository->index($serviceCategoryTable->generate());
    }

    public function finddriverIndex(ServiceCategoryTable $serviceCategoryTable)
    {
        request()->merge(['service' => ServicesEnum::FINDDRIVER]);
        return $this->repository->index($serviceCategoryTable->generate());
    }

    public function finddriverEdit(ServiceCategory $serviceCategory)
    {
       request()->merge(['service' => ServicesEnum::FINDDRIVER]);

        return view('taxido::admin.service-category.edit', ['serviceCategory' => $serviceCategory]);
    }

    /**
     * Display a listing of the resource.
     */
    public function cabEdit(ServiceCategory $serviceCategory)
    {
        request()->merge(['service' => ServicesEnum::CAB]);

        return view('taxido::admin.service-category.edit', ['serviceCategory' => $serviceCategory, 'service' => ServicesEnum::PARCEL]);
    }

    /**
     * Display a listing of the resource.
     */
    public function parcelEdit(ServiceCategory $serviceCategory)
    {
        request()->merge(['service' => ServicesEnum::PARCEL]);
        $serviceCategories = getServiceIdByServiceCategories(ServicesEnum::PARCEL);

        return view('taxido::admin.service-category.edit', ['serviceCategory' => $serviceCategory, 'service' => ServicesEnum::PARCEL]);
    }

    /**
     * Display a listing of the resource.
     */
    public function freightEdit(ServiceCategory $serviceCategory)
    {
        request()->merge(['service' => ServicesEnum::FREIGHT]);

        return view('taxido::admin.service-category.edit', ['serviceCategory' => $serviceCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceCategoryRequest $request, ServiceCategory $serviceCategory)
    {
         
        return $this->repository->update($request->all(), $serviceCategory->id);
    }

    /**
     * Change status of the specified resource.
     */
    public function status(Request $request, $id)
    {
        return $this->repository->status($id, $request->status);
    }
}
