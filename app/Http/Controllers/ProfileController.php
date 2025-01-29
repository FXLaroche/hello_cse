<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;
use Orion\Http\Requests\Request;

class ProfileController extends Controller
{
    use DisableAuthorization;

    protected $model = Profile::class;


    public function buildIndexFetchQuery(Request $request, array $requestedRelations) : Builder 
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        
        if($request->getUser()) {
            Auth::basic();
        }

        return $query->select(['firstname', 'lastname'])
        ->when(Auth::check(), function (Builder $query) {
            $query->addSelect('status');
        })
        ->where('status', 'active');
    }
}
