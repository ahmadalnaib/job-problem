<script setup>
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
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
  <div class=" p-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold">Notes</h1>
      <Link href="/notes/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + New Note
      </Link>
    </div>

    <div v-if="notes.length" class="space-y-4">
      <div v-for="note in notes" :key="note.id" class="p-4 bg-white shadow rounded">
        <div class="flex justify-between items-center">
          <div>
            <h2 class="font-bold text-gray-800">
              {{ note.job_application?.position }} @ {{ note.job_application?.company }}
            </h2>
            <p class="text-gray-600 mt-1 whitespace-pre-line">{{ note.content }}</p>
          </div>
          <div class="flex gap-2">
            <Link :href="`/notes/${note.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
            <Link :href="`/notes/${note.id}`" class="text-green-600 hover:underline">Show</Link>
            <button @click="deleteNote(note.id)" class="text-red-600 hover:underline">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <p v-else class="text-gray-500">No notes available.</p>
  </div>
  </AppLayout>
</template>
