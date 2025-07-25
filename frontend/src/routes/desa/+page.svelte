<script lang="ts">
  import { onMount } from "svelte";
  let desaList: any[] = [];
  let nama = "";
  let kepala_desa = "";
  let alamat = "";
  let editingId: number | null = null;

  async function loadDesa() {
    const res = await fetch("http://localhost:8000/api/desa");
    desaList = await res.json();
  }

  async function simpan() {
    const payload = { nama, kepala_desa, alamat };
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
      nama = kepala_desa = alamat = "";
      editingId = null;
    } else {
      alert("Gagal menyimpan");
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
    nama = desa.nama;
    kepala_desa = desa.kepala_desa;
    alamat = desa.alamat;
  }

  onMount(loadDesa);
</script>

<h1>Manajemen Data Desa</h1>

<table border="1" cellpadding="8" class="w-full text-sm">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Kepala Desa</th>
      <th>Alamat</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    {#each desaList as desa}
      <tr>
        <td>{desa.nama}</td>
        <td>{desa.kepala_desa}</td>
        <td>{desa.alamat}</td>
        <td>
          <button on:click={() => edit(desa)}>Edit</button>
          <button on:click={() => hapus(desa.id)}>Hapus</button>
        </td>
      </tr>
    {/each}
  </tbody>
</table>

<h2>{editingId ? "Edit Desa" : "Tambah Desa"}</h2>
<form on:submit|preventDefault={simpan} class="space-y-2">
  <input bind:value={nama} placeholder="Nama Desa" required />
  <input bind:value={kepala_desa} placeholder="Kepala Desa" required />
  <input bind:value={alamat} placeholder="Alamat" required />
  <button type="submit">{editingId ? "Update" : "Simpan"}</button>
</form>
