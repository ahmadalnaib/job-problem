<template>
    <AppLayout>
        <div class="container mx-auto flex h-[70vh] overflow-hidden rounded-xl bg-white px-2 py-10 shadow dark:bg-gray-900">
            <!-- Sidebar: Applications List -->
            <div class="flex w-1/3 flex-col overflow-y-auto border-r border-gray-200 dark:border-gray-800">
                <div class="flex items-center justify-between px-4 pt-4 pb-2">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100">Job Applications</h2>
                    <Link
                        href="/job-applications/create"
                        class="ml-2 rounded bg-gray-900 px-3 py-1 text-sm font-medium text-white shadow transition hover:bg-gray-800"
                    >
                        + New
                    </Link>
                </div>
                <ul class="flex-1">
                    <li
                        v-for="application in jobApplications"
                        :key="application.id"
                        @click="selectApplication(application)"
                        :class="[
                            'cursor-pointer border-b border-gray-100 px-4 py-3 transition hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-800',
                            selected && selected.id === application.id ? 'bg-gray-100 font-semibold dark:bg-gray-800' : '',
                        ]"
                    >
                        <div class="flex items-center justify-between">
                            <span>{{ application.position }}</span>
                            <span
                                :class="[
                                    'ml-2 rounded-full px-2 py-0.5 text-xs font-semibold uppercase',
                                    application.status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '',
                                    application.status === 'accepted' ? 'bg-green-100 text-green-700' : '',
                                    application.status === 'rejected' ? 'bg-red-100 text-red-700' : '',
                                    !['pending', 'accepted', 'rejected'].includes(application.status) ? 'bg-gray-100 text-gray-700' : '',
                                ]"
                            >
                                {{ application.status }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-500">{{ application.company }}</div>
                        <div class="mt-1 text-xs text-gray-400">{{ formatDate(application.applied_at) }}</div>
                    </li>
                </ul>
            </div>

            <!-- Main: Application Details (Timeline Style) -->
            <div class="relative flex h-full flex-1 flex-col overflow-y-auto p-8">
                <div v-if="selected" class="flex h-full flex-col">
                    <div
                        class="relative mb-8 flex flex-col overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-white md:flex-row dark:border-blue-900 dark:from-blue-950 dark:to-gray-900"
                    >
                        <!-- Timeline & Date -->
                        <div
                            class="flex flex-col items-center justify-center border-r border-blue-100 bg-white px-8 py-10 md:w-1/3 dark:border-blue-800 dark:bg-gray-900"
                        >
                            <div class="flex flex-col items-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-600 text-white shadow">
                                    <!-- Briefcase Icon -->
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="size-8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z"
                                        />
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <div class="mb-1 text-xs font-semibold tracking-wider text-blue-700 uppercase dark:text-blue-200">Applied</div>
                                    <div class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ formatDate(selected.applied_at) }}</div>
                                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">{{ selected.company }}</div>
                                </div>
                            </div>
                        </div>
                        <!-- Details -->
                        <div class="flex flex-1 flex-col p-8">
                            <div class="mb-4 flex items-center gap-4">
                                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">
                                    {{ selected.position }}
                                    <span class="font-normal text-gray-400">@</span>
                                    {{ selected.company }}
                                </h2>
                                <span
                                    v-if="selected.status"
                                    :class="[
                                        'ml-auto rounded-full px-3 py-1 text-xs font-semibold uppercase',
                                        selected.status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '',
                                        selected.status === 'accepted' ? 'bg-green-100 text-green-700' : '',
                                        selected.status === 'rejected' ? 'bg-red-100 text-red-700' : '',
                                        !['pending', 'accepted', 'rejected'].includes(selected.status) ? 'bg-gray-100 text-gray-700' : '',
                                    ]"
                                >
                                    {{ selected.status }}
                                </span>
                            </div>
                            <div class="mb-4 grid grid-cols-1 gap-x-8 gap-y-2 text-sm text-gray-700 md:grid-cols-2 dark:text-gray-300">
                                <div>
                                    <span class="font-semibold">Company:</span>
                                    <span>{{ selected.company }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold">Position:</span>
                                    <span>{{ selected.position }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold">Applied At:</span>
                                    <span>{{ formatDate(selected.applied_at) }}</span>
                                </div>
                                <div v-if="selected.job_link">
                                    <span class="font-semibold">Job Link:</span>
                                    <a :href="selected.job_link" target="_blank" class="break-all text-blue-600 underline hover:text-blue-800">
                                        {{ selected.job_link }}
                                    </a>
                                </div>
                                <div v-if="selected.note" class="md:col-span-2">
                                    <span class="font-semibold">Notes:</span>
                                    <span class="block whitespace-pre-line">{{ selected.note }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Action buttons fixed at the bottom right -->
                    <div class="mt-auto flex justify-end gap-2 pt-6">
                        <Link
                            :href="`/job-applications/${selected.slug}/edit`"
                            class="flex items-center gap-1 rounded-full bg-blue-50 px-4 py-2 font-medium text-blue-900 transition hover:bg-blue-100 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800"
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
                            @click="deleteApplication(selected.slug)"
                            class="flex items-center gap-1 rounded-full bg-blue-50 px-4 py-2 font-medium text-red-600 transition hover:bg-blue-100 dark:bg-blue-900 dark:text-red-400 dark:hover:bg-blue-800"
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
                    <span>Select an application to view details</span>
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
    jobApplications: Array,
});

const selected = ref(null);

// Automatically select the first application when available
watchEffect(() => {
    if (!selected.value && props.jobApplications.length > 0) {
        selected.value = props.jobApplications[0];
    }
});

const selectApplication = (application) => {
    selected.value = application;
};

const formatDate = (dateStr) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateStr).toLocaleDateString(undefined, options);
};

const deleteApplication = (id) => {
    if (confirm('Are you sure you want to delete this application?')) {
        router.delete(`/job-applications/${id}`);
        if (selected.value && selected.value.id === id) {
            selected.value = null;
        }
    }
};
</script>
