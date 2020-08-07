<?php

namespace OZiTAG\Tager\Backend\Administrators\Controllers;

use Illuminate\Session\Store;
use OZiTAG\Tager\Backend\Administrators\Features\DeleteAdminFeature;
use OZiTAG\Tager\Backend\Administrators\Features\ListAdminFeature;
use OZiTAG\Tager\Backend\Administrators\Features\StoreAdminFeature;
use OZiTAG\Tager\Backend\Administrators\Features\UpdateAdminFeature;
use OZiTAG\Tager\Backend\Administrators\Features\ViewAdminFeature;
use OZiTAG\Tager\Backend\Core\Controllers\Controller;

class AdminsController extends Controller
{
    public function index()
    {
        return $this->serve(ListAdminFeature::class);
    }

    public function store()
    {
        return $this->serve(StoreAdminFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateAdminFeature::class, [
            'id' => $id
        ]);
    }

    public function view($id)
    {
        return $this->serve(ViewAdminFeature::class, [
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteAdminFeature::class, [
            'id' => $id
        ]);
    }
}
