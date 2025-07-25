const API_BASE = 'http://localhost:8000/api';

export async function getDesa() {
  const res = await fetch(`${API_BASE}/desa`);
  return res.json();
}

export async function updateDesa(id: number, data: any) {
  const res = await fetch(`http://localhost:8000/api/desa/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data),
  });

  if (!res.ok) {
    throw new Error('Gagal mengupdate data desa.');
  }

  return await res.json();
}
