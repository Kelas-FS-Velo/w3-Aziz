<template>
  <div class="max-w-7xl mx-auto px-4 py-8">
    <form
      @submit.prevent="submitFormDataBuku"
      enctype="multipart/form-data"
      class="grid grid-cols-1 md:grid-cols-2 gap-6"
    >
      <div class="col-span-1 md:col-span-2">
        <h2 class="text-xl font-bold text-gray-800">Tambah Buku</h2>
        <hr class="my-4" />
      </div>

      <div class="space-y-6">
        <!-- judul buku -->
        <div class="form-group">
          <label for="judul" class="block text-sm font-medium text-gray-700"
            >Judul Buku</label
          >
          <div class="mt-2">
            <input
              type="text"
              v-model="post.judul"
              id="judul"
              class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan Judul Buku"
            />
          </div>
          <div v-if="validation.judul" class="mt-2">
            <UAlert class="text-red-600">{{ validation.judul[0] }}</UAlert>
          </div>
        </div>

        <!-- penulis -->
        <div class="form-group">
          <label for="penulis" class="block text-sm font-medium text-gray-700"
            >Penulis</label
          >
          <div class="mt-2">
            <input
              type="text"
              v-model="post.penulis"
              id="penulis"
              class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan Penulis Buku"
            />
          </div>
          <div v-if="validation.penulis" class="mt-2">
            <UAlert class="text-red-600">{{ validation.penulis[0] }}</UAlert>
          </div>
        </div>

        <!-- penerbit -->
        <div class="form-group">
          <label for="penerbit" class="block text-sm font-medium text-gray-700"
            >Penerbit</label
          >
          <div class="mt-2">
            <input
              type="text"
              v-model="post.penerbit"
              id="penerbit"
              class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan Penerbit Buku"
            />
          </div>
          <div v-if="validation.penerbit" class="mt-2">
            <UAlert class="text-red-600">{{ validation.penerbit[0] }}</UAlert>
          </div>
        </div>

        <!-- tahun terbit -->
        <div class="form-group">
          <label
            for="tahun_terbit"
            class="block text-sm font-medium text-gray-700"
            >Tahun Terbit</label
          >
          <div class="mt-2">
            <input
              type="number"
              v-model="post.tahun_terbit"
              id="tahun_terbit"
              min="1900"
              max="2099"
              class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan Tahun Terbit"
            />
          </div>
          <div v-if="validation.tahun_terbit" class="mt-2">
            <UAlert class="text-red-600">{{
              validation.tahun_terbit[0]
            }}</UAlert>
          </div>
        </div>

        <!-- isbn -->
        <div class="form-group">
          <label for="isbn" class="block text-sm font-medium text-gray-700"
            >ISBN</label
          >
          <div class="mt-2">
            <input
              type="number"
              v-model="post.isbn"
              id="isbn"
              class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan ISBN Buku"
            />
          </div>
          <div v-if="validation.isbn" class="mt-2">
            <UAlert class="text-red-600">{{ validation.isbn[0] }}</UAlert>
          </div>
        </div>

        <!-- jumlah halaman -->
        <div class="form-group">
          <label
            for="jumlah_halaman"
            class="block text-sm font-medium text-gray-700"
            >Jumlah Halaman</label
          >
          <div class="mt-2">
            <input
              type="number"
              v-model="post.jumlah_halaman"
              id="jumlah_halaman"
              class="max-w-4xl px-3 py-2 w-full rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan Jumlah Halaman Buku"
            />
          </div>
          <div v-if="validation.jumlah_halaman" class="mt-2">
            <UAlert class="text-red-600">{{
              validation.jumlah_halaman[0]
            }}</UAlert>
          </div>
        </div>
      </div>

      <div class="space-y-6">
        <!-- kategori -->
        <div class="form-group">
          <label for="kategori" class="block text-sm font-medium text-gray-700"
            >Kategori</label
          >
          <div class="mt-2">
            <input
              type="text"
              v-model="post.kategori"
              id="kategori"
              class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan Kategori Buku"
            />
          </div>
          <div v-if="validation.kategori" class="mt-2">
            <UAlert class="text-red-600">{{ validation.kategori[0] }}</UAlert>
          </div>
        </div>

        <!-- sinopsis -->
        <div class="form-group">
          <label for="sinopsis" class="block text-sm font-medium text-gray-700"
            >Sinopsis</label
          >
          <div class="mt-2">
            <input
              v-model="post.sinopsis"
              id="sinopsis"
              class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan Sinopsis Buku"
            />
          </div>
          <div v-if="validation.sinopsis" class="mt-2">
            <UAlert class="text-red-600">{{ validation.sinopsis[0] }}</UAlert>
          </div>
        </div>

        <!-- cover buku -->
        <div class="form-group">
          <label
            for="cover_buku"
            class="block text-sm font-medium text-gray-700"
            >Cover Buku</label
          >
          <div class="mt-2">
            <input
              type="file"
              id="cover_buku"
              @change="handleFileUpload"
              accept="image/*"
            />
          </div>
          <div v-if="validation.cover_buku" class="mt-2">
            <UAlert class="text-red-600">{{ validation.cover_buku[0] }}</UAlert>
          </div>
        </div>

        <!-- status -->
        <div class="form-group">
          <label for="status" class="block text-sm font-medium text-gray-700"
            >Status</label
          >
          <div class="mt-2">
            <select
              v-model="post.status"
              id="status"
              class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
              <option value="" disabled selected>Pilih Status Buku</option>
              <option value="tersedia">Tersedia</option>
              <option value="dipinjam">Dipinjam</option>
              <option value="rusak">Rusak</option>
            </select>
          </div>
          <div v-if="validation.status" class="mt-2">
            <UAlert class="text-red-600">{{ validation.status[0] }}</UAlert>
          </div>
        </div>

        <!-- lokasi rak -->
        <div class="form-group">
          <label
            for="lokasi_rak"
            class="block text-sm font-medium text-gray-700"
            >Lokasi Rak</label
          >
          <div class="mt-2">
            <input
              type="text"
              v-model="post.lokasi_rak"
              id="lokasi_rak"
              class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan Lokasi Rak Buku"
            />
          </div>
          <div v-if="validation.lokasi_rak" class="mt-2">
            <UAlert class="text-red-600">{{ validation.lokasi_rak[0] }}</UAlert>
          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="col-span-1 md:col-span-2 mt-6">
        <UButton
          label="Show toast"
          color="neutral"
          variant="outline"
          @click="showToast"
          class="w-full rounded-md px-4 py-3 text-white bg-green-600 font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
          type="submit"
        >
          Kirim
        </UButton>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      //State buku
      post: {
        judul: "",
        penulis: "",
        penerbit: "",
        tahun_terbit: "",
        isbn: "",
        jumlah_halaman: "",
        kategori: "",
        sinopsis: "",
        cover_buku: "",
        status: "",
        lokasi_rak: "",
      },

      //State validation
      validation: {},
    };
  },

  methods: {
    //Tambah method untuk cover buku type file
    handleFileUpload(event) {
      this.post.cover_buku = event.target.files[0];
    },
    async submitFormDataBuku(e) {
      e.preventDefault();

      //Data yang dikirim ke server
      const formData = new FormData();
      formData.append("judul", this.post.judul);
      formData.append("penulis", this.post.penulis);
      formData.append("penerbit", this.post.penerbit);
      formData.append("tahun_terbit", this.post.tahun_terbit);
      formData.append("isbn", this.post.isbn);
      formData.append("jumlah_halaman", this.post.jumlah_halaman);
      formData.append("kategori", this.post.kategori);
      formData.append("sinopsis", this.post.sinopsis);
      formData.append("cover_buku", this.post.cover_buku);
      formData.append("status", this.post.status);
      formData.append("lokasi_rak", this.post.lokasi_rak);

      try {
        await axios.post("http://localhost:8000/api/buku", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });

        //Menampilkan toast notification
        this.$toast.success("Buku berhasil ditambahkan!", {
          position: "top-right",
          duration: 1500,
          dismissible: true,
        });

        //Redirect ke route "buku"
        this.$router.push({ name: "buku" });
      } catch (error) {
        //Periksa response datanya
        if (error.response && error.response.data) {
          this.validation = error.response.data;
          this.$toast.error(
            "Gagal menambahkan buku. Periksa kembali data anda.",
            {
              position: "top-right",
              duration: 2000,
              dismissible: true,
            }
          );
        } else {
          console.error("Unexpected error:", error);
          this.$toast.error("Terjadi kesalahan pada sistem.", {
            position: "top-right",
            duration: 2000,
            dismissible: true,
          });
        }
      }
    },
  },
};
</script>
