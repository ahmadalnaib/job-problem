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
      <div class="flex-1 overflow-y-auto p-6">
        <div v-if="selected" class="h-full">
          <h2 class="mb-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ selected.job_application.position }}
            <span class="font-normal text-gray-400">@</span>
            {{ selected.job_application.company }}
          </h2>
          <div class="mb-4 flex flex-wrap gap-3 items-center text-sm text-gray-500 dark:text-gray-400">
            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 dark:bg-gray-800 px-3 py-1 font-semibold text-xs text-gray-700 dark:text-gray-300">
              📅 {{ formatDate(selected.scheduled_at) }}
            </span>
            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 dark:bg-gray-800 px-3 py-1 font-semibold text-xs text-gray-700 dark:text-gray-300">
              📍 {{ selected.location }}
            </span>
          </div>
          <div class="mb-4 text-gray-700 dark:text-gray-200">
            <strong>Location:</strong> {{ selected.location }}
          </div>
          <div class="flex gap-3 mt-2">
            <Link
              :href="`/interviews/${selected.id}/edit`"
              class="rounded bg-gray-100 px-3 py-1 font-medium text-gray-900 transition hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
            >
              Edit
            </Link>
            <button
              @click="deleteInterview(selected.id)"
              class="rounded bg-gray-100 px-3 py-1 font-medium text-red-600 transition hover:bg-gray-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
            >
              Delete
            </button>
          </div>
        </div>
        <div v-else class="flex items-center justify-center h-full text-gray-400">
          <span>Select an interview to view details</span>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
  interviews: Array,
});

const selected = ref(null);

const selectInterview = (interview) => {
  selected.value = interview;
};

const formatDate = (dateStr) => {
  const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' }
  return new Date(dateStr).toLocaleDateString(undefined, options)
}

const deleteInterview = (id) => {
  if (confirm('Are you sure you want to delete this interview?')) {
    router.delete(`/interviews/${id}`)
  }
}
</script>