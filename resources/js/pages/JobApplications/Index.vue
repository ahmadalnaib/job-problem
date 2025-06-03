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

            <!-- Main: Application Details -->
            <div class="relative flex h-full flex-1 flex-col overflow-y-auto p-8">
                <div v-if="selected" class="flex h-full flex-col">
                    <!-- Modern Details Card -->
                    <div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-200 text-3xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 01-8 0M12 3v4m0 0a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4h1a4 4 0 014 4z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ selected.position }}
                                    <span class="font-normal text-gray-400">@</span>
                                    {{ selected.company }}
                                </h2>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                        📅 {{ formatDate(selected.applied_at) }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                        🏢 {{ selected.company }}
                                    </span>
                                </div>
                            </div>
                            <span
                                v-if="selected.status"
                                :class="[
                                    'ml-auto px-3 py-1 rounded-full text-xs font-semibold uppercase',
                                    selected.status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '',
                                    selected.status === 'accepted' ? 'bg-green-100 text-green-700' : '',
                                    selected.status === 'rejected' ? 'bg-red-100 text-red-700' : '',
                                    !['pending', 'accepted', 'rejected'].includes(selected.status) ? 'bg-gray-100 text-gray-700' : '',
                                ]"
                            >
                                {{ selected.status }}
                            </span>
                        </div>
                        <div class="rounded-2xl border border-gray-100 bg-gradient-to-br from-gray-50 to-white p-6 shadow dark:border-gray-800 dark:from-gray-950 dark:to-gray-900">
                            <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 01-8 0M12 3v4m0 0a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4h1a4 4 0 014 4z" />
                                </svg>
                                Application Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 text-sm text-gray-700 dark:text-gray-300">
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
                                    <a :href="selected.job_link" target="_blank" class="text-blue-600 underline hover:text-blue-800 break-all">
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
                            :href="`/job-applications/${selected.id}/edit`"
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
                            @click="deleteApplication(selected.id)"
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