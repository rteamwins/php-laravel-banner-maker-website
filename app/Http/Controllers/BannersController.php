<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use Response;
use File;

class BannersController extends Controller
{
    /**
     * Show all banners.
     *
     * @return Response
     */
    public function index() {

        // Get the user's saved images.
        $savedimages = Banner::where('userid', Session::get('user')->userid)->orderBy('id', 'asc')->get();

        // Get the image library tree.
        $directory = "images/editorimages";
        $tree = $this->fileTree($directory);
//echo $tree;
//exit;
        return view('pages.banners', compact('tree', 'savedimages'));
    }

    /**
     * Download banner.
     *
     * @return Response
     */
    public function getbanner(Request $request) {

        //Get the base-64 string from data
        $img_val = $request->get('img_val');

        $filteredData = substr($img_val, strpos($img_val, ",")+1);
        //Decode the string
        $unencodedData = base64_decode($filteredData);

        //Save the image with a random filename.
        $dlfilelong = md5(rand(0,9999999));
        $dlfileshort = substr($dlfilelong, 0, 12);
        $today = date("YmdHis");
        $dlfile = $today . $dlfileshort . ".png";
        $dlfilepath = 'mybanners/' . $dlfile;

        // write the file to the server.
        file_put_contents('mybanners/' . $dlfile, $unencodedData);

        // save image into the banners database table.
        $banner = new Banner();
        $banner->userid = Session::get('user')->userid;
        $banner->htmlcode = trim($request->get('htmlcode'));
        $banner->filename = $dlfile;
        $banner->width =$request->get('img_width');
        $banner->height =$request->get('img_height');
        $banner->bgcolor = $request->get('img_bgcolor');
        $banner->bgimage = $request->get('img_bgimage');
        $banner->bordercolor = $request->get('img_bordercolor');
        $banner->borderwidth = $request->get('img_borderwidth');
        $banner->borderstyle = $request->get('img_borderstyle');
        $banner->save();

        // open a download open/save dialog box for the user to download the file.
        $headers = array('Content-Type: image/png');
        return Response::download($dlfilepath, $dlfile, $headers);
    }

    /**
     * Build the directory and file tree for the image library.
     *
     * @param $directory  the top root directory folder.
     * @return $tree  The tree structure to use in the view.
     */
    public function fileTree($directory) {
        $tree = '';
        // get all top level folders:
        $directories = File::directories($directory);
        foreach ($directories as $directory_fullpath) {
            $directory_fullpath_array = explode("/", $directory_fullpath);
            $directory = end($directory_fullpath_array);
            $tree .= '<div class="imagefolder">' . $directory . '</div>';
            // get subdirectories and files recursively that are in the top folder:
            $tree .= $this->fileTree($directory_fullpath);
            // get all files in the top folder(directory);
            $files = File::allFiles($directory_fullpath);
            foreach($files as $file_fullpath) {
                $extension = File::extension($file_fullpath);
                if ($extension === 'gif' || $extension === 'png' || $extension === 'jpg' || $extension === 'jpeg') {
                    $file_fullpath_array = explode("/", $file_fullpath);
                    $file = end($file_fullpath_array);
                    //$tree .= '<li>' . $file . '</li>';
                    $tree .= '<div class="imagename"><img src="' . $file_fullpath . '" style="width: 50px;"></div>';
                }
            }
        }
        $tree .= rtrim($tree, ',');
        return $tree;
    }

    /**
     * Display the specified image.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Request $request)
    {
        // get the page content for this id.
        $banner = Banner::find($id);
        return $banner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $banner = Banner::find($id);
        return "update function";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $banner = Banner::find($id);
        // delete the file:
        $filename = $banner->filename;
        $filepath = 'mybanners/' . $filename;
        File::delete($filepath);
        // delete the record:
        $banner->delete();
        return $banner;
    }


}


