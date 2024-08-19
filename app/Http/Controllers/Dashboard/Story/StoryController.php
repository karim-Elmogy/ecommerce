<?php

namespace App\Http\Controllers\Dashboard\Story;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoryRequest;
use App\Models\Dashboard\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $stories=Story::orderBy('order','asc')->latest()->paginate(10);
        return view('admin.pages.stories.index',get_defined_vars());
    }

    public function create()
    {
        return view('admin.pages.stories.create');
    }

    public function store(StoryRequest $request)
    {
        if (!request()->ajax()) {
            try {
                $story=Story::create(array_except($request->validated(),['image']));
                if($request->image ){
                    $imageName=upload($request->image , 'dash-img/story');
                    $story->image=$imageName;
                    $story->save();
                }
                return redirect(route('admin.story.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function edit($id)
    {
        if (!request()->ajax()) {
            try {
                $story=Story::find($id);
                return view('admin.pages.stories.edit',get_defined_vars());
            }catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }

    public function update(StoryRequest $request, $id)
    {
        if (!request()->ajax()) {
            try {
                $story = Story::find($id);
                $story->update(array_except($request->validated(), ['image']));

                if ($request->image) {
                    $imageName = upload($request->image, 'dash-img/story');
                    $story->image = $imageName;
                    $story->save();
                }

                return redirect(route('admin.story.index'))->with('toast_success', 'تم التعديل بنجاح ✌️');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }

    public function destroy($id)
    {
        $story=Story::find($id);
        if ($story) {
            $story->delete();
            return redirect(route('admin.story.index'))->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }

    public function update_story_order(Request $request){
        $cat_ids = $request->input('cateIds');
        foreach ($cat_ids as $index => $cat_id) {
            Story::where('id', $cat_id)->update(['order' => $index + 1]);
        }

        return response()->json(['message' => 'Item order updated successfully']);
    }
}
