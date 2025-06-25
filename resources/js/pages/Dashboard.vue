<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Chart, registerables } from 'chart.js';
import { onMounted, ref, watch } from 'vue';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

// Register Chart.js components
Chart.register(...registerables);

// --- TypeScript interfaces for props ---
interface JobApplication {
    id: number;
    position: string;
    company: string;
}

interface Interview {
    id: number;
    slug: string;
    scheduled_at: string;
    location: string;
    job_application?: JobApplication;
}

interface Props {
    nextInterviews: Interview[];
    jobCount: number;
    statusCounts: Record<string, number>;
}

// --- Define props with types ---
const props = defineProps<Props>();

// --- Chart.js setup ---
const chartRef = ref<HTMLCanvasElement | null>(null);
let chartInstance: Chart | null = null;

function renderChart() {
    if (!chartRef.value) return;

    // Destroy previous chart if exists
    if (chartInstance) {
        chartInstance.destroy();
    }

    const labels = Object.keys(props.statusCounts);
    const data = Object.values(props.statusCounts);

    chartInstance = new Chart(chartRef.value, {
        type: 'bar',
        data: {
            labels,
            datasets: [
                {
                    label: 'Applications',
                    data,
                    backgroundColor: '#3b82f6',
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: { beginAtZero: true },
            },
        },
    });
}
function isToday(dateString: string): boolean {
    if (!dateString) return false;
    const date = new Date(dateString.replace(' ', 'T'));
    const today = new Date();
    return date.getDate() === today.getDate() && date.getMonth() === today.getMonth() && date.getFullYear() === today.getFullYear();
}

onMounted(renderChart);
watch(() => props.statusCounts, renderChart);

// --- Breadcrumbs ---
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
            <!-- Top: Jobs Applied (full width) -->
            <!-- Top: Jobs Applied (modern, clean, no extra card, just stats) -->
            <div class="mb-8 flex flex-col gap-6 md:flex-row">
                <!-- Jobs Applied Stat -->
                <div
                    class="flex flex-1 items-center justify-center rounded-2xl bg-gray-100 px-8 py-10 shadow-lg"
                >
                    <div class="flex items-center gap-5">
                        <span class="inline-flex items-center justify-center rounded-full bg-white/80 p-5 shadow">
                            <svg class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 6V4a3 3 0 016 0v2m2 0a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V8a2 2 0 012-2h10z"
                                />
                            </svg>
                        </span>
                        <div>
                            <div class="text-4xl font-extrabold text-blue-600 drop-shadow">{{ props.jobCount }}</div>
                            <div class="mt-1 text-lg font-semibold text-blue-600">Jobs Applied</div>
                        </div>
                    </div>
                </div>
                <!-- Upcoming Interviews Stat -->
                <div
                    class="flex flex-1 items-center justify-center rounded-2xl bg-gray-100 px-8 py-10 shadow-lg"
                >
                    <div class="flex items-center gap-5">
                        <span class="inline-flex items-center justify-center rounded-full bg-white/80 p-5 shadow">
                            <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                        </span>
                        <div>
                            <div class="text-4xl font-extrabold text-green-800 drop-shadow">{{ props.nextInterviews.length }}</div>
                            <div class="mt-1 text-lg font-semibold text-green-900/90">Upcoming Interviews</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bottom: Two cards side by side on md+ screens, stacked on mobile -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <!-- Upcoming Interviews Section (scrollable) -->
                <div class="rounded-xl bg-white p-4 shadow dark:bg-gray-900">
                    <h2 class="mb-4 text-lg font-semibold">Upcoming Interviews (This Month)</h2>
                    <div class="flex h-96 flex-col space-y-4 overflow-y-auto pb-2">
                        <Link
                            v-for="interview in props.nextInterviews"
                            :key="interview.id"
                            :href="`/interviews/${interview.slug}`"
                            :class="[
                                'group w-full rounded-lg border bg-gray-50 p-4 transition hover:border-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:hover:border-blue-400',
                                isToday(interview.scheduled_at) ? 'border-yellow-300 bg-yellow-100' : 'border-gray-200',
                            ]"
                        >
                            <div class="mb-1 flex items-center justify-between">
                                <h3 class="text-md font-bold text-blue-600 group-hover:underline dark:text-blue-400">
                                    {{ interview.job_application?.position }} @ {{ interview.job_application?.company }}
                                </h3>
                                <span class="flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400">
                                    {{ new Date(interview.scheduled_at).toLocaleDateString() }}
                                    <span v-if="isToday(interview.scheduled_at)" class="ml-2 font-bold text-red-600"> Today </span>
                                </span>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">📍 {{ interview.location }}</div>
                        </Link>
                    </div>
                    <p v-if="!props.nextInterviews.length" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        No interviews scheduled for this month.
                    </p>
                </div>
                <!-- Status Chart -->
                <div class="rounded-xl bg-white p-4 shadow dark:bg-gray-900">
                    <h2 class="mb-2 text-lg font-semibold">Status Chart</h2>
                    <canvas ref="chartRef" height="150"></canvas>
                </div>
            </div>
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative mt-4 min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
