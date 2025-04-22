<template>
  <div>
    <!-- Navbar -->
    <header class="bg-white shadow-md fixed top-0 w-full z-50">
      <div
        class="max-w-7-xl mx-auto px-4 py-4 flex justify-between items-center"
      >
        <!-- Brand -->
        <NuxtLink to="/" class="text-xl font-bold text-gray-800">
          NUXT CRUD
        </NuxtLink>

        <!-- Nav Items -->
        <nav class="space-x-6 hidden lg:block">
          <NuxtLink to="/buku" class="text-gray-700 hover:text-blue-600"
            >POST</NuxtLink
          >
          <a
            href="https://history-covid19.vercel.app/"
            class="text-gray-700 hover:text-blue-600"
            target="_blank"
            >EBOOK</a
          >
          <a
            href="https://website-cyber.vercel.app/"
            class="text-gray-700 hover:text-blue-600"
            target="_blank"
            >COURSE</a
          >
        </nav>
      </div>
    </header>

    <!-- Page Content -->
    <main class="mt-24">
      <NuxtPage />
    </main>
  </div>
</template>
