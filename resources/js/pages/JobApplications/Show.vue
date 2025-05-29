<script setup>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

defineProps({
  application: Object
})
</script>

<template>
  <AppLayout>
    <div class="p-6">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Application Details</h1>
        <Link href="/job-applications" class="text-gray-600 hover:text-gray-900 underline">Back</Link>
      </div>

      <!-- Application Info Card -->
      <div class="rounded-2xl border border-gray-200 bg-white dark:bg-gray-900 shadow p-6 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-2">
          {{ application.position }} <span class="text-gray-400 font-normal">@</span> {{ application.company }}
        </h2>
        <div class="flex flex-wrap gap-4 items-center mb-4">
          <span
            :class="[
              'rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide',
              application.status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '',
              application.status === 'accepted' ? 'bg-green-100 text-green-700' : '',
              application.status === 'rejected' ? 'bg-red-100 text-red-700' : '',
              !['pending', 'accepted', 'rejected'].includes(application.status) ? 'bg-gray-100 text-gray-700' : '',
            ]"
          >
            {{ application.status }}
          </span>
          <span class="text-sm text-gray-500 dark:text-gray-400">
            Applied: {{ new Date(application.applied_at).toLocaleDateString() }}
          </span>
        </div>
        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
          <li><strong>Company:</strong> {{ application.company }}</li>
          <li><strong>Position:</strong> {{ application.position }}</li>
          <li><strong>Status:</strong> {{ application.status }}</li>
          <li><strong>Applied At:</strong> {{ new Date(application.applied_at).toLocaleDateString() }}</li>
        </ul>
      </div>

      <!-- Notes Section -->
      <div class="rounded-2xl border border-gray-200 bg-white dark:bg-gray-900 shadow p-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Notes</h2>
          <Link
            :href="`/notes/create?job_application_id=${application.id}`"
            class="rounded bg-gray-900 text-white px-4 py-1.5 text-sm font-medium shadow hover:bg-gray-700 transition"
          >
            + Add Note
          </Link>
        </div>

        <div v-if="application.notes && application.notes.length" class="space-y-4">
          <div
            v-for="note in application.notes"
            :key="note.id"
            class="rounded-xl border border-gray-100 bg-gray-50 dark:bg-gray-800 p-4 shadow-sm"
          >
            <p class="text-gray-800 dark:text-gray-100 whitespace-pre-line">{{ note.content }}</p>
            <div class="mt-3 flex gap-4 text-sm">
              <Link :href="`/notes/${note.id}`" class="text-green-600 hover:underline">Show</Link>
              <Link :href="`/notes/${note.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
            </div>
          </div>
        </div>
        <p v-else class="text-gray-500 text-sm">No notes yet.</p>
      </div>
    </div>
  </AppLayout>
</template>