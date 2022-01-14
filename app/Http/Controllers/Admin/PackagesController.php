<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    function packages()
    {
        $vendors = glob(package_path() . '/*' , GLOB_ONLYDIR);

        $packages = [];

        foreach($vendors as $vendor)
        {
            $package = [
                'vendor' => basename($vendor),
                'package' => basename(glob($vendor . '/*' , GLOB_ONLYDIR)[0]),
            ];

            array_push($packages, $package);
        }

        $data = [
            'packages' => $packages,
        ];

        return view('admin.pages.packages', $data);
    }
}
