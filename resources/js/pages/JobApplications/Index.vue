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
                        <div class="text-xs text-gray-400 mt-1">{{ formatDate(application.applied_at) }}</div>
                    </li>
                </ul>
            </div>

            <!-- Main: Application Details -->
            <div class="flex-1 overflow-y-auto p-8 flex flex-col h-full relative">
                <div v-if="selected" class="flex flex-col h-full">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ selected.position }}
                                <span class="font-normal text-gray-400">@</span>
                                {{ selected.company }}
                            </h2>
                            <span
                                :class="[
                                    'rounded-full px-3 py-1 text-xs font-semibold tracking-wide uppercase',
                                    selected.status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '',
                                    selected.status === 'accepted' ? 'bg-green-100 text-green-700' : '',
                                    selected.status === 'rejected' ? 'bg-red-100 text-red-700' : '',
                                    !['pending', 'accepted', 'rejected'].includes(selected.status) ? 'bg-gray-100 text-gray-700' : '',
                                ]"
                            >
                                {{ selected.status }}
                            </span>
                        </div>
                        <div class="mb-2 flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 dark:bg-gray-800 px-3 py-1 font-semibold text-xs text-gray-700 dark:text-gray-300">
                                📅 {{ formatDate(selected.applied_at) }}
                            </span>
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 dark:bg-gray-800 px-3 py-1 font-semibold text-xs text-gray-700 dark:text-gray-300 ">
                                🏢 {{ selected.company }}
                            </span>
                        </div>
                     
                        <!-- Description -->
                        <div class="mb-4 text-gray-700 dark:text-gray-200" v-if="selected.description">
                            <strong>Description:</strong>
                            <span class="block whitespace-pre-line">{{ selected.description }}</span>
                        </div>
                       
                        <!-- Job Link as button -->
                        <div v-if="selected.job_link" class="mb-4">
                            <a
                                :href="selected.job_link"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center gap-1 rounded px-4 py-2 text-blue-600 font-xs shadow transition"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 010 5.656m1.415-1.415a6 6 0 10-8.486-8.486 6 6 0 008.486 8.486zm-1.415 1.415L21 21" />
                                </svg>
                                View Job Link
                            </a>
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
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182l-10.5 10.5a2.25 2.25 0 01-1.06.592l-4.5 1a.75.75 0 01-.91-.91l1-4.5a2.25 2.25 0 01.592-1.06l10.5-10.5z" />
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
                    <!-- Note attached bottom left -->
                    <div class="absolute left-8 bottom-8">
                        <Link
                            v-if="selected.notes && selected.notes.length > 0"
                            :href="`/notes?job_application_id=${selected.id}`"
                            class="inline-flex items-center gap-1 rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-800 transition hover:bg-gray-300 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
                        >
                            <span class="text-base">📝</span>
                            Note attached
                        </Link>
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
import { ref, watchEffect } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

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