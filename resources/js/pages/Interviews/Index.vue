<template>
  <div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Interviews</h1>

    <div class="mb-4">
      <Link
        href="/interviews/create"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
      >
        + New Interview
      </Link>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Company
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Position
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Scheduled At
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Location
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="interview in interviews" :key="interview.id">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ interview.job_application.company }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ interview.job_application.position }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ formatDate(interview.scheduled_at) }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ interview.location }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <Link
                :href="`/interviews/${interview.id}/edit`"
                class="text-blue-600 hover:underline mr-2"
              >
                Edit
              </Link>
              <button
                @click="deleteInterview(interview.id)"
                class="text-red-600 hover:underline"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'

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
