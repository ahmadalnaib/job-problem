<template>
  <AppLayout>
    <div class="container mx-auto py-10 px-2">
      <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center tracking-tight">Interviews</h1>

      <div class="mb-4 flex justify-center">
        <Link
          href="/interviews/create"
          class="bg-gray-900 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-800 transition font-medium"
        >
          + New Interview
        </Link>
      </div>

      <div v-if="interviews.length" class="space-y-5">
        <div
          v-for="interview in interviews"
          :key="interview.id"
          class="rounded-xl border border-gray-200 bg-white dark:bg-gray-900 p-4 shadow-sm hover:shadow-md transition flex flex-col gap-2"
        >
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
            <div>
              <div class="text-base font-semibold text-gray-900 dark:text-gray-100">
                {{ interview.job_application.position }}
                <span class="text-gray-400 font-normal">@</span>
                {{ interview.job_application.company }}
              </div>
              <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                {{ interview.location }}
              </div>
            </div>
            <div class="flex gap-2 mt-2 md:mt-0">
              <span class="inline-block rounded-full bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300 px-2 py-0.5 text-xs font-semibold">
                {{ formatDate(interview.scheduled_at) }}
              </span>
            </div>
          </div>
          <div class="flex gap-3 mt-3 justify-end">
            <Link
              :href="`/interviews/${interview.id}/edit`"
              class="rounded px-3 py-1 text-gray-900 bg-gray-100 hover:bg-gray-200 font-medium transition dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
            >
              Edit
            </Link>
            <button
              @click="deleteInterview(interview.id)"
              class="rounded px-3 py-1 text-red-600 bg-gray-100 hover:bg-gray-200 font-medium transition dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
      <p v-else class="mt-8 text-gray-500 text-center">No interviews found.</p>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
  interviews: Array,
})

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