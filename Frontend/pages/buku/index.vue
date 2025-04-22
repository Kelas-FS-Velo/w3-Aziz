<template>
  <div class="container mx-auto py-6 px-4">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <div class="p-6">
        <h5 class="text-xl font-semibold mb-2">Data Buku</h5>
        <hr class="mb-4" />
        <NuxtLink to="/buku/create">
          <button
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 transition duration-200"
          >
            Tambah
          </button>
        </NuxtLink>

        <!-- Reponsive Table Data -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
              <tr>
                <th
                  class="px-4 py-3 text-left text-sm font-medium text-gray-700"
                >
                  Judul
                </th>
                <th
                  class="px-4 py-3 text-left text-sm font-medium text-gray-700"
                >
                  Penulis
                </th>
                <th
                  class="px-4 py-3 text-left text-sm font-medium text-gray-700"
                >
                  Penerbit
                </th>
                <th
                  class="px-4 py-3 text-left text-sm font-medium text-gray-700"
                >
                  Tahun
                </th>
                <th
                  class="px-4 py-3 text-left text-sm font-medium text-gray-700"
                >
                  ISBN
                </th>
                <th
                  class="px-4 py-3 text-left text-sm font-medium text-gray-700"
                >
                  Halaman
                </th>
                <th
                  class="px-4 py-3 text-left text-sm font-medium text-gray-700"
                >
                  Kategori
                </th>
                <th
                  class="px-4 py-3 text-left text-sm font-medium text-gray-700"
                >
                  Status
                </th>
                <th
                  class="px-4 py-3 text-left text-sm font-medium text-gray-700"
                >
                  Lokasi
                </th>
                <th
                  class="px-4 py-3 text-left text-sm font-medium text-gray-700"
                >
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr
                v-for="item in buku"
                :key="item.id"
                class="hover:bg-gray-50 transition duration-150"
              >
                <td class="px-4 py-3 whitespace-nowrap">
                  <div class="font-medium text-gray-900">{{ item.judul }}</div>
                  <div
                    v-if="item.sinopsis"
                    class="text-xs text-gray-500 truncate max-w-xs"
                  >
                    {{ item.sinopsis }}
                  </div>
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                  {{ item.penulis }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                  {{ item.penerbit }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                  {{ item.tahun_terbit }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                  {{ item.isbn }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                  {{ item.jumlah_halaman }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                  {{ item.kategori }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm">
                  <span
                    :class="{
                      'px-2 py-1 text-xs font-medium rounded-full': true,
                      'bg-green-100 text-green-800': item.status === 'Tersedia',
                      'bg-red-100 text-red-800': item.status === 'Dipinjam',
                      'bg-yellow-100 text-yellow-800':
                        item.status === 'Dipesan',
                    }"
                  >
                    {{ item.status }}
                  </span>
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                  {{ item.lokasi_rak }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm">
                  <div class="flex gap-2">
                    <NuxtLink :to="`/buku/edit/${item.id}`">
                      <button
                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition duration-200"
                      >
                        Edit
                      </button>
                    </NuxtLink>
                    <Ubutton
                      label="Show Toast"
                      color="neutral"
                      variant="outline"
                      type="button"
                      class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition duration-200 cursor-pointer"
                      @click="deleteData(item.id)"
                    >
                      Delete
                    </Ubutton>
                  </div>
                </td>
              </tr>
              <!-- Default Baris Data Kosong -->
              <tr v-if="!buku || buku.length === 0">
                <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                  Tidak ada data buku tersedia
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useFetch } from "#app";
import { useToast } from "vue-toast-notification";

const toast = useToast();
const buku = ref([]);

const fetchDataBuku = async () => {
  try {
    const response = await $fetch("http://localhost:8000/api/buku");
    console.log("HASIL FETCH:", response);

    if (response && response.data) {
      buku.value = response.data;
    } else {
      console.error("Gagal ambil data:", error.value || "Format tidak sesuai");
      //Menampilkan toast notification
      toast.error("Gagal mengambil data buku!", {
        position: "top-right",
        duration: 1500,
        dismissible: true,
      });
    }
  } catch (error) {
    console.error("Error fetching data", error);
    //Menampilkan toast notification
    toast.error("Terjadi kesalahan saat mengambil data", {
      position: "top-right",
      duration: 1500,
      dismissible: true,
    });
  }
};
const deleteData = async (id) => {
  try {
    const { data, error } = await useFetch(
      `http://localhost:8000/api/buku/${id}`,
      {
        method: "DELETE",
      }
    );

    if (error.value) {
      console.error("Gagal menghapus data", error.value);
      //Menampilkan toast notification
      toast.error("Gagal menghapus data buku!", {
        position: "top-right",
        duration: 1500,
        dismissible: true,
      });
      return { success: false, error };
    }

    await fetchDataBuku();
    //Menampilkan toast notification
    toast.success("Data buku berhasil dihapus!", {
      position: "top-right",
      duration: 1500,
      dismissible: true,
    });
    return { success: true, data };
  } catch (error) {
    console.error("Gagal menghapus data", error);
    //Menampilkan toast notification
    toast.error("Terjadi kesalahan saat menghapus data", {
      position: "top-right",
      duration: 1500,
      dismissible: true,
    });
    return { success: false, error };
  }
};

onMounted(() => {
  fetchDataBuku();
});
</script>
