'use client';
import { useEffect, useState } from 'react';
const API = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8080';
const TENANT = process.env.NEXT_PUBLIC_TENANT || 'ideaholiday.local';

export default function Agent(){
  const [info,setInfo]=useState<any>(null);
  useEffect(()=>{ fetch(`${API}/api/ping`,{headers:{'X-Tenant-Domain':TENANT}}).then(r=>r.json()).then(setInfo); },[]);
  return (<main className="p-6 max-w-4xl mx-auto">
    <h1 className="text-2xl font-bold mb-2">B2B — Agent Dashboard</h1>
    <p className="text-sm text-gray-600 mb-4">Tenant context & API health</p>
    <pre className="bg-gray-100 p-3 rounded">{JSON.stringify(info,null,2)}</pre>
  </main>);
}
