{{-- alert session info --}}
@if(session()->has('error'))
<div class="w-full my-2 relative flex flex-col space-y-2 items-center justify-center" x-data="{ open: true }">
    <div class="px-7 py-5 flex items-center justify-between w-full  rounded-md bg-red-400" x-show="open">
        <div class="flex items-center space-x-3 ">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                  </svg>
            </div>
            <div>
                <h3 class="text-gray-800 text-lg font-medium">{{ session()->get('error') }}</h3>
            </div>
        </div>
        <div class="flex items-center">
            <button type="button" class="focus:outline-none" @click="open = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
            </button>
        </div>
    </div>
</div>
@endif
@if(session()->has('success'))
<div class="w-full my-2 relative flex flex-col space-y-2 items-center justify-center" x-data="{ open: true }">
    <div class="px-7 py-5 flex items-center justify-between w-full  rounded-md bg-green-400" x-show="open">
        <div class="flex items-center space-x-3 ">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
            </div>
            <div>
                <h3 class="text-gray-800 text-lg font-medium">{{ session()->get('success') }}</h3>
            </div>
        </div>
        <div class="flex items-center">
            <button type="button" class="focus:outline-none" @click="open = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
            </button>
        </div>
    </div>
</div>
@endif