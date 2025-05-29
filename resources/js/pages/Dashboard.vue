<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Chart, registerables } from 'chart.js';

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
      <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <!-- Jobs Applied -->
        <div class="rounded-xl bg-white p-4 shadow dark:bg-gray-900">
          <h2 class="text-lg font-semibold">Jobs Applied</h2>
          <p class="text-2xl">{{ props.jobCount }}</p>
        </div>
        <!-- Upcoming Interviews Section (scrollable) -->
        <div class="rounded-xl bg-white p-4 shadow dark:bg-gray-900">
          <h2 class="mb-4 text-lg font-semibold">Upcoming Interviews (This Month)</h2>
          <div class="flex space-x-4 overflow-x-auto pb-2">
            <Link
              v-for="interview in props.nextInterviews"
              :key="interview.id"
              :href="`/interviews/${interview.id}`"
              class="group min-w-[280px] flex-shrink-0 rounded-lg border border-gray-200 bg-gray-50 p-4 hover:border-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:hover:border-blue-400 transition"
            >
              <div class="mb-1 flex items-center justify-between">
                <h3 class="text-md font-bold text-blue-600 dark:text-blue-400 group-hover:underline">
                  {{ interview.job_application?.position }} @ {{ interview.job_application?.company }}
                </h3>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                  {{ new Date(interview.scheduled_at).toLocaleDateString() }}
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
      <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
        <PlaceholderPattern />
      </div>
    </div>
  </AppLayout>
</template>