<div class="py-2">
    @foreach (range(1, 4) as $index)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="idea-container bg-white rounded-xl flex mt-5">
                <div class="border-r border-gray-100 px-5 py-8">
                    <div class="flex items-center justify-center bg-gray-200 w-14 h-14 rounded-xl animate-pulse">

                    </div>
                </div>
                <div class="flex flex-col justify-between px-4 py-6">
                    <div class="mt-2">
                        <div class="h-4 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[640px] mb-4 mx-auto"></div>
                    </div>
                    <div class="text-gray-600 mt-3">
                        <div class="animate-pulse h-4 mx-auto bg-gray-200 rounded-full  max-w-[540px]"></div>
                        <div class="animate-pulse h-4 mx-auto bg-gray-200 rounded-full  max-w-[540px]"></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
