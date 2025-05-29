<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

defineProps({
    nextInterviews: Array,
    jobCount: Number,
    statusCounts: Object,
});
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>
<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-xl bg-white p-4 shadow dark:bg-gray-900">
                    <h2 class="text-lg font-semibold">Jobs Applied</h2>
                    <p class="text-2xl">{{ jobCount }}</p>
                </div>
                <!-- Upcoming Interviews Section (scrollable) -->
                <div class="rounded-xl bg-white p-4 shadow dark:bg-gray-900">
                    <h2 class="mb-4 text-lg font-semibold">Upcoming Interviews (This Month)</h2>

                    <div class="flex space-x-4 overflow-x-auto pb-2">
                        <Link
                            v-for="interview in nextInterviews"
                            :key="interview.id"
                            :href="`/interviews/${interview.id}`"
                            class="group min-w-[280px] flex-shrink-0 rounded-lg border border-gray-200 bg-gray-50 p-4 transition hover:border-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:hover:border-blue-400"
                        >
                            <div class="mb-1 flex items-center justify-between">
                                <h3 class="text-md font-bold text-blue-600 group-hover:underline dark:text-blue-400">
                                    {{ interview.job_application?.position }} @ {{ interview.job_application?.company }}
                                </h3>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ new Date(interview.scheduled_at).toLocaleDateString() }}
                                </span>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">📍 {{ interview.location }}</div>
                        </Link>
                    </div>

                    <p v-if="!nextInterviews.length" class="mt-2 text-sm text-gray-500 dark:text-gray-400">No interviews scheduled for this month.</p>
                </div>

                <div class="rounded-xl bg-white p-4 shadow dark:bg-gray-900">
                    <h2 class="mb-2 text-lg font-semibold">Status Chart</h2>
                    <canvas ref="chartRef" height="150"></canvas>
                </div>
            </div>

            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
