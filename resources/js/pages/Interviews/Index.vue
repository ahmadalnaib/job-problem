<template>
    <Head title="Interviews" />
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
        isToday(interview.scheduled_at) ? 'bg-yellow-100' : ''
    ]"
>
    <div class="flex items-center justify-between">
        <span>{{ interview.job_application.position }}</span>
        <span class="ml-2 text-xs text-gray-500">
            {{ formatDate(interview.scheduled_at) }}
            <span
                v-if="isToday(interview.scheduled_at)"
                class="ml-2 font-bold text-red-600"
            >
                Today
            </span>
        </span>
    </div>
    <div class="text-xs text-gray-500">{{ interview.job_application.company }}</div>
</li>
                </ul>
            </div>

            <!-- Main: Interview Details -->
            <div class="flex h-full flex-1 flex-col overflow-y-auto p-6">
                <div v-if="selected" class="flex h-full flex-col">
                    <!-- Interview Timeline Card -->
                    <div
                        class="relative mb-8 flex flex-col overflow-hidden rounded-2xl bg-gradient-to-br from-purple-50 to-white md:flex-row dark:border-purple-900 dark:from-purple-950 dark:to-gray-900"
                    >
                        <!-- Timeline & Date -->
                        <div
                            class="flex flex-col items-center justify-center border-r border-purple-100 bg-white px-8 py-10 md:w-1/3 dark:border-purple-800 dark:bg-gray-900"
                        >
                            <div class="flex flex-col items-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-purple-600 text-white shadow">
                                    <!-- Calendar Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <div class="mb-1 text-xs font-semibold tracking-wider text-purple-700 uppercase dark:text-purple-200">
                                        Scheduled
                                    </div>
                                    <div class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ formatDate(selected.scheduled_at) }}</div>
                                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">{{ selected.location }}</div>
                                </div>
                                <div class="mt-6 w-full">
                                    <div
                                        v-if="selected.remind_me"
                                        class="flex items-center gap-2 rounded-xl bg-purple-100 px-4 py-2 shadow dark:bg-purple-900"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-purple-500"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                            />
                                        </svg>
                                        <span class="text-xs font-semibold text-purple-700 dark:text-purple-200">Remind Me:</span>
                                        <span class="text-xs text-gray-700 dark:text-gray-200">{{ formatDate(selected.remind_me, false) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Details -->
                        <div class="flex flex-1 flex-col p-8">
                            <div class="mb-4 flex items-center gap-4">
                                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">
                                    {{ selected.job_application.position }}
                                    <span class="font-normal text-gray-400">@</span>
                                    {{ selected.job_application.company }}
                                </h2>
                                <span
                                    v-if="selected.job_application.status"
                                    :class="[
                                        'ml-auto rounded-full px-3 py-1 text-xs font-semibold uppercase',
                                        selected.job_application.status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '',
                                        selected.job_application.status === 'accepted' ? 'bg-green-100 text-green-700' : '',
                                        selected.job_application.status === 'rejected' ? 'bg-red-100 text-red-700' : '',
                                        !['pending', 'accepted', 'rejected'].includes(selected.job_application.status)
                                            ? 'bg-gray-100 text-gray-700'
                                            : '',
                                    ]"
                                >
                                    {{ selected.job_application.status }}
                                </span>
                            </div>
                            <!-- Details with Icons -->
                            <div class="mb-4 grid grid-cols-1 gap-x-8 gap-y-2 text-sm text-gray-700 md:grid-cols-2 dark:text-gray-300">
                                <div class="flex items-center gap-2">
                                    <!-- Briefcase Icon -->
                                    <svg class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 6V4a3 3 0 016 0v2m2 0a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V8a2 2 0 012-2h10z"
                                        />
                                    </svg>
                                    <span class="font-semibold">Position:</span>
                                    <span>{{ selected.job_application.position }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <!-- Calendar Icon -->
                                    <svg class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>
                                    <span class="font-semibold">Applied At:</span>
                                    <span>{{ selected.job_application.applied_at }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <!-- Link Icon -->
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-10 w-10 font-extrabold text-purple-500"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"
                                        />
                                    </svg>

                                    <span class="font-semibold">Job Link:</span>
                                    <a
                                        :href="selected.job_application.job_link"
                                        target="_blank"
                                        class="break-all text-purple-600 underline hover:text-purple-800"
                                    >
                                        {{ selected.job_application.job_link }}
                                    </a>
                                </div>
                                <!-- Meeting Link -->
                                <div v-if="selected.meeting_link" class="flex items-center gap-2 md:col-span-2">
                                    <!-- Video Camera Icon -->
                                    <svg class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"
                                        />
                                    </svg>
                                    <span class="font-semibold">Meeting Link:</span>
                                    <a
                                        :href="selected.meeting_link"
                                        target="_blank"
                                        class="break-all text-purple-600 underline hover:text-purple-800"
                                    >
                                        {{ selected.meeting_link }}
                                    </a>
                                </div>
                                <div v-if="selected.job_application.note" class="flex items-center gap-2 md:col-span-2">
                                    <!-- Note Icon -->
                                    <svg class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8h-6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v7m-2 5l5-5"
                                        />
                                    </svg>
                                    <span class="font-semibold">Notes:</span>
                                    <span class="block whitespace-pre-line">{{ selected.job_application.note }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Action buttons -->
                    <div class="mt-auto flex justify-end gap-2 pt-6">
                        <Link
                            :href="`/interviews/${selected.slug}/edit`"
                            class="flex items-center gap-1 rounded-full bg-purple-50 px-4 py-2 font-medium text-purple-900 transition hover:bg-purple-100 dark:bg-purple-900 dark:text-purple-200 dark:hover:bg-purple-800"
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
                            @click="deleteInterview(selected.slug)"
                            class="flex items-center gap-1 rounded-full bg-purple-50 px-4 py-2 font-medium text-red-600 transition hover:bg-purple-100 dark:bg-purple-900 dark:text-red-400 dark:hover:bg-purple-800"
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
import { Head, Link, router } from '@inertiajs/vue3';
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

function isToday(dateString) {
    if (!dateString) return false;
    const date = new Date(dateString.replace(' ', 'T'));
    const today = new Date();
    return (
        date.getDate() === today.getDate() &&
        date.getMonth() === today.getMonth() &&
        date.getFullYear() === today.getFullYear()
    );
}

function formatDate(dateString, showTime = true) {
    if (!dateString) return ''; // Prevents error if dateString is null/undefined
    const isoUtcString = dateString.replace(' ', 'T') ;
    const date = new Date(isoUtcString);
    const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        ...(showTime && { hour: '2-digit', minute: '2-digit' }),
    };
    return date.toLocaleString(undefined, options);
}

const deleteInterview = (id) => {
    if (confirm('Are you sure you want to delete this interview?')) {
        router.delete(`/interviews/${id}`, {
            onSuccess: () => {
                // Find the index of the deleted interview
                const idx = props.interviews.findIndex((i) => i.id === id || i.slug === id);
                // Select the next interview if available
                if (props.interviews.length > 1) {
                    // Try to select the next one, or previous if last
                    const nextIdx = idx < props.interviews.length - 1 ? idx + 1 : idx - 1;
                    selected.value = props.interviews[nextIdx];
                } else {
                    // No interviews left, refresh the page or clear selection
                    selected.value = null;
                    router.reload();
                }
            },
        });
    }
};
</script>
