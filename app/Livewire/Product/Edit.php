<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Product $product;
    public $title;
    public $description;
    public $status;
    public $images;
    public $variants = [];
    public $existingImages;
    public $tag_ids;
    public $tags;

    protected function rules()
    {
        return [
            'title' => ['required', 'string', 'max:50'],
            'description'  => ['required', 'string', 'max:50'],
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'status' => ['required', 'boolean'],
            'variants' => ['required', 'array', 'min:1'],
            'variants.*.title' => ['required', 'string', 'max:50'],
            'variants.*.price' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'variants.*.sku' => ['required', 'string', 'max:50'],
        ];
    }


    public function mount(Product $product)
    {
        $this->product = $product;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->status = $product->status;
        $this->existingImages = $product->getMedia('products');
        $this->tag_ids = $product->tags()->pluck('tags.id')->toArray();
        $this->tags = Tag::all();
        foreach ($product->variants as $variant) {
            $this->variants[] = [
                'title' => $variant->title,
                'price' => $variant->price,
                'sku' => $variant->sku,
            ];
        }
    }
    public function addVariant()
    {
        $this->variants[] = ['title' => '', 'price' => '', 'sku' => ''];
    }

    public function removeVariant($i)
    {
        if (count($this->variants) <= 1) {
            return;
        }
        unset($this->variants[$i]);
        $this->variants = array_values($this->variants);
    }


    public function render()
    {
        return view('livewire.product.edit');
    }

    public function submit()
    {
        $finalTagIds = [];
        foreach ($this->tag_ids as $value) {

            if (is_numeric($value)) {
                $finalTagIds[] = $value;
            } else {

                $newTag = Tag::create(['name' => $value]);
                $finalTagIds[] = $newTag->id;

                $this->tags->push($newTag);
            }
        }
        $this->validate();
        $this->product->update([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ]);
        if($this->images) {
            $this->product->clearMediaCollection('products');

            foreach ($this->images as $image) {
                $this->product
                    ->addMedia($image)
                    ->toMediaCollection('products');
            }
        }
        $this->product->tags()->sync($finalTagIds);

        $this->product->variants()->delete();

        foreach ($this->variants as $variant) {
            $this->product->variants()->create([
                'title' => $variant['title'],
                'price' => $variant['price'],
                'sku'   => $variant['sku'] ?? null,
            ]);
        }

        session()->flash('status', 'Product Edited Successfully..');

        $this->redirectRoute('product.index');
    }
}
