<template>
    <AppLayout>
        <div class="container mx-auto flex h-[70vh] overflow-hidden rounded-xl bg-white px-2 py-10 shadow dark:bg-gray-900">
            <!-- Sidebar: Interviews List -->
            <div class="flex w-1/3 flex-col overflow-y-auto border-r border-gray-200 dark:border-gray-800">
                <div class="flex items-center justify-between px-4 pt-4 pb-2">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100">Interviews</h2>
                    <Link
                        href="/interviews/create"
                        class="ml-2 rounded bg-gray-900 px-3 py-1 text-sm font-medium text-white shadow transition hover:bg-gray-800"
                    >
                        + New
                    </Link>
                </div>
                <ul class="flex-1">
                    <li
                        v-for="interview in interviews"
                        :key="interview.id"
                        @click="selectInterview(interview)"
                        :class="[
                            'cursor-pointer border-b border-gray-100 px-4 py-3 transition hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-800',
                            selected && selected.id === interview.id ? 'bg-gray-100 font-semibold dark:bg-gray-800' : '',
                        ]"
                    >
                        <div class="flex items-center justify-between">
                            <span>{{ interview.job_application.position }}</span>
                            <span class="ml-2 text-xs text-gray-500">{{ formatDate(interview.scheduled_at) }}</span>
                        </div>
                        <div class="text-xs text-gray-500">{{ interview.job_application.company }}</div>
                    </li>
                </ul>
            </div>

            <!-- Main: Interview Details -->
            <div class="flex h-full flex-1 flex-col overflow-y-auto p-6">
                <div v-if="selected" class="flex h-full flex-col">
                    <div>
                        <h2 class="mb-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                            {{ selected.job_application.position }}
                            <span class="font-normal text-gray-400">@</span>
                            {{ selected.job_application.company }}
                        </h2>
                        <div class="mb-4 flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700 dark:bg-gray-800 dark:text-gray-300"
                            >
                                📅 {{ formatDate(selected.scheduled_at) }}
                            </span>
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700 dark:bg-gray-800 dark:text-gray-300"
                            >
                                📍 {{ selected.location }}
                            </span>
                        </div>

                        <!-- Job Application Details -->
                        <div class="mt-4 mb-6 rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-950">
                            <h3 class="mb-2 text-lg font-semibold text-gray-800 dark:text-gray-100">Job Application</h3>
                            <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                                <li>
                                    <span class="font-semibold">Company:</span>
                                    {{ selected.job_application.company }}
                                </li>
                                <li>
                                    <span class="font-semibold">Position:</span>
                                    {{ selected.job_application.position }}
                                </li>
                                <li>
                                    <span class="font-semibold">Status:</span>
                                    {{ selected.job_application.status }}
                                </li>
                                <li>
                                    <span class="font-semibold">Applied At:</span>
                                    {{ selected.job_application.applied_at }}
                                </li>
                                <li>
                                    <span class="font-semibold">job link:</span>
                                    <a :href="selected.job_application.job_link" target="_blank" class="text"> {{ selected.job_application.job_link }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Action buttons fixed at the bottom right -->
                    <div class="mt-auto flex justify-end gap-2 pt-6">
                        <Link
                            :href="`/interviews/${selected.id}/edit`"
                            class="flex items-center gap-1 rounded-full bg-gray-100 px-4 py-2 font-medium text-gray-900 transition hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
                            title="Edit"
                        >
                            <!-- Heroicon: Pencil Square -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16.862 3.487a2.25 2.25 0 113.182 3.182l-10.5 10.5a2.25 2.25 0 01-1.06.592l-4.5 1a.75.75 0 01-.91-.91l1-4.5a2.25 2.25 0 01.592-1.06l10.5-10.5z"
                                />
                            </svg>
                            Edit
                        </Link>
                        <button
                            @click="deleteInterview(selected.id)"
                            class="flex items-center gap-1 rounded-full bg-gray-100 px-4 py-2 font-medium text-red-600 transition hover:bg-gray-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                            title="Delete"
                        >
                            <!-- Heroicon: Trash -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
                <div v-else class="flex h-full items-center justify-center text-gray-400">
                    <span>Select an interview to view details</span>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue';

const props = defineProps({
    interviews: Array,
});

const selected = ref(null);

watchEffect(() => {
    if (!selected.value && props.interviews.length > 0) {
        selected.value = props.interviews[0];
    }
});

const selectInterview = (interview) => {
    selected.value = interview;
};

const formatDate = (dateStr) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateStr).toLocaleDateString(undefined, options);
};

const deleteInterview = (id) => {
    if (confirm('Are you sure you want to delete this interview?')) {
        router.delete(`/interviews/${id}`);
    }
};
</script>
