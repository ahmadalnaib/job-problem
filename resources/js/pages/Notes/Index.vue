<script setup>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, watchEffect } from 'vue';

const props = defineProps({
  notes: Array
});

const selected = ref(null);

watchEffect(() => {
  if (!selected.value && props.notes.length > 0) {
    selected.value = props.notes[0];
  }
});

const selectNote = (note) => {
  selected.value = note;
};

const deleteNote = (id) => {
  if (confirm('Delete this note?')) {
    router.delete(`/notes/${id}`);
    if (selected.value && selected.value.id === id) {
      selected.value = null;
    }
  }
};
</script>


<template>
  <AppLayout>
    <div class="container mx-auto flex h-[70vh] overflow-hidden rounded-xl bg-white px-2 py-10 shadow dark:bg-gray-900">
      <!-- Sidebar: Notes List -->
      <div class="flex w-1/3 flex-col overflow-y-auto border-r border-gray-200 dark:border-gray-800">
        <div class="flex items-center justify-between px-4 pt-4 pb-2">
          <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100">Notes</h2>
          <Link
            href="/notes/create"
            class="ml-2 rounded bg-gray-900 px-3 py-1 text-sm font-medium text-white shadow transition hover:bg-gray-800"
          >
            + New
          </Link>
        </div>
        <ul class="flex-1">
          <li
            v-for="note in notes"
            :key="note.id"
            @click="selectNote(note)"
            :class="[
              'cursor-pointer border-b border-gray-100 px-4 py-3 transition hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-800',
              selected && selected.id === note.id ? 'bg-gray-100 font-semibold dark:bg-gray-800' : '',
            ]"
          >
            <div class="flex items-center justify-between">
              <span>{{ note.job_application?.position }}</span>
            </div>
            <div class="text-xs text-gray-500">{{ note.job_application?.company }}</div>
          </li>
        </ul>
      </div>

      <!-- Main: Note Details -->
      <div class="flex-1 overflow-y-auto p-6 flex flex-col h-full">
        <div v-if="selected" class="flex flex-col h-full">
          <div>
            <h2 class="mb-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
              {{ selected.job_application?.position }}
              <span class="font-normal text-gray-400">@</span>
              {{ selected.job_application?.company }}
            </h2>
            <div class="mb-4 text-gray-700 dark:text-gray-200 whitespace-pre-line">
              {{ selected.content }}
            </div>
          </div>
          <!-- Action buttons fixed at the bottom right -->
          <div class="mt-auto flex justify-end gap-2 pt-6">
            <Link
              :href="`/notes/${selected.id}/edit`"
              class="flex items-center gap-1 rounded-full bg-gray-100 px-4 py-2 font-medium text-gray-900 transition hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
              title="Edit"
            >
              <!-- Heroicon: Pencil Square -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182l-10.5 10.5a2.25 2.25 0 01-1.06.592l-4.5 1a.75.75 0 01-.91-.91l1-4.5a2.25 2.25 0 01.592-1.06l10.5-10.5z" />
              </svg>
              Edit
            </Link>
            <button
              @click="deleteNote(selected.id)"
              class="flex items-center gap-1 rounded-full bg-gray-100 px-4 py-2 font-medium text-red-600 transition hover:bg-gray-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
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
        <div v-else class="flex items-center justify-center h-full text-gray-400">
          <span>Select a note to view details</span>
        </div>
      </div>
    </div>
  </AppLayout>
</template>