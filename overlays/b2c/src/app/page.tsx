'use client';
import { useState } from 'react';
const API = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8080';
const TENANT = process.env.NEXT_PUBLIC_TENANT || 'ideaholiday.local';

export default function Home(){
  const [from,setFrom]=useState('DEL'); const [to,setTo]=useState('BOM');
  const [dep,setDep]=useState(new Date().toISOString().slice(0,10));
  const [loading,setLoading]=useState(false); const [results,setResults]=useState<any[]>([]);

  const search=async()=>{
    setLoading(true); setResults([]);
    const r = await fetch(`${API}/api/v1/search/flights`,{
      method:'POST', headers:{'Content-Type':'application/json','X-Tenant-Domain':TENANT},
      body: JSON.stringify({from,to,depDate:dep,adults:1})
    }); const data = await r.json(); setResults(data.results||[]); setLoading(false);
  };

  return (<main className="p-6 max-w-3xl mx-auto">
    <h1 className="text-2xl font-bold mb-4">B2C — Flight Search</h1>
    <div className="grid grid-cols-2 gap-3 mb-4">
      <input className="border p-2" value={from} onChange={e=>setFrom(e.target.value.toUpperCase())} placeholder="From (IATA)" />
      <input className="border p-2" value={to} onChange={e=>setTo(e.target.value.toUpperCase())} placeholder="To (IATA)" />
      <input className="border p-2" type="date" value={dep} onChange={e=>setDep(e.target.value)} />
      <button className="border p-2" onClick={search} disabled={loading}>{loading?'Searching...':'Search'}</button>
    </div>
    <ul className="space-y-3">{results.map((r:any)=>(
      <li key={r.id} className="border p-3 rounded">
        <div className="font-medium">{r.carrier} {r.flight} • {r.from} → {r.to}</div>
        <div>{r.dep} → {r.arr} • Stops: {r.stops}</div>
        <div className="font-bold">₹ {r.total} {r.currency}</div>
      </li>))}
    </ul>
  </main>);
}
