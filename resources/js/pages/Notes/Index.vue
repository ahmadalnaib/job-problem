<script setup>
import { Link, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
  notes: Array
})

const deleteNote = (id) => {
  if (confirm('Delete this note?')) {
    router.delete(`/notes/${id}`)
  }
}
</script>

<template>
  <AppLayout>
    <div class="container mx-auto py-10 px-2">
      <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Notes</h1>
        <Link href="/notes/create" class="bg-gray-900 text-white px-4 py-2 rounded shadow hover:bg-gray-800 transition">
          + New Note
        </Link>
      </div>

      <div v-if="notes.length" class="space-y-5">
        <div
          v-for="note in notes"
          :key="note.id"
          class="rounded-xl border border-gray-200 bg-white dark:bg-gray-900 p-4 shadow-sm hover:shadow-md transition flex flex-col gap-2"
        >
          <div class="flex justify-between items-start gap-4">
            <div>
              <Link
                :href="`/notes/${note.id}`"
                class="font-semibold text-gray-900 dark:text-gray-100 text-base hover:underline"
              >
                {{ note.job_application?.position }} <span class="text-gray-400 font-normal">@</span> {{ note.job_application?.company }}
              </Link>
              <p class="text-gray-600 dark:text-gray-300 mt-1 whitespace-pre-line text-sm">{{ note.content }}</p>
            </div>
            <div class="flex flex-col gap-2 items-end">
              <Link
                :href="`/notes/${note.id}/edit`"
                class="px-3 py-1 rounded-full bg-gray-100 text-gray-900 text-xs font-medium hover:bg-gray-200 transition dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
              >
                Edit
              </Link>
              <button
                @click="deleteNote(note.id)"
                class="px-3 py-1 rounded-full bg-gray-100 text-red-600 text-xs font-medium hover:bg-gray-200 transition dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
      <p v-else class="mt-8 text-gray-500 text-center">No notes available.</p>
    </div>
  </AppLayout>
</template>