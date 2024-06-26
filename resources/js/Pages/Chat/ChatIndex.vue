<script setup>
import { ref, onMounted, computed } from "vue";
import ChatLayout from "@/Layouts/ChatLayout.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, Link } from "@inertiajs/vue3";
import ChatContent from "@/Components/ChatContent.vue";
import Skeleton from "@/Components/Skeleton.vue";

const promtInput = ref(null);
const chatContainer = ref(null);
const showDeleteButton = ref(false);
const instruction = ref("");

const props = defineProps({
    messages: Array,
    chat: null | Object,
});

const form = useForm({
    promt: "",
});

const submit = () => {
    const url = props.chat ? `/chat/${props.chat?.id}` : "/chat";
    form.post(url, {
        onFinish: () => clear(),
    });
};

const handleFileUpload = (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = (e) => {
        form.promt = instruction.value + e.target.result;
        submit();
    };

    reader.readAsText(file);
};

const scrollToBottom = () => {
    if (props.chat) {
        const el = chatContainer.value;
        el.scrollTop = el.scrollHeight;
    }
};

const clear = () => {
    form.promt = "";
    promtInput.value.focus();
    scrollToBottom();
};
onMounted(() => {
    clear();
});

const title = computed(() => props.chat?.context[0].content ?? "New Chat");
</script>
<template>
    <AdminLayout title="Chatbot">
        <ChatLayout>
            <template #aside>
                <ul class="p-2">
                    <li
                        v-if="chat"
                        class="px-4 py-2 my-2 flex justify-between font-semibold text-green-400 bg-slate-900 hover:bg-slate-700 rounded-lg duration-200"
                    >
                        <Link href="/chat" class="w-full">New Chat</Link>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4.5v15m7.5-7.5h-15"
                            />
                        </svg>
                    </li>
                    <template v-for="message in messages" :key="message.id">
                        <li
                            :class="[
                                message.id === chat?.id
                                    ? 'bg-slate-700'
                                    : 'bg-slate-900',
                                'px-4 py-2 my-2 flex justify-between font-semibold text-slate-400 hover:bg-slate-700 rounded-lg duration-200',
                            ]"
                        >
                            <Link :href="`/chat/${message.id}`">{{
                                message.context[0].content
                            }}</Link>
                            <div v-if="message.id === chat?.id">
                                <button
                                    v-if="!showDeleteButton"
                                    @click="
                                        showDeleteButton = !showDeleteButton
                                    "
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6 text-red-300"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                        />
                                    </svg>
                                </button>
                                <span
                                    v-if="showDeleteButton"
                                    class="flex justify-between"
                                >
                                    <Link
                                        :href="route('chat.destroy', chat?.id)"
                                        method="DELETE"
                                        as="button"
                                        class="text-red-300 hover:text-red-500"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M4.5 12.75l6 6 9-13.5"
                                            />
                                        </svg>
                                    </Link>

                                    <button
                                        @click="showDeleteButton = false"
                                        class="text-slate-300 hover:text-slate-500"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </li>
                    </template>
                </ul>
            </template>
            <div class="w-full flex text-white">
                <template v-if="chat">
                    <div class="w-full flex h-screen bg-slate-900">
                        <div
                            class="w-full overflow-auto pb-36"
                            ref="chatContainer"
                        >
                            <template
                                v-for="(content, index) in chat?.context"
                                :key="index"
                            >
                                <ChatContent :content="content" />
                            </template>
                            <Skeleton v-show="form.processing" />
                        </div>
                    </div>
                </template>
            </div>
            <template #form>
                <section class="px-6 top-0">
                    <div class="w-full">
                        <div class="relative flex-1 flex items-center">
                            <input
                                type="file"
                                class="w-full bg-gray-200 border text-blue-600 dark:bg-transparent dark:text-white"
                                @change="handleFileUpload"
                                :disabled="form.processing"
                                ref="promtInput"
                            />
                            <div
                                class="ml-2"
                                :class="{ 'animate-bounce': form.processing }"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 text-white"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </section>
            </template>
        </ChatLayout>
    </AdminLayout>
</template>
<style>
.dot-typing {
    position: relative;
    left: -9999px;
    width: 10px;
    height: 10px;
    border-radius: 5px;
    background-color: #9880ff;
    color: #9880ff;
    box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
        10014px 0 0 0 #9880ff;
    animation: dot-typing 1.5s infinite linear;
}

@keyframes dot-typing {
    0% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
            10014px 0 0 0 #9880ff;
    }

    16.667% {
        box-shadow: 9984px -10px 0 0 #9880ff, 9999px 0 0 0 #9880ff,
            10014px 0 0 0 #9880ff;
    }

    33.333% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
            10014px 0 0 0 #9880ff;
    }

    50% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px -10px 0 0 #9880ff,
            10014px 0 0 0 #9880ff;
    }

    66.667% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
            10014px 0 0 0 #9880ff;
    }

    83.333% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
            10014px -10px 0 0 #9880ff;
    }

    100% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
            10014px 0 0 0 #9880ff;
    }
}
</style>
