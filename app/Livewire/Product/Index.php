<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.product.index', [
            'products' => Product::all(),
        ]);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->hasMedia('products')) {
            $product->clearMediaCollection('products');
        }

        $product->delete();

        session()->flash('status', 'Product deleted successfully.');
    }
}
