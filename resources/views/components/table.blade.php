<div class="flex flex-col justify-center h-full">
    <!-- Table -->
    <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
        <header class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">Customers</h2>
        </header>
        <div class="p-3">
            <div class="overflow-x-auto">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
</section>
</div>