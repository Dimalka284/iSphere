@extends('layouts.admin')

@section('content')
    <!-- Main Content -->
    <main class="flex flex-col flex-1 overflow-hidden bg-slate-50">
        <!-- Header -->
        <header class="sticky top-0 z-10 flex items-center justify-between h-16 px-8 border-b bg-white/80 glass border-slate-200">
            <div class="flex items-center gap-4">
                <a href="/dashboard" class="p-2 transition-all rounded-lg text-slate-400 hover:text-indigo-600 hover:bg-indigo-50">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <h1 class="text-xl font-bold text-slate-800">Edit Product: {{ $product->name }}</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <button type="submit" form="productForm" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl font-semibold text-sm transition-all shadow-lg shadow-indigo-100">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Update Product
                </button>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-4xl mx-auto">
                @if ($errors->any())
                    <div class="p-4 mb-6 border border-red-100 bg-red-50 rounded-2xl">
                        <div class="flex items-center gap-2 mb-2 text-red-700">
                            <i data-lucide="alert-circle" class="w-5 h-5"></i>
                            <span class="font-bold">Please fix the following errors:</span>
                        </div>
                        <ul class="pl-5 list-disc text-red-600/80 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="productForm" action="/admin/products/{{ $product->id }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info Section -->
                    <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-100">
                        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="text-lg font-bold text-slate-800">Basic Information</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-slate-700">Product Name</label>
                                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-2.5 transition-all border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/30" placeholder="e.g. iPhone 15 Pro">
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-slate-700">Category</label>
                                    <select name="category_id" required class="w-full px-4 py-2.5 transition-all border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/30">
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-slate-700">Base Price ($)</label>
                                    <div class="relative">
                                        <span class="absolute -translate-y-1/2 left-4 top-1/2 text-slate-400 font-medium">$</span>
                                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full pl-8 pr-4 py-2.5 transition-all border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/30" placeholder="999.00">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700">Description</label>
                                <textarea name="description" rows="4" class="w-full px-4 py-2.5 transition-all border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/30" placeholder="Product features and details...">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Images Section -->
                    <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-100">
                        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="text-lg font-bold text-slate-800">Product Images</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700">Image URLs (External Links)</label>
                                @php
                                    $externalUrls = $product->images->where('image_path', 'LIKE', 'http%')->pluck('image_path')->implode("\n");
                                @endphp
                                <textarea name="image_urls" rows="3" class="w-full px-4 py-2.5 transition-all border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50/30 text-sm" placeholder="https://example.com/image1.jpg&#10;https://example.com/image2.jpg&#10;(Enter one URL per line)">{{ old('image_urls', $externalUrls) }}</textarea>
                            </div>

                            <div class="p-6 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50 hover:bg-slate-50 transition-colors">
                                <div class="flex flex-col items-center text-center">
                                    <i data-lucide="upload-cloud" class="w-10 h-10 text-slate-300 mb-2"></i>
                                    <label class="block mb-1 text-sm font-bold text-slate-700">Add More Local Images</label>
                                    <p class="text-xs text-slate-400 mb-4">Leave empty to keep current local images.</p>
                                    <input type="file" name="images[]" multiple accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Variants Section -->
                    @php
                        $variants = $product->variants->map(function($v) {
                            return [
                                'color' => $v->color,
                                'storage' => $v->storage,
                                'stock' => $v->stock,
                                'price' => $v->price
                            ];
                        });
                        if ($variants->isEmpty()) {
                            $variants = [['color' => '', 'storage' => '', 'stock' => 0, 'price' => '']];
                        }
                    @endphp
                    <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-100" x-data="{ variants: {{ $variants->toJson() }} }">
                        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="text-lg font-bold text-slate-800">Product Variants</h3>
                            <button type="button" @click="variants.push({color: '', storage: '', stock: 0, price: ''})" class="flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-700 bg-indigo-50 px-4 py-2 rounded-xl transition-all">
                                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                                Add Variant
                            </button>
                        </div>
                        <div class="p-6 space-y-6">
                            <p class="text-sm text-slate-500">Define different versions like color or storage capacity.</p>
                            
                            <template x-for="(v, index) in variants" :key="index">
                                <div class="relative grid grid-cols-1 gap-4 p-5 border border-slate-100 rounded-2xl md:grid-cols-4 bg-slate-50/30">
                                    <button type="button" @click="variants.splice(index, 1)" class="absolute -top-2 -right-2 p-1.5 bg-white border border-slate-100 text-slate-400 hover:text-red-600 rounded-full shadow-sm" x-show="variants.length > 1">
                                        <i data-lucide="x" class="w-3 h-3"></i>
                                    </button>
                                    <div>
                                        <label class="block mb-1.5 text-[11px] font-bold uppercase tracking-wider text-slate-400">Color</label>
                                        <input type="text" x-model="v.color" :name="`variants[${index}][color]`" class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white" placeholder="Space Black">
                                    </div>
                                    <div>
                                        <label class="block mb-1.5 text-[11px] font-bold uppercase tracking-wider text-slate-400">Storage</label>
                                        <input type="text" x-model="v.storage" :name="`variants[${index}][storage]`" class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white" placeholder="256GB">
                                    </div>
                                    <div>
                                        <label class="block mb-1.5 text-[11px] font-bold uppercase tracking-wider text-slate-400">Stock</label>
                                        <input type="number" x-model="v.stock" :name="`variants[${index}][stock]`" class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white">
                                    </div>
                                    <div>
                                        <label class="block mb-1.5 text-[11px] font-bold uppercase tracking-wider text-slate-400">Override Price</label>
                                        <input type="number" step="0.01" x-model="v.price" :name="`variants[${index}][price]`" class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white" placeholder="Optional">
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 pb-8">
                        <button type="submit" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-3.5 rounded-2xl font-bold transition-all shadow-xl shadow-indigo-100 active:scale-95">
                            <i data-lucide="save" class="w-5 h-5"></i>
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection
