<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $status;
    public $images;
    public $variants = [['title' => '', 'price' => '', 'sku' => '']];
    public $tags = [];
    public $tag_ids;

    protected function rules()
    {
        return [
            'title' => ['required', 'string', 'max:50'],
            'description'  => ['required', 'string', 'max:50'],
            'images' => ['required', 'array'],
            'images.*' => ['file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'status' => ['required', 'boolean'],
            'variants' => ['required', 'array', 'min:1'],
            'variants.*.title' => ['required', 'string', 'max:50'],
            'variants.*.price' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'variants.*.sku' => ['required', 'string', 'max:50'],
        ];
    }


    public function mount()
    {
        $this->tags = Tag::all();
    }

    public function addVariant()
    {
        $this->variants[] = ['title' => '', 'price' => '', 'sku' => ''];
    }

    public function render()
    {
        return view('livewire.product.create');
    }


    public function removeVariant($i)
    {
        if (count($this->variants) <= 1) {
            return;
        }
        unset($this->variants[$i]);
        $this->variants = array_values($this->variants);
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
        $product = Product::create([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        foreach ($this->images as $image) {
            $product
                ->addMedia($image)
                ->toMediaCollection('products');
        }
        $product->tags()->sync($finalTagIds);

        foreach ($this->variants as $variant) {
            $product->variants()->create([
                'title' => $variant['title'],
                'price' => $variant['price'],
                'sku' => $variant['sku'],
            ]);
        }

        $this->title = '';
        $this->description = '';
        $this->images = '';
        $this->variants = [['title' => '', 'price' => '', 'sku' => '']];
        $this -> status = '';


        session()->flash('status', 'Product Created.');

        $this->redirectRoute('product.index');

    }
}
