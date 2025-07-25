<script lang="ts">
  import { onMount } from "svelte";
  let semuaDesa: any[] = [];
  let search = "";
  let desaList: any[] = [];
  let filteredList: any[] = [];
  let nomor = "";
  let nama = "";
  let kepala_desa = "";
  let alamat = "";
  let editingId: number | null = null;

  async function loadDesa() {
    const res = await fetch("http://localhost:8000/api/desa");
    desaList = await res.json();
    console.log("semua desa:", desaList);
    console.log(desaList);
  }

  async function simpan() {
    const payload = { nomor, nama, kepala_desa, alamat };
    const method = editingId ? "PUT" : "POST";
    const url = editingId
      ? `http://localhost:8000/api/desa/${editingId}`
      : `http://localhost:8000/api/desa`;

    const res = await fetch(url, {
      method,
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload),
    });

    if (res.ok) {
      await loadDesa();
      nomor = nama = kepala_desa = alamat = "";
      editingId = null;
    } else {
      alert("Gagal menyimpan");
    }
  }
  async function tambahDesa() {
    const response = await fetch("http://localhost:8000/api/desa", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ nomor, nama, kepala_desa, alamat }),
    });

    if (response.ok) {
      alert("Berhasil menambahkan desa!");
      nomor = nama = kepala_desa = alamat = "";
    } else {
      alert("Gagal menambahkan desa. Silakan coba lagi.");
    }
  }

  async function hapus(id: number) {
    if (confirm("Yakin hapus data ini?")) {
      await fetch(`http://localhost:8000/api/desa/${id}`, {
        method: "DELETE",
      });
      await loadDesa();
    }
  }

  function edit(desa: any) {
    editingId = desa.id;
    nomor = desa.nomor;
    nama = desa.nama;
    kepala_desa = desa.kepala_desa;
    alamat = desa.alamat;
  }
  onMount(async () => {
    const res = await fetch('http://127.0.0.1:8000/api/desa');
    semuaDesa = await res.json();
    desaList = semuaDesa;
  });

  function cariDesa() {
    const query = search.toLowerCase();
    filteredList = desaList.filter((desa) =>
      desa.nama.toLowerCase().includes(query)
    );
  }
</script>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">
  <a class="navbar-brand" href="#top">Manajemen Data Desa</a>

  <div class="collapse navbar-collapse justify-content-end">
    <form class="d-flex" on:submit|preventDefault={cariDesa}>
      <input
        class="form-control me-2"
        type="search"
        placeholder="Cari Desa"
        bind:value={search}
      />
      <button class="btn btn-light" type="submit">Cari</button>
    </form>
  </div>
</nav>
<table
  class="mt-4 text-center d-flex-justify-content-center container table table-success table-striped-colums"
>
  <thead>
    <tr>
      <th>nomor</th>
      <th>Nama</th>
      <th>Kepala Desa</th>
      <th>Alamat</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    {#each desaList as desa, i}
      <tr>
        <td>{i + 1}</td>
        <td>{desa.nama}</td>
        <td>{desa.kepala_desa}</td>
        <td>{desa.alamat}</td>
        <td class="d-flex justify-content-center gap-2">
          <button
            class="btn btn-primary rounded-1 btn-sm"
            on:click={() => edit(desa)}>Edit</button
          >
          <button
            class="btn btn-danger rounded-1 btn-sm"
            on:click={() => hapus(desa.id)}>Hapus</button
          >
        </td>
      </tr>
    {/each}
  </tbody>
</table>
<div class="card mt-4 table-striped">
  <h2 class="text-center card-header bg-cream text-black">Tambah Data Desa</h2>
  <div class="card-body">
    <form
      on:submit|preventDefault={tambahDesa}
      class="border rounded p-4 shadow-sm"
    >
      <div class="mb-3">
        <label for="inputNomor" class="form-label">Nomor</label>
        <input
          id="inputNomor"
          type="text"
          class="form-control"
          bind:value={nomor}
          placeholder="Contoh: 001"
          required
        />
      </div>

      <div class="mb-3">
        <label for="inputNama" class="form-label">Nama Desa</label>
        <input
          id="inputNama"
          type="text"
          class="form-control"
          bind:value={nama}
          placeholder="Contoh: Waru Timur"
          required
        />
      </div>

      <div class="mb-3">
        <label for="inputKepala" class="form-label">Kepala Desa</label>
        <input
          id="inputKepala"
          type="text"
          class="form-control"
          bind:value={kepala_desa}
          placeholder="Contoh: Bapak Hasbullah"
          required
        />
      </div>

      <div class="mb-3">
        <label for="inputAlamat" class="form-label">Alamat</label>
        <input
          id="inputAlamat"
          type="text"
          class="form-control"
          bind:value={alamat}
          placeholder="Contoh: Jl. Raya No. 123"
          required
        />
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>
