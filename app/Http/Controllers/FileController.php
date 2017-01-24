<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\FileRepository;

class FileController extends Controller
{
    /**
     * The file repository instance.
     *
     * @var FileRepository
     */
    protected $files;

    /**
     * Create a new controller instance.
     *
     * @param  FileRepository  $files
     * @return void
     */
    public function __construct(FileRepository $files)
    {
      $this->middleware('auth');
      $this->files = $files;
    }

    /**
    * Create a new file.
    *
    * @param  Request  $request
    * @return Response
    */
   public function store(Request $request)
   {
     $this->validate($request, [
       'path' => 'required|max:500',
       'name' => 'string|max:255',
     ]);

     $request->files()->create([
       'name' => $request->name,
       'path' => $request->path,
     ]);
   }

}
