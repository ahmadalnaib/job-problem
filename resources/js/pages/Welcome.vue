<script setup >
import { Dialog, DialogPanel } from '@headlessui/vue';
import { ChevronRightIcon } from '@heroicons/vue/20/solid';
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const navigation = [
    { name: 'Product', href: '#' },
    { name: 'Features', href: '#' },
    { name: 'Marketplace', href: '#' },
    { name: 'Company', href: '#' },
];

const mobileMenuOpen = ref(false);
</script>

<template>
    <Head title="HumanHup - Job Application & Interview Management" >
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="min-h-screen bg-white dark:bg-[#0a0a0a]">
        <!-- Header -->
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">HumanHup</span>
                        <img class="h-12 w-auto" src="/img/humanhup-logo.png" alt="Humanhup Logo" />
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button
                        type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = true"
                    >
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon class="size-6" aria-hidden="true" />
                    </button>
                </div>
                <!-- <div class="hidden lg:flex lg:gap-x-12">
                    <a
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        class="text-sm/6 font-semibold text-gray-900 dark:text-gray-100"
                        >{{ item.name }}</a
                    >
                </div> -->
                <div class="hidden gap-2 lg:flex lg:flex-1 lg:justify-end">
                    <Link v-if="$page.props.auth?.user" :href="route('dashboard')" class="text-sm/6 font-semibold text-gray-900 dark:text-gray-100">
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link :href="route('login')" class="text-sm/6 font-semibold text-gray-900 dark:text-gray-100">
                            Log in <span aria-hidden="true">&rarr;</span>
                        </Link>
                    </template>
                </div>
            </nav>
            <!-- Mobile menu dialog -->
            <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
                <div class="fixed inset-0 z-50" />
                <DialogPanel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">HumanHup</span>
                            <img class="h-8 w-auto" src="/img/humanhup-logo.png" alt="Humanhup Logo" />
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                            <span class="sr-only">Close menu</span>
                            <XMarkIcon class="size-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :href="item.href"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                                    >{{ item.name }}</a
                                >
                            </div>
                            <div class="flex flex-col gap-2 py-6">
                                <Link
                                    v-if="$page.props.auth?.user"
                                    :href="route('dashboard')"
                                    class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                                >
                                    Dashboard
                                </Link>
                                <template v-else>
                                    <Link
                                        :href="route('login')"
                                        class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        :href="route('register')"
                                        class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                                    >
                                        Register
                                    </Link>
                                </template>
                            </div>
                        </div>
                    </div>
                </DialogPanel>
            </Dialog>
        </header>

        <!-- Hero Section -->
        <div class="relative isolate pt-14">
            <svg
                class="absolute inset-0 -z-10 h-full w-full [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)] stroke-gray-200"
                aria-hidden="true"
            >
                <defs>
                    <pattern id="pattern" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
                        <path d="M100 200V.5M.5 .5H200" fill="none" />
                    </pattern>
                </defs>
                <svg x="50%" y="-1" class="overflow-visible fill-gray-50">
                    <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M-300.5 600h201v201h-201Z" stroke-width="0" />
                </svg>
                <rect width="100%" height="100%" stroke-width="0" fill="url(#pattern)" />
            </svg>
            <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:flex lg:items-center lg:gap-x-10 lg:px-8 lg:py-40">
                <div class="mx-auto max-w-2xl lg:mx-0 lg:flex-auto">
                    <div class="flex">
                        <div
                            class="relative flex items-center gap-x-4 rounded-full bg-white px-4 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20"
                        >
                            <span class="font-semibold text-orange-600">iOS</span>
                            <span class="h-4 w-px bg-gray-900/10" aria-hidden="true" />
                              <span class="font-semibold text-indigo-600">Web</span>
                                <span class="h-4 w-px bg-gray-900/10" aria-hidden="true" />
                            <a href="#" class="flex items-center gap-x-1">
                                <span class="absolute inset-0" aria-hidden="true" />
                               Android
                                <ChevronRightIcon class="-mr-2 size-5 text-gray-400" aria-hidden="true" />
                            </a>
                              
                        </div>
                    </div>
                    <h1 class="mt-10 text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-6xl dark:text-gray-100">
                        Job Application & Interview <br />
                        Management Platform
                    </h1>
                    <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8 dark:text-gray-300">
                        HumanHup is a web application designed to help you efficiently manage your job search and interviews in one place. Track every
                        application, schedule interviews, and never miss an opportunity.
                    </p>

                    <div class="mt-10 flex items-center gap-x-6">
                        <Link
                            v-if="!$page.props.auth?.user"
                            :href="route('register')"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Get started
                        </Link>
                        <Link v-if="!$page.props.auth?.user" :href="route('login')" class="text-sm/6 font-semibold text-gray-900 dark:text-gray-100">
                            Log in <span aria-hidden="true">&rarr;</span>
                        </Link>
                        <Link
                            v-if="$page.props.auth?.user"
                            :href="route('dashboard')"
                            class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Go to Dashboard
                        </Link>
                    </div>
                </div>
                <div class="mt-16 flex items-center justify-center sm:mt-24 lg:mt-0 lg:shrink-0 lg:grow">
                    <img src="/img/showcasePhone.png" alt="App screenshot" class="mx-auto w-[22.875rem] max-w-full rounded-2xl drop-shadow-xl" />
                </div>
            </div>
        </div>
    </div>
</template>
