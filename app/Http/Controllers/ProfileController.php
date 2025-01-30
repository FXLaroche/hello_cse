<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;
use Orion\Http\Requests\Request;

class ProfileController extends Controller
{
    use DisableAuthorization;

    protected $model = Profile::class;

    /* Orion documentation on hooks: https://orion.tailflow.org/guide/hooks */
    /* Spatie Media Library documentation: https://spatie.be/docs/laravel-medialibrary/v11/basic-usage/associating-files */

    protected function afterStore(Request $request, Model $entity)
    {
        $picture = $request->file('profilePicture');
        $pictureName = $picture->getClientOriginalName();
        
        $entity->addMedia($picture->path())
        ->usingName($pictureName)
        ->usingFileName($pictureName)
        ->toMediaCollection();
    }

    protected function afterUpdate(Request $request, Model $entity)
    {
        $picture = $request->file('profilePicture');

        $pictureName = $picture->getClientOriginalName();

        $entity->clearMediaCollection();
        
        $entity->addMedia($picture->path())
        ->usingName($pictureName)
        ->usingFileName($pictureName)
        ->toMediaCollection();
    }

    protected function afterIndex(Request $request, $entities) {
        $entities->each(function (Profile $profile) {
            $profile->profilePicture = $profile->getMedia();
        });
    }

    public function buildIndexFetchQuery(Request $request, array $requestedRelations) : Builder 
    {
        /* https://orion.tailflow.org/guide/models#for-individual-endpoints */

        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        
        if($request->getUser()) {
            Auth::basic();
        }

        return $query->select(['id', 'firstname', 'lastname'])
        ->when(Auth::check(), function (Builder $query) {
            $query->addSelect('status');
        })
        ->where('status', 'active');
    }
}
