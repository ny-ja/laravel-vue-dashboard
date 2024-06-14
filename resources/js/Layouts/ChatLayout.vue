<script setup></script>
<template>
    <aside
        class="ml-[-100%]z-10 top-0 pb-3 px-4 w-full flex flex-col justify-between h-[65vh] border dark:border-gray-600 shadow-2xl bg-transparent bg-opacity-70 transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]"
    >
        <div>
            <slot name="aside" />
        </div>
    </aside>
    <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
        <div class="pt-6">
            <main>
                <slot />
            </main>
        </div>
        <div
            class="z-20 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] bottom-0 h-28 bg-transparent bg-opacity-70 shadow-2xl lg:py-2.5 dark:shadow-md"
        >
            <slot name="form" />
        </div>
    </div>
</template>