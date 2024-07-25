<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ClaimedItem;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ItemStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\Location;

class ItemController extends Controller
{
   public function index(Request $request)
   {
   $query = Item::query();

   if ($request->filled('search')) {
   $search = $request->input('search');
   $query->where('name', 'like', "%{$search}%")
   ->orWhere('description', 'like', "%{$search}%")
   ->orWhereHas('category', function ($q) use ($search) {
   $q->where('name', 'like', "%{$search}%");
   })
   ->orWhereHas('location', function ($q) use ($search) {
   $q->where('name', 'like', "%{$search}%");
   });
   }

   $items = $query->get();
   $categories = Category::all();
   $locations = Location::all();

   return view('home', compact('items', 'categories', 'locations'));
   }

   public function claim(Request $request)
   {
   $query = Item::query();

   if ($request->filled('search')) {
   $search = $request->input('search');
   $query->where('name', 'like', "%{$search}%")
   ->orWhere('description', 'like', "%{$search}%")
   ->orWhereHas('category', function ($q) use ($search) {
   $q->where('name', 'like', "%{$search}%");
   })
   ->orWhereHas('location', function ($q) use ($search) {
   $q->where('name', 'like', "%{$search}%");
   });
   }

   $items = $query->get();
   $categories = Category::all();
   $locations = Location::all();
   

   return view('claimIT', compact('items', 'categories', 'locations'));
   }

  public function claimItem($id)
  {
    try {
    $item = Item::findOrFail($id);

    if (!$item) {
        return redirect()->back()->with('error', 'Item not found.');
        }

  // Check if the item is already claimed
  if ($item->status == 1) {
  return redirect()->back()->with('warning', 'This item is already claimed by another user.');
  }

  // Update the status of the item to claimed (1)
  $item->status = 1;
  $item->users_id = Auth::user()->id;
  $item->save();

  ClaimedItem::create([
    'item_id' => $item->id,
    'users_id' => Auth::user()->id,
    'claimed_at' => now(),
    ]);

  return redirect()->back()->with('success', 'Item claimed successfully.');
  } catch (\Exception $e) {
  Log::error('Error claiming item: ' . $e->getMessage());
  return redirect()->back()->with('error', $e->getMessage());
  }
  }
  
   public function updateStatus(Request $request, string $id)
   {
   try {
   $item = Item::findOrFail($id);

   if (!$item) {
   return redirect()->back()->with('error', 'Item not found.');
   }

   $request->validate([
   'status' => 'required|integer|in:0,1'
   ]);

   if ($item->status == 1 && $item->users_id != Auth::user()->id) {
   return redirect()->back()->with('error', 'This item is already claimed by another user.');
   }

   $item->status = $request->status;

   if ($request->status == 1) {
   $existingClaim = ClaimedItem::where('item_id', $item->id)->first();
   if ($existingClaim) {
   return redirect()->back()->with('warning', 'You already claimed this item.');
   }

   ClaimedItem::create([
   'item_id' => $item->id,
   'users_id' => Auth::user()->id,
   'claimed_at' => now(),
   ]);

   $item->users_id = Auth::user()->id;
   } else {
   $item->users_id = null;
   }

   $item->save();

   return redirect()->back()->with('success', 'Item status successfully updated.');
   } catch (\Exception $e) {
   Log::error('Error updating item status: ' . $e->getMessage());
   return redirect()->back()->with('error', $e->getMessage());
   }
   }


    public function store(ItemStoreRequest $request)
    {
        try {
            $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();

            Item::create([
                'image' => $imageName,
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'location_id' => $request->location_id,
                'datefound' => $request->datefound,
            ]);

            Storage::disk('public')->put($imageName, file_get_contents($request->image));

            return redirect()->back()->with('success', 'Item successfully created.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit($id)
    {
    $item = Item::findOrFail($id);
    $categories = Category::all();
    $locations = Location::all();

    return view('edit', compact('item', 'categories', 'locations'));
    }

    public function update(Request $request, string $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->back()->with('error', 'Item not found.');
        }
        
        try {
            $request->validate([
                'image' => 'nullable|image|max:2048',
                'name' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|required|string',
                'category_id' => 'sometimes|required|integer',
                'location_id' => 'sometimes|required|integer',
                'datefound' => 'sometimes|required|date',
            ]);

            if ($request->hasFile('image')) {
                $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                Storage::disk('public')->put($imageName, file_get_contents($request->image));
                if (Storage::disk('public')->exists($item->image)) {
                    Storage::disk('public')->delete($item->image);
                }
                $item->image = $imageName;
            }

            $item->update($request->only('name', 'description', 'category_id', 'location_id', 'datefound', 'status'));
            $item->save();

            return redirect('home')->with('success', 'Item successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $item->delete();
        return redirect()->back()->with('success', 'Item deleted successfully.');
    }

    public function search($name)
    {
        return Item::where('name', 'like', '%' . $name . '%')->get();
    }
    public function claimIT()
    {
    $items = Item::all(); // Fetch all items
    return view('claimIT', compact('items'));
    }

    
    
}
